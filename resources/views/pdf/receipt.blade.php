<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Service Receipt</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #222; font-size: 14px; line-height: 1.5; }
        .header { border-bottom: 2px solid #222; margin-bottom: 20px; padding-bottom: 10px; }
        .title { font-size: 22px; font-weight: bold; margin: 0 0 8px; }
        .section { margin-bottom: 18px; }
        .section h3 { font-size: 16px; margin: 0 0 8px; border-bottom: 1px solid #ddd; padding-bottom: 4px; }
        .row { margin-bottom: 6px; }
        .label { font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <p class="title">{{ $appointment->office->name ?? 'Municipality Office' }}</p>
        <p>Service Receipt</p>
        <p>Receipt No: REC-{{ $appointment->id }}</p>
        <p>Issue Date: {{ now()->format('Y-m-d') }}</p>
    </div>

    <div class="section">
        <h3>Citizen Information</h3>
        <div class="row"><span class="label">Name:</span> {{ $appointment->citizen_name ?: ($appointment->user->name ?? 'N/A') }}</div>
        <div class="row"><span class="label">Email:</span> {{ $appointment->citizen_email ?: ($appointment->user->email ?? 'N/A') }}</div>
        <div class="row"><span class="label">Phone:</span> {{ $appointment->citizen_phone ?: ($appointment->user->phone ?? 'N/A') }}</div>
    </div>

    <div class="section">
        <h3>Service Record</h3>
        <div class="row"><span class="label">Service:</span> {{ $appointment->service->name ?? 'N/A' }}</div>
        <div class="row"><span class="label">Appointment Date:</span> {{ optional($appointment->appointment_date)->format('Y-m-d') ?? 'N/A' }}</div>
        <div class="row"><span class="label">Appointment Time:</span> {{ $appointment->appointment_time ?? 'N/A' }}</div>
        <div class="row"><span class="label">Current Status:</span> {{ ucfirst($appointment->status) }}</div>
        <div class="row"><span class="label">Recorded Fee:</span> {{ isset($appointment->service) ? number_format((float) $appointment->service->fee, 2) : '0.00' }}</div>
    </div>

    <div class="section">
        <h3>Receipt Statement</h3>
        <p>
            This receipt confirms that the service appointment has been recorded in the municipality system.
            Any applicable service fee or payment requirement is handled according to office policy.
        </p>
        @if ($appointment->notes)
            <p><span class="label">Notes:</span> {{ $appointment->notes }}</p>
        @endif
    </div>

    <div class="section">
        <h3>Office Contact</h3>
        <div class="row"><span class="label">Email:</span> {{ $appointment->office->email ?? 'N/A' }}</div>
        <div class="row"><span class="label">Phone:</span> {{ $appointment->office->phone ?? 'N/A' }}</div>
        <div class="row"><span class="label">Address:</span> {{ $appointment->office->address ?? 'N/A' }}</div>
    </div>
</body>
</html>