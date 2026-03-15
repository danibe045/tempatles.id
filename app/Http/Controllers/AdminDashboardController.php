<?php

namespace App\Http\Controllers;

use App\Models\TutorProfile;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data tutor (kita pakai eager loading 'user' agar bisa ambil email/nama dari tabel users)
        $query = TutorProfile::with('user');

        // Logika Filter Search (Jika ada)
        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $tutors = $query->get();

        return view('admin.dashboard', compact('tutors'));
    }

    public function show($id)
    {
        $tutor = TutorProfile::with('user')->findOrFail($id);
        return view('admin.tutor-detail', compact('tutor'));
    }
}