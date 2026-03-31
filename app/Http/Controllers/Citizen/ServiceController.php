<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    // List all services
    public function index()
    {
        $services = Service::all();
        return view('citizen.services', compact('services'));
    }

    // Show a single service
    public function show($id)
    {
        $service = Service::findOrFail($id);
        return view('citizen.service-details', compact('service'));
    }
}