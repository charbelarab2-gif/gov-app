@extends('layouts.app')
@section('content')
{{-- Include office navigation menu --}}
@include('office.partials.nav')
<div class="container-fluid px-0">
{{-- Office Details Card --}}
<div class="card shadow-sm border-0 rounded-4">
<div class="card-body p-4 p-md-5">
{{-- Page Title --}}
<div class="mb-4">
<h1 class="fw-bold mb-2">Office Details</h1>
<p class="text-muted mb-0">
Update office information, contact details, and Google Maps location.
</p>
</div>
{{-- Success Message --}}
@if (session('success'))
<div class="alert alert-success rounded-3 mb-4">
{{ session('success') }}
</div>
@endif
{{-- Validation Errors --}}
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
{{-- Form to update office details --}}
<form method="POST" action="/office/details">
@csrf
<div class="row g-4">
{{-- Name --}}
<div class="col-md-6">
<label class="form-label fw-semibold">Name</label>
<input
type="text"
name="name"
value="{{ old('name', $office->name) }}"
class="form-control rounded-3"
>
</div>
{{-- Email --}}
<div class="col-md-6">
<label class="form-label fw-semibold">Email</label>
<input
type="text"
name="email"
value="{{ old('email', $office->email) }}"
class="form-control rounded-3"
>
</div>
{{-- Phone --}}
<div class="col-md-6">
<label class="form-label fw-semibold">Phone</label>
<input
type="text"
name="phone"
value="{{ old('phone', $office->phone) }}"
class="form-control rounded-3"
>
</div>
{{-- Address --}}
<div class="col-md-6">
<label class="form-label fw-semibold">Address</label>
<input
type="text"
name="address"
value="{{ old('address', $office->address) }}"
class="form-control rounded-3"
>
</div>
{{-- Google Maps Link --}}
<div class="col-md-6">
<label class="form-label fw-semibold">Google Maps Link</label>
<input
type="url"
name="google_maps_url"
value="{{ old('google_maps_url', $office->google_maps_url) }}"
class="form-control rounded-3"
>
</div>
{{-- Working Hours --}}
<div class="col-md-6">
<label class="form-label fw-semibold">Working Hours</label>
<input
type="text"
name="working_hours"
value="{{ old('working_hours', $office->working_hours) }}"
class="form-control rounded-3"
>
</div>
{{-- Contact Info --}}
<div class="col-12">
<label class="form-label fw-semibold">Contact Info</label>
<input
type="text"
name="contact_info"
value="{{ old('contact_info', $office->contact_info) }}"
class="form-control rounded-3"
>
</div>
</div>
{{-- Submit Button --}}
<div class="mt-4">
<button type="submit" class="btn btn-primary px-4 rounded-3">
Save Changes
</button>
</div>
</form>
</div>
</div>
{{-- Location Preview Card --}}
<div class="card shadow-sm border-0 rounded-4 mt-4">
<div class="card-body p-4 p-md-5">
{{-- Section Title --}}
<h2 class="fw-bold mb-3">Location Preview</h2>
{{-- Open Google Maps Link --}}
@if ($office->google_maps_url)
<p class="mb-3">
<a href="{{ $office->google_maps_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary rounded-3">
Open Google Maps
</a>
</p>
@endif
{{-- Google Maps Preview --}}
@if ($office->address)
<div class="rounded-4 overflow-hidden border">
<iframe
src="https://www.google.com/maps?q={{ urlencode($office->address) }}&z=15&output=embed"
width="100%"
height="350"
style="border:0;"
allowfullscreen
loading="lazy">
</iframe>
</div>
@else
{{-- No address message --}}
<div class="alert alert-secondary mb-0 rounded-3">
Add an address to preview the office location, and optionally a Google Maps link to open it directly.
</div>
@endif
</div>
</div>
</div>
@endsection