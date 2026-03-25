<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CitizenRequest;
class CitizenRequestController extends Controller
{
   // Citizen sends request
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

   // Office view requests
   public function officeIndex()
   {
       $requests = CitizenRequest::with(['service','user'])
           ->orderByDesc('id')
           ->get();
       return view('office.index', compact('requests'));
   }

   // Approve request
   public function approve($id)
   {
       $req = CitizenRequest::findOrFail($id);
       $req->status = 'approved';
       $req->save();
       return redirect()->back();
   }

   // Reject request
   public function reject($id)
   {
       $req = CitizenRequest::findOrFail($id);
       $req->status = 'rejected';
       $req->save();
       return redirect()->back();
   }
}