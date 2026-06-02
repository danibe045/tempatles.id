<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'murid');

        // Filter Bulan (Berdasarkan tanggal bergabung/created_at)
        if ($request->filled('month')) {
            $query->whereMonth('created_at', $request->month);
        }

        // Filter Tahun
        if ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
        }

        // Pencarian Text
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Hitung total siswa sesuai filter yang aktif
        $totalSiswa = $query->count();
        
        // Ambil data dengan Pagination & Query String agar filter tidak hilang saat pindah halaman
        $siswas = $query->latest()->paginate(10)->withQueryString();

        return view('admin.siswa.index', compact('siswas', 'totalSiswa'));
    }

    public function destroy($id)
    {
        $siswa = User::findOrFail($id);
        
        try {
            $siswa->delete();
            // Pastikan route diarahkan kembali dengan pesan sukses
            return redirect()->route('admin.siswa.index')->with('success', 'Data murid berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.siswa.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}