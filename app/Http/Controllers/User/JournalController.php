<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TeachingJournal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JournalController extends Controller
{
    /**
     * Menyimpan laporan jurnal mengajar dari Tutor
     */
    public function store(Request $request)
    {
        // Validasi Input
        $request->validate([
            'order_session_id' => 'required',
            'materi_pembahasan' => 'required|string|min:10',
            'foto_bukti' => 'required|image|mimes:jpeg,png,jpg|max:5120', // Wajib Foto Absen (Maks 5MB)
            'file_materi' => 'nullable|mimes:pdf,doc,docx,ppt,pptx|max:5120', // Opsional File Materi
        ]);

        // 1. Proses Upload Foto Bukti Absensi
        $fotoPath = null;
        if ($request->hasFile('foto_bukti')) {
            $fotoPath = $request->file('foto_bukti')->store('bukti_mengajar', 'public');
        }

        // 2. Proses Upload File Materi Tambahan (Jika ada)
        $materiPath = null;
        if ($request->hasFile('file_materi')) {
            $materiPath = $request->file('file_materi')->store('materi_pembelajaran', 'public');
        }

        // 3. Simpan ke Database
        TeachingJournal::create([
            'order_session_id' => $request->order_session_id,
            'catatan_materi' => $request->materi_pembahasan,
            'foto_bukti_path' => $fotoPath,
            // 'file_materi' => $materiPath, // Bisa dibuka jika tabel TeachingJournal punya kolom file_materi
            'waktu_submit' => now(),
        ]);

        return redirect()->back()->with('success', 'Hebat! Jurnal mengajar dan absensi berhasil dikirim.');
    }
}