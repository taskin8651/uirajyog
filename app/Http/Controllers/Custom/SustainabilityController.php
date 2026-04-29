<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use App\Models\SustainabilitySection;

class SustainabilityController extends Controller
{
    public function index()
    {
        $sustainabilitySections = SustainabilitySection::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        return view('custom.sustainability', compact('sustainabilitySections'));
    }
}