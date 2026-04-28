<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use App\Models\ManufactureSection;

class ManufacturingController extends Controller
{
    public function index()
    {
        $manufactureSections = ManufactureSection::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $heroManufactureSection = $manufactureSections->first();

        return view('custom.manufacturing', compact(
            'manufactureSections',
            'heroManufactureSection'
        ));
    }
}