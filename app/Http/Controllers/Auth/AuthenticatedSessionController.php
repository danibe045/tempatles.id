<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1. Cek kecocokan email dan password
        $request->authenticate();

        // --- 2. CEK STATUS BANNED KHUSUS TUTOR ---
        $user = $request->user();
        
        if ($user->role === 'tutor') {
            $profile = \App\Models\TutorProfile::where('user_id', $user->id)->first();
            
            // Jika profil ditemukan dan statusnya banned, langsung tendang keluar
            if ($profile && $profile->status_akun === 'banned') {
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Maaf, akun Tutor Anda telah diblokir secara permanen oleh Admin karena pelanggaran.',
                ]);
            }
        }
        // ------------------------------------------

        // 3. Jika aman, buatkan sesi login
        $request->session()->regenerate();

        // 4. Cek apakah user yang baru saja login punya akses admin
        if ($request->user()->can('access-admin')) {
            // Lempar ke Dashboard Admin
            return redirect()->intended(route('admin.dashboard', absolute: false));
        }

        // Kalau user biasa/murid/tutor yang aman
        return redirect()->intended(route('dashboard', absolute: false));
    }    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}