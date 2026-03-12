<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\ServiceRequestController;
use App\Models\Office;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','admin'])->group(function(){

Route::get('/admin/dashboard',[AdminController::class,'dashboard']);
Route::get('/admin/reports',[AdminController::class,'reports']);
Route::get('/admin/offices',[OfficeController::class,'index']);
Route::get('/admin/offices/create',[OfficeController::class,'create']);
Route::post('/admin/offices',[OfficeController::class,'store']);
Route::delete('/admin/offices/{id}',[OfficeController::class,'destroy']);
Route::get('/admin/requests',[AdminController::class,'requests']);
Route::post('/admin/requests/{id}/approve',[AdminController::class,'approve']);
Route::post('/admin/requests/{id}/reject', [AdminController::class, 'reject'])->name('admin.requests.reject');
Route::get('/admin/users',[AdminController::class,'users']);
Route::post('/admin/users/{id}/activate',[AdminController::class,'activate']);
Route::post('/admin/users/{id}/deactivate',[AdminController::class,'deactivate']);
Route::get('/admin/offices/{id}/edit',[OfficeController::class,'edit']);
Route::post('/admin/offices/{id}/update',[OfficeController::class,'update']);

});
Route::middleware('auth')->group(function(){

Route::get('/request', function(){

$offices = Office::all();

return view('member.request',compact('offices'));

});

Route::post('/request',[ServiceRequestController::class,'store']);

});

Route::post('/request',[ServiceRequestController::class,'store']);
require __DIR__.'/auth.php';
