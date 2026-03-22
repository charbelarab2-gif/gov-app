<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index()
    {
        return view('citizen.payment');
    }
}