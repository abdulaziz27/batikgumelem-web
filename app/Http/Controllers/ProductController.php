<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, $category = null)
    {
        $query = Product::with('galleries', 'category');

        // Filter by category if provided
        if ($category) {
            $query->whereHas('category', function($q) use ($category) {
                $q->where('slug', $category);
            });
        }

        // search
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // sort
        if ($request->sort == 'new') {
            $query->latest();
        } elseif ($request->sort == 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'price_desc') {
            $query->orderBy('price', 'desc');
        }

        $products = $query->paginate(12);
        $categories = Category::all();

        return view('pages.frontend.products', compact('products', 'categories', 'category'));
    }
}
