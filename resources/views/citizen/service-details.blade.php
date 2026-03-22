<h1>{{ $service->name }}</h1>

<p>Price: {{ $service->price }}</p>

<p>Description: {{ $service->description }}</p>

<a href="/request/create/{{ $service->id }}">Request This Service</a>