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

        <label>Citizen Name</label><br>
        <input type="text" name="citizen_name" value="{{ old('citizen_name') }}" required>
        <br><br>

        <label>Citizen Email</label><br>
        <input type="email" name="citizen_email" value="{{ old('citizen_email') }}" required>
        <br><br>

        <label>Citizen Phone</label><br>
        <input type="text" name="citizen_phone" value="{{ old('citizen_phone') }}">
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
        <th>Citizen</th>
        <th>Status</th>
        <th>Notes</th>
        <th>Update Status</th>
        <th>Email Reminder</th>
        <th>Documents</th>
    </tr>

    @forelse ($appointments as $appointment)
        <tr>
            <td>{{ $appointment->id }}</td>
            <td>{{ $appointment->service->name ?? 'N/A' }}</td>
            <td>{{ optional($appointment->appointment_date)->format('Y-m-d') ?? 'N/A' }}</td>
            <td>{{ $appointment->appointment_time ?? 'N/A' }}</td>
            <td>
                <div>{{ $appointment->citizen_name ?: ($appointment->user->name ?? 'N/A') }}</div>
                <div>{{ $appointment->citizen_email ?: ($appointment->user->email ?? 'No email') }}</div>
                <div>{{ $appointment->citizen_phone ?: ($appointment->user->phone ?? 'No phone') }}</div>
            </td>
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
                <form method="POST" action="{{ route('office.appointments.emailReminder', $appointment->id) }}" style="display:inline;">
                    @csrf
                    <button type="submit" @disabled(! $appointment->citizen_email && ! $appointment->user?->email)>
                        Send Email
                    </button>
                </form>
                <div>
                    Email:
                    {{ optional($appointment->email_reminder_sent_at)->format('Y-m-d H:i') ?? 'Not sent' }}
                </div>
            </td>
            <td>
                <a href="{{ route('office.appointments.approval', $appointment->id) }}">Approval</a>
                <a href="{{ route('office.appointments.certificate', $appointment->id) }}">Certificate</a>
                <a href="{{ route('office.appointments.receipt', $appointment->id) }}">Receipt</a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="10">No appointments found for this office.</td>
        </tr>
    @endforelse
</table>