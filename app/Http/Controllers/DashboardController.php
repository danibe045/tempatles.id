<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data user yang login
        $user = Auth::user();

        // 2. Jika Admin, arahkan ke dashboard admin
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // 3. Jika Tutor, arahkan ke view tutor.dashboard
        if ($user->role === 'tutor') {
            return view('tutor.dashboard-tutor', compact('user'));
        }

        // 4. Jika Murid (atau role lain), arahkan ke dashboard murid
        // Kita gunakan compact('user') agar nama "Dani" bisa muncul di banner
        return view('user.dashboard-murid', compact('user'));
    }
}