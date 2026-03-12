<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\CitizenRequestController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\AppointmentController;


Route::post('/requests', [CitizenRequestController::class, 'store'])->name('requests.store');
Route::get('/office/requests', [CitizenRequestController::class, 'officeIndex'])->name('office.requests');
Route::post('/requests/{id}/approve', [CitizenRequestController::class, 'approve']);
Route::post('/requests/{id}/reject', [CitizenRequestController::class, 'reject']);
Route::get('/office/requests', [OfficeController::class, 'requests'])->name('office.requests');
Route::post('/office/requests/{id}/status', [OfficeController::class, 'updateRequestStatus'])
   ->name('office.requests.updateStatus');
Route::post('/office/requests/{id}/upload', [OfficeController::class, 'uploadResponseDocument'])
   ->name('office.requests.upload');
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Social auth routes - must be outside 'auth' middleware
Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback']);
 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
Route::get('/service-categories', [ServiceCategoryController::class, 'index'])->name('service-categories.index');
Route::post('/service-categories', [ServiceCategoryController::class, 'store'])->name('service-categories.store');
Route::get('/service-categories/{id}/edit', [ServiceCategoryController::class, 'edit'])->name('service-categories.edit');
Route::put('/service-categories/{id}', [ServiceCategoryController::class, 'update'])->name('service-categories.update');
Route::delete('/service-categories/{id}', [ServiceCategoryController::class, 'destroy'])->name('service-categories.destroy');
Route::get('/office/details', [OfficeController::class, 'details']);
Route::get('/office/details/edit', [OfficeController::class, 'editDetails']);
Route::post('/office/details', [OfficeController::class, 'updateDetails']);
Route::get('/office/appointments', [AppointmentController::class, 'index'])->name('office.appointments');
Route::post('/office/appointments', [AppointmentController::class, 'store'])->name('office.appointments.store');
Route::post('/office/appointments/{id}/status', [AppointmentController::class, 'updateStatus'])->name('office.appointments.updateStatus');
Route::post('/office/appointments/{id}/email-reminder', [AppointmentController::class, 'sendEmailReminder'])->name('office.appointments.emailReminder');
Route::get('/office/appointments/{id}/approval-pdf', [AppointmentController::class, 'generateApprovalPDF'])->name('office.appointments.approval');
Route::get('/office/appointments/{id}/certificate-pdf', [AppointmentController::class, 'generateCertificate'])->name('office.appointments.certificate');
Route::get('/office/appointments/{id}/receipt-pdf', [AppointmentController::class, 'generateReceipt'])->name('office.appointments.receipt');
});

require __DIR__.'/auth.php';