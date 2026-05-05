<!DOCTYPE html>
<html>
<head>
    <title>My Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>My Requests</h2>

    <!-- ✅ SUCCESS MESSAGE (FIXED POSITION) -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Buttons -->
    <div class="mb-3">
        <a href="/services" class="btn btn-primary">Request New Service</a>
        <a href="/citizen/dashboard" class="btn btn-dark">Dashboard</a>
    </div>

    <!-- FILTER -->
    <form method="GET" class="mb-3 d-flex align-items-center gap-2">
        <select name="status" class="form-select w-25">
            <option value="">All</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
        </select>

        <button class="btn btn-primary">Filter</button>
    </form>

    <!-- Table -->
    <table class="table table-bordered table-hover">

        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Service</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>
        @forelse($requests as $req)
            <tr>
                <td>
                    <a href="/my-requests/{{ $req->id }}">
                        {{ $req->id }}
                    </a>
                </td>

                <td>{{ $req->service->name ?? 'N/A' }}</td>

                <td>
                    @if($req->status == 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                    @elseif($req->status == 'approved')
                        <span class="badge bg-success">Approved</span>
                    @elseif($req->status == 'rejected')
                        <span class="badge bg-danger">Rejected</span>
                    @endif
                </td>

                <!-- ✅ FORMAT DATE -->
                <td>{{ $req->created_at->format('d M Y') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">No requests found.</td>
            </tr>
        @endforelse
        </tbody>

    </table>

</div>

</body>
</html>