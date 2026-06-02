<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TeachingJournal;
use App\Models\OrderSession;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi Inputan
        $request->validate([
            'order_session_id' => 'required|exists:order_sessions,id',
            'materi_pembahasan' => 'required|string',
            'foto_bukti' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'file_materi' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:5120',
        ]);

        try {
            // Gunakan Transaksi untuk memastikan data tersimpan dengan benar
            \DB::transaction(function () use ($request) {
                // 2. Simpan Foto Bukti
                $fotoPath = $request->file('foto_bukti')->store('jurnal_mengajar', 'public');

                // 3. Simpan File Modul (Jika ada)
                $fileMateriPath = null;
                if ($request->hasFile('file_materi')) {
                    $fileMateriPath = $request->file('file_materi')->store('modul_materi', 'public');
                }

                // 4. Masukkan ke Database
                TeachingJournal::create([
                    'order_session_id' => $request->order_session_id,
                    'catatan_materi'   => $request->materi_pembahasan,
                    'foto_bukti_path'  => $fotoPath,
                    'file_materi'      => $fileMateriPath,
                ]);

                // 5. Update status sesi
                OrderSession::where('id', $request->order_session_id)->update([
                    'status_sesi' => 'selesai'
                ]);
            });

            return redirect()->back()->with('success', 'Jurnal & Modul berhasil dikirim!');
        } catch (\Exception $e) {
            // Jika gagal, kembalikan pesan error
            return redirect()->back()->with('error', 'Gagal mengirim jurnal: ' . $e->getMessage());
        }
    }
}