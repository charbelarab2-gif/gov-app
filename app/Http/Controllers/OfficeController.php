<?php

namespace App\Http\Controllers;

use App\Models\CitizenRequest;
use App\Models\Office;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OfficeController extends Controller
{
    public function requests(): View
    {
        $requests = CitizenRequest::with(['user', 'service'])->get();

        return view('office.requests', compact('requests'));
    }

    public function updateRequestStatus(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'status' => 'required',
        ]);

        $citizenRequest = CitizenRequest::findOrFail($id);
        $citizenRequest->status = $request->status;
        $citizenRequest->save();

        return redirect()->back();
    }

    public function uploadResponseDocument(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'response_document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $citizenRequest = CitizenRequest::findOrFail($id);
        $file = $request->file('response_document');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/responses', $filename);
        $citizenRequest->response_document = $filename;
        $citizenRequest->save();

        return redirect()->back()->with('success', 'Response uploaded');
    }

    public function details(): View
    {
        $office = $this->currentOffice();

        return view('office.details', compact('office'));
    }

    public function editDetails(): View
    {
        $office = $this->currentOffice();

        return view('office.edit', compact('office'));
    }

    public function updateDetails(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'google_maps_url' => 'nullable|url|max:2048',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'working_hours' => 'nullable|string|max:255',
            'contact_info' => 'nullable|string|max:255',
        ]);

        $office = $this->currentOffice();
        $office->update($validated);

        return redirect('/office/details')->with('success', 'Office details updated successfully.');
    }

    private function currentOffice(): Office
    {
        $officeId = auth()->user()?->office_id;

        abort_unless($officeId, 403, 'Your account is not linked to an office.');

        return Office::findOrFail($officeId);
    }
}