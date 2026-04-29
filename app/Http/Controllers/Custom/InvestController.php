<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;

class InvestController extends Controller
{
    public function index()
    {
        $siteSetting = SiteSetting::where('status', 1)->first();

        return view('custom.investor', compact('siteSetting'));
    }
}