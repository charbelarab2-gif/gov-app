<!DOCTYPE html>
<html>
<head>
    <title>Request Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Request Service: {{ $service->name }}</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Messages --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/requests" enctype="multipart/form-data">
        @csrf

        <!-- Hidden Service ID -->
        <input type="hidden" name="service_id" value="{{ $service->id }}">

        <!-- Description -->
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea 
                name="description" 
                class="form-control" 
                placeholder="Explain your request..."
                rows="4"
                required>{{ old('description') }}</textarea>
        </div>

        <!-- Upload Document -->
        <div class="mb-3">
            <label class="form-label">Upload Document (optional)</label>
            <input 
                type="file" 
                name="document" 
                class="form-control">
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">
            Submit Request
        </button>

        <!-- Back Button -->
        <a href="/services" class="btn btn-secondary">
            Back to Services
        </a>

    </form>

</div>

</body>
</html>