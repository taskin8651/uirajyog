<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use App\Models\ManufactureSection;
use App\Models\Faq;

class ManufacturingController extends Controller
{
    public function index()
    {
        $manufactureSections = ManufactureSection::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $heroManufactureSection = $manufactureSections->first();

        $qualityManufactureSection = $manufactureSections->skip(1)->first()
            ?? $heroManufactureSection;

        $processManufactureSection = $manufactureSections->skip(2)->first()
            ?? $qualityManufactureSection
            ?? $heroManufactureSection;

        $faqs = Faq::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        return view('custom.manufacturing', compact(
            'manufactureSections',
            'heroManufactureSection',
            'qualityManufactureSection',
            'processManufactureSection',
            'faqs'
        ));
    }
}