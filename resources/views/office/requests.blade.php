@extends('layouts.app')
@section('content')
{{-- Display incoming citizen requests with update and upload response options --}}
@include('office.partials.nav')
<div class="container-fluid px-0">
{{-- Page Title --}}
<div class="mb-4">
<h1 class="fw-bold mb-2">Incoming Requests</h1>
<p class="text-muted mb-0">
Review incoming requests, update their status, and upload response documents.
</p>
</div>
{{-- Display success message --}}
@if (session('success'))
<div class="alert alert-success rounded-3 mb-4">
{{ session('success') }}
</div>
@endif
{{-- Display validation errors --}}
@if ($errors->any())
<div class="alert alert-danger rounded-3 mb-4">
<strong>Please fix the following errors:</strong>
<ul class="mb-0 mt-2">
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
{{-- Requests table card --}}
<div class="card shadow-sm border-0 rounded-4">
<div class="card-body p-4 p-md-5">
{{-- Requests table --}}
<div class="table-responsive">
<table class="table table-bordered table-hover align-middle">
<thead class="table-light">
<tr>
<th>ID</th>
<th>User</th>
<th>Service</th>
<th>Status</th>
<th>Update Status</th>
<th>Upload Response</th>
</tr>
</thead>
<tbody>
{{-- Loop through incoming requests --}}
@forelse ($requests as $req)
<tr>
<td>{{ $req->id }}</td>
<td>{{ $req->user->name ?? 'N/A' }}</td>
<td>{{ $req->service->name ?? 'N/A' }}</td>
<td>{{ $req->status }}</td>
<td>
{{-- Form to update request status --}}
<form action="{{ route('office.requests.updateStatus', $req->id) }}" method="POST">
@csrf
<div class="d-flex flex-column gap-2">
<select name="status" class="form-select form-select-sm rounded-3">
<option value="pending" {{ $req->status == 'pending' ? 'selected' : '' }}>Pending</option>
<option value="in_review" {{ $req->status == 'in_review' ? 'selected' : '' }}>In Review</option>
<option value="missing_documents" {{ $req->status == 'missing_documents' ? 'selected' : '' }}>Missing Documents</option>
<option value="approved" {{ $req->status == 'approved' ? 'selected' : '' }}>Approved</option>
<option value="rejected" {{ $req->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
<option value="completed" {{ $req->status == 'completed' ? 'selected' : '' }}>Completed</option>
</select>
<button type="submit" class="btn btn-sm btn-outline-primary rounded-3">
Update
</button>
</div>
</form>
</td>
<td>
{{-- Form to upload office request response document --}}
<form action="{{ route('office.requests.upload', $req->id) }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="d-flex flex-column gap-2">
<input type="file" name="response_document" class="form-control form-control-sm rounded-3" required>
<button type="submit" class="btn btn-sm btn-outline-success rounded-3">
Upload
</button>
</div>
</form>
{{-- Display uploaded response file link --}}
@if ($req->response_document)
<div class="mt-2">
<a href="{{ asset('storage/responses/' . $req->response_document) }}" target="_blank" class="btn btn-sm btn-link p-0 text-decoration-none">
View File
</a>
</div>
@endif
</td>
</tr>
@empty
<tr>
<td colspan="6" class="text-center text-muted py-4">
No requests found for this office.
</td>
</tr>
@endforelse
</tbody>
</table>
</div>
</div>
</div>
</div>
@endsection