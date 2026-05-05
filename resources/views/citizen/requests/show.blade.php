<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Details</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <!-- Back to Dashboard -->
    <a href="/citizen/dashboard" class="btn btn-dark mb-3">Dashboard</a>

    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Request Details</h2>
        </div>

        <div class="card-body">

            <p><strong>Service:</strong> {{ $request->service->name }}</p>

            <p><strong>Status:</strong>
                @if($request->status == 'pending')
                    <span class="badge bg-warning text-dark">Pending</span>
                @elseif($request->status == 'approved')
                    <span class="badge bg-success">Approved</span>
                @elseif($request->status == 'rejected')
                    <span class="badge bg-danger">Rejected</span>
                @endif
            </p>

            <p><strong>Description:</strong> {{ $request->description }}</p>

            <p><strong>Date:</strong> {{ $request->created_at->format('d M Y, H:i') }}</p>

            <!-- ✅ DOCUMENT INSIDE CARD -->
            @if($request->response_document)
                <hr>
                <p><strong>Document:</strong></p>
                <a href="{{ asset('storage/' . $request->response_document) }}" 
                   class="btn btn-outline-primary btn-sm" target="_blank">
                    View Uploaded Document
                </a>
            @endif

        </div>

        <div class="card-footer text-end">
            <a href="/my-requests" class="btn btn-secondary">Back</a>
        </div>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>