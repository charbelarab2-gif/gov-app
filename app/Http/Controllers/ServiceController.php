<?php
namespace App\Http\Controllers;
use App\Models\Service;
use Illuminate\Http\Request;
class ServiceController extends Controller
{
   public function index()
   {
       // Show only services for the logged-in office user
       $services = Service::where('office_id', auth()->user()->office_id)->get();
       return view('services.index', compact('services'));
   }
   public function create()
   {
       return view('services.create');
   }
   public function store(Request $request)
   {
       $request->validate([
           'name' => 'required|string|max:255',
           'description' => 'nullable|string',
           'fee' => 'required|numeric',
           'duration' => 'nullable|integer|min:0',
           'required_documents' => 'nullable|string',
       ]);
       Service::create([
           'office_id' => auth()->user()->office_id,
           'name' => $request->name,
           'description' => $request->description,
           'fee' => $request->fee,
           'duration' => $request->duration,
           'required_documents' => $request->required_documents,
           'is_active' => true,
       ]);
       return redirect()->route('services.index');
   }
   public function edit($id)
   {
       // Make sure the service belongs to this office
       $service = Service::where('office_id', auth()->user()->office_id)->findOrFail($id);
       return view('services.edit', compact('service'));
   }
   public function update(Request $request, $id)
   {
       $request->validate([
           'name' => 'required|string|max:255',
           'description' => 'nullable|string',
           'fee' => 'required|numeric',
           'duration' => 'nullable|integer|min:0',
           'required_documents' => 'nullable|string',
       ]);
       $service = Service::where('office_id', auth()->user()->office_id)->findOrFail($id);
       $service->update([
           'name' => $request->name,
           'description' => $request->description,
           'fee' => $request->fee,
           'duration' => $request->duration,
           'required_documents' => $request->required_documents,
       ]);
       return redirect()->route('services.index');
   }
   public function destroy($id)
   {
       $service = Service::where('office_id', auth()->user()->office_id)->findOrFail($id);
       $service->delete();
       return redirect()->route('services.index');
   }
}