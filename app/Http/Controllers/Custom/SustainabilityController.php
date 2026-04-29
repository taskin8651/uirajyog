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

        $firstSustainabilitySection = $sustainabilitySections->first();

        $approachSustainabilitySection = $sustainabilitySections->skip(1)->first() 
            ?? $firstSustainabilitySection;

        return view('custom.sustainability', compact(
            'sustainabilitySections',
            'firstSustainabilitySection',
            'approachSustainabilitySection'
        ));
    }
}