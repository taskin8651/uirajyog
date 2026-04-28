<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Illuminate\Http\Request;

class AboutSectionController extends Controller
{
    public function index()
    {
        $aboutSections = AboutSection::orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.aboutSections.index', compact('aboutSections'));
    }

    public function create()
    {
        return view('admin.aboutSections.create');
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

        $aboutSection = AboutSection::create([
            'title'             => $request->title,
            'short_description' => $request->short_description,
            'description'       => $request->description,
            'status'            => $request->has('status') ? 1 : 0,
            'sort_order'        => $request->sort_order ?? 0,
        ]);

        if ($request->hasFile('image')) {
            $aboutSection
                ->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        return redirect()
            ->route('admin.about-sections.index')
            ->with('success', 'About section created successfully.');
    }

    public function show(AboutSection $aboutSection)
    {
        return view('admin.aboutSections.show', compact('aboutSection'));
    }

    public function edit(AboutSection $aboutSection)
    {
        return view('admin.aboutSections.edit', compact('aboutSection'));
    }

    public function update(Request $request, AboutSection $aboutSection)
    {
        $request->validate([
            'title'             => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'description'       => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'            => 'nullable|boolean',
            'sort_order'        => 'nullable|integer',
        ]);

        $aboutSection->update([
            'title'             => $request->title,
            'short_description' => $request->short_description,
            'description'       => $request->description,
            'status'            => $request->has('status') ? 1 : 0,
            'sort_order'        => $request->sort_order ?? 0,
        ]);

        if ($request->hasFile('image')) {
            $aboutSection
                ->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        return redirect()
            ->route('admin.about-sections.index')
            ->with('success', 'About section updated successfully.');
    }

    public function destroy(AboutSection $aboutSection)
    {
        $aboutSection->clearMediaCollection('image');

        $aboutSection->delete();

        return redirect()
            ->route('admin.about-sections.index')
            ->with('success', 'About section deleted successfully.');
    }

    public function destroyImage(AboutSection $aboutSection)
    {
        $aboutSection->clearMediaCollection('image');

        return back()->with('success', 'About image deleted successfully.');
    }
}