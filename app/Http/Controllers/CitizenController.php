<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CitizenController extends Controller
{
    public function dashboard()
{
    return view('citizen.dashboard');
}
}
