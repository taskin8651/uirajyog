<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;

class HeroSectionController extends Controller
{
    public function index()
    {
        $heroSections = HeroSection::orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.heroSections.index', compact('heroSections'));
    }

    public function create()
    {
        return view('admin.heroSections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'                  => 'nullable|string|max:255',
            'subtitle'               => 'nullable|string|max:255',
            'description'            => 'nullable|string',
            'button_text'            => 'nullable|string|max:255',
            'button_link'            => 'nullable|string|max:255',
            'secondary_button_text'  => 'nullable|string|max:255',
            'secondary_button_link'  => 'nullable|string|max:255',
            'image'                  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'                 => 'nullable|boolean',
            'sort_order'             => 'nullable|integer',
        ]);

        $heroSection = HeroSection::create([
            'title'                 => $request->title,
            'subtitle'              => $request->subtitle,
            'description'           => $request->description,
            'button_text'           => $request->button_text,
            'button_link'           => $request->button_link,
            'secondary_button_text' => $request->secondary_button_text,
            'secondary_button_link' => $request->secondary_button_link,
            'status'                => $request->has('status') ? 1 : 0,
            'sort_order'            => $request->sort_order ?? 0,
        ]);

        if ($request->hasFile('image')) {
            $heroSection
                ->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        return redirect()
            ->route('admin.hero-sections.index')
            ->with('success', 'Hero section created successfully.');
    }

    public function show(HeroSection $heroSection)
    {
        return view('admin.heroSections.show', compact('heroSection'));
    }

    public function edit(HeroSection $heroSection)
    {
        return view('admin.heroSections.edit', compact('heroSection'));
    }

    public function update(Request $request, HeroSection $heroSection)
    {
        $request->validate([
            'title'                  => 'nullable|string|max:255',
            'subtitle'               => 'nullable|string|max:255',
            'description'            => 'nullable|string',
            'button_text'            => 'nullable|string|max:255',
            'button_link'            => 'nullable|string|max:255',
            'secondary_button_text'  => 'nullable|string|max:255',
            'secondary_button_link'  => 'nullable|string|max:255',
            'image'                  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'                 => 'nullable|boolean',
            'sort_order'             => 'nullable|integer',
        ]);

        $heroSection->update([
            'title'                 => $request->title,
            'subtitle'              => $request->subtitle,
            'description'           => $request->description,
            'button_text'           => $request->button_text,
            'button_link'           => $request->button_link,
            'secondary_button_text' => $request->secondary_button_text,
            'secondary_button_link' => $request->secondary_button_link,
            'status'                => $request->has('status') ? 1 : 0,
            'sort_order'            => $request->sort_order ?? 0,
        ]);

        if ($request->hasFile('image')) {
            $heroSection
                ->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        return redirect()
            ->route('admin.hero-sections.index')
            ->with('success', 'Hero section updated successfully.');
    }

    public function destroy(HeroSection $heroSection)
    {
        $heroSection->clearMediaCollection('image');

        $heroSection->delete();

        return redirect()
            ->route('admin.hero-sections.index')
            ->with('success', 'Hero section deleted successfully.');
    }

    public function destroyImage(HeroSection $heroSection)
    {
        $heroSection->clearMediaCollection('image');

        return back()->with('success', 'Hero image deleted successfully.');
    }
}