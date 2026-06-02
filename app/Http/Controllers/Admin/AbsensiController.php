<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderSession;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today();
        
        // Sesi yang dijadwalkan KHUSUS HARI INI (Tetap hari ini, tidak terpengaruh filter bulan)
        $countHariIni = OrderSession::whereDate('tanggal_jadwal', $today)->count();
        
        // Siapkan kerangka Query untuk tabel dan statistik
        $querySelesai = OrderSession::where('status_sesi', 'selesai');
        $queryKendala = OrderSession::whereIn('status_sesi', ['absen_tutor', 'absen_murid']);
        $query = OrderSession::with(['order.murid', 'order.tutor']);

        // --- FITUR BARU: FILTER BULAN & TAHUN ---
        if ($request->filled('month')) {
            $query->whereMonth('tanggal_jadwal', $request->month);
            $querySelesai->whereMonth('tanggal_jadwal', $request->month);
            $queryKendala->whereMonth('tanggal_jadwal', $request->month);
        }

        if ($request->filled('year')) {
            $query->whereYear('tanggal_jadwal', $request->year);
            $querySelesai->whereYear('tanggal_jadwal', $request->year);
            $queryKendala->whereYear('tanggal_jadwal', $request->year);
        }

        // Eksekusi hitungan statistik
        $countSelesai = $querySelesai->count();
        $countKendala = $queryKendala->count();

        // Fitur Filter Status (Dropdown Lama)
        if ($request->filled('status')) {
            $query->where('status_sesi', $request->status);
        }

        // Fitur Pencarian Text
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

        // Eksekusi dengan Query String agar pagination tidak mereset filter
        $sessions = $query->orderBy('tanggal_jadwal', 'desc')
                        ->orderBy('waktu_mulai', 'desc')
                        ->paginate(10)->withQueryString();

        return view('admin.absensi.index', compact('countHariIni', 'countSelesai', 'countKendala', 'sessions'));
    }

    // Tampilkan Detail Jurnal
    public function show($id)
    {
        $session = OrderSession::with(['order.murid', 'order.tutor', 'teachingJournal'])->findOrFail($id);
        return view('admin.absensi.show', compact('session'));
    }

    // Fitur Override (Admin menolak jurnal)
    public function override(Request $request, $id)
    {
        $session = OrderSession::findOrFail($id);
        if ($session->status_sesi !== 'selesai') {
            return redirect()->back()->with('error', 'Hanya sesi dengan status "Selesai" yang dapat ditolak jurnalnya.');
        }
        
        DB::beginTransaction();
        try {
            if ($session->teachingJournal) {
                $session->teachingJournal->delete();
            }
            $session->update([
                'status_sesi' => 'absen_tutor'
            ]);

            DB::commit();
            return redirect()->route('admin.absensi')->with('success', 'Jurnal berhasil ditolak secara sepihak. Status sesi diubah menjadi Tutor Absen.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membatalkan jurnal: ' . $e->getMessage());
        }
    }
}