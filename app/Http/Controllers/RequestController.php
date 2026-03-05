<?php

namespace App\Http\Controllers;

use App\Models\Request as ServiceRequest;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RequestController extends Controller
{
    public function store(Request $request)
    {
        $serviceRequest = ServiceRequest::create([
            'user_id'    => auth()->id(),
            'service_id' => $request->service_id,
            'status'     => 'pending',
        ]);

        $this->generateQr($serviceRequest);

        return redirect()->route('requests.show', $serviceRequest->id);
    }

    private function generateQr($serviceRequest)
    {
        $url    = route('requests.show', $serviceRequest->id);
        $qrCode = new QrCode($url);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        $path = 'qrcodes/request_' . $serviceRequest->id . '.png';
        Storage::disk('public')->put($path, $result->getString());

        $serviceRequest->update(['qr_code_path' => $path]);
    }

    public function show($id)
    {
        $request = ServiceRequest::findOrFail($id);
        return view('requests.show', compact('request'));
    }
}