<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->pluck('name', 'id')
            ->prepend('Please select', '');

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'        => 'nullable|exists:product_categories,id',
            'name'               => 'required|string|max:255|unique:products,name',
            'short_description'  => 'nullable|string',
            'description'        => 'nullable|string',
            'features'           => 'nullable|string',
            'ingredients'        => 'nullable|string',
            'usage_instruction'  => 'nullable|string',
            'pack_size'          => 'nullable|string|max:255',
            'price'              => 'nullable|numeric|min:0',

            'image'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images'             => 'nullable|array',
            'images.*'           => 'image|mimes:jpg,jpeg,png,webp|max:2048',

            'status'             => 'nullable|boolean',
            'is_featured'        => 'nullable|boolean',
            'sort_order'         => 'nullable|integer',
        ]);

        $product = Product::create([
            'category_id'        => $request->category_id,
            'name'               => $request->name,
            'slug'               => Str::slug($request->name),
            'short_description'  => $request->short_description,
            'description'        => $request->description,
            'features'           => $request->features,
            'ingredients'        => $request->ingredients,
            'usage_instruction'  => $request->usage_instruction,
            'pack_size'          => $request->pack_size,
            'price'              => $request->price,
            'status'             => $request->has('status') ? 1 : 0,
            'is_featured'        => $request->has('is_featured') ? 1 : 0,
            'sort_order'         => $request->sort_order ?? 0,
        ]);

        if ($request->hasFile('image')) {
            $product
                ->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $product
                    ->addMedia($image)
                    ->toMediaCollection('images');
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $product->load('category');

        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->pluck('name', 'id')
            ->prepend('Please select', '');

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id'        => 'nullable|exists:product_categories,id',
            'name'               => 'required|string|max:255|unique:products,name,' . $product->id,
            'short_description'  => 'nullable|string',
            'description'        => 'nullable|string',
            'features'           => 'nullable|string',
            'ingredients'        => 'nullable|string',
            'usage_instruction'  => 'nullable|string',
            'pack_size'          => 'nullable|string|max:255',
            'price'              => 'nullable|numeric|min:0',

            'image'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images'             => 'nullable|array',
            'images.*'           => 'image|mimes:jpg,jpeg,png,webp|max:2048',

            'status'             => 'nullable|boolean',
            'is_featured'        => 'nullable|boolean',
            'sort_order'         => 'nullable|integer',
        ]);

        $product->update([
            'category_id'        => $request->category_id,
            'name'               => $request->name,
            'slug'               => Str::slug($request->name),
            'short_description'  => $request->short_description,
            'description'        => $request->description,
            'features'           => $request->features,
            'ingredients'        => $request->ingredients,
            'usage_instruction'  => $request->usage_instruction,
            'pack_size'          => $request->pack_size,
            'price'              => $request->price,
            'status'             => $request->has('status') ? 1 : 0,
            'is_featured'        => $request->has('is_featured') ? 1 : 0,
            'sort_order'         => $request->sort_order ?? 0,
        ]);

        if ($request->hasFile('image')) {
            $product
                ->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $product
                    ->addMedia($image)
                    ->toMediaCollection('images');
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->clearMediaCollection('image');
        $product->clearMediaCollection('images');

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    public function destroyMainImage(Product $product)
    {
        $product->clearMediaCollection('image');

        return back()->with('success', 'Product main image deleted successfully.');
    }

    public function destroyGalleryImage(Product $product, Media $media)
    {
        if (
            $media->model_id == $product->id &&
            $media->model_type == Product::class &&
            $media->collection_name === 'images'
        ) {
            $media->delete();

            return back()->with('success', 'Product gallery image deleted successfully.');
        }

        return back()->with('error', 'Invalid media selected.');
    }
}