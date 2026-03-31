<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    // Show the "create request" form
    public function create($serviceId)
    {
        $service = Service::findOrFail($serviceId);
          return view('citizen.request-form', compact('service'));
    }

    // Store a new request
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'description' => 'nullable|string',
            'document' => 'nullable|file|mimes:pdf,jpg,png',
        ]);

        $documentPath = $request->hasFile('document') 
            ? $request->file('document')->store('documents', 'public') 
            : null;

        ServiceRequest::create([
            'user_id' => Auth::id(),
            'service_id' => $request->service_id,
            'description' => $request->description,
            'document' => $documentPath,
            'status' => 'Pending',
        ]);

        return redirect()->route('citizen.my.requests')
                         ->with('success', 'Request submitted successfully.');
    }

    // List all requests
    
    public function index()
{
    $requests = ServiceRequest::where('user_id', auth()->id())->get();
    return view('citizen.my-requests', compact('requests'));
}
}