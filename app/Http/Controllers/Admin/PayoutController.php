<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payout;
use App\Models\TutorWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayoutController extends Controller
{
    public function index(Request $request)
    {
        // Query utama dan Query untuk Statistik
        $query = Payout::with('tutor');
        $queryStats = Payout::query();

        // -- FILTER BULAN --
        if ($request->filled('month')) {
            $query->whereMonth('created_at', $request->month);
            $queryStats->whereMonth('created_at', $request->month);
        }

        // -- FILTER TAHUN --
        if ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
            $queryStats->whereYear('created_at', $request->year);
        }

        // 1. Statistik (Akan terpengaruh oleh filter bulan/tahun)
        $countPending = (clone $queryStats)->whereIn('status', ['pending', 'diproses'])->count();
        $totalNominalPending = (clone $queryStats)->whereIn('status', ['pending', 'diproses'])->sum('nominal');
        $totalNominalBerhasil = (clone $queryStats)->where('status', 'berhasil')->sum('nominal');

        // Filter Status Pencairan
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter Pencarian Teks
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

        // 3. Eksekusi Query, urutkan status dan waktu terbaru
        $payouts = $query->orderByRaw("FIELD(status, 'pending', 'diproses', 'berhasil', 'ditolak')")
                        ->latest()
                        ->paginate(10)->withQueryString();

        return view('admin.payout.index', compact(
            'countPending', 
            'totalNominalPending', 
            'totalNominalBerhasil', 
            'payouts'
        ));
    }

    /**
     * Fungsi untuk Admin mengonfirmasi bahwa dana sudah ditransfer
     * dan mengunggah bukti struk transfer.
     */
    public function markPaid(Request $request, $id)
    {
        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:5120'
        ], [
            'bukti_transfer.required' => 'Anda wajib mengunggah foto bukti transfer!',
            'bukti_transfer.image' => 'File harus berupa gambar (JPG/PNG).',
            'bukti_transfer.max' => 'Ukuran gambar maksimal 5MB. Tolong kompres fotonya sedikit ya.'
        ]);

        $payout = Payout::findOrFail($id);

        if (!in_array($payout->status, ['pending', 'diproses'])) {
            return redirect()->back()->with('error', 'Status penarikan ini sudah selesai atau ditolak.');
        }

        DB::beginTransaction();
        try {
            // 1. Simpan foto bukti transfer
            $path = $request->file('bukti_transfer')->store('payout_receipts', 'public');

            // 2. Update status tiket payout menjadi berhasil
            $payout->update([
                'status' => 'berhasil',
                'bukti_transfer_path' => $path
            ]);

            // 3. Potong Saldo Aktif di Dompet Tutor
            $wallet = TutorWallet::where('user_id', $payout->tutor_id)->first();
            
            // PENGAMAN: Jika dompet tidak ada atau saldo kurang, BATALKAN SEMUA!
            if (!$wallet || $wallet->saldo_aktif < $payout->nominal) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Gagal! Saldo Aktif Tutor tidak mencukupi untuk penarikan ini. Terdapat ketidaksesuaian data dompet.');
            }

            // Jika aman, potong saldo
            $wallet->decrement('saldo_aktif', $payout->nominal);
            
            // Catat kalau uangnya keluar (ditarik)!
            \App\Models\WalletHistory::create([
                'wallet_id' => $wallet->id,
                'type' => 'out',
                'amount' => $payout->nominal,
                'description' => 'Penarikan Dana ke Rekening ' . $payout->nama_bank
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Transfer berhasil dikonfirmasi! Bukti transfer telah tersimpan dan saldo tutor telah dipotong.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memproses payout: ' . $e->getMessage());
        }
    }
}