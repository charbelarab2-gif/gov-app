<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialAuthController;

// Citizen Controllers
use App\Http\Controllers\Citizen\AuthController;
use App\Http\Controllers\Citizen\DashboardController;
use App\Http\Controllers\Citizen\ServiceController;
use App\Http\Controllers\Citizen\RequestController;
use App\Http\Controllers\Citizen\PaymentController;
use App\Http\Controllers\Citizen\QRController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Default Dashboard (Laravel Breeze / Auth users)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Social Login
|--------------------------------------------------------------------------
*/
Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback']);

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Citizen Panel
|--------------------------------------------------------------------------
*/
Route::prefix('citizen')->group(function () {

    // Authentication
    Route::get('/register', [AuthController::class, 'registerForm'])->name('citizen.register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('citizen.register');

    Route::get('/login', [AuthController::class, 'loginForm'])->name('citizen.login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('citizen.login');

    Route::post('/logout', [AuthController::class, 'logout'])->name('citizen.logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('citizen.dashboard');

    // Services
    Route::get('/services', [ServiceController::class, 'index'])->name('citizen.services');
    Route::get('/services/{id}', [ServiceController::class, 'show'])->name('citizen.service.details');

    // Service Requests
    Route::get('/request/create/{service}', [RequestController::class, 'create'])->name('citizen.request.create');
    Route::post('/request/store', [RequestController::class, 'store'])->name('citizen.request.store');

    // My Requests
    Route::get('/my-requests', [RequestController::class, 'index'])->name('citizen.my.requests');

    // Show the payment form (GET)
Route::get('/payment/{requestId}', [PaymentController::class, 'showPaymentForm'])
    ->name('citizen.payment.form');

// Submit the payment (POST)
Route::post('/payment', [PaymentController::class, 'pay'])
    ->name('citizen.payment');

    // QR Tracking
    Route::get('/track/{request}', [QRController::class, 'track'])->name('citizen.track');
});

require __DIR__.'/auth.php';