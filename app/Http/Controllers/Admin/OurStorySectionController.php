<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurStorySection;
use Illuminate\Http\Request;

class OurStorySectionController extends Controller
{
    public function index()
    {
        $ourStorySections = OurStorySection::orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.ourStorySections.index', compact('ourStorySections'));
    }

    public function create()
    {
        return view('admin.ourStorySections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'description'       => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'            => 'nullable|boolean',
            'sort_order'        => 'nullable|integer',
        ]);

        $ourStorySection = OurStorySection::create([
            'title'             => $request->title,
            'short_description' => $request->short_description,
            'description'       => $request->description,
            'status'            => $request->has('status') ? 1 : 0,
            'sort_order'        => $request->sort_order ?? 0,
        ]);

        if ($request->hasFile('image')) {
            $ourStorySection
                ->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        return redirect()
            ->route('admin.our-story-sections.index')
            ->with('success', 'Our story section created successfully.');
    }

    public function show(OurStorySection $ourStorySection)
    {
        return view('admin.ourStorySections.show', compact('ourStorySection'));
    }

    public function edit(OurStorySection $ourStorySection)
    {
        return view('admin.ourStorySections.edit', compact('ourStorySection'));
    }

    public function update(Request $request, OurStorySection $ourStorySection)
    {
        $request->validate([
            'title'             => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'description'       => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'            => 'nullable|boolean',
            'sort_order'        => 'nullable|integer',
        ]);

        $ourStorySection->update([
            'title'             => $request->title,
            'short_description' => $request->short_description,
            'description'       => $request->description,
            'status'            => $request->has('status') ? 1 : 0,
            'sort_order'        => $request->sort_order ?? 0,
        ]);

        if ($request->hasFile('image')) {
            $ourStorySection
                ->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        return redirect()
            ->route('admin.our-story-sections.index')
            ->with('success', 'Our story section updated successfully.');
    }

    public function destroy(OurStorySection $ourStorySection)
    {
        $ourStorySection->clearMediaCollection('image');

        $ourStorySection->delete();

        return redirect()
            ->route('admin.our-story-sections.index')
            ->with('success', 'Our story section deleted successfully.');
    }

    public function destroyImage(OurStorySection $ourStorySection)
    {
        $ourStorySection->clearMediaCollection('image');

        return back()->with('success', 'Our story image deleted successfully.');
    }
}