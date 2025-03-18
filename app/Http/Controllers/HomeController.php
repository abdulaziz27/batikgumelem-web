<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage
     */
    public function index(Request $request)
    {
        // Prioritize products with stock, but include some out-of-stock products if needed
        $inStockProducts = Product::with(['galleries'])
            ->where('stock', '>', 0)
            ->latest()
            ->limit(8)
            ->get();

        // If we don't have enough in-stock products, get some out-of-stock ones too
        if ($inStockProducts->count() < 8) {
            $outOfStockProducts = Product::with(['galleries'])
                ->where('stock', '<=', 0)
                ->latest()
                ->limit(8 - $inStockProducts->count())
                ->get();

            $products = $inStockProducts->concat($outOfStockProducts);
        } else {
            $products = $inStockProducts;
        }

        $categories = Category::withCount('products')->get();

        return view('pages.frontend.index', compact('products', 'categories'));
    }

    /**
     * Display the history page
     */
    public function history(Request $request)
    {
        return view('pages.frontend.history');
    }

    /**
     * Display the promotion page
     */
    public function promotion(Request $request)
    {
        return view('pages.frontend.promotion');
    }

    /**
     * Display the terms and conditions page
     */
    public function termsCondition(Request $request)
    {
        return view('pages.frontend.terms-condition');
    }

    /**
     * Display the privacy policy page
     */
    public function privacyPolicy(Request $request)
    {
        return view('pages.frontend.privacy-policy');
    }

    /**
     * Display the FAQ page
     */
    public function faq(Request $request)
    {
        return view('pages.frontend.faq');
    }
}
