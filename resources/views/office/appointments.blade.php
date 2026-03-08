<h1>Appointments</h1>
@if(session('success'))
<p style="color: green;">{{ session('success') }}</p>
@endif
<h2>Schedule Appointment</h2>
<form method="POST" action="{{ route('office.appointments.store') }}">
   @csrf
<label>Service</label><br>
<select name="service_id" required>
<option value="">Select Service</option>
       @foreach($services as $service)
<option value="{{ $service->id }}">{{ $service->name }}</option>
       @endforeach
</select>
<br><br>
<label>Appointment Date</label><br>
<input type="date" name="appointment_date" required>
<label>Appointment Time</label>
<select name="appointment_time">
<option value="09:00:00">09:00 AM</option>
<option value="10:00:00">10:00 AM</option>
<option value="11:00:00">11:00 AM</option>
</select>
<br><br>
<label>Notes</label><br>
<textarea name="notes"></textarea>
<br><br>
<button type="submit">Book Appointment</button>
</form>
<hr>
<h2>All Appointments</h2>
<table border="1" cellpadding="8">
<tr>
<th>ID</th>
<th>Service ID</th>
<th>Appointment Date</th>
<th>Status</th>
<th>Notes</th>
<th>Update Status</th>
</tr>
   @foreach($appointments as $appointment)
<tr>
<td>{{ $appointment->id }}</td>
<td>{{ $appointment->service_id }}</td>
<td>{{ $appointment->appointment_date }}</td>
<td>{{ $appointment->status }}</td>
<td>{{ $appointment->notes }}</td>
<td>
<form method="POST" action="{{ route('office.appointments.updateStatus', $appointment->id) }}">
               @csrf
<select name="status">
<option value="pending">Pending</option>
<option value="confirmed">Confirmed</option>
<option value="cancelled">Cancelled</option>
<option value="completed">Completed</option>
</select>
<button type="submit">Update</button>
</form>
</td>
</tr>
   @endforeach
</table>