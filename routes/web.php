<?php 

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CitizenRequestController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SocialAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServiceRequestController;
use App\Models\Office;

/* ===================== REQUEST ROUTES ===================== */

Route::post('/requests', [CitizenRequestController::class, 'store'])->name('requests.store');
Route::post('/requests/{id}/approve', [CitizenRequestController::class, 'approve']);
Route::post('/requests/{id}/reject', [CitizenRequestController::class, 'reject']);

/* ===================== MAIN ROUTES ===================== */

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {

    //  ADDED FROM MAIN PROJECT
    if (auth()->check() && auth()->user()->role === 'office') {
        return redirect('/office');
    }

    return view('dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');

/* ===================== SOCIAL LOGIN ===================== */

Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback']);

/* ===================== AUTH USER ROUTES ===================== */

Route::middleware('auth')->group(function () {

    //  MAIN PROJECT FEATURES
    Route::get('/map', [OfficeController::class, 'map'])->name('map');
    Route::get('/requests/{id}', [RequestController::class, 'show'])->name('requests.show');
    Route::get('/conversations/{conversation}', [ChatController::class, 'index'])->name('conversations.show');
    Route::post('/conversations/{conversation}/messages', [ChatController::class, 'send'])->name('conversations.messages.send');

    //  PROFILE (COMMON)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* ===================== ADMIN ROUTES ===================== */

    Route::middleware(['auth','admin'])->group(function(){

        Route::get('/admin/dashboard',[AdminController::class,'dashboard']);
        Route::get('/admin/reports',[AdminController::class,'reports']);

        Route::get('/admin/offices',[OfficeController::class,'index']);
        Route::get('/admin/offices/create',[OfficeController::class,'create']);
        Route::post('/admin/offices',[OfficeController::class,'store']);
        Route::delete('/admin/offices/{id}',[OfficeController::class,'destroy']);
        Route::get('/admin/offices/{id}/edit',[OfficeController::class,'edit']);
        Route::post('/admin/offices/{id}/update',[OfficeController::class,'update']);

        Route::get('/admin/requests',[AdminController::class,'requests']);
        Route::post('/admin/requests/{id}/approve',[AdminController::class,'approve']);
        Route::post('/admin/requests/{id}/reject',[AdminController::class,'reject'])->name('admin.requests.reject');

        Route::get('/admin/users',[AdminController::class,'users']);
        Route::post('/admin/users/{id}/activate',[AdminController::class,'activate']);
        Route::post('/admin/users/{id}/deactivate',[AdminController::class,'deactivate']);

    });

    /* ===================== USER REQUEST (YOUR PART) ===================== */

    Route::get('/request', function(){

        $offices = Office::all();
        return view('member.request',compact('offices'));

    });

    Route::post('/request',[ServiceRequestController::class,'store']);

    /* ===================== OFFICE ROUTES (MAIN PROJECT) ===================== */

    Route::middleware('office')->group(function () {

        Route::get('/office', function () {
            return view('office.dashboard');
        })->name('office.dashboard');

        Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
        Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
        Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
        Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
        Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
        Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');

        Route::get('/service-categories', [ServiceCategoryController::class, 'index'])->name('service-categories.index');
        Route::post('/service-categories', [ServiceCategoryController::class, 'store'])->name('service-categories.store');
        Route::get('/service-categories/{id}/edit', [ServiceCategoryController::class, 'edit'])->name('service-categories.edit');
        Route::put('/service-categories/{id}', [ServiceCategoryController::class, 'update'])->name('service-categories.update');
        Route::delete('/service-categories/{id}', [ServiceCategoryController::class, 'destroy'])->name('service-categories.destroy');

        Route::get('/office/details', [OfficeController::class, 'details'])->name('office.details');
        Route::get('/office/details/edit', [OfficeController::class, 'editDetails'])->name('office.details.edit');
        Route::post('/office/details', [OfficeController::class, 'updateDetails'])->name('office.details.update');

        Route::get('/office/requests', [OfficeController::class, 'requests'])->name('office.requests');
        Route::post('/office/requests/{id}/status', [OfficeController::class, 'updateRequestStatus'])->name('office.requests.updateStatus');
        Route::post('/office/requests/{id}/upload', [OfficeController::class, 'uploadResponseDocument'])->name('office.requests.upload');

        Route::get('/office/appointments', [AppointmentController::class, 'index'])->name('office.appointments');
        Route::post('/office/appointments', [AppointmentController::class, 'store'])->name('office.appointments.store');
        Route::post('/office/appointments/{id}/status', [AppointmentController::class, 'updateStatus'])->name('office.appointments.updateStatus');
        Route::post('/office/appointments/{id}/email-reminder', [AppointmentController::class, 'sendEmailReminder'])->name('office.appointments.emailReminder');

        Route::get('/office/appointments/{id}/approval-pdf', [AppointmentController::class, 'generateApprovalPDF'])->name('office.appointments.approval');
        Route::get('/office/appointments/{id}/certificate-pdf', [AppointmentController::class, 'generateCertificate'])->name('office.appointments.certificate');
        Route::get('/office/appointments/{id}/receipt-pdf', [AppointmentController::class, 'generateReceipt'])->name('office.appointments.receipt');
    });

});

/* ===================== AUTH FILE ===================== */

require __DIR__.'/auth.php';