<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TutorPackage; 

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
            
            // Hitung paket aktif milik tutor ini
            $totalPaket = TutorPackage::where('user_id', $user->id)
                                    ->where('is_active', true)
                                    ->count();

            return view('tutor.dashboard-tutor', compact('user', 'totalPaket'));
        }

        // 4. Jika Murid (atau role lain), arahkan ke dashboard murid
        return view('user.dashboard-murid', compact('user'));
    }
}