<?php

namespace App\Http\Controllers;

use App\Models\CitizenRequest;
use App\Models\Office;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Municipality;

class OfficeController extends Controller
{
    // -------------------------
    // Admin Office CRUD methods
    // -------------------------
    
    public function index(): View
    {
        $offices = Office::all();
        return view('admin.offices.index', compact('offices'));
    }

  

public function create()
{
    $municipalities = Municipality::all();

    return view('admin.offices.create', compact('municipalities'));
}

public function store(Request $request): RedirectResponse
{
    Office::create([
        'name' => $request->name,
        'municipality_id' => $request->municipality_id,
        'address' => $request->address,
        'email' => $request->email, 
    ]);

    return redirect('/admin/offices');
}

public function edit($id): View
{
    $office = Office::findOrFail($id);
    $municipalities = Municipality::all();

    return view('admin.offices.edit', compact('office','municipalities'));
}

public function update(Request $request, $id): RedirectResponse
{
    $office = Office::findOrFail($id);

    $office->name = $request->name;
    $office->municipality_id = $request->municipality_id; // FIXED
    $office->address = $request->address;

    $office->save();

    return redirect('/admin/offices');
}

    public function destroy($id): RedirectResponse
    {
        Office::destroy($id);
        return back();
    }

    // -------------------------
    // Office user-specific methods
    // -------------------------

    // Show office map
    public function map(): View
    {
        return view('citizen.map');
    }

    // Show all citizen requests for this office
    public function requests(): View
    {
        $requests = CitizenRequest::with(['user', 'service'])
            ->whereHas('service', function ($query) {
                $query->where('office_id', $this->currentOffice()->id);
            })
            ->orderByDesc('id')
            ->get();

        return view('office.requests', compact('requests'));
    }

    // Update request status (approve, reject, etc.)
    public function updateRequestStatus(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_review,missing_documents,approved,rejected,completed',
        ]);

        $citizenRequest = $this->requestForCurrentOffice($id);
        $citizenRequest->status = $validated['status'];
        $citizenRequest->save();

        return redirect()->back()->with('success', 'Request status updated successfully.');
    }

    // Upload response document for request
    public function uploadResponseDocument(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'response_document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $citizenRequest = $this->requestForCurrentOffice($id);
        $file = $request->file('response_document');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/responses', $filename);
        $citizenRequest->response_document = $filename;
        $citizenRequest->save();

        return redirect()->back()->with('success', 'Response uploaded');
    }

    // Show office details page
    public function details(): View
    {
        $office = $this->currentOffice();
        return view('office.details', compact('office'));
    }

    // Show edit office details form
    public function editDetails(): View
    {
        $office = $this->currentOffice();
        return view('office.details', compact('office'));
    }

    // Update office details
    public function updateDetails(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'google_maps_url' => 'nullable|url|max:2048',
            'working_hours' => 'nullable|string|max:255',
            'contact_info' => 'nullable|string|max:255',
        ]);

        $office = $this->currentOffice();
        $office->update($validated);

        return redirect('/office/details')->with('success', 'Office details updated successfully.');
    }

    // -------------------------
    // Private helper methods
    // -------------------------

    // Get current logged-in office
    private function currentOffice(): Office
    {
        $user = auth()->user();
        $officeId = $user?->office_id;

        abort_unless($user && $user->role === 'office', 403, 'Only office users can access this area.');
        abort_unless($officeId, 403, 'Your account is not linked to an office.');

        return Office::findOrFail($officeId);
    }

    // Get request that belongs to this office only
    private function requestForCurrentOffice(int $id): CitizenRequest
    {
        return CitizenRequest::with(['user', 'service'])
            ->whereHas('service', function ($query) {
                $query->where('office_id', $this->currentOffice()->id);
            })
            ->findOrFail($id);
    }
}