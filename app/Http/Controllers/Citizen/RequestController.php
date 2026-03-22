<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    // show request form
    public function create()
    {
        return view('citizen.request-form');
    }

    // submit request
    public function store(Request $request)
    {
        return redirect()->route('citizen.myrequests');
    }

    // view citizen requests
    public function myRequests()
    {
        return view('citizen.my-requests');
    }
}