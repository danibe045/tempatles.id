<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TutorPackage; 

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'tutor') {
            // Karena profil dan user dibuat bersamaan, 
            // Kita sudah tidak perlu lagi melempar paksa ke form wizard di sini.
            // Biarkan file Blade yang menampilkan layar "Karantina" jika statusnya pending.

            $totalPaket = TutorPackage::where('user_id', $user->id)
                                    ->where('is_active', true)
                                    ->count();

            return view('tutor.dashboard-tutor', compact('user', 'totalPaket'));
        }

        return view('user.dashboard-murid', compact('user'));
    }
}