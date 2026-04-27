<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $productCategories = ProductCategory::orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.productCategories.index', compact('productCategories'));
    }

    public function create()
    {
        return view('admin.productCategories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255|unique:product_categories,name',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'      => 'nullable|boolean',
            'sort_order'  => 'nullable|integer',
        ]);

        $productCategory = ProductCategory::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'status'      => $request->has('status') ? 1 : 0,
            'sort_order'  => $request->sort_order ?? 0,
        ]);

        if ($request->hasFile('image')) {
            $productCategory
                ->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        return redirect()
            ->route('admin.product-categories.index')
            ->with('success', 'Product category created successfully.');
    }

    public function show(ProductCategory $productCategory)
    {
        return view('admin.productCategories.show', compact('productCategory'));
    }

    public function edit(ProductCategory $productCategory)
    {
        return view('admin.productCategories.edit', compact('productCategory'));
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        $request->validate([
            'name'        => 'required|string|max:255|unique:product_categories,name,' . $productCategory->id,
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'      => 'nullable|boolean',
            'sort_order'  => 'nullable|integer',
        ]);

        $productCategory->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'status'      => $request->has('status') ? 1 : 0,
            'sort_order'  => $request->sort_order ?? 0,
        ]);

        if ($request->hasFile('image')) {
            $productCategory
                ->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        return redirect()
            ->route('admin.product-categories.index')
            ->with('success', 'Product category updated successfully.');
    }

    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();

        return redirect()
            ->route('admin.product-categories.index')
            ->with('success', 'Product category deleted successfully.');
    }
}