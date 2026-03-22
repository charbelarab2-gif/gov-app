<h1>Available Services</h1>

@foreach($services as $service)

<div>
<h3>{{ $service->name }}</h3>

<p>Price: {{ $service->price }}</p>

<a href="/services/{{ $service->id }}">View Details</a>

</div>

<hr>

@endforeach