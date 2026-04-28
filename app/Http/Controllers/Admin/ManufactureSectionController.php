<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ManufactureSection;
use Illuminate\Http\Request;

class ManufactureSectionController extends Controller
{
    public function index()
    {
        $manufactureSections = ManufactureSection::orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.manufactureSections.index', compact('manufactureSections'));
    }

    public function create()
    {
        return view('admin.manufactureSections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'nullable|string|max:255',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'     => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $manufactureSection = ManufactureSection::create([
            'title'      => $request->title,
            'status'     => $request->has('status') ? 1 : 0,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        if ($request->hasFile('image')) {
            $manufactureSection
                ->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        return redirect()
            ->route('admin.manufacture-sections.index')
            ->with('success', 'Manufacture section created successfully.');
    }

    public function show(ManufactureSection $manufactureSection)
    {
        return view('admin.manufactureSections.show', compact('manufactureSection'));
    }

    public function edit(ManufactureSection $manufactureSection)
    {
        return view('admin.manufactureSections.edit', compact('manufactureSection'));
    }

    public function update(Request $request, ManufactureSection $manufactureSection)
    {
        $request->validate([
            'title'      => 'nullable|string|max:255',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'     => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $manufactureSection->update([
            'title'      => $request->title,
            'status'     => $request->has('status') ? 1 : 0,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        if ($request->hasFile('image')) {
            $manufactureSection
                ->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        return redirect()
            ->route('admin.manufacture-sections.index')
            ->with('success', 'Manufacture section updated successfully.');
    }

    public function destroy(ManufactureSection $manufactureSection)
    {
        $manufactureSection->clearMediaCollection('image');

        $manufactureSection->delete();

        return redirect()
            ->route('admin.manufacture-sections.index')
            ->with('success', 'Manufacture section deleted successfully.');
    }

    public function destroyImage(ManufactureSection $manufactureSection)
    {
        $manufactureSection->clearMediaCollection('image');

        return back()->with('success', 'Manufacture image deleted successfully.');
    }
}