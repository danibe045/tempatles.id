<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payout;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    public function index(Request $request)
    {
        // 1. Statistik untuk Gradient Cards
        $countPending = Payout::where('status', 'pending')->count();
        $totalNominalPending = Payout::where('status', 'pending')->sum('nominal');
        $totalNominalBerhasil = Payout::where('status', 'berhasil')->sum('nominal');

        // 2. Query Data Payout beserta info Tutor
        $query = Payout::with('tutor');

        // Fitur Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Fitur Pencarian (Berdasarkan Kode Payout, Nama Tutor, atau Bank)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('kode_pencairan', 'like', "%{$search}%")
                ->orWhere('nama_bank', 'like', "%{$search}%")
                ->orWhereHas('tutor', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                });
            });
        }

        // 3. Eksekusi Query, urutkan dari yang terbaru (yang pending diutamakan jika mau, tapi latest cukup)
        $payouts = $query->orderByRaw("FIELD(status, 'pending', 'diproses', 'berhasil', 'ditolak')")
                        ->latest()
                        ->paginate(10);

        return view('admin.payout.index', compact(
            'countPending', 
            'totalNominalPending', 
            'totalNominalBerhasil', 
            'payouts'
        ));
    }
}