<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PasswordResetOtpController extends Controller
{
    // 1. Menampilkan form input nomor WA awal
    public function create()
    {
        return view('auth.forgot-password');
    }

    // 2. Memproses pembuatan OTP & simulasi kirim WA
    public function store(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string',
        ], [
            'phone_number.required' => 'Nomor WhatsApp wajib diisi untuk verifikasi data.'
        ]);

        // Cari data pengguna berdasarkan nomor WhatsApp
        $user = User::where('phone_number', $request->phone_number)->first();

        if (!$user) {
            return back()->withErrors(['phone_number' => 'Nomor WhatsApp tersebut tidak terdaftar di sistem Tempatles.id.']);
        }

        // Generate kode OTP acak (6 digit)
        $otp = rand(100000, 999999);

        // Simpan ke database dengan batas kedaluwarsa 5 menit ke depan
        $user->update([
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(30),
        ]);

        // Format pesan teks formal
        $pesanWa = "Halo {$user->name}!\n\nKode OTP Anda untuk melakukan pengaturan ulang kata sandi di *Tempatles.id* adalah: *{$otp}*\n\nDemi keamanan akun Anda, mohon jangan menyebarkan kode ini kepada pihak manapun. Kode ini bersifat rahasia dan akan kedaluwarsa dalam waktu 5 menit.";

        // CATATAN LOG LOKAL: Cek kodenya nanti di file storage/logs/laravel.log
        Log::info("=== WHATSAPP OTP SEND TO {$user->phone_number} ===\n" . $pesanWa);

        // Simpan nomor WhatsApp sementara ke session untuk validasi di halaman berikutnya
        session(['reset_phone' => $user->phone_number]);

        return redirect()->route('password.otp.verify_form')->with('success', 'Kode keamanan OTP berhasil dikirimkan ke WhatsApp Anda.');
    }

    // 3. Menampilkan form input 6 digit OTP
    public function showVerifyForm()
    {
        if (!session()->has('reset_phone')) {
            return redirect()->route('password.request');
        }
        return view('auth.verify-otp');
    }

    // 4. Memverifikasi kode OTP dari user
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|array|size:6',
        ], [
            'otp.required' => 'Mohon lengkapi kode verifikasi OTP Anda.'
        ]);

        // 1. Ambil data nomor dari session
        $phone = session('reset_phone');

        // JIKA SESSION HILANG/KOSONG, BERARTI DRIVER DATABASE BERMASALAH
        if (!$phone) {
            return back()->withErrors(['otp' => 'Sesi verifikasi hilang atau tidak valid. Silakan kembali ke halaman awal dan masukkan nomor kembali.']);
        }

        // Satukan array input menjadi string "123456"
        $otpCode = implode('', $request->otp);

        // 2. Cari user berdasarkan nomor telepon dan kode OTP saja dulu
        $user = User::where('phone_number', $phone)
                    ->where('otp_code', $otpCode)
                    ->first();

        if (!$user) {
            return back()->withErrors(['otp' => 'Kode OTP yang Anda masukkan salah.']);
        }

        // 3. Pengecekan waktu dengan library Carbon agar aman dari selisih jam database
        $waktuSkarang = \Carbon\Carbon::now('Asia/Jakarta');
        $waktuExpires = \Carbon\Carbon::parse($user->otp_expires_at, 'Asia/Jakarta');

        if ($waktuSkarang->greaterThan($waktuExpires)) {
            return back()->withErrors(['otp' => 'Kode OTP telah kedaluwarsa. Silakan ajukan ulang kode baru.']);
        }

        // Jika lolos, buat token akses sementara
        $secretToken = Str::random(60);
        session(['otp_verified_token' => $secretToken]);

        return redirect()->route('password.reset', ['token' => $secretToken]);
    }

    // 5. Menampilkan halaman input password baru
    public function showResetForm(Request $request)
    {
        if (!session()->has('otp_verified_token') || session('otp_verified_token') !== $request->token) {
            return redirect()->route('password.request')->with('error', 'Akses otentikasi tidak sah.');
        }

        return view('auth.reset-password', ['token' => $request->token]);
    }

    // 6. Eksekusi update password baru ke database
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
            'password.min' => 'Kata sandi minimal harus terdiri dari 8 karakter.'
        ]);

        if (!session()->has('otp_verified_token') || session('otp_verified_token') !== $request->token) {
            return redirect()->route('password.request')->with('error', 'Sesi verifikasi Anda telah kedaluwarsa.');
        }

        $phone = session('reset_phone');
        $user = User::where('phone_number', $phone)->firstOrFail();

        // Update password baru dan langsung bersihkan rekam jejak OTP
        $user->update([
            'password' => Hash::make($request->password),
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);

        // Bersihkan data session
        session()->forget(['reset_phone', 'otp_verified_token']);

        return redirect()->route('login')->with('success', 'Kata sandi akun Anda berhasil diperbarui! Silakan masuk kembali.');
    }
}