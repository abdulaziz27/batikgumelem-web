<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;


class FrontendController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with(['galleries'])->latest()->get();
        $categories = Category::withCount('products')->get();

        return view('pages.frontend.index', compact('products', 'categories'));
    }

    public function details(Request $request, $slug)
    {
        $product = Product::with(['galleries'])->where('slug', $slug)->firstOrFail();
        $recommendations = Product::with(['galleries'])->inRandomOrder()->limit(4)->get();

        return view('pages.frontend.details', compact('product','recommendations'));
    }

    public function cartAdd(Request $request, $id)
    {
        \Log::info('About to Cart Add');


        $cartItem = Cart::where('user_id', Auth::user()->id)
                    ->where('product_id', $id)
                    ->first();

        if ($cartItem) {
            $cartItem->increment('quantity'); // Jika sudah ada, tingkatkan quantity
        } else {
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $id,
                'quantity' => 1, // Default quantity
            ]);
        }

        return redirect('cart')->with('success', 'Item berhasil ditambahkan ke keranjang');
    }

    public function cartDelete(Request $request, $id)
    {
        $item = Cart::findOrFail($id);

        $item->delete();

        return redirect('cart');
    }

    public function cart(Request $request)
    {
        $carts = Cart::with(['product.galleries'])->where('user_id', Auth::user()->id)->get();

        return view('pages.frontend.cart', compact('carts'));
    }

    public function checkout(Request $request)
    {
        \Log::info('Checkout method called');
        \Log::info($request->all());

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
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
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
            \Log::error('Checkout error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat checkout. Silakan coba lagi.');
        }
    }

    private function getSnapToken($transaction)
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $transaction->id,
                'gross_amount' => $transaction->total_price,
            ],
            'customer_details' => [
                'first_name' => $transaction->name,
                'email' => $transaction->email,
                'phone' => $transaction->phone,
            ],
        ];

        try {
            $snapToken = Snap::createTransaction($params)->redirect_url;
            return $snapToken;
        } catch (\Exception $e) {
            \Log::error('Midtrans Error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function success(Request $request)
    {
        $orderId = $request->query('order_id');
        $transaction = Transaction::findOrFail($orderId);

        return view('pages.frontend.success', compact('transaction'));
    }

    public function blogs(Request $request)
    {
        return view('pages.frontend.blogs');
    }

    public function history(Request $request)
    {
        return view('pages.frontend.history');
    }
    public function promotion(Request $request)
    {
        return view('pages.frontend.promotion');
    }

    public function termsCondition(Request $request)
    {
        return view('pages.frontend.terms-condition');
    }

    public function privacyPolicy(Request $request)
    {
        return view('pages.frontend.privacy-policy');
    }

    public function faq(Request $request)
    {
        return view('pages.frontend.faq');
    }
}
