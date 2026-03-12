<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Service Approval Notice</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #222; font-size: 14px; line-height: 1.5; }
        .header { border-bottom: 2px solid #222; margin-bottom: 20px; padding-bottom: 10px; }
        .title { font-size: 22px; font-weight: bold; margin: 0 0 8px; }
        .subtitle { margin: 0; color: #555; }
        .section { margin-bottom: 18px; }
        .section h3 { font-size: 16px; margin: 0 0 8px; border-bottom: 1px solid #ddd; padding-bottom: 4px; }
        .row { margin-bottom: 6px; }
        .label { font-weight: bold; }
        .signature { margin-top: 40px; }
    </style>
</head>
<body>
    <div class="header">
        <p class="title">{{ $appointment->office->name ?? 'Municipality Office' }}</p>
        <p class="subtitle">Service Approval Notice</p>
        <p class="subtitle">Reference: APP-{{ $appointment->id }}</p>
        <p class="subtitle">Issue Date: {{ now()->format('Y-m-d') }}</p>
    </div>

    <div class="section">
        <h3>Citizen Information</h3>
        <div class="row"><span class="label">Name:</span> {{ $appointment->citizen_name ?: ($appointment->user->name ?? 'N/A') }}</div>
        <div class="row"><span class="label">Email:</span> {{ $appointment->citizen_email ?: ($appointment->user->email ?? 'N/A') }}</div>
        <div class="row"><span class="label">Phone:</span> {{ $appointment->citizen_phone ?: ($appointment->user->phone ?? 'N/A') }}</div>
    </div>

    <div class="section">
        <h3>Service Details</h3>
        <div class="row"><span class="label">Service:</span> {{ $appointment->service->name ?? 'N/A' }}</div>
        <div class="row"><span class="label">Appointment Date:</span> {{ optional($appointment->appointment_date)->format('Y-m-d') ?? 'N/A' }}</div>
        <div class="row"><span class="label">Appointment Time:</span> {{ $appointment->appointment_time ?? 'N/A' }}</div>
        <div class="row"><span class="label">Status:</span> {{ ucfirst($appointment->status) }}</div>
    </div>

    <div class="section">
        <h3>Approval Statement</h3>
        <p>
            This document confirms that the municipality office has approved the requested service appointment.
            The citizen is requested to attend on the scheduled date and time and bring all required supporting documents.
        </p>
        @if ($appointment->notes)
            <p><span class="label">Office Notes:</span> {{ $appointment->notes }}</p>
        @endif
    </div>

    <div class="section">
        <h3>Office Contact</h3>
        <div class="row"><span class="label">Email:</span> {{ $appointment->office->email ?? 'N/A' }}</div>
        <div class="row"><span class="label">Phone:</span> {{ $appointment->office->phone ?? 'N/A' }}</div>
        <div class="row"><span class="label">Address:</span> {{ $appointment->office->address ?? 'N/A' }}</div>
    </div>

    <div class="signature">
        <p>Authorized by: ________________________</p>
        <p>Municipality Stamp: __________________</p>
    </div>
</body>
</html>