<?php

use Illuminate\Support\Facades\Route;

// ─────────────────────────────────────────────
// IMPORT CONTROLLERS
// ─────────────────────────────────────────────
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
// TutorProfileController tidak dipakai lagi untuk registrasi awal
use App\Http\Controllers\User\TutorDirectoryController;
use App\Http\Controllers\User\PackageTutorController;
use App\Http\Controllers\User\JournalController; 

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\KatalogTutorController;
use App\Http\Controllers\Admin\ImportTutorController;
use App\Http\Controllers\Admin\SiswaController; 
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\StrikeController;
use App\Http\Controllers\Admin\EscrowController;
use App\Http\Controllers\Admin\PayoutController;

// ─────────────────────────────────────────────
// PUBLIC ROUTES
// ─────────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
});

Route::get('/layanan', function () {
    return view('layanan');
})->name('layanan');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

Route::get('/katalog-tutor', [TutorDirectoryController::class, 'index'])->name('katalog.publik');

// ─────────────────────────────────────────────
// AUTHENTICATED ROUTES
// ─────────────────────────────────────────────
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute untuk halaman Checkout / Detail Tutor
    Route::get('/katalog-tutor/{id}', [\App\Http\Controllers\User\TutorDirectoryController::class, 'show'])->name('katalog.detail');
    Route::post('/katalog-tutor/{id}/pesan', [\App\Http\Controllers\User\TutorDirectoryController::class, 'storeOrder'])->name('katalog.pesan');

    // ─────────────────────────────────────────
    // TUTOR ROUTES (Etalase & Jurnal)
    // ─────────────────────────────────────────
   // ─────────────────────────────────────────
    // TUTOR ROUTES (Etalase, Jurnal, & Pesanan)
    // ─────────────────────────────────────────
    Route::prefix('tutor')->name('tutor.')->group(function () {
        // Paket / Etalase
        Route::get('/my-packages', [PackageTutorController::class, 'index'])->name('packages.index');
        Route::post('/my-packages', [PackageTutorController::class, 'store'])->name('packages.store');
        Route::patch('/my-packages/{id}/toggle', [PackageTutorController::class, 'toggleActive'])->name('packages.toggle');
        Route::delete('/my-packages/{id}', [PackageTutorController::class, 'destroy'])->name('packages.destroy');
        
        // Jurnal
        Route::post('/journal/store', [JournalController::class, 'store'])->name('journal.store');

        // 👇 PESANAN (MANAJEMEN TRANSAKSI FASE 2) 👇
        Route::get('/orders', [\App\Http\Controllers\User\OrderTutorController::class, 'index'])->name('orders.index');
        Route::post('/orders/{id}/accept', [\App\Http\Controllers\User\OrderTutorController::class, 'accept'])->name('orders.accept');
        Route::post('/orders/{id}/reject', [\App\Http\Controllers\User\OrderTutorController::class, 'reject'])->name('orders.reject');
    });

    // ─────────────────────────────────────────
    // ADMIN ROUTES
    // ─────────────────────────────────────────
    Route::middleware(['can:access-admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');   
    
        Route::post('/tutor/{tutor}/approve', [AdminDashboardController::class, 'approve'])->name('tutor.approve');
        Route::post('/tutor/{tutor}/reject', [AdminDashboardController::class, 'reject'])->name('tutor.reject');
        Route::post('/tutor/{tutor}/activate', [AdminDashboardController::class, 'activate'])->name('tutor.activate');
        
        Route::get('/tutor/{tutor}', [KatalogTutorController::class, 'show'])->name('tutor.detail');
        Route::get('/tutor/{tutor}/edit', [KatalogTutorController::class, 'edit'])->name('tutor.edit');
        Route::put('/tutor/{tutor}', [KatalogTutorController::class, 'update'])->name('tutor.update');

        Route::get('/katalog-tutor', [KatalogTutorController::class, 'index'])->name('katalog-tutor');
        Route::post('/katalog-tutor/manual', [KatalogTutorController::class, 'storeManual'])->name('tutor.store-manual');
        Route::post('/katalog-tutor/import', [ImportTutorController::class, 'import'])->name('tutor.import');

        Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
        Route::get('/siswa/{id}', [SiswaController::class, 'show'])->name('siswa.show');
        Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
        Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
        Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
        Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
        Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

        Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi');
        Route::get('/absensi/{jurnal}', [AbsensiController::class, 'show'])->name('absensi.show');
        Route::post('/absensi/{jurnal}/override', [AbsensiController::class, 'override'])->name('absensi.override');

        Route::get('/strike', [StrikeController::class, 'index'])->name('strike');
        Route::post('/strike/{tutor}/beri', [StrikeController::class, 'beri'])->name('strike.beri');
        Route::post('/strike/{tutor}/cabut', [StrikeController::class, 'cabut'])->name('strike.cabut');
        Route::post('/strike/{tutor}/banned', [StrikeController::class, 'banned'])->name('strike.banned');

        Route::get('/escrow', [EscrowController::class, 'index'])->name('escrow');
        Route::get('/escrow/{transaksi}', [EscrowController::class, 'show'])->name('escrow.show');
        Route::get('/payout', [PayoutController::class, 'index'])->name('payout');
        Route::get('/payout/{payout}', [PayoutController::class, 'show'])->name('payout.show');
        Route::post('/payout/{payout}/mark-paid', [PayoutController::class, 'markPaid'])->name('payout.mark-paid');
    });
});

require __DIR__.'/auth.php';