<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/reservations', [AdminController::class, 'reservations'])->name('reservations');
    Route::put('/reservations/{id}/status', [AdminController::class, 'updateStatus'])->name('reservations.status');
    Route::delete('/reservations/{id}', [AdminController::class, 'deleteReservation'])->name('reservations.delete');

    Route::get('/layanan', [AdminController::class, 'showLayanan'])->name('layanan');
    Route::post('/layanan', [AdminController::class, 'storeLayanan'])->name('layanan.store');
    Route::put('/layanan/{id}', [AdminController::class, 'updateLayanan'])->name('layanan.update');
    Route::delete('/layanan/{id}', [AdminController::class, 'deleteLayanan'])->name('layanan.delete');

    Route::get('/status', [AdminController::class, 'status'])->name('status');
    Route::get('/antrian', [AdminController::class, 'antrian'])->name('antrian');
    Route::get('/laporan', [AdminController::class, 'laporan'])->name('laporan');
});