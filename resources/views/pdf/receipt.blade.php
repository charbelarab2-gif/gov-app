<!DOCTYPE html>
<html>
<head>
<title>Payment Receipt</title>
</head>
<body>
<h2>Municipality Receipt</h2>
<p>This document confirms the payment for the municipal service.</p>
<p><strong>Appointment ID:</strong> {{ $appointment->id }}</p>
<p><strong>Service ID:</strong> {{ $appointment->service_id }}</p>
<p><strong>Date:</strong> {{ $appointment->appointment_date }}</p>
<p><strong>Time:</strong> {{ $appointment->appointment_time }}</p>
</body>
</html>