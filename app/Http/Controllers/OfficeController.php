<?php

namespace App\Http\Controllers;

use App\Models\CitizenRequest;
use App\Models\Office;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OfficeController extends Controller
{
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