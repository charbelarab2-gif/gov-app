<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CitizenRequest;
use App\Models\Office;
use Illuminate\Support\Facades\Auth;

class OfficeController extends Controller
{
    public function map()
    {
        $offices = Office::all();
        return view('citizen.map', compact('offices'));
    }

    public function requests()
    {
        $requests = CitizenRequest::with(['user', 'service'])->get();
        return view('office.requests', compact('requests'));
    }

    public function updateRequestStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);
        $citizenRequest = CitizenRequest::findOrFail($id);
        $citizenRequest->status = $request->status;
        $citizenRequest->save();
        return redirect()->back();
    }

    public function uploadResponseDocument(Request $request, $id)
    {
        $request->validate([
            'response_document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120'
        ]);
        $citizenRequest = CitizenRequest::findOrFail($id);
        $file = $request->file('response_document');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/responses', $filename);
        $citizenRequest->response_document = $filename;
        $citizenRequest->save();
        return redirect()->back()->with('success', 'Response uploaded');
    }

    public function details()
    {
        $office = Office::first();
        return view('office.details', compact('office'));
    }

    public function editDetails()
    {
        $office = Office::first();
        return view('office.edit', compact('office'));
    }

    public function updateDetails(Request $request)
    {
        $office = Office::first();
        $office->name = $request->name;
        $office->email = $request->email;
        $office->phone = $request->phone;
        $office->address = $request->address;
        $office->latitude = $request->latitude;
        $office->longitude = $request->longitude;
        $office->working_hours = $request->working_hours;
        $office->contact_info = $request->contact_info;
        $office->save();
        return redirect('/office/details');
    }
}