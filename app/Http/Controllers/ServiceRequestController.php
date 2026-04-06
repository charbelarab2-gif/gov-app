<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequest;

class ServiceRequestController extends Controller
{

public function store(Request $request)
{

$request->validate([
    'office_id' => 'required',
    'service' => 'required|min:3|max:255'
]);

ServiceRequest::create([
'user_id' => auth()->id(),
'office_id' => $request->office_id,
'title' => $request->service,
'description' => $request->service,
]);

return back()->with('success','Request submitted');
}

}