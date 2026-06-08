<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(9);

        return view('custom.blog', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::where('status', 1)
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedBlogs = Blog::where('status', 1)
            ->where('id', '!=', $blog->id)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->take(3)
            ->get();

        return view('custom.blog-detail', compact('blog', 'relatedBlogs'));
    }
}
