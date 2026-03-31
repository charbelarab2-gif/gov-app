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
<a href="{{ route('citizen.services') }}">Browse Services</a>

<br><br>

<h3>Requests</h3>
<a href="{{ route('citizen.my.requests') }}">My Requests</a>

<br><br>

<a href="{{ route('citizen.request.create', ['service' => 1]) }}">Submit New Request</a>

<br><br>

<h3>Tracking</h3>
<!-- Example: track request with ID 1 -->
<a href="{{ route('citizen.track', ['request' => 1]) }}">Track Request (QR)</a>

<br><br>

<h3>Payments</h3>

@if(isset($requests) && count($requests) > 0)
    @foreach($requests as $request)
        <p>{{ $request->service_name }} - Status: {{ $request->status }}</p>
        <a href="{{ route('citizen.payment.form', ['requestId' => $request->id]) }}">
            Make Payment
        </a>
    @endforeach
@else
    <p>No requests available to pay yet.</p>
@endif
<hr>

<form method="POST" action="{{ route('citizen.logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>

</body>
</html>