@extends('layouts.app')
@section('content')
{{-- Include office navigation menu --}}
@include('office.partials.nav')
<div class="container-fluid px-0">
{{-- Page Title --}}
<div class="mb-4">
<h1 class="fw-bold mb-2">Appointments</h1>
<p class="text-muted mb-0">
Manage office appointments including scheduling, updating status, sending emails, and generating documents.
</p>
</div>
{{-- Success message after operations --}}
@if (session('success'))
<div class="alert alert-success rounded-3 mb-4">
{{ session('success') }}
</div>
@endif
{{-- Display validation error messages --}}
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
{{-- Appointment scheduling card --}}
<div class="card shadow-sm border-0 rounded-4 mb-4">
<div class="card-body p-4 p-md-5">
{{-- Appointment scheduling form title --}}
<h2 class="fw-bold mb-4">Schedule Appointment</h2>
@if ($services->isEmpty())
<div class="alert alert-warning rounded-3 mb-0">
Add at least one service before scheduling appointments.
</div>
@else
{{-- Form to create new appointment --}}
<form method="POST" action="{{ route('office.appointments.store') }}">
@csrf
<div class="row g-4">
{{-- Select service for appointment --}}
<div class="col-md-6">
<label class="form-label fw-semibold">Service</label>
<select name="service_id" class="form-select rounded-3" required>
<option value="">Select Service</option>
@foreach ($services as $service)
<option value="{{ $service->id }}" @selected(old('service_id') == $service->id)>
{{ $service->name }}
</option>
@endforeach
</select>
</div>
{{-- Citizen Name --}}
<div class="col-md-6">
<label class="form-label fw-semibold">Citizen Name</label>
<input
type="text"
name="citizen_name"
value="{{ old('citizen_name') }}"
class="form-control rounded-3"
required
>
</div>
{{-- Citizen Email --}}
<div class="col-md-6">
<label class="form-label fw-semibold">Citizen Email</label>
<input
type="email"
name="citizen_email"
value="{{ old('citizen_email') }}"
class="form-control rounded-3"
required
>
</div>
{{-- Citizen Phone --}}
<div class="col-md-6">
<label class="form-label fw-semibold">Citizen Phone</label>
<input
type="text"
name="citizen_phone"
value="{{ old('citizen_phone') }}"
class="form-control rounded-3"
>
</div>
{{-- Appointment Date --}}
<div class="col-md-6">
<label class="form-label fw-semibold">Appointment Date</label>
<input
type="date"
name="appointment_date"
value="{{ old('appointment_date') }}"
class="form-control rounded-3"
required
>
</div>
{{-- Select available appointment time --}}
<div class="col-md-6">
<label class="form-label fw-semibold">Appointment Time</label>
<select name="appointment_time" class="form-select rounded-3" required>
@foreach ([
'09:00:00' => '09:00 AM',
'10:00:00' => '10:00 AM',
'11:00:00' => '11:00 AM',
'12:00:00' => '12:00 PM',
'01:00:00' => '01:00 PM',
'02:00:00' => '02:00 PM',
'03:00:00' => '03:00 PM',
'04:00:00' => '04:00 PM',
] as $value => $label)
<option value="{{ $value }}" @selected(old('appointment_time') === $value)>
{{ $label }}
</option>
@endforeach
</select>
</div>
{{-- Notes --}}
<div class="col-12">
<label class="form-label fw-semibold">Notes</label>
<textarea
name="notes"
rows="3"
class="form-control rounded-3"
>{{ old('notes') }}</textarea>
</div>
</div>
{{-- Submit button --}}
<div class="mt-4">
<button type="submit" class="btn btn-primary rounded-3 px-4">
Book Appointment
</button>
</div>
</form>
@endif
</div>
</div>
{{-- Display all scheduled appointments --}}
<div class="card shadow-sm border-0 rounded-4">
<div class="card-body p-4 p-md-5">
<h2 class="fw-bold mb-4">All Appointments</h2>
<div class="table-responsive">
<table class="table table-bordered table-hover align-middle">
<thead class="table-light">
<tr>
<th>ID</th>
<th>Service</th>
<th>Date</th>
<th>Time</th>
<th>Citizen</th>
<th>Status</th>
<th>Notes</th>
<th>Update Status</th>
<th>Email Reminder</th>
<th>Documents</th>
</tr>
</thead>
<tbody>
{{-- Loop through appointments list --}}
@forelse ($appointments as $appointment)
<tr>
<td>{{ $appointment->id }}</td>
<td>{{ $appointment->service->name ?? 'N/A' }}</td>
<td>{{ optional($appointment->appointment_date)->format('Y-m-d') ?? 'N/A' }}</td>
<td>{{ $appointment->appointment_time ?? 'N/A' }}</td>
<td>
<div><strong>{{ $appointment->citizen_name ?: ($appointment->user->name ?? 'N/A') }}</strong></div>
<div>{{ $appointment->citizen_email ?: ($appointment->user->email ?? 'No email') }}</div>
<div>{{ $appointment->citizen_phone ?: ($appointment->user->phone ?? 'No phone') }}</div>
</td>
<td>{{ ucfirst($appointment->status) }}</td>
<td>{{ $appointment->notes ?: 'N/A' }}</td>
<td>
{{-- Update appointment status --}}
<form method="POST" action="{{ route('office.appointments.updateStatus', $appointment->id) }}">
@csrf
<div class="d-flex flex-column gap-2">
<select name="status" class="form-select form-select-sm">
@foreach (['pending', 'confirmed', 'cancelled', 'completed'] as $status)
<option value="{{ $status }}" @selected($appointment->status === $status)>
{{ ucfirst($status) }}
</option>
@endforeach
</select>
<button type="submit" class="btn btn-sm btn-outline-primary rounded-3">
Update
</button>
</div>
</form>
</td>
<td>
{{-- Send email reminder to citizen --}}
<form method="POST" action="{{ route('office.appointments.emailReminder', $appointment->id) }}">
@csrf
<button
type="submit"
class="btn btn-sm btn-outline-success rounded-3 mb-2"
@disabled(! $appointment->citizen_email && ! $appointment->user?->email)
>
Send Email
</button>
</form>
<div class="small text-muted">
<strong>Email:</strong><br>
{{ optional($appointment->email_reminder_sent_at)->format('Y-m-d H:i') ?? 'Not sent' }}
</div>
</td>
<td>
{{-- Generate related documents --}}
<div class="d-flex flex-column gap-2">
<a href="{{ route('office.appointments.approval', $appointment->id) }}" class="btn btn-sm btn-outline-secondary rounded-3">
Approval
</a>
<a href="{{ route('office.appointments.certificate', $appointment->id) }}" class="btn btn-sm btn-outline-secondary rounded-3">
Certificate
</a>
<a href="{{ route('office.appointments.receipt', $appointment->id) }}" class="btn btn-sm btn-outline-secondary rounded-3">
Receipt
</a>
</div>
</td>
</tr>
@empty
<tr>
<td colspan="10" class="text-center text-muted py-4">
No appointments found for this office.
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