<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;

class QRController extends Controller
{
    
    public function track($id)
{
    return "Tracking request: ".$id;
}
}