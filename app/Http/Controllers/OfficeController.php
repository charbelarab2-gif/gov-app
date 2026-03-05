<?php

namespace App\Http\Controllers;

use App\Models\Office;

class OfficeController extends Controller
{
    public function map()
    {
        $offices = Office::all();
        return view('citizen.map', compact('offices'));
    }
}