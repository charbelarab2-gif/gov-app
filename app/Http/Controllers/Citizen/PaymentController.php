<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceRequest; // import the model

class PaymentController extends Controller
{
    // Show payment form
  public function showPaymentForm($requestId)
{
    $request = ServiceRequest::findOrFail($requestId);
    return view('citizen.payment', compact('request'));
}

    // Handle payment submission
    public function pay(Request $request)
    {
        $request->validate([
            'request_id' => 'required|exists:service_requests,id',
            'amount' => 'required|numeric',
            'method' => 'required|string',
        ]);

        $serviceRequest = ServiceRequest::findOrFail($request->request_id);
        $serviceRequest->status = 'Paid';
        $serviceRequest->save();

        return redirect()->route('citizen.my.requests')
                         ->with('success', 'Payment completed successfully.');
    }
}