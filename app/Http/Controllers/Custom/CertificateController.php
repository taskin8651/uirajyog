<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Faq;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $faqs = Faq::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

             $certificateImages = $certificates->filter(function ($certificate) {
            return $certificate->file_type === 'image';
        })->values();

        return view('custom.certificate', compact('certificates', 'faqs', 'certificateImages'));
    }
}