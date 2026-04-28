<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManufacturingController extends Controller
{
    public function index()
    {
        return view('custom.manufacturing');
}

}
