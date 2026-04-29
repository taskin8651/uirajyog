<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use App\Models\AboutSection;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ManufactureSection;
use App\Models\Faq;
use App\Models\SustainabilitySection;
use App\Models\Certificate;
use App\Models\SiteSetting;


class HomeController extends Controller
{
    public function index()
    {
        $heroSections = HeroSection::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $aboutSection = AboutSection::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->first();

        $productCategories = ProductCategory::where('status', 1)
            ->whereHas('products', function ($query) {
                $query->where('status', 1);
            })
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $featuredProducts = Product::with('category')
            ->where('status', 1)
            ->where('is_featured', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->take(8)
            ->get();

        $manufactureSections = ManufactureSection::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $homeManufactureSection = $manufactureSections->first();

        $mfgFaqs = Faq::where('status', 1)
    ->orderBy('sort_order', 'asc')
    ->orderBy('id', 'desc')
    ->get();

$mfgHeaderFaq = $mfgFaqs->first();

$sustainabilitySections = SustainabilitySection::where('status', 1)
    ->orderBy('sort_order', 'asc')
    ->orderBy('id', 'desc')
    ->get();

$homeSustainabilitySection = $sustainabilitySections->first();

$certificates = Certificate::where('status', 1)
    ->orderBy('sort_order', 'asc')
    ->orderBy('id', 'desc')
    ->get();

$certificateImages = $certificates->filter(function ($certificate) {
    return $certificate->file_type === 'image';
})->values();

 $siteSetting = SiteSetting::where('status', 1)->first();

        return view('custom.home', compact(
            'heroSections',
            'aboutSection',
            'productCategories',
            'featuredProducts',
            'manufactureSections',
            'homeManufactureSection',
            'mfgFaqs',
            'mfgHeaderFaq',
            'sustainabilitySections',
            'homeSustainabilitySection',
            'certificates',
            'certificateImages',
            'siteSetting'
        ));
    }
}