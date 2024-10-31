<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function Provinces (Request $request) {
        return Province::all();
    }
    
    public function Regencies (Request $request, $province_id) {
        return Regency::where('province_id', $province_id)->get();
    }
}
