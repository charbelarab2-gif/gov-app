<h1>Appointments</h1>

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

<h2>Schedule Appointment</h2>

@if ($services->isEmpty())
    <p>Add at least one service before scheduling appointments.</p>
@else
    <form method="POST" action="{{ route('office.appointments.store') }}">
        @csrf

        <label>Service</label><br>
        <select name="service_id" required>
            <option value="">Select Service</option>
            @foreach ($services as $service)
                <option value="{{ $service->id }}" @selected(old('service_id') == $service->id)>
                    {{ $service->name }}
                </option>
            @endforeach
        </select>
        <br><br>

        <label>Appointment Date</label><br>
        <input type="date" name="appointment_date" value="{{ old('appointment_date') }}" required>
        <br><br>

        <label>Appointment Time</label><br>
        <select name="appointment_time" required>
            @foreach (['09:00:00' => '09:00 AM', '10:00:00' => '10:00 AM', '11:00:00' => '11:00 AM'] as $value => $label)
                <option value="{{ $value }}" @selected(old('appointment_time') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        <br><br>

        <label>Notes</label><br>
        <textarea name="notes">{{ old('notes') }}</textarea>
        <br><br>

        <button type="submit">Book Appointment</button>
    </form>
@endif

<hr>

<h2>All Appointments</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Service</th>
        <th>Date</th>
        <th>Time</th>
        <th>Status</th>
        <th>Notes</th>
        <th>Update Status</th>
        <th>Documents</th>
    </tr>

    @forelse ($appointments as $appointment)
        <tr>
            <td>{{ $appointment->id }}</td>
            <td>{{ $appointment->service->name ?? 'N/A' }}</td>
            <td>{{ optional($appointment->appointment_date)->format('Y-m-d') ?? 'N/A' }}</td>
            <td>{{ $appointment->appointment_time ?? 'N/A' }}</td>
            <td>{{ ucfirst($appointment->status) }}</td>
            <td>{{ $appointment->notes ?: 'N/A' }}</td>
            <td>
                <form method="POST" action="{{ route('office.appointments.updateStatus', $appointment->id) }}">
                    @csrf
                    <select name="status">
                        @foreach (['pending', 'confirmed', 'cancelled', 'completed'] as $status)
                            <option value="{{ $status }}" @selected($appointment->status === $status)>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
            <td>
                <a href="{{ route('office.appointments.approval', $appointment->id) }}">Approval</a>
                <a href="{{ route('office.appointments.certificate', $appointment->id) }}">Certificate</a>
                <a href="{{ route('office.appointments.receipt', $appointment->id) }}">Receipt</a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8">No appointments found for this office.</td>
        </tr>
    @endforelse
</table>