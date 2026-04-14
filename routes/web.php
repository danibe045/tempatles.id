<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TutorProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\KatalogTutorController;
use App\Http\Controllers\Admin\ImportTutorController;
// use App\Http\Controllers\Admin\SilabusController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AbsensiController;
// use App\Http\Controllers\Admin\ResolusiController;
use App\Http\Controllers\Admin\StrikeController;
use App\Http\Controllers\Admin\EscrowController;
use App\Http\Controllers\Admin\PayoutController;
// User
use App\Http\Controllers\User\TutorDirectoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rute Layanan Kami
Route::get('/layanan', function () {
    return view('user.layanan');
})->name('layanan');

// Rute Tentang Kami
Route::get('/tentang', function () {
    return view('user.tentang');
})->name('tentang');

// Rute Katalog Tutor untuk Murid (Publik)
Route::get('/tutor', [TutorDirectoryController::class, 'index'])->name('katalog.publik');


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

        // Approve tutor - Tahap 1 (kirim kredensial login & ID Tutor)
        Route::post('/tutor/{tutor}/approve', [AdminDashboardController::class, 'approve'])
            ->name('tutor.approve');

        // Reject tutor - Tahap 1
        Route::post('/tutor/{tutor}/reject', [AdminDashboardController::class, 'reject'])
            ->name('tutor.reject');

        // Aktivasi akun - Tahap 2 (setelah MoU diverifikasi)
        Route::post('/tutor/{tutor}/activate', [AdminDashboardController::class, 'activate'])
            ->name('tutor.activate');

        Route::get('/tutor/{tutor}', [KatalogTutorController::class, 'show'])
            ->name('tutor.detail');
        // TAMBAHKAN 2 BARIS INI UNTUK FITUR EDIT
        Route::get('/tutor/{tutor}/edit', [KatalogTutorController::class, 'edit'])
            ->name('tutor.edit');
        Route::put('/tutor/{tutor}', [KatalogTutorController::class, 'update'])
            ->name('tutor.update');

        // Smart Filter - rekomendasi tutor cepat
        Route::get('/katalog-tutor', [KatalogTutorController::class, 'index'])
            ->name('katalog-tutor');

        // ── TAMBAHAN RUTE BARU UNTUK INPUT DATA ──────────
        Route::post('/katalog-tutor/manual', [KatalogTutorController::class, 'storeManual'])
            ->name('tutor.store-manual');
            
        Route::post('/katalog-tutor/import', [ImportTutorController::class, 'import'])
            ->name('tutor.import');

        // ── Manajemen Siswa (TAMBAHKAN INI) ───────────
        Route::get('/siswa', [App\Http\Controllers\Admin\SiswaController::class, 'index'])
            ->name('siswa.index');
        Route::get('/siswa/{id}', [App\Http\Controllers\Admin\SiswaController::class, 'show'])
            ->name('siswa.show');
        Route::get('/siswa/{id}/edit', [App\Http\Controllers\Admin\SiswaController::class, 'edit'])
            ->name('siswa.edit');
        Route::put('/siswa/{id}', [App\Http\Controllers\Admin\SiswaController::class, 'update'])
            ->name('siswa.update');
        Route::delete('/siswa/{id}', [App\Http\Controllers\Admin\SiswaController::class, 'destroy'])
            ->name('siswa.destroy');

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