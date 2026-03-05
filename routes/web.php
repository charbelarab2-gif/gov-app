<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CitizenRequestController;

Route::post('/requests', [CitizenRequestController::class, 'store'])->name('requests.store');
Route::get('/office/requests', [CitizenRequestController::class, 'officeIndex'])->name('office.requests');
Route::post('/requests/{id}/approve', [CitizenRequestController::class, 'approve']);
Route::post('/requests/{id}/reject', [CitizenRequestController::class, 'reject']);
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
});

require __DIR__.'/auth.php';