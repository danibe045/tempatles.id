<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TutorPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageTutorController extends Controller
{
    /**
     * Menampilkan daftar paket belajar milik Tutor yang sedang login.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Ambil paket yang hanya dimiliki oleh tutor ini, urutkan dari yang terbaru
        $packages = TutorPackage::where('user_id', $user->id)
                                ->latest()
                                ->paginate(10);
                                
        return view('tutor.packages.index', compact('packages'));
    }

    /**
     * Menyimpan paket belajar baru ke etalase.
     */
    public function store(Request $request)
    {
        // 1. Validasi Inputan
        $request->validate([
            'nama_mapel'  => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'jenjang'     => 'required|in:SD,SMP,SMA,Umum',
            'jumlah_sesi' => 'required|integer|min:1',
            'kuota'       => 'required|integer|min:1',
            'metode'      => 'required|in:Online,Offline',
            'domisili'    => 'required|string|max:255',
            'hari'        => 'required|string|max:255',
            'jam'         => 'required|string|max:255',
            'harga_nett'  => 'required|integer|min:50000',
        ], [
            'harga_nett.min' => 'Harga bersih minimal adalah Rp 50.000.',
            'jumlah_sesi.min' => 'Jumlah sesi minimal adalah 1 sesi pertemuan.'
        ]);

        // 2. Simpan ke Database dan masukkan ke dalam variabel
        $package = TutorPackage::create([
            'user_id'     => Auth::id(),
            'nama_mapel'  => $request->nama_mapel,
            'deskripsi'   => $request->deskripsi,
            'jenjang'     => $request->jenjang,
            'jumlah_sesi' => $request->jumlah_sesi,
            'kuota'       => $request->kuota,
            'metode'      => $request->metode,
            'domisili'    => $request->domisili,
            'hari'        => $request->hari,
            'jam'         => $request->jam,
            'harga_nett'  => $request->harga_nett,
            'is_active'   => true, 
        ]);

        // 3. Cek apakah berhasil
        if($package) {
            return redirect()->back()->with('success', 'Paket berhasil dibuat!');
        }
        
        return redirect()->back()->with('error', 'Gagal menyimpan paket.');
    }

    /**
     * Fitur Toggle: Menghidupkan atau Mematikan Paket Belajar
     */
    public function toggleActive($id)
    {
        // Cari paket berdasarkan ID, dan pastikan paket ini benar-benar milik Tutor yang login
        $package = TutorPackage::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        // Balikkan nilainya (Jika true jadi false, jika false jadi true)
        $package->update([
            'is_active' => !$package->is_active
        ]);

        $status = $package->is_active ? 'diaktifkan dan siap dipesan' : 'dinonaktifkan sementara';
        return redirect()->back()->with('success', "Status paket berhasil {$status}.");
    }

    /**
     * Menghapus paket belajar secara permanen.
     */
    public function destroy($id) 
    {
        $paket = TutorPackage::findOrFail($id);
        if($paket->delete()) {
            return redirect()->back()->with('success', 'Paket berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'Gagal menghapus paket.');
    }
}