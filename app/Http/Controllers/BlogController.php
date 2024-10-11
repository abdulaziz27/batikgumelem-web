<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('user')->where('is_published', true)->latest('published_at')->paginate(9);
        return view('pages.frontend.blogs.index', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::with('user')->where('slug', $slug)->firstOrFail();
        return view('pages.frontend.blogs.show', compact('blog'));
    }
}
