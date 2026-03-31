<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
   // DashboardController.php
public function index() {
    $requests = ServiceRequest::where('user_id', auth()->id())->get();
    return view('citizen.dashboard', compact('requests'));
}
}