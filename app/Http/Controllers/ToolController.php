<?php

namespace App\Http\Controllers;

use App\Services\GeoIPService;

class ToolController extends Controller
{
    protected $geoIPService;

    public function __construct(GeoIPService $geoIPService)
    {
        $this->geoIPService = $geoIPService;
    }
    public function geoIP($ip) {
        // $ipAddress = $request->ip();

        // Lấy thông tin địa lý
        $location = $this->geoIPService->getCountry($ip);
        echo $location['iso_code'];
        // return view('home', compact('location'));
    }
    
    
}