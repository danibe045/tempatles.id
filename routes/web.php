<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TutorProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\KatalogTutorController;
use App\Http\Controllers\Admin\SilabusController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\ResolusiController;
use App\Http\Controllers\Admin\StrikeController;
use App\Http\Controllers\Admin\EscrowController;
use App\Http\Controllers\Admin\PayoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ─────────────────────────────────────────────
// AUTHENTICATED ROUTES
// ─────────────────────────────────────────────
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

    // ─────────────────────────────────────────
    // ADMIN ROUTES
    // ─────────────────────────────────────────
    Route::middleware(['can:access-admin'])->prefix('admin')->name('admin.')->group(function () {

        // ── Dashboard Utama Admin ─────────────
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');   
    
        // ── Manajemen Tutor ───────────────────
        // Detail tutor

        // Approve tutor - Tahap 1 (kirim kredensial login & ID Tutor)
        Route::post('/tutor/{tutor}/approve', [AdminDashboardController::class, 'approve'])
            ->name('tutor.approve');

        // Reject tutor - Tahap 1
        Route::post('/tutor/{tutor}/reject', [AdminDashboardController::class, 'reject'])
            ->name('tutor.reject');

        // Aktivasi akun - Tahap 2 (setelah MoU diverifikasi)
        Route::post('/tutor/{tutor}/activate', [AdminDashboardController::class, 'activate'])
            ->name('tutor.activate');

        Route::get('/tutor/{tutor}', [AdminDashboardController::class, 'show'])
            ->name('tutor.detail');

        // Smart Filter - rekomendasi tutor cepat
        Route::get('/katalog-tutor', [KatalogTutorController::class, 'index'])
            ->name('katalog-tutor');

        // Monitoring Silabus & Rencana Ajar
        Route::get('/silabus', [SilabusController::class, 'index'])
            ->name('silabus');
        Route::get('/silabus/{silabus}', [SilabusController::class, 'show'])
            ->name('silabus.show');

        // ── Operasional ───────────────────────

        // Manajemen Pesanan
        Route::get('/orders', [OrderController::class, 'index'])
            ->name('orders');
        Route::get('/orders/create', [OrderController::class, 'create'])
            ->name('orders.create');
        Route::post('/orders', [OrderController::class, 'store'])
            ->name('orders.store');
        Route::get('/orders/{order}', [OrderController::class, 'show'])
            ->name('orders.show');

        // Absensi & Jurnal Mengajar
        Route::get('/absensi', [AbsensiController::class, 'index'])
            ->name('absensi');
        Route::get('/absensi/{jurnal}', [AbsensiController::class, 'show'])
            ->name('absensi.show');
        // Override strike otomatis (batalkan jika ada kendala sah)
        Route::post('/absensi/{jurnal}/override', [AbsensiController::class, 'override'])
            ->name('absensi.override');

        // Pusat Resolusi Komplain
        Route::get('/resolusi', [ResolusiController::class, 'index'])
            ->name('resolusi');
        Route::get('/resolusi/{komplain}', [ResolusiController::class, 'show'])
            ->name('resolusi.show');
        // Putuskan: teruskan dana ke tutor atau refund ke murid
        Route::post('/resolusi/{komplain}/putuskan', [ResolusiController::class, 'putuskan'])
            ->name('resolusi.putuskan');

        // ── Kendali Mutu ──────────────────────

        // Manajemen Strike
        Route::get('/strike', [StrikeController::class, 'index'])
            ->name('strike');
        Route::post('/strike/{tutor}/beri', [StrikeController::class, 'beri'])
            ->name('strike.beri');
        Route::post('/strike/{tutor}/cabut', [StrikeController::class, 'cabut'])
            ->name('strike.cabut');
        Route::post('/strike/{tutor}/banned', [StrikeController::class, 'banned'])
            ->name('strike.banned');

        // ── Keuangan ─────────────────────────

        // Monitoring Escrow
        Route::get('/escrow', [EscrowController::class, 'index'])
            ->name('escrow');
        Route::get('/escrow/{transaksi}', [EscrowController::class, 'show'])
            ->name('escrow.show');

        // Pencairan Dana (Payout)
        Route::get('/payout', [PayoutController::class, 'index'])
            ->name('payout');
        Route::get('/payout/{payout}', [PayoutController::class, 'show'])
            ->name('payout.show');
        // Mark as Paid - konfirmasi transfer sudah dilakukan admin
        Route::post('/payout/{payout}/mark-paid', [PayoutController::class, 'markPaid'])
            ->name('payout.mark-paid');

    });

});

require __DIR__.'/auth.php';