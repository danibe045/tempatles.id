<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Strike;
use App\Models\Komplain; // 1. Pastikan Model Komplain di-import
use App\Models\Order;    // 2. Pastikan Model Order di-import untuk urusan dana/status
use App\Models\TutorProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StrikeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil Parameter Filter
        $status = $request->input('status');
        $search = $request->input('search');

        // 2. KONTEN TAB 1: KELUHAN / KOMPLAIN MURID (Kunci Perbaikan Error)
        $complaintsQuery = Komplain::with(['order.tutor', 'pelapor']);

        if ($search) {
            $complaintsQuery->where(function ($q) use ($search) {
                $q->where('jenis_komplain', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhereHas('pelapor', function ($qUser) use ($search) {
                      $qUser->where('name', 'like', "%{$search}%");
                  });
            });
        }
        
        if ($status) {
            if ($status == 'aktif') {
                $complaintsQuery->whereIn('status', ['menunggu_review', 'sedang_dimediasi']);
            } elseif ($status == 'selesai') {
                $complaintsQuery->whereIn('status', ['selesai_refund', 'selesai_tolak']);
            }
        }
        $complaints = $complaintsQuery->latest()->get();

        // 3. KONTEN TAB 2: QUERY DATA LOG STRIKE (Eksisting D)
        $strikeQuery = Strike::with('tutor');

        if ($status) {
            $strikeQuery->where('status', $status);
        }

        if ($search) {
            $strikeQuery->where(function($q) use ($search) {
                $q->where('alasan_pelanggaran', 'like', "%{$search}%")
                ->orWhereHas('tutor', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                });
            });
        }
        $strikes = $strikeQuery->latest()->paginate(10)->withQueryString();

        // 4. STATISTIK BANNER (Disesuaikan dengan tabel strikes asli)
        $countAktif = Strike::where('status', 'aktif')->count();
        $countDicabut = Strike::where('status', 'dicabut')->count();
        $countTutorBermasalah = TutorProfile::where('status_akun', 'dibekukan')->orWhere('status_akun', 'banned')->count();

        // 5. Daftar tutor untuk pilihan di Modal "Beri Strike Baru Manual"
        $tutors = User::where('role', 'tutor')->orderBy('name')->get();

        return view('admin.strike.index', compact(
            'countAktif', 
            'countDicabut', 
            'countTutorBermasalah', 
            'strikes', 
            'complaints', // Di-return ke view agar error hilang!
            'tutors'
        ));
    }

    /**
     * MEMPROSES KEPUTUSAN KASUS KOMPLAIN MURID (Aksi Form Tab 1)
     */
    public function updateStatusKomplain(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:selesai_refund,selesai_tolak',
            'keputusan' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $komplain = Komplain::with('order')->findOrFail($id);
            
            // 1. Update data internal Komplain
            $komplain->update([
                'status' => $request->status,
                'keputusan_admin' => $request->keputusan
            ]);

            // 2. Eksekusi Konsekuensi Finansial & Status Order
            if ($request->status == 'selesai_refund') {
                // Murid Benar: Dana Escrow kembali ke murid, pesanan hangus
                $komplain->order->update(['status_pesanan' => 'dibatalkan']);
                
                // Jika checkbox sanksi di-centang admin
                if ($request->has('berikan_sp')) {
                    // Catat ke log histori tabel strikes
                    Strike::create([
                        'tutor_id' => $komplain->order->tutor_id,
                        'alasan_pelanggaran' => 'Komplain: ' . $komplain->jenis_komplain,
                        'keterangan_detail' => $request->keputusan,
                        'status' => 'aktif'
                    ]);

                    // Tambah angka sanksi di tabel users (kolom strike)
                    $tutor = User::find($komplain->order->tutor_id);
                    if ($tutor) {
                        $tutor->increment('strike');
                        
                        // Sistem Otomatis: Jika strike menyentuh angka 3, bekukan akunnya!
                        if ($tutor->strike >= 3) {
                            TutorProfile::where('user_id', $tutor->id)->update(['status_akun' => 'dibekukan']);
                        }
                    }
                }
            } elseif ($request->status == 'selesai_tolak') {
                // Tutor Benar: Komplain murid ditolak, pesanan selesai, dana diteruskan ke tutor
                $komplain->order->update(['status_pesanan' => 'selesai']);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Aksi mediasi komplain murid berhasil diproses!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memproses keputusan: ' . $e->getMessage());
        }
    }

    /**
     * FUNGSI MEMBERIKAN SP (STRIKE) MANUAL (Aksi Modal Tombol Merah)
     */
    public function beri(Request $request)
    {
        $request->validate([
            'tutor_id' => 'required|exists:users,id',
            'alasan_pelanggaran' => 'required|string|max:255',
            'keterangan_detail' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            // 1. Masukkan ke log riwayat tabel strikes
            Strike::create([
                'tutor_id' => $request->tutor_id,
                'alasan_pelanggaran' => $request->alasan_pelanggaran,
                'keterangan_detail' => $request->keterangan_detail,
                'status' => 'aktif'
            ]);

            // 2. Sinkronisasi: Tambah angka hitungan di tabel users (kolom strike)
            $tutor = User::findOrFail($request->tutor_id);
            $tutor->increment('strike');

            // Proteksi Sistem otomatis pembekuan sanksi maksimal
            if ($tutor->strike >= 3) {
                TutorProfile::where('user_id', $tutor->id)->update(['status_akun' => 'dibekukan']);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Surat Peringatan (Strike) berhasil diterbitkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memberikan strike: ' . $e->getMessage());
        }
    }

    /**
     * FUNGSI MEMAAFKAN / MENCABUT SP
     */
    public function cabut($id)
    {
        DB::beginTransaction();
        try {
            $strike = Strike::findOrFail($id);
            $strike->update(['status' => 'dicabut']);

            // Kurangi angka strike di tabel users
            $tutor = User::find($strike->tutor_id);
            if ($tutor && $tutor->strike > 0) {
                $tutor->decrement('strike');
                
                // Jika strikes turun di bawah 3, pulihkan status akunnya menjadi aktif kembali
                if ($tutor->strike < 3) {
                    TutorProfile::where('user_id', $tutor->id)->update(['status_akun' => 'aktif']);
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Pelanggaran berhasil dimaafkan dan poin strike dikurangi.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mencabut strike: ' . $e->getMessage());
        }
    }

    /**
     * FUNGSI BANNED AKUN PERMANEN (Tindakan Mutlak Admin)
     */
    public function banned($id)
    {
        DB::beginTransaction();
        try {
            // Ubah status di profil tutor menjadi banned
            TutorProfile::where('user_id', $id)->update(['status_akun' => 'banned']);
            
            // Set poin kesalahan langsung penuh sebagai penanda audit
            User::where('id', $id)->update(['strike' => 3]);

            DB::commit();
            return redirect()->back()->with('success', 'Tegas! Akun Tutor berhasil dinonaktifkan secara permanen dari platform.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengeksekusi sanksi: ' . $e->getMessage());
        }
    }
}