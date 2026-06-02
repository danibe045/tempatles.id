<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TutorProfile;
use App\Models\Order;
use App\Models\TutorPackage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TutorDirectoryController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data tutor yang AKTIF beserta User dan Paketnya
        $query = TutorProfile::with(['user', 'packages'])->where('status_akun', 'aktif');

        // 2. Filter Pencarian: Mata Pelajaran (Cari di Keahlian Tutor ATAU Nama Paket)
        if ($request->filled('mapel')) {
            $mapel = $request->mapel;
            $query->where(function($q) use ($mapel) {
                $q->where('bidang', 'like', '%' . $mapel . '%')
                ->orWhereHas('packages', function($pkgQuery) use ($mapel) {
                    $pkgQuery->where('nama_mapel', 'like', '%' . $mapel . '%')
                            ->where('is_active', true);
                });
            });
        }

        // 3. Filter Pencarian: Kota / Lokasi (SUDAH DIPERBAIKI)
        // Hanya mencari di Alamat Tutor ATAU Domisili Paket Belajarnya
        if ($request->filled('lokasi')) {
            $lokasi = $request->lokasi;
            $query->where(function($q) use ($lokasi) {
                $q->where('alamat_domisili', 'like', '%' . $lokasi . '%') // <-- Kolom 'area' dihapus
                ->orWhereHas('packages', function($pkgQuery) use ($lokasi) {
                    $pkgQuery->where('domisili', 'like', '%' . $lokasi . '%')
                            ->where('is_active', true);
                });
            });
        }

        // Pagination dengan Query String agar filter tidak hilang saat pindah halaman
        $tutors = $query->latest()->paginate(12)->withQueryString();

        return view('user.tutor-directory', compact('tutors')); 
    }

    public function show($id)
    {
        // Cukup ambil profil yang statusnya aktif saja
        $tutor = TutorProfile::with(['user', 'packages' => function($q) {
            $q->where('is_active', true)->where('kuota', '>', 0);
        }])
        ->where('status_akun', 'aktif') // Pastikan hanya yang aktif yang bisa dibuka
        ->findOrFail($id);

        return view('user.tutor-detail', compact('tutor'));
    }

    public function storeOrder(Request $request, $id)
    {
        // 1. Validasi disesuaikan dengan 'name' di form HTML
        $request->validate([
            'tutor_package_id' => 'required|exists:tutor_packages,id',
            'jadwal_request'   => 'required|string',
            'catatan'          => 'nullable|string',
        ], [
            'tutor_package_id.required' => 'Pilih salah satu paket belajar terlebih dahulu.',
            'jadwal_request.required'   => 'Preferensi jadwal belajar wajib diisi.'
        ]);

        // 2. Ambil data paket
        $paket = TutorPackage::findOrFail($request->tutor_package_id);
        $tutorProfile = TutorProfile::findOrFail($id);

        // 3. LOGIKA KOMISI (Bagi Hasil 90:10)
        // Harga yang dibayar murid adalah harga paket itu sendiri (nett)
        $grandTotal = $paket->harga_nett; 
        
        // Komisi platform diambil dari harga paket (10%)
        $biayaLayanan = $paket->harga_nett * 0.10; 
        
        // Pendapatan bersih tutor (yang akan masuk ke saldo tutor nantinya)
        $pendapatanTutor = $paket->harga_nett - $biayaLayanan;

        DB::beginTransaction();
        try {
            // 4. Simpan Transaksi
            Order::create([
                'murid_id'          => Auth::id(),
                'tutor_id'          => $tutorProfile->user_id,
                'tutor_package_id'  => $paket->id,
                'mata_pelajaran'    => $paket->nama_mapel,
                'jumlah_sesi'       => $paket->jumlah_sesi,
                'harga_paket'       => $paket->harga_nett, // Harga yang diinput tutor
                'total_harga_sesi'  => $paket->harga_nett, 
                'biaya_layanan'     => $biayaLayanan, // Potongan untuk platform
                'grand_total'       => $grandTotal,   // Total yang harus dibayar murid
                'status_pesanan'    => 'menunggu_konfirmasi',
                'status_pembayaran' => 'belum_bayar',
                'jadwal_request'    => $request->jadwal_request,
                'catatan'           => $request->catatan,
            ]);

            DB::commit();
            return redirect()->route('dashboard')->with('success', 'Pesanan berhasil dikirim!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membuat pesanan: ' . $e->getMessage());
        }
    }
}