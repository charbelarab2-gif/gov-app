<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    // list services
    public function index()
    {
        return view('citizen.services');
    }

    // service details
    public function show($id)
    {
        return view('citizen.service-details');
    }
}