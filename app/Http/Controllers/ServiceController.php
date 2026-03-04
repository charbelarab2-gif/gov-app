<?php
namespace App\Http\Controllers;
use App\Models\Service;
use Illuminate\Http\Request;
class ServiceController extends Controller
{
   public function index()
   {
       $services = Service::all();
       return view('services.index', compact('services'));
   }
   public function create()
   {
       return view('services.create');
   }
   public function store(Request $request)
   {
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'fee' => 'required|numeric'
    ]);
    Service::create([
        'office_id' => auth()->user()->office_id,
        'name' => $request->name,
        'description' => $request->description,
        'fee' => $request->fee,
        'is_active' => true
    ]);
    return redirect()->route('services.index');
       
}
      
   public function edit($id)
   {
       $service = Service::findOrFail($id);
       return view('services.edit', compact('service'));
   }
   public function update(Request $request, $id)
   {
       $request->validate([
           'name' => 'required|string|max:255',
           'description' => 'nullable|string',
           'fee' => 'nullable|numeric',
       ]);
       $service = Service::findOrFail($id);
       $service->update([
           'name' => $request->name,
           'description' => $request->description,
           'fee' => $request->fee,
       ]);
       return redirect()->route('services.index');
   }
   public function destroy($id)
   {
       $service = Service::findOrFail($id);
       $service->delete();
       return redirect()->route('services.index');
   }
}