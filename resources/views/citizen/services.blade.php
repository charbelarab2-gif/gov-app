<!DOCTYPE html>
<html>
<head>
    <title>Services</title>
</head>
<body>

<h1>Services</h1>

@if($services->count())
    <ul>
    @foreach($services as $service)
        <li>
            <strong>{{ $service->name }}</strong> - ${{ $service->price }}
            <a href="/citizen/services/{{ $service->id }}">View Details</a>
        </li>
    @endforeach
    </ul>
@else
    <p>No services found.</p>
@endif

</body>
</html>