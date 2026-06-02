<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Strike;
use Illuminate\Support\Facades\Auth;

class TutorReputationController extends Controller
{
    /**
     * Menampilkan Halaman Ulasan (Rating)
     */
    public function reviews()
    {
        $user = Auth::user();
        
        // Ambil ulasan, urutkan dari yang terbaru
        $reviews = Review::with(['murid', 'order'])
                        ->where('tutor_id', $user->id)
                        ->latest()
                        ->paginate(12);

        $avgRating = Review::where('tutor_id', $user->id)->avg('rating') ?? 0;
        $totalReviews = Review::where('tutor_id', $user->id)->count();

        return view('tutor.reviews.index', compact('user', 'reviews', 'avgRating', 'totalReviews'));
    }

    /**
     * Menampilkan Halaman Catatan Pelanggaran (Strike)
     */
    public function strikes()
    {
        $user = Auth::user();

        // Ambil data strike, urutkan dari yang terbaru
        $strikes = Strike::where('tutor_id', $user->id)
                        ->latest()
                        ->paginate(10);

        $activeStrikes = Strike::where('tutor_id', $user->id)->where('status', 'aktif')->count();

        return view('tutor.strikes.index', compact('user', 'strikes', 'activeStrikes'));
    }
}