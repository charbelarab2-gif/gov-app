<!DOCTYPE html>
<html>
<head>
    <title>Citizen Dashboard</title>
</head>
<body>

<h1>Citizen Dashboard</h1>

<p>Welcome to the Government Services Portal</p>

<hr>

<h3>Services</h3>

<a href="/citizen/services">Browse Services</a>

<br><br>

<h3>Requests</h3>

<a href="/citizen/my-requests">My Requests</a>

<br><br>

<a href="/citizen/request/create/1">Submit New Request</a>

<br><br>

<h3>Tracking</h3>

<a href="/citizen/track/1">Track Request (QR)</a>

<br><br>

<h3>Payments</h3>

<a href="/citizen/payment">Make Payment</a>

<br><br>

<hr>

<form method="POST" action="/citizen/logout">
@csrf
<button type="submit">Logout</button>
</form>

</body>
</html>