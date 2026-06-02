<?php

use Illuminate\Support\Facades\Route;

// ─────────────────────────────────────────────
// IMPORT CONTROLLERS
// ─────────────────────────────────────────────
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TutorProfileController;
use App\Http\Controllers\User\ProfileMuridController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\TutorDirectoryController;
use App\Http\Controllers\User\PackageTutorController;
use App\Http\Controllers\User\JournalController; 
use App\Http\Controllers\User\OrderTutorController;
use App\Http\Controllers\User\OrderMuridController;
use App\Http\Controllers\User\WalletController;

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\KatalogTutorController;
use App\Http\Controllers\Admin\ImportTutorController;
use App\Http\Controllers\Admin\SiswaController; 
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\StrikeController;
use App\Http\Controllers\Admin\EscrowController;
use App\Http\Controllers\Admin\PayoutController;
use App\Http\Controllers\User\TutorReputationController;

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
Route::get('/katalog-tutor/{id}', [TutorDirectoryController::class, 'show'])->name('katalog.detail');

// ─────────────────────────────────────────────
// AUTHENTICATED ROUTES
// ─────────────────────────────────────────────
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ─────────────────────────────────────────
    // MURID ROUTES
    // ─────────────────────────────────────────
    Route::post('/katalog-tutor/{id}/pesan', [TutorDirectoryController::class, 'storeOrder'])->name('katalog.pesan');
    
    // Pembayaran, Penyelesaian & Komplain Murid (Duplikat sudah dibersihkan)
    Route::post('/murid/orders/{id}/bayar', [OrderMuridController::class, 'bayar'])->name('murid.orders.bayar');
    Route::post('/murid/orders/{id}/selesai', [OrderMuridController::class, 'selesaikan'])->name('murid.orders.selesai');
    Route::post('/murid/orders/{id}/komplain', [OrderMuridController::class, 'komplain'])->name('murid.orders.komplain');
    Route::get('/murid/riwayat', [OrderMuridController::class, 'riwayat'])->name('murid.riwayat');

    // Edit Profil Murid
    Route::put('/murid/profil/update', [ProfileMuridController::class, 'update'])->name('murid.profil.update');
    Route::delete('/murid/profil/foto', [ProfileMuridController::class, 'destroyPhoto'])->name('murid.profil.hapus-foto');

    // ─────────────────────────────────────────
    // TUTOR ROUTES (Etalase, Jurnal, & Pesanan)
    // ─────────────────────────────────────────
    Route::prefix('tutor')->name('tutor.')->group(function () {
        // Profil Tutor (Wizard Step 1 & 2)
        Route::get('/profile', [TutorProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [TutorProfileController::class, 'update'])->name('profile.update');
        Route::patch('/profile/password', [TutorProfileController::class, 'updatePassword'])->name('profile.password');

        // Paket / Etalase
        Route::get('/my-packages', [PackageTutorController::class, 'index'])->name('packages.index');
        Route::post('/my-packages', [PackageTutorController::class, 'store'])->name('packages.store');
        Route::patch('/my-packages/{id}/toggle', [PackageTutorController::class, 'toggleActive'])->name('packages.toggle');
        Route::delete('/my-packages/{id}', [PackageTutorController::class, 'destroy'])->name('packages.destroy');

        // Reputasi Tutor (Rating & Strike)
        Route::get('/reviews', [TutorReputationController::class, 'reviews'])->name('reviews');
        Route::get('/strikes', [TutorReputationController::class, 'strikes'])->name('strikes');
        
        // Jurnal & Dompet
        Route::post('/journal/store', [JournalController::class, 'store'])->name('journal.store');
        Route::post('/wallet/claim/{order_id}', [WalletController::class, 'claimEscrow'])->name('wallet.claim');
        Route::post('/wallet/payout', [WalletController::class, 'requestPayout'])->name('wallet.payout');
        
        // Pesanan (Manajemen Transaksi Fase 2)
        Route::get('/orders', [OrderTutorController::class, 'index'])->name('orders.index');
        Route::post('/orders/{id}/accept', [OrderTutorController::class, 'accept'])->name('orders.accept');
        Route::post('/orders/{id}/reject', [OrderTutorController::class, 'reject'])->name('orders.reject');

        // Cukup tulis /schedule/update karena sudah otomatis diawali /tutor dari prefix group
        Route::post('/schedule/update', [OrderTutorController::class, 'aturJadwal'])->name('schedule.update');
    });

    // ─────────────────────────────────────────
    // ADMIN ROUTES
    // ─────────────────────────────────────────
    Route::middleware(['can:access-admin'])->prefix('admin')->name('admin.')->group(function () {
        
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');   
        Route::put('/tutors/{id}/status', [AdminDashboardController::class, 'updateStatus'])->name('tutors.updateStatus');
        Route::delete('/tutors/{id}/hapus', [AdminDashboardController::class, 'destroyTutor'])->name('tutors.destroy');
        
        // Katalog Tutor Admin
        Route::get('/katalog-tutor', [KatalogTutorController::class, 'index'])->name('katalog-tutor');
        Route::get('/tutor/{tutor}', [KatalogTutorController::class, 'show'])->name('tutor.detail');
        Route::get('/tutor/{tutor}/edit', [KatalogTutorController::class, 'edit'])->name('tutor.edit');
        Route::put('/tutor/{tutor}', [KatalogTutorController::class, 'update'])->name('tutor.update');
        Route::post('/katalog-tutor/manual', [KatalogTutorController::class, 'storeManual'])->name('tutor.store-manual');
        Route::post('/katalog-tutor/import', [ImportTutorController::class, 'import'])->name('tutor.import');
        Route::delete('/tutor/{id}/hapus-foto', [KatalogTutorController::class, 'destroyPhoto'])->name('tutor.hapus-foto');
        Route::patch('/tutor/{id}/nonaktifkan', [KatalogTutorController::class, 'nonaktifkan'])->name('tutor.nonaktifkan');

        // Manajemen Siswa
        Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
        Route::get('/siswa/{id}', [SiswaController::class, 'show'])->name('siswa.show');
        Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
        Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
        Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

        // Manajemen Pesanan
        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
        Route::post('/orders/{order}/verify', [OrderController::class, 'verifyPayment'])->name('orders.verify');

        // Absensi
        Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi');
        Route::get('/absensi/{jurnal}', [AbsensiController::class, 'show'])->name('absensi.show');
        Route::post('/absensi/{jurnal}/override', [AbsensiController::class, 'override'])->name('absensi.override');

        // Manajemen Strike & Komplain
        Route::get('/strike', [StrikeController::class, 'index'])->name('strike');
        Route::post('/strike/beri', [StrikeController::class, 'beri'])->name('strike.beri');
        Route::post('/strike/{id}/cabut', [StrikeController::class, 'cabut'])->name('strike.cabut');
        Route::post('/tutor/{id}/banned', [StrikeController::class, 'banned'])->name('strike.banned');
        Route::post('/admin/complaints/{id}/update', [StrikeController::class, 'updateStatusKomplain'])->name('complaints.update');
        
        // Keuangan (Escrow & Payout)
        Route::get('/escrow', [EscrowController::class, 'index'])->name('escrow');
        Route::get('/escrow/{transaksi}', [EscrowController::class, 'show'])->name('escrow.show');
        Route::post('/escrow/{transaksi}/release', [EscrowController::class, 'release'])->name('escrow.release');
        Route::get('/payout', [PayoutController::class, 'index'])->name('payout');
        Route::get('/payout/{payout}', [PayoutController::class, 'show'])->name('payout.show');
        Route::post('/payout/{payout}/mark-paid', [PayoutController::class, 'markPaid'])->name('payout.mark-paid');
    });
});

require __DIR__.'/auth.php';