<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use App\Models\Product;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index()
    {
        $enquiries = Enquiry::with('product')
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('admin.enquiries.index', compact('enquiries'));
    }

    public function create()
    {
        $products = Product::where('status', 1)
            ->orderBy('name', 'asc')
            ->pluck('name', 'id')
            ->prepend('Please select', '');

        return view('admin.enquiries.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'name'       => 'required|string|max:255',
            'email'      => 'nullable|email|max:255',
            'phone'      => 'nullable|string|max:20',
            'subject'    => 'nullable|string|max:255',
            'message'    => 'nullable|string',
            'status'     => 'nullable|in:new,in_progress,completed,cancelled',
            'is_read'    => 'nullable|boolean',
            'admin_note' => 'nullable|string',
        ]);

        Enquiry::create([
            'product_id' => $request->product_id,
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'subject'    => $request->subject,
            'message'    => $request->message,
            'status'     => $request->status ?? 'new',
            'is_read'    => $request->has('is_read') ? 1 : 0,
            'admin_note' => $request->admin_note,
        ]);

        return redirect()
            ->route('admin.enquiries.index')
            ->with('success', 'Enquiry created successfully.');
    }

    public function show(Enquiry $enquiry)
    {
        $enquiry->load('product');

        if (! $enquiry->is_read) {
            $enquiry->update([
                'is_read' => 1,
            ]);
        }

        return view('admin.enquiries.show', compact('enquiry'));
    }

    public function edit(Enquiry $enquiry)
    {
        $products = Product::where('status', 1)
            ->orderBy('name', 'asc')
            ->pluck('name', 'id')
            ->prepend('Please select', '');

        return view('admin.enquiries.edit', compact('enquiry', 'products'));
    }

    public function update(Request $request, Enquiry $enquiry)
    {
        $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'name'       => 'required|string|max:255',
            'email'      => 'nullable|email|max:255',
            'phone'      => 'nullable|string|max:20',
            'subject'    => 'nullable|string|max:255',
            'message'    => 'nullable|string',
            'status'     => 'nullable|in:new,in_progress,completed,cancelled',
            'is_read'    => 'nullable|boolean',
            'admin_note' => 'nullable|string',
        ]);

        $enquiry->update([
            'product_id' => $request->product_id,
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'subject'    => $request->subject,
            'message'    => $request->message,
            'status'     => $request->status ?? 'new',
            'is_read'    => $request->has('is_read') ? 1 : 0,
            'admin_note' => $request->admin_note,
        ]);

        return redirect()
            ->route('admin.enquiries.index')
            ->with('success', 'Enquiry updated successfully.');
    }

    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();

        return redirect()
            ->route('admin.enquiries.index')
            ->with('success', 'Enquiry deleted successfully.');
    }

    public function markAsRead(Enquiry $enquiry)
    {
        $enquiry->update([
            'is_read' => 1,
        ]);

        return back()->with('success', 'Enquiry marked as read.');
    }

    public function markAsUnread(Enquiry $enquiry)
    {
        $enquiry->update([
            'is_read' => 0,
        ]);

        return back()->with('success', 'Enquiry marked as unread.');
    }

    public function updateStatus(Request $request, Enquiry $enquiry)
    {
        $request->validate([
            'status' => 'required|in:new,in_progress,completed,cancelled',
        ]);

        $enquiry->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Enquiry status updated successfully.');
    }
}