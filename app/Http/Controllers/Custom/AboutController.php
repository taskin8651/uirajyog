<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use App\Models\OurStorySection;
use App\Models\Certificate;

class AboutController extends Controller
{
    public function index()
    {
        $aboutSection = AboutSection::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->first();

        $ourStorySection = OurStorySection::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->first();

        $certificates = Certificate::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->first();

        return view('custom.about', compact(
            'aboutSection',
            'ourStorySection',
            'certificates'
        ));
    }
}