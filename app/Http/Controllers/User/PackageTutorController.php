<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TutorPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageTutorController extends Controller
{
    // Menampilkan daftar paket milik tutor
    public function index()
    {
        $packages = TutorPackage::where('user_id', Auth::id())->latest()->get();
        return view('tutor.packages.index', compact('packages'));
    }

    // Menyimpan paket baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'jenjang' => 'required|in:SD,SMP,SMA,Umum',
            'jumlah_sesi' => 'required|integer|min:1',
            'domisili' => 'required|string',
            'metode' => 'required|in:Online,Offline',
            'harga_nett' => 'required|integer|min:50000', // Minimum rasional Rp 50.000
            'deskripsi' => 'required|string|max:1000', // Wajib ada deskripsi
        ]);

        TutorPackage::create([
            'user_id' => Auth::id(),
            'nama_mapel' => $request->nama_mapel,
            'jenjang' => $request->jenjang,
            'jumlah_sesi' => $request->jumlah_sesi,
            'domisili' => $request->domisili,
            'metode' => $request->metode,
            'harga_nett' => $request->harga_nett,
            'deskripsi' => $request->deskripsi,
            'is_active' => true, // Default saat dibuat otomatis aktif
        ]);

        return redirect()->back()->with('success', 'Paket belajar berhasil ditambahkan ke etalase!');
    }

    // Mengubah status Aktif / Non-Aktif (Baru)
    public function toggleActive($id)
    {
        $package = TutorPackage::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        $package->update([
            'is_active' => !$package->is_active // Membalikkan status (true jadi false, dst)
        ]);

        $statusMessage = $package->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Paket berhasil {$statusMessage}.");
    }

    // Menghapus paket
    public function destroy($id)
    {
        $package = TutorPackage::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        // Opsional: Cek apakah paket sedang dipesan sebelum menghapus. 
        // Jika iya, beri error. Jika tidak, hapus.
        $package->delete();

        return redirect()->back()->with('success', 'Paket berhasil dihapus secara permanen.');
    }
}