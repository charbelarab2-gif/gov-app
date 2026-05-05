<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
class CitizenServiceController extends Controller
{
     public function index()
    {
        $services = Service::where('is_active', true)->get();
return view('citizen.services.index', compact('services'));
        
    }
}
