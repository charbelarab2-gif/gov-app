<!-- Office dashboard providing quick access to main office features and pages -->
<!-- Include office navigation menu -->
@extends('layouts.app')
@section('content')
@include('office.partials.nav')
<h1 class="mb-4">Office Dashboard</h1>
<div class="row g-4">
<div class="col-md-6 col-lg-4">
<a href="{{ url('/office/details') }}" class="text-decoration-none">
<div class="card shadow-sm border-0 h-100">
<div class="card-body">
<h5 class="card-title">Office Details and Google Maps</h5>
<p class="card-text text-muted">Manage office information and map location.</p>
</div>
</div>
</a>
</div>
<div class="col-md-6 col-lg-4">
<a href="{{ route('service-categories.index') }}" class="text-decoration-none">
<div class="card shadow-sm border-0 h-100">
<div class="card-body">
<h5 class="card-title">Service Categories</h5>
<p class="card-text text-muted">View and manage service categories.</p>
</div>
</div>
</a>
</div>
<div class="col-md-6 col-lg-4">
<a href="{{ route('services.index') }}" class="text-decoration-none">
<div class="card shadow-sm border-0 h-100">
<div class="card-body">
<h5 class="card-title">Services</h5>
<p class="card-text text-muted">Manage office services.</p>
</div>
</div>
</a>
</div>
<div class="col-md-6 col-lg-4">
<a href="{{ route('office.appointments') }}" class="text-decoration-none">
<div class="card shadow-sm border-0 h-100">
<div class="card-body">
<h5 class="card-title">Appointments and Email Reminders</h5>
<p class="card-text text-muted">Track appointments and reminders.</p>
</div>
</div>
</a>
</div>
<div class="col-md-6 col-lg-4">
<a href="{{ route('office.requests') }}" class="text-decoration-none">
<div class="card shadow-sm border-0 h-100">
<div class="card-body">
<h5 class="card-title">Requests and Response Uploads</h5>
<p class="card-text text-muted">Review requests and upload responses.</p>
</div>
</div>
</a>
</div>
<div class="col-md-6 col-lg-4">
<a href="{{ route('profile.edit') }}" class="text-decoration-none">
<div class="card shadow-sm border-0 h-100">
<div class="card-body">
<h5 class="card-title">Profile and Two-Factor Authentication</h5>
<p class="card-text text-muted">Manage profile settings and security.</p>
</div>
</div>
</a>
</div>
</div>
@endsection