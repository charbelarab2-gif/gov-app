<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequest;
use App\Models\CitizenRequest; // ✅ ADDED (important)

class ServiceRequestController extends Controller
{

public function store(Request $request)
{

$request->validate([
    'service_id' => 'required|exists:services,id', // ✅ CHANGED
]);

ServiceRequest::create([
'user_id' => auth()->id(),
'service_id' => $request->service_id, // ✅ CHANGED
'office_id' => $request->office_id,
'title' => $request->service,
'description' => $request->service,
]);

// ✅ OPTIONAL: also save in CitizenRequest to match team system
CitizenRequest::create([
    'user_id' => auth()->id(),
    'service_id' => $request->service_id,
    'status' => 'pending',
]);

return back()->with('success','Request submitted');
}

}