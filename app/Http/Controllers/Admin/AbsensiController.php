<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderSession;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        // 1. Statistik untuk Gradient Cards
        $today = Carbon::today();
        
        // Sesi yang dijadwalkan hari ini
        $countHariIni = OrderSession::whereDate('tanggal_jadwal', $today)->count();
        
        // Total Sesi Sukses
        $countSelesai = OrderSession::where('status_sesi', 'selesai')->count();
        
        // Total Sesi Bermasalah (Tutor/Murid Absen)
        $countKendala = OrderSession::whereIn('status_sesi', ['absen_tutor', 'absen_murid'])->count();

        // 2. Query Data Sesi (Bawa relasi Order, Murid, dan Tutor biar efisien)
        $query = OrderSession::with(['order.murid', 'order.tutor']);

        // Fitur Filter Status
        if ($request->filled('status')) {
            $query->where('status_sesi', $request->status);
        }

        // Fitur Pencarian (Cari berdasarkan nama Murid, Tutor, atau Mapel)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('order', function($q) use ($search) {
                $q->where('mata_pelajaran', 'like', "%{$search}%")
                ->orWhereHas('murid', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('tutor', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                });
            });
        }

        // 3. Eksekusi Query, urutkan dari jadwal paling dekat/terbaru
        $sessions = $query->orderBy('tanggal_jadwal', 'desc')
                        ->orderBy('waktu_mulai', 'desc')
                        ->paginate(10);

        return view('admin.absensi.index', compact(
            'countHariIni', 
            'countSelesai', 
            'countKendala', 
            'sessions'
        ));
    }
}