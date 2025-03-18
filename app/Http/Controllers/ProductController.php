<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(Request $request, $category = null)
    {
        $query = Product::with('galleries', 'category', 'reviews');

        // Filter by category if provided
        if ($category) {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('slug', $category);
            });
        }

        // search
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Price range filter
        if ($request->has('min_price') && is_numeric($request->min_price)) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && is_numeric($request->max_price)) {
            $query->where('price', '<=', $request->max_price);
        }

        // Stock availability filter
        if ($request->has('in_stock') && $request->in_stock == 1) {
            $query->where('stock', '>', 0);
        }

        // Rating filter
        if ($request->has('min_rating') && is_numeric($request->min_rating)) {
            $query->whereHas('reviews', function ($q) use ($request) {
                $q->select('product_id')
                    ->groupBy('product_id')
                    ->havingRaw('AVG(rating) >= ?', [$request->min_rating]);
            });
        }

        // sort
        if ($request->sort == 'new') {
            $query->latest();
        } elseif ($request->sort == 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'price_desc') {
            $query->orderBy('price', 'desc');
        } elseif ($request->sort == 'popular') {
            $query->withCount('reviews')->orderBy('reviews_count', 'desc');
        } elseif ($request->sort == 'rating') {
            $query->withAvg('reviews', 'rating')->orderByDesc('reviews_avg_rating');
        }

        $products = $query->paginate(12);
        $categories = Category::all();

        // Get min and max prices for filter dropdowns
        $minPrice = Product::min('price');
        $maxPrice = Product::max('price');

        return view('pages.frontend.product.index', compact(
            'products',
            'categories',
            'category',
            'minPrice',
            'maxPrice'
        ));
    }

    /**
     * Display the specified product.
     */
    public function show(Request $request, $slug)
    {
        // Load product with galleries and reviews relationship
        $product = Product::with(['galleries', 'reviews.user', 'sizes'])->where('slug', $slug)->firstOrFail();

        // Get recommendations, prioritizing in-stock products
        $recommendations = Product::with(['galleries'])
            ->where('id', '!=', $product->id)
            ->where('stock', '>', 0)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        // If we don't have enough in-stock recommendations, add some out-of-stock ones
        if ($recommendations->count() < 4) {
            $moreRecommendations = Product::with(['galleries'])
                ->where('id', '!=', $product->id)
                ->where('stock', '<=', 0)
                ->inRandomOrder()
                ->limit(4 - $recommendations->count())
                ->get();

            $recommendations = $recommendations->concat($moreRecommendations);
        }

        return view('pages.frontend.product.show', compact('product', 'recommendations'));
    }
}
