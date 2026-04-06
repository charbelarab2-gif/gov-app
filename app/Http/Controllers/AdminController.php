<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Office;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\DB; // ADDED

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::count();
        $offices = Office::count();
        $requests = ServiceRequest::count();

        // ADDED FOR CHART
        $officeNames = Office::pluck('name');
        $officeRequestCounts = Office::withCount('serviceRequests')->pluck('service_requests_count');

        return view('admin.dashboard', compact('users','offices','requests','officeNames','officeRequestCounts'));
    }
       

    public function activate($id)
    {
        $user = User::find($id);

        $user->status = 1;

        $user->save();

        return back();
    }

     public function deactivate($id)
{
    $user = User::find($id);

    $user->status = 0;

    $user->save();

    return back();
}

    public function requests()
    {
        $requests = ServiceRequest::with('user','office')->get();

        return view('admin.requests',compact('requests'));
    }


    public function approve($id)
    {
        $r = ServiceRequest::find($id);

        $r->status = 'Approved';

        $r->save();

        return back();
    }
     
    public function reject($id)
{
    $r = ServiceRequest::find($id);

    $r->status = 'Rejected';

    $r->save();

    return back();
}


    public function users()
{

$users = User::all();

return view('admin.users',compact('users'));

}

public function reports()
{

$totalRequests = ServiceRequest::count();

$approvedRequests = ServiceRequest::where('status','Approved')->count();

$rejectedRequests = ServiceRequest::where('status','Rejected')->count();

$pendingRequests = ServiceRequest::where('status','Pending')->count();

return view('admin.reports',compact(
'totalRequests',
'approvedRequests',
'rejectedRequests',
'pendingRequests'
));

}

}