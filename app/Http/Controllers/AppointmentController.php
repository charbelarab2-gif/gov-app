<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
class AppointmentController extends Controller
{
   public function index()
   {
       $appointments = Appointment::all();
       $services = Service::all();
       return view('office.appointments', compact('appointments', 'services'));
   }
   public function store(Request $request)
   {
       $request->validate([
           'service_id' => 'required|exists:services,id',
           'appointment_date' => 'required|date',
           'notes' => 'nullable|string',
           'appointment_time' => 'required',
       ]);
       $service = Service::findOrFail($request->service_id);
       Appointment::create([
           'user_id' => auth()->id(),
           'office_id' => $service->office_id,
           'service_id' => $service->id,
           'appointment_date' => $request->appointment_date,
           'appointment_time' => $request->appointment_time,
           'status' => 'pending',
           'notes' => $request->notes,
       ]);
       \Log::info('Email function reached');
       Mail::raw('Your appointment is confirmed. Please arrive 10 minutes before the scheduled time.', function ($message) {

        $message->to(auth()->user()->email)
    
                ->subject('Appointment Confirmation');
    
    });
     
       return redirect()->back()->with('success', 'Appointment created successfully');
   }
   public function updateStatus(Request $request, $id)
   {
       $request->validate([
           'status' => 'required',
       ]);
       $appointment = Appointment::findOrFail($id);
       $appointment->status = $request->status;
       $appointment->save();
       return redirect()->back()->with('success', 'Appointment status updated successfully');
   }
public function generateApprovalPDF($id)
{

    $appointment = Appointment::findOrFail($id);

    $pdf = Pdf::loadView('pdf.approval', compact('appointment'));

    return $pdf->download('approval.pdf');

}
public function generateCertificate($id)
{
   $appointment = Appointment::findOrFail($id);
   $pdf = Pdf::loadView('pdf.certificate', compact('appointment'));
   return $pdf->download('certificate.pdf');
}
public function generateReceipt($id)
{
   $appointment = Appointment::findOrFail($id);
   $pdf = Pdf::loadView('pdf.receipt', compact('appointment'));
   return $pdf->download('receipt.pdf');
}
}