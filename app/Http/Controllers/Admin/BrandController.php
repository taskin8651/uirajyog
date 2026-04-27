<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255|unique:brands,name',
            'description' => 'nullable|string',
            'website_url' => 'nullable|string|max:255',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'status'      => 'nullable|boolean',
            'sort_order'  => 'nullable|integer',
        ]);

        $brand = Brand::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'website_url' => $request->website_url,
            'status'      => $request->has('status') ? 1 : 0,
            'sort_order'  => $request->sort_order ?? 0,
        ]);

        if ($request->hasFile('logo')) {
            $brand
                ->addMediaFromRequest('logo')
                ->toMediaCollection('logo');
        }

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Brand created successfully.');
    }

    public function show(Brand $brand)
    {
        return view('admin.brands.show', compact('brand'));
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name'        => 'required|string|max:255|unique:brands,name,' . $brand->id,
            'description' => 'nullable|string',
            'website_url' => 'nullable|string|max:255',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'status'      => 'nullable|boolean',
            'sort_order'  => 'nullable|integer',
        ]);

        $brand->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'website_url' => $request->website_url,
            'status'      => $request->has('status') ? 1 : 0,
            'sort_order'  => $request->sort_order ?? 0,
        ]);

        if ($request->hasFile('logo')) {
            $brand
                ->addMediaFromRequest('logo')
                ->toMediaCollection('logo');
        }

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Brand updated successfully.');
    }

    public function destroy(Brand $brand)
    {
        $brand->clearMediaCollection('logo');

        $brand->delete();

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Brand deleted successfully.');
    }

    public function destroyLogo(Brand $brand)
    {
        $brand->clearMediaCollection('logo');

        return back()->with('success', 'Brand logo deleted successfully.');
    }
}