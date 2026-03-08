<!DOCTYPE html>
<html>
<head>
<title>Approval Document</title>
</head>
<body>
<h2>Municipality Approval Document</h2>
<p><strong>Appointment ID:</strong> {{ $appointment->id }}</p>
<p><strong>User ID:</strong> {{ $appointment->user_id }}</p>
<p><strong>Service ID:</strong> {{ $appointment->service_id }}</p>
<p><strong>Date:</strong> {{ $appointment->appointment_date }}</p>
<p><strong>Time:</strong> {{ $appointment->appointment_time }}</p>
<p><strong>Status:</strong> {{ $appointment->status }}</p>
<p>This document confirms that the request has been approved by the municipality office.</p>
</body>
</html>