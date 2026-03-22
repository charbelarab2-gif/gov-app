<h1>My Requests</h1>

@foreach($requests as $request)

<div>

<p>Request ID: {{ $request->id }}</p>

<p>Status: {{ $request->status }}</p>

</div>

<hr>

@endforeach