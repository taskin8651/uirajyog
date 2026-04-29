<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SiteSetting;

class ProductController extends Controller
{
    public function index()
{
    $categories = ProductCategory::where('status', 1)
        ->whereHas('products', function ($query) {
            $query->where('status', 1);
        })
        ->orderBy('sort_order', 'asc')
        ->orderBy('id', 'desc')
        ->get();

    $products = Product::with('category')
        ->where('status', 1)
        ->orderBy('sort_order', 'asc')
        ->orderBy('id', 'desc')
        ->get();

    $heroProduct = $products->first();

    $heroCategory = $categories->first();

    return view('custom.product', compact(
        'categories',
        'products',
        'heroProduct',
        'heroCategory'
    ));
}

    public function show($slug)
{
    $product = Product::with(['category'])
        ->where('status', 1)
        ->where('slug', $slug)
        ->firstOrFail();

    $relatedProducts = Product::with('category')
        ->where('status', 1)
        ->where('id', '!=', $product->id)
        ->when($product->category_id, function ($query) use ($product) {
            $query->where('category_id', $product->category_id);
        })
        ->orderBy('sort_order', 'asc')
        ->orderBy('id', 'desc')
        ->take(4)
        ->get();

    $siteSetting = SiteSetting::where('status', 1)->first();

    return view('custom.product-detail', compact(
        'product',
        'relatedProducts',
        'siteSetting'
    ));
}

    
}