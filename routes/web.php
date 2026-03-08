<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CitizenRequestController;
use App\Http\Controllers\AppointmentController;


// Public request routes (outside auth middleware)
Route::post('/requests', [CitizenRequestController::class, 'store'])->name('requests.store');
Route::get('/office/requests', [CitizenRequestController::class, 'officeIndex'])->name('office.requests');
Route::post('/requests/{id}/approve', [CitizenRequestController::class, 'approve']);
Route::post('/requests/{id}/reject', [CitizenRequestController::class, 'reject']);
Route::post('/office/requests/{id}/status', [OfficeController::class, 'updateRequestStatus'])
    ->name('office.requests.updateStatus');
Route::post('/office/requests/{id}/upload', [OfficeController::class, 'uploadResponseDocument'])
    ->name('office.requests.upload');
Route::get('/appointment/{id}/pdf', [AppointmentController::class, 'generateApprovalPDF']);
Route::get('/appointment/{id}/certificate', [AppointmentController::class, 'generateCertificate']);
Route::get('/appointment/{id}/receipt', [AppointmentController::class, 'generateReceipt']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Social auth routes
Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback']);

// Protected routes
Route::middleware('auth')->group(function () {

    // Map route
    Route::get('/map', [OfficeController::class, 'map']);

    // Request routes
    Route::post('/requests', [RequestController::class, 'store'])->name('requests.store');
    Route::get('/requests/{id}', [RequestController::class, 'show'])->name('requests.show');

    // Chat routes
    Route::get('/conversations/{conversation}', [ChatController::class, 'index']);
    Route::post('/conversations/{conversation}/messages', [ChatController::class, 'send']);

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Service routes
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');

    // Office routes
    Route::get('/office/requests', [OfficeController::class, 'requests'])->name('office.requests');
    Route::get('/office/details', [OfficeController::class, 'details']);
    Route::get('/office/details/edit', [OfficeController::class, 'editDetails']);
    Route::post('/office/details', [OfficeController::class, 'updateDetails']);

    // Appointment routes
    Route::get('/office/appointments', [AppointmentController::class, 'index'])->name('office.appointments');
    Route::post('/office/appointments', [AppointmentController::class, 'store'])->name('office.appointments.store');
    Route::post('/office/appointments/{id}/status', [AppointmentController::class, 'updateStatus'])->name('office.appointments.updateStatus');
});

require __DIR__.'/auth.php';