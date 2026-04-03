<?php

namespace App\Mail;

use App\Models\Request as ServiceRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RequestStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $request;

    public function __construct(ServiceRequest $request)
    {
        $this->request = $request;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Request #' . $this->request->id . ' Updated',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.request-status',
        );
    }
}