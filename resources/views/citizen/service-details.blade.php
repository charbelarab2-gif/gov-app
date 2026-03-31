<!DOCTYPE html>
<html>
<head>
    <title>{{ $service->name }} Details</title>
</head>
<body>

<h1>{{ $service->name }}</h1>
<p>Price: ${{ $service->price }}</p>

<a href="/citizen/services">Back to all services</a>

</body>
</html>