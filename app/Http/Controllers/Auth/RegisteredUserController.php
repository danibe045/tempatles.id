<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Menampilkan halaman pendaftaran.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Menangani permintaan pendaftaran masuk.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi data input termasuk role
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:murid,tutor,admin'], 
        ]);

        // 2. Simpan data user baru ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, 
        ]);

        event(new Registered($user));

        Auth::login($user);

        // 3. Logika Redirect: Jika pendaftar adalah Tutor, arahkan ke form profil
        if ($user->role === 'tutor') {
            return redirect()->route('tutor.register'); 
        }

        // Jika murid atau admin, arahkan ke dashboard standar
        return redirect(route('dashboard', absolute: false));
    }
}