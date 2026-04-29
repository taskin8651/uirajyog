<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SustainabilitySection;
use Illuminate\Http\Request;

class SustainabilitySectionController extends Controller
{
    public function index()
    {
        $sustainabilitySections = SustainabilitySection::orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.sustainabilitySections.index', compact('sustainabilitySections'));
    }

    public function create()
    {
        return view('admin.sustainabilitySections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'      => 'nullable|boolean',
            'sort_order'  => 'nullable|integer',
        ]);

        $sustainabilitySection = SustainabilitySection::create([
            'title'       => $request->title,
            'description' => $request->description,
            'status'      => $request->has('status') ? 1 : 0,
            'sort_order'  => $request->sort_order ?? 0,
        ]);

        if ($request->hasFile('image')) {
            $sustainabilitySection
                ->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        return redirect()
            ->route('admin.sustainability-sections.index')
            ->with('success', 'Sustainability section created successfully.');
    }

    public function show(SustainabilitySection $sustainabilitySection)
    {
        return view('admin.sustainabilitySections.show', compact('sustainabilitySection'));
    }

    public function edit(SustainabilitySection $sustainabilitySection)
    {
        return view('admin.sustainabilitySections.edit', compact('sustainabilitySection'));
    }

    public function update(Request $request, SustainabilitySection $sustainabilitySection)
    {
        $request->validate([
            'title'       => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'      => 'nullable|boolean',
            'sort_order'  => 'nullable|integer',
        ]);

        $sustainabilitySection->update([
            'title'       => $request->title,
            'description' => $request->description,
            'status'      => $request->has('status') ? 1 : 0,
            'sort_order'  => $request->sort_order ?? 0,
        ]);

        if ($request->hasFile('image')) {
            $sustainabilitySection
                ->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        return redirect()
            ->route('admin.sustainability-sections.index')
            ->with('success', 'Sustainability section updated successfully.');
    }

    public function destroy(SustainabilitySection $sustainabilitySection)
    {
        $sustainabilitySection->clearMediaCollection('image');

        $sustainabilitySection->delete();

        return redirect()
            ->route('admin.sustainability-sections.index')
            ->with('success', 'Sustainability section deleted successfully.');
    }

    public function destroyImage(SustainabilitySection $sustainabilitySection)
    {
        $sustainabilitySection->clearMediaCollection('image');

        return back()->with('success', 'Sustainability image deleted successfully.');
    }
}