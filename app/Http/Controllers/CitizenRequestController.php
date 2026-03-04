<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CitizenRequest;
class CitizenRequestController extends Controller
{
   public function store(Request $request)
   {
       $request->validate([
           'service_id' => 'required|exists:services,id',
       ]);
       CitizenRequest::create([
           'user_id' => auth()->id(),
           'service_id' => $request->service_id,
           'status' => 'pending',
       ]);
       return redirect()->back()->with('success', 'Request Sent');
   }
}
