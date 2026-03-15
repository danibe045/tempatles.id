<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TutorProfileController;
use App\Http\Controllers\AdminDashboardController; // Pastikan ini di-import
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard Khusus Admin (Diproteksi Gate access-admin)
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->middleware('can:access-admin')
        ->name('admin.dashboard');

// Grouping Route yang membutuhkan Login
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard Umum
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    

    // Profile User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pendaftaran Profil Tutor
    Route::get('/tutor/register', [TutorProfileController::class, 'create'])->name('tutor.register');
    Route::post('/tutor/register', [TutorProfileController::class, 'store'])->name('tutor.store');
    Route::get('/admin/tutor/{id}', [AdminDashboardController::class, 'show'])
    ->middleware('can:access-admin')
    ->name('admin.tutor.detail');
});

require __DIR__.'/auth.php';