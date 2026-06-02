<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TutorProfile; 
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(Request $request): View
    {
        $role = $request->query('role', 'murid');
        return view('auth.register', compact('role'));
    }

    public function store(Request $request): RedirectResponse
    {
        $role = $request->input('role', 'murid');

        // ========================================================
        // JIKA YANG MENDAFTAR ADALAH TUTOR (FULL WIZARD)
        // ========================================================
        if ($role === 'tutor') {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'phone_number' => ['required', 'string', 'max:255'],
                'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
                'tempat_lahir' => ['required', 'string', 'max:255'],
                'tanggal_lahir' => ['required', 'date'],
                'alamat_domisili' => ['required', 'string'],
                'pendidikan_terakhir' => ['required', 'string', 'max:255'],
                'instansi' => ['required', 'string', 'max:255'],
                'bidang' => ['required', 'string', 'max:255'],
                'pengalaman' => ['required', 'string'],
                'link' => ['required', 'url'],
                
                'setuju_pernyataan' => ['accepted'],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'tutor',
                'phone_number' => $request->phone_number,
            ]);

            TutorProfile::create([
                'user_id' => $user->id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat_domisili' => $request->alamat_domisili,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'instansi' => $request->instansi,
                'bidang' => $request->bidang,
                'pengalaman' => $request->pengalaman,
                'link' => $request->link,
                
                'setuju_pernyataan' => true,
                'strike_count' => 0,
                'status_akun' => 'menunggu_mou', 
            ]);

            event(new Registered($user));
            Auth::login($user);

            return redirect(route('dashboard', absolute: false));
        }

        // ========================================================
        // JIKA YANG MENDAFTAR ADALAH MURID BIASA
        // ========================================================
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'murid',
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}