<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    public function index(): View
    {
        $officeId = $this->currentOfficeId();

        $appointments = Appointment::with(['service', 'user'])
            ->where('office_id', $officeId)
            ->orderByDesc('appointment_date')
            ->orderBy('appointment_time')
            ->get();

        $services = Service::where('office_id', $officeId)
            ->orderBy('name')
            ->get();

        return view('office.appointments', compact('appointments', 'services'));
    }

    public function store(Request $request): RedirectResponse
    {
        $officeId = $this->currentOfficeId();

        $validated = $request->validate([
            'service_id' => 'required|integer',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i:s',
            'notes' => 'nullable|string',
        ]);

        $service = Service::where('office_id', $officeId)->findOrFail($validated['service_id']);

        Appointment::create([
            'user_id' => null,
            'office_id' => $officeId,
            'service_id' => $service->id,
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'],
            'status' => 'pending',
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()
            ->route('office.appointments')
            ->with('success', 'Appointment created successfully.');
    }

    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $officeId = $this->currentOfficeId();

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $appointment = Appointment::where('office_id', $officeId)->findOrFail($id);
        $appointment->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('office.appointments')
            ->with('success', 'Appointment status updated successfully.');
    }

    public function generateApprovalPDF(int $id)
    {
        $appointment = $this->appointmentForCurrentOffice($id);
        $pdf = Pdf::loadView('pdf.approval', compact('appointment'));

        return $pdf->download("appointment-{$appointment->id}-approval.pdf");
    }

    public function generateCertificate(int $id)
    {
        $appointment = $this->appointmentForCurrentOffice($id);
        $pdf = Pdf::loadView('pdf.certificate', compact('appointment'));

        return $pdf->download("appointment-{$appointment->id}-certificate.pdf");
    }

    public function generateReceipt(int $id)
    {
        $appointment = $this->appointmentForCurrentOffice($id);
        $pdf = Pdf::loadView('pdf.receipt', compact('appointment'));

        return $pdf->download("appointment-{$appointment->id}-receipt.pdf");
    }

    private function appointmentForCurrentOffice(int $id): Appointment
    {
        return Appointment::with(['service', 'user'])
            ->where('office_id', $this->currentOfficeId())
            ->findOrFail($id);
    }

    private function currentOfficeId(): int
    {
        $officeId = auth()->user()?->office_id;

        abort_unless($officeId, 403, 'Your account is not linked to an office.');

        return (int) $officeId;
    }
}