<h1>Incoming Requests</h1>

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>User</th>
        <th>Service</th>
        <th>Status</th>
        <th>Update Status</th>
        <th>Upload Response</th>
    </tr>
    @forelse ($requests as $req)
        <tr>
            <td>{{ $req->id }}</td>
            <td>{{ $req->user->name ?? 'N/A' }}</td>
            <td>{{ $req->service->name ?? 'N/A' }}</td>
            <td>{{ $req->status }}</td>
            <td>
                <form action="{{ route('office.requests.updateStatus', $req->id) }}" method="POST">
                    @csrf
                    <select name="status">
                        <option value="pending" {{ $req->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_review" {{ $req->status == 'in_review' ? 'selected' : '' }}>In Review</option>
                        <option value="missing_documents" {{ $req->status == 'missing_documents' ? 'selected' : '' }}>Missing Documents</option>
                        <option value="approved" {{ $req->status == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ $req->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="completed" {{ $req->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
            <td>
                <form action="{{ route('office.requests.upload', $req->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="response_document" required>
                    <button type="submit">Upload</button>
                </form>
                @if ($req->response_document)
                    <a href="{{ asset('storage/responses/' . $req->response_document) }}" target="_blank">View File</a>
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6">No requests found for this office.</td>
        </tr>
    @endforelse
</table>