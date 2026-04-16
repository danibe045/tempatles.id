<?php

use Illuminate\Support\Facades\Route;

// ─────────────────────────────────────────────
// IMPORT CONTROLLERS
// ─────────────────────────────────────────────
// User & Publik
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TutorProfileController;
use App\Http\Controllers\User\TutorDirectoryController;
use App\Http\Controllers\User\PackageTutorController;

// Admin
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\KatalogTutorController;
use App\Http\Controllers\Admin\ImportTutorController;
use App\Http\Controllers\Admin\SiswaController; // <-- Import dirapikan di sini
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\StrikeController;
use App\Http\Controllers\Admin\EscrowController;
use App\Http\Controllers\Admin\PayoutController;
// use App\Http\Controllers\Admin\SilabusController;
// use App\Http\Controllers\Admin\ResolusiController;


// ─────────────────────────────────────────────
// PUBLIC ROUTES (Tidak Perlu Login)
// ─────────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
});

// Halaman Statis
Route::get('/layanan', function () {
    return view('user.layanan');
})->name('layanan');

Route::get('/tentang', function () {
    return view('user.tentang');
})->name('tentang');

// Katalog Tutor Publik
Route::get('/tutor', [TutorDirectoryController::class, 'index'])->name('katalog.publik');


// ─────────────────────────────────────────────
// AUTHENTICATED ROUTES (Wajib Login)
// ─────────────────────────────────────────────
Route::middleware(['auth', 'verified'])->group(function () {

    // 1. Dashboard Pintar (Otomatis diarahkan sesuai Role: Murid/Tutor/Admin)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Profile User (Bawaan Laravel Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 3. Pendaftaran Profil Tutor (Setelah user biasa/murid ingin jadi tutor)
    Route::get('/tutor/register', [TutorProfileController::class, 'create'])->name('tutor.register');
    Route::post('/tutor/register', [TutorProfileController::class, 'store'])->name('tutor.store');

    // ─────────────────────────────────────────
    // TUTOR ROUTES (Fitur Etalase Paket Maharani)
    // ─────────────────────────────────────────
    Route::prefix('tutor')->name('tutor.')->group(function () {
        // Manajemen Paket (Etalase Produk Tutor)
        Route::get('/my-packages', [PackageTutorController::class, 'index'])->name('packages.index');
        Route::post('/my-packages', [PackageTutorController::class, 'store'])->name('packages.store');
        
        // 👇 INI BARIS YANG KURANG MAS DANI (Route untuk Switch On/Off) 👇
        Route::patch('/my-packages/{id}/toggle', [PackageTutorController::class, 'toggleActive'])->name('packages.toggle');
        
        Route::delete('/my-packages/{id}', [PackageTutorController::class, 'destroy'])->name('packages.destroy');
    });


    // ─────────────────────────────────────────
    // ADMIN ROUTES (Wajib Login & Wajib Admin)
    // ─────────────────────────────────────────
    Route::middleware(['can:access-admin'])->prefix('admin')->name('admin.')->group(function () {

        // -- Dashboard Utama Admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');   
    
        // -- Manajemen Tutor
        Route::post('/tutor/{tutor}/approve', [AdminDashboardController::class, 'approve'])->name('tutor.approve');
        Route::post('/tutor/{tutor}/reject', [AdminDashboardController::class, 'reject'])->name('tutor.reject');
        Route::post('/tutor/{tutor}/activate', [AdminDashboardController::class, 'activate'])->name('tutor.activate');
        
        Route::get('/tutor/{tutor}', [KatalogTutorController::class, 'show'])->name('tutor.detail');
        Route::get('/tutor/{tutor}/edit', [KatalogTutorController::class, 'edit'])->name('tutor.edit');
        Route::put('/tutor/{tutor}', [KatalogTutorController::class, 'update'])->name('tutor.update');

        // -- Smart Filter / Katalog Tutor Admin
        Route::get('/katalog-tutor', [KatalogTutorController::class, 'index'])->name('katalog-tutor');
        Route::post('/katalog-tutor/manual', [KatalogTutorController::class, 'storeManual'])->name('tutor.store-manual');
        Route::post('/katalog-tutor/import', [ImportTutorController::class, 'import'])->name('tutor.import');

        // -- Manajemen Siswa (Lebih rapi karena import ditaruh di atas)
        Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
        Route::get('/siswa/{id}', [SiswaController::class, 'show'])->name('siswa.show');
        Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
        Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
        Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

        // -- Manajemen Pesanan (Orders)
        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
        Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
        Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

        // -- Absensi & Jurnal Mengajar
        Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi');
        Route::get('/absensi/{jurnal}', [AbsensiController::class, 'show'])->name('absensi.show');
        Route::post('/absensi/{jurnal}/override', [AbsensiController::class, 'override'])->name('absensi.override');

        // -- Manajemen Strike (Pelanggaran)
        Route::get('/strike', [StrikeController::class, 'index'])->name('strike');
        Route::post('/strike/{tutor}/beri', [StrikeController::class, 'beri'])->name('strike.beri');
        Route::post('/strike/{tutor}/cabut', [StrikeController::class, 'cabut'])->name('strike.cabut');
        Route::post('/strike/{tutor}/banned', [StrikeController::class, 'banned'])->name('strike.banned');

        // -- Keuangan & Escrow
        Route::get('/escrow', [EscrowController::class, 'index'])->name('escrow');
        Route::get('/escrow/{transaksi}', [EscrowController::class, 'show'])->name('escrow.show');
        Route::get('/payout', [PayoutController::class, 'index'])->name('payout');
        Route::get('/payout/{payout}', [PayoutController::class, 'show'])->name('payout.show');
        Route::post('/payout/{payout}/mark-paid', [PayoutController::class, 'markPaid'])->name('payout.mark-paid');
    });
});

require __DIR__.'/auth.php';