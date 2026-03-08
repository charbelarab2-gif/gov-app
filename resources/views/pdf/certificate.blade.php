<!DOCTYPE html>
<html>
<head>
<title>Municipality Certificate</title>
</head>
<body>
<h2>Municipality Certificate</h2>
<p>This certificate confirms that the citizen has completed the requested municipal service.</p>
<p><strong>Appointment ID:</strong> {{ $appointment->id }}</p>
<p><strong>User ID:</strong> {{ $appointment->user_id }}</p>
<p><strong>Service ID:</strong> {{ $appointment->service_id }}</p>
<p><strong>Date:</strong> {{ $appointment->appointment_date }}</p>
<br>
<p>Municipality Office</p>
</body>
</html>