<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Display the cart page.
     */
    public function index(Request $request)
    {
        $carts = Cart::with(['product.galleries', 'size'])->where('user_id', Auth::user()->id)->get();

        // Check if any cart items are out of stock or have reduced availability
        foreach ($carts as $item) {
            // If the cart has a size, check the size stock; otherwise, check the product stock
            if ($item->product_size_id) {
                $sizeStock = $item->size ? $item->size->stock : 0;

                if ($sizeStock <= 0) {
                    $item->stock_warning = 'This product size is now out of stock.';
                } elseif ($item->quantity > $sizeStock) {
                    $item->stock_warning = 'Only ' . $sizeStock . ' items available in this size. Quantity has been adjusted.';
                    $item->update(['quantity' => $sizeStock]);
                }
            } else {
                if ($item->product->stock <= 0) {
                    $item->stock_warning = 'This product is now out of stock.';
                } elseif ($item->quantity > $item->product->stock) {
                    $item->stock_warning = 'Only ' . $item->product->stock . ' items available. Quantity has been adjusted.';
                    $item->update(['quantity' => $item->product->stock]);
                }
            }
        }

        return view('pages.frontend.cart', compact('carts'));
    }

    /**
     * Add a product to the cart.
     */
    public function add(Request $request, $id)
    {
        Log::info('About to Cart Add');

        $product = Product::findOrFail($id);

        // Validate that a size is selected
        $request->validate([
            'size_id' => 'required|exists:product_sizes,id',
        ], [
            'size_id.required' => 'Please select a size before adding to cart.',
            'size_id.exists' => 'The selected size is invalid.',
        ]);

        // Get the selected size
        $productSize = ProductSize::findOrFail($request->size_id);

        // Verify that the size belongs to the product
        if ($productSize->product_id != $product->id) {
            return redirect()->back()->with('error', 'Invalid size selection for this product.');
        }

        // Check if the selected size is in stock
        if ($productSize->stock <= 0) {
            return redirect()->back()->with('error', 'Sorry, this size is out of stock.');
        }

        // Check if the product with the same size is already in the cart
        $cartItem = Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $id)
            ->where('product_size_id', $request->size_id)
            ->first();

        if ($cartItem) {
            // Check if requested quantity is available for this size
            if ($cartItem->quantity + 1 > $productSize->stock) {
                return redirect()->back()->with('error', 'Sorry, we only have ' . $productSize->stock . ' items in stock for this size.');
            }

            $cartItem->increment('quantity'); // If already in cart, increase quantity
        } else {
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $id,
                'product_size_id' => $request->size_id,
                'quantity' => 1, // Default quantity
            ]);
        }

        return redirect('cart')->with('success', 'Item berhasil ditambahkan ke keranjang');
    }

    /**
     * Remove an item from the cart.
     */
    public function delete(Request $request, $id)
    {
        $item = Cart::findOrFail($id);

        $item->delete();

        return redirect('cart');
    }
}
