<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question'   => 'required|string|max:255',
            'answer'     => 'nullable|string',
            'status'     => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        Faq::create([
            'question'   => $request->question,
            'answer'     => $request->answer,
            'status'     => $request->has('status') ? 1 : 0,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ created successfully.');
    }

    public function show(Faq $faq)
    {
        return view('admin.faqs.show', compact('faq'));
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question'   => 'required|string|max:255',
            'answer'     => 'nullable|string',
            'status'     => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $faq->update([
            'question'   => $request->question,
            'answer'     => $request->answer,
            'status'     => $request->has('status') ? 1 : 0,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ deleted successfully.');
    }
}