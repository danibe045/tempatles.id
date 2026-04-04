<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\TutorImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportTutorController extends Controller
{
    public function import(Request $request)
    {
        // 1. Validasi file (Pastikan file yang diupload adalah Excel/CSV)
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:5120', // Maksimal ukuran 5MB
        ]);

        try {
            // 2. Lempar file ke Mesin Import (TutorImport)
            Excel::import(new TutorImport, $request->file('file'));
            
            return redirect()->back()->with('success', 'Selamat! Data tutor berhasil di-import ke sistem.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Waduh, gagal memproses file: ' . $e->getMessage());
        }
    }
}