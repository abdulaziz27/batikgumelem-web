<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    /**
     * Process checkout request
     */
    public function process(Request $request)
    {
        Log::info('Checkout method called');
        Log::info($request->all());

        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'phone' => 'required|string',
            'payment' => 'required|in:midtrans,gopay',
        ]);

        DB::beginTransaction();
        try {
            $cartItems = auth()->user()->carts;

            // Check stock availability before proceeding
            foreach ($cartItems as $item) {
                $product = Product::find($item->product_id);

                if (!$product) {
                    throw new Exception('Product not found: ' . $item->product_id);
                }

                // Check size-specific stock if applicable
                if ($item->product_size_id) {
                    $productSize = ProductSize::find($item->product_size_id);

                    if (!$productSize) {
                        throw new Exception('Product size not found: ' . $item->product_size_id);
                    }

                    if ($productSize->stock < $item->quantity) {
                        if ($productSize->stock <= 0) {
                            throw new Exception('Product size is out of stock: ' . $product->name . ' - ' . $productSize->name);
                        } else {
                            throw new Exception('Not enough stock for ' . $product->name . ' (Size: ' . $productSize->name . '). Available: ' . $productSize->stock);
                        }
                    }
                } else {
                    if ($product->stock < $item->quantity) {
                        if ($product->stock <= 0) {
                            throw new Exception('Product is out of stock: ' . $product->name);
                        } else {
                            throw new Exception('Not enough stock for ' . $product->name . '. Available: ' . $product->stock);
                        }
                    }
                }
            }

            $total = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            $transaction = Transaction::create([
                'user_id' => auth()->id(),
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'address' => $validatedData['address'],
                'phone' => $validatedData['phone'],
                'payment' => $validatedData['payment'],
                'total_price' => $total,
                'status' => 'PENDING',
            ]);

            foreach ($cartItems as $item) {
                // Get size information if available
                $sizeName = null;
                if ($item->product_size_id && $item->size) {
                    $sizeName = $item->size->name;
                }

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item->product_id,
                    'product_size_id' => $item->product_size_id,
                    'size_name' => $sizeName,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);

                // Reduce stock based on the purchase
                if ($item->product_size_id) {
                    // Reduce size-specific stock
                    $productSize = ProductSize::find($item->product_size_id);
                    if ($productSize) {
                        $productSize->stock -= $item->quantity;
                        $productSize->save();

                        // Also update the main product stock to reflect the total remaining stock
                        $product = Product::find($item->product_id);
                        $totalStock = $product->sizes()->sum('stock');
                        $product->stock = $totalStock;
                        $product->save();
                    }
                } else {
                    // Reduce main product stock (for backward compatibility)
                    $product = Product::find($item->product_id);
                    $product->stock -= $item->quantity;
                    $product->save();
                }
            }

            auth()->user()->carts()->delete();

            DB::commit();

            if ($validatedData['payment'] == 'midtrans' || $validatedData['payment'] == 'gopay') {
                $paymentUrl = $this->getSnapToken($transaction);
                $transaction->payment_url = $paymentUrl;
                $transaction->save();

                return redirect($paymentUrl);
            }

            return redirect()->route('checkout-success', ['order_id' => $transaction->id]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Checkout error: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display checkout success page
     */
    public function success(Request $request)
    {
        $orderId = $request->query('order_id');
        $transaction = Transaction::findOrFail($orderId);

        return view('pages.frontend.success', compact('transaction'));
    }

    /**
     * Generate Midtrans payment token
     */
    private function getSnapToken($transaction)
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Generate a unique order ID
        $uniqueOrderId = $transaction->id . '-' . time() . '-' . uniqid();

        $params = [
            'transaction_details' => [
                'order_id' => $uniqueOrderId, // Use the unique order ID
                'gross_amount' => $transaction->total_price,
            ],
            'customer_details' => [
                'first_name' => $transaction->name,
                'email' => $transaction->email,
                'phone' => $transaction->phone,
            ],
        ];

        try {
            Log::info('Generating Snap Token', [
                'transaction_id' => $transaction->id,
                'total_price' => $transaction->total_price,
                'customer_name' => $transaction->name,
            ]);
            $snapToken = Snap::createTransaction($params)->redirect_url;

            // Store the unique order ID in the transaction
            $transaction->midtrans_order_id = $uniqueOrderId;
            $transaction->save();

            return $snapToken;
        } catch (\Exception $e) {
            Log::error('Midtrans Snap Token Generation Error', [
                'error' => $e->getMessage(),
                'transaction_id' => $transaction->id,
            ]);
            throw $e;
        }
    }
}
