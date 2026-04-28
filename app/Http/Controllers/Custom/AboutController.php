<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;

class AboutController extends Controller
{
    public function index()
    {
        $aboutSection = AboutSection::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->first();

        return view('custom.about', compact('aboutSection'));
    }
}