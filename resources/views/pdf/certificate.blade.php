<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Service Completion Certificate</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #222; font-size: 14px; line-height: 1.6; }
        .header { text-align: center; border-bottom: 2px solid #222; padding-bottom: 10px; margin-bottom: 24px; }
        .title { font-size: 24px; font-weight: bold; margin: 0; }
        .subtitle { margin: 6px 0 0; color: #555; }
        .certificate-body { margin-top: 25px; }
        .highlight { font-weight: bold; }
        .footer { margin-top: 50px; }
    </style>
</head>
<body>
    <div class="header">
        <p class="title">{{ $appointment->office->name ?? 'Municipality Office' }}</p>
        <p class="subtitle">Service Completion Certificate</p>
        <p class="subtitle">Certificate No: CERT-{{ $appointment->id }}</p>
        <p class="subtitle">Issue Date: {{ now()->format('Y-m-d') }}</p>
    </div>

    <div class="certificate-body">
        <p>
            This is to certify that
            <span class="highlight">{{ $appointment->citizen_name ?: ($appointment->user->name ?? 'N/A') }}</span>
            has successfully completed the municipal service
            <span class="highlight">{{ $appointment->service->name ?? 'N/A' }}</span>.
        </p>

        <p>
            The appointment was recorded on
            <span class="highlight">{{ optional($appointment->appointment_date)->format('Y-m-d') ?? 'N/A' }}</span>
            at
            <span class="highlight">{{ $appointment->appointment_time ?? 'N/A' }}</span>.
        </p>

        <p>
            This certificate is issued by the municipality office for official and administrative use.
        </p>

        @if ($appointment->notes)
            <p><strong>Remarks:</strong> {{ $appointment->notes }}</p>
        @endif
    </div>

    <div class="footer">
        <p><strong>Office Contact:</strong> {{ $appointment->office->contact_info ?? ($appointment->office->email ?? 'N/A') }}</p>
        <p>Authorized Signature: ________________________</p>
        <p>Municipality Stamp: ________________________</p>
    </div>
</body>
</html>