<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index()
    {
        $siteSetting = SiteSetting::where('status', 1)->first();

        $products = Product::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        return view('custom.enquiry', compact('siteSetting', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'name'       => 'required|string|max:255',
            'phone'      => 'required|string|max:30',
            'email'      => 'nullable|email|max:255',
            'subject'    => 'nullable|string|max:255',
            'message'    => 'required|string',
        ]);

        Enquiry::create([
            'product_id' => $request->product_id,
            'name'       => $request->name,
            'phone'      => $request->phone,
            'email'      => $request->email,
            'subject'    => $request->subject,
            'message'    => $request->message,
            'status'     => 'new',
            'is_read'    => 0,
        ]);

        return back()->with('success', 'Thank you! Your enquiry has been submitted successfully.');
    }
}