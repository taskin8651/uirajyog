<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'pdf'               => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',
            'status'            => 'nullable|boolean',
            'sort_order'        => 'nullable|integer',
        ]);

        $certificate = Certificate::create([
            'title'             => $request->title,
            'short_description' => $request->short_description,
            'status'            => $request->has('status') ? 1 : 0,
            'sort_order'        => $request->sort_order ?? 0,
        ]);

        if ($request->hasFile('pdf')) {
            $certificate
                ->addMediaFromRequest('pdf')
                ->toMediaCollection('pdf');
        }

        return redirect()
            ->route('admin.certificates.index')
            ->with('success', 'Certificate created successfully.');
    }

    public function show(Certificate $certificate)
    {
        return view('admin.certificates.show', compact('certificate'));
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $request->validate([
            'title'             => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'pdf'               => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',
            'status'            => 'nullable|boolean',
            'sort_order'        => 'nullable|integer',
        ]);

        $certificate->update([
            'title'             => $request->title,
            'short_description' => $request->short_description,
            'status'            => $request->has('status') ? 1 : 0,
            'sort_order'        => $request->sort_order ?? 0,
        ]);

        if ($request->hasFile('pdf')) {
            $certificate
                ->addMediaFromRequest('pdf')
                ->toMediaCollection('pdf');
        }

        return redirect()
            ->route('admin.certificates.index')
            ->with('success', 'Certificate updated successfully.');
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->clearMediaCollection('pdf');

        $certificate->delete();

        return redirect()
            ->route('admin.certificates.index')
            ->with('success', 'Certificate deleted successfully.');
    }

    public function destroyPdf(Certificate $certificate)
    {
        $certificate->clearMediaCollection('pdf');

        return back()->with('success', 'Certificate file deleted successfully.');
    }
}