<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
            'transaction_id' => 'nullable|exists:transactions,id'
        ]);

        $product = Product::findOrFail($productId);

        // Check if the user has already reviewed this product
        if ($product->hasBeenReviewedBy(Auth::id())) {
            return redirect()->back()->with('error', 'You have already reviewed this product.');
        }

        // Check if the user has purchased this product (optional validation)
        $hasPurchased = Transaction::where('user_id', Auth::id())
            ->whereHas('transactionItems', function ($query) use ($productId) {
                $query->where('product_id', $productId);
            })
            ->where('status', 'COMPLETED')
            ->exists();

        if (!$hasPurchased) {
            return redirect()->back()->with('error', 'You can only review products you have purchased.');
        }

        $review = Review::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
            'transaction_id' => $request->transaction_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => true // Auto-approve, you might want to change this for moderation
        ]);

        return redirect()->back()->with('success', 'Thank you for your review!');
    }

    /**
     * Show the form for creating a new review.
     */
    public function create($productId)
    {
        $product = Product::with('galleries')->findOrFail($productId);

        // Check if the user has already reviewed this product
        if ($product->hasBeenReviewedBy(Auth::id())) {
            return redirect()->route('details', $product->slug)->with('error', 'You have already reviewed this product.');
        }

        // Get user's transactions for this product
        $transactions = Transaction::where('user_id', Auth::id())
            ->whereHas('transactionItems', function ($query) use ($productId) {
                $query->where('product_id', $productId);
            })
            ->where('status', 'COMPLETED')
            ->get();

        if ($transactions->isEmpty()) {
            return redirect()->route('details', $product->slug)
                ->with('error', 'You can only review products you have purchased.');
        }

        return view('pages.frontend.review.create', compact('product', 'transactions'));
    }

    /**
     * Update the specified review in storage.
     */
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        // Check if the review belongs to the authenticated user
        if ($review->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to update this review.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500'
        ]);

        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return redirect()->route('details', $review->product->slug)
            ->with('success', 'Your review has been updated.');
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        // Check if the review belongs to the authenticated user
        if ($review->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this review.');
        }

        $review->delete();

        return redirect()->back()->with('success', 'Your review has been deleted.');
    }
}
