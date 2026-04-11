<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Office;
use App\Models\ServiceRequest;
use App\Models\CitizenRequest; // ✅ ADDED
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceCategory;


class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::count();
        $offices = Office::count();
        $requests = CitizenRequest::count(); // ✅ FIXED (was ServiceRequest)

        // ADDED FOR CHART
        $officeNames = Office::pluck('name');
        $officeNames = Office::pluck('name');

          $officeRequestCounts = Office::with(['services.requests'])
    ->get()
    ->map(function ($office) {
        return $office->services->sum(function ($service) {
            return $service->requests->count();
        });
    });

        return view('admin.dashboard', compact('users','offices','requests','officeNames','officeRequestCounts'));
    }
       

    public function activate($id)
    {
        $user = User::find($id);

        $user->is_active = 1;

        $user->save();

        return back();
    }

     public function deactivate($id)
{
    $user = User::find($id);

    $user->is_active = 0;

    $user->save();

    return back();
}

    public function requests()
    {
        $requests = CitizenRequest::with('user','service')->get(); // ✅ FIXED

        return view('admin.requests',compact('requests'));
    }


    public function approve($id)
    {
        $r = CitizenRequest::find($id); // ✅ FIXED

        $r->status = 'approved';

        $r->save();

        return back();
    }
     
    public function reject($id)
{
    $r = CitizenRequest::find($id); // ✅ FIXED

    $r->status = 'rejected';

    $r->save();

    return back();
}
 



// ===== SERVICES MANAGEMENT =====



public function manageServices()
{
    $offices = Office::all();
    $categories = ServiceCategory::with('office')->get();
    $services = Service::with(['office','category'])->get();

    return view('admin.manage', compact('offices', 'categories', 'services'));
}    

public function storeCategory(Request $request)
{
    ServiceCategory::create([
        'name' => $request->name,
        'office_id' => $request->office_id
    ]);

    return back();
}

public function storeService(Request $request)
{
    Service::create([
        'name' => $request->name,
        'description' => $request->description,
        'office_id' => $request->office_id,
        'service_category_id' => $request->service_category_id,
        'fee' => $request->fee,
        'is_active' => 1
    ]);

    return back();
}

    public function users()
{

$users = User::all();

return view('admin.users',compact('users'));

} 


public function createUser()
{
    $offices = Office::all(); // ✅ get offices
    return view('admin.create_user', compact('offices'));
}

public function storeUser(Request $request)
{
    \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
         'password' => Hash::make($request->password),
        'role' => $request->role,
        'office_id' => $request->role == 'municipality' ? $request->office_id : null,
        'is_active' => 1
    ]);

    return redirect('/admin/users');
}   


public function deleteCategory($id)
{
    ServiceCategory::find($id)->delete();
    return back();
}

public function deleteService($id)
{
    Service::find($id)->delete();
    return back();
}

public function editCategory($id)
{
    $category = ServiceCategory::findOrFail($id);
    $offices = Office::all();

    return view('admin.edit_category', compact('category','offices'));
}


public function updateCategory(Request $request, $id)
{
    $category = ServiceCategory::findOrFail($id);

    $category->update([
        'name' => $request->name,
        'office_id' => $request->office_id
    ]);

    return redirect('/admin/manage');
}

public function editService($id)
{
    $service = Service::findOrFail($id);
    $offices = Office::all();
    $categories = ServiceCategory::all();

    return view('admin.edit_service', compact('service','offices','categories'));
}

public function updateService(Request $request, $id)
{
    $service = Service::findOrFail($id);

    $service->update([
        'name' => $request->name,
        'description' => $request->description,
        'office_id' => $request->office_id,
        'service_category_id' => $request->service_category_id,
        'fee' => $request->fee
    ]);

    return redirect('/admin/manage');
}






public function reports()
{
    // ===== BASIC STATS =====
    $totalRequests = CitizenRequest::count();
    $approvedRequests = CitizenRequest::where('status','approved')->count();
    $rejectedRequests = CitizenRequest::where('status','rejected')->count();
    $pendingRequests = CitizenRequest::where('status','pending')->count();

    // ===== REQUESTS PER OFFICE =====
    $requestsPerOffice = Office::withCount(['services as requests_count' => function($query){
        $query->join('citizen_requests', 'services.id', '=', 'citizen_requests.service_id');
    }])->get();

    // ===== REVENUE PER OFFICE =====
    $revenuePerOffice = Office::with('services')->get()->map(function($office){
        $total = 0;

        foreach ($office->services as $service) {
            $count = CitizenRequest::where('service_id', $service->id)
                ->where('status', 'approved')
                ->count();

            $total += $count * $service->fee;
        }

        return [
            'office_name' => $office->name,
            'revenue' => $total
        ];
    });

    return view('admin.reports', compact(
        'totalRequests',
        'approvedRequests',
        'rejectedRequests',
        'pendingRequests',
        'requestsPerOffice',
        'revenuePerOffice'
    ));
}

}