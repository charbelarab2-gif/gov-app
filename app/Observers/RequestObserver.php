<?php

namespace App\Observers;

use App\Mail\RequestStatusMail;
use App\Models\Request as ServiceRequest;
use App\Services\SmsService;
use Illuminate\Support\Facades\Mail;

class RequestObserver
{
    public function updated(ServiceRequest $request): void
    {
        if ($request->isDirty('status')) {

            // Send Email
            if ($request->user && $request->user->email) {
                Mail::to($request->user->email)
                    ->queue(new RequestStatusMail($request));
            }

            // Send SMS
            if ($request->user && $request->user->phone ?? null) {
                app(SmsService::class)->send(
                    $request->user->phone,
                    "Your request #{$request->id} is now: {$request->status}"
                );
            }
        }
    }
}