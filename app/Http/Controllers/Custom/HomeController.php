<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;

class HomeController extends Controller
{
    public function index()
    {
        $heroSections = HeroSection::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        return view('custom.home', compact('heroSections'));
    }
}