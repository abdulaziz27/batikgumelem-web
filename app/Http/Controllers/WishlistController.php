<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display the user's wishlist.
     */
    public function index()
    {
        $wishlists = Auth::user()->wishlists()->with('product.galleries')->latest()->get();

        return view('pages.frontend.wishlist.index', compact('wishlists'));
    }

    /**
     * Add a product to the user's wishlist.
     */
    public function add($productId)
    {
        $product = Product::findOrFail($productId);

        // Check if product is already in the wishlist
        if (Auth::user()->hasInWishlist($productId)) {
            return redirect()->back()->with('info', 'This product is already in your wishlist.');
        }

        // Add to wishlist
        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $productId
        ]);

        return redirect()->back()->with('success', 'Product added to your wishlist.');
    }

    /**
     * Remove a product from the user's wishlist.
     */
    public function remove($wishlistId)
    {
        $wishlist = Wishlist::findOrFail($wishlistId);

        // Check if wishlist item belongs to the authenticated user
        if ($wishlist->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to remove this item.');
        }

        $wishlist->delete();

        return redirect()->back()->with('success', 'Product removed from your wishlist.');
    }

    /**
     * Toggle a product in the user's wishlist (add if not exists, remove if exists).
     */
    public function toggle($productId)
    {
        $product = Product::findOrFail($productId);
        $existingWishlist = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($existingWishlist) {
            // Remove from wishlist
            $existingWishlist->delete();
            $inWishlist = false;
            $message = 'Product removed from your wishlist.';
        } else {
            // Add to wishlist
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $productId
            ]);
            $inWishlist = true;
            $message = 'Product added to your wishlist.';
        }

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'in_wishlist' => $inWishlist
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Move a product from wishlist to cart.
     */
    public function moveToCart($wishlistId)
    {
        $wishlist = Wishlist::with('product')->findOrFail($wishlistId);

        // Check if wishlist item belongs to the authenticated user
        if ($wishlist->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to move this item.');
        }

        // Check if the product is available
        if ($wishlist->product->stock <= 0) {
            return redirect()->back()->with('error', 'Sorry, this product is out of stock.');
        }

        // Add to cart
        $cartItem = Auth::user()->carts()
            ->where('product_id', $wishlist->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity'); // If already in cart, increase quantity
        } else {
            Auth::user()->carts()->create([
                'product_id' => $wishlist->product_id,
                'quantity' => 1
            ]);
        }

        // Remove from wishlist
        $wishlist->delete();

        return redirect()->back()->with('success', 'Product moved to your cart.');
    }
}
