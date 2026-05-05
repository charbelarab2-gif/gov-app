<!DOCTYPE html>
<html>
<head>
    <title>Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Available Services</h2>

    <div class="row">

        @forelse($services as $service)
            <div class="col-md-4">
                <div class="card mb-3 shadow">
                    <div class="card-body">
                        <h5>{{ $service->name }}</h5>
                        <p>{{ $service->description }}</p>
                        <p>Fee: ${{ $service->fee }}</p>

                        <a href="/citizen/request/{{ $service->id }}" class="btn btn-primary">
                            Request Service
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p>No services available.</p>
        @endforelse

    </div>

</div>

</body>
</html>