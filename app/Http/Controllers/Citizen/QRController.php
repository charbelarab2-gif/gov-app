<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;

class QRController extends Controller
{
    public function generate($id)
    {
        return "QR Code for Request " . $id;
    }
}