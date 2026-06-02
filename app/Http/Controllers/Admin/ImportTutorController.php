<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\TutorImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class ImportTutorController extends Controller
{
    public function import(Request $request)
    {
        // 1. Validasi File
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:5120',
        ]);

        // 2. Set Limit Server agar tidak Timeout
        set_time_limit(600); 
        ini_set('memory_limit', '512M'); 

        try {
            // 3. Eksekusi Import
            Excel::import(new TutorImport, $request->file('file'));
            
            return redirect()->back()->with('success', 'Data tutor berhasil diimpor ke dalam sistem.');
            
        } catch (\Exception $e) {
            // 4. Log error untuk investigasi
            Log::error('Gagal Import Tutor: ' . $e->getMessage());
            
            return redirect()->back()->with('error', 'Terjadi kesalahan: Pastikan format file sesuai dengan template.');
        }
    }
}