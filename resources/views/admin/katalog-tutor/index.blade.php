<x-app-layout>
    <style>
        /* Mencegah kedip saat halaman baru dimuat (Alpine.js cloak) */
        [x-cloak] { display: none !important; }
    </style>

    {{-- ========================================================================= --}}
    {{-- WRAPPER UTAMA STICKY (Mengunci Header + Filter di Puncak Layar)           --}}
    {{-- ========================================================================= --}}
    <div class="sticky top-0 z-[40] w-full pb-4">
        
        {{-- AREA HEADER PUTIH --}}
        <div class="bg-white/95 backdrop-blur-md border-b border-slate-200 pt-6 pb-16 px-6 md:px-8">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <div class="inline-flex items-center gap-2 bg-orange-100 border border-orange-200 px-3 py-1 rounded-full mb-3 shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span>
                        <p class="text-[10px] font-black text-orange-600 uppercase tracking-[0.2em]">Manajemen Data Tutor</p>
                    </div>
                    <h2 class="font-black text-2xl text-slate-900 leading-tight tracking-tight">
                        Katalog Pengajar Aktif
                    </h2>
                    <p class="text-sm text-slate-400 font-medium mt-0.5">Cari, kelola, dan rekomendasikan tutor terbaik untuk murid.</p>
                </div>

                {{-- KELOMPOK TOMBOL AKSI --}}
                <div class="flex flex-wrap gap-3 mt-4 md:mt-0">
                    <button @click="$dispatch('open-modal-import')" type="button" class="inline-flex items-center gap-2 bg-slate-50 hover:bg-emerald-50 border border-slate-200 hover:border-emerald-300 text-slate-600 hover:text-emerald-700 px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                        Import Data
                    </button>
                    <button @click="$dispatch('open-modal-manual')" type="button" class="inline-flex items-center gap-2 bg-blue-950 hover:bg-orange-500 text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        Tambah Manual
                    </button>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 md:px-8 -mt-12 relative z-40">
            <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-200 shadow-xl">
                <form action="{{ route('admin.katalog-tutor') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                    {{-- Cari Nama / ID --}}
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Cari Nama / ID</label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama tutor atau ID..."
                                class="w-full bg-slate-50 border border-slate-300 rounded-xl text-xs font-bold text-slate-700 pl-9 focus:ring-2 focus:ring-blue-900 transition-all">
                        </div>
                    </div>

                    {{-- Mata Pelajaran --}}
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Mata Pelajaran</label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <input type="text" name="mapel" value="{{ request('mapel') }}" placeholder="Cth: Matematika"
                                class="w-full bg-slate-50 border border-slate-300 rounded-xl text-xs font-bold text-slate-700 pl-9 focus:ring-2 focus:ring-blue-900 transition-all">
                        </div>
                    </div>

                    {{-- Domisili --}}
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Domisili (Kota)</label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <input type="text" name="kota" value="{{ request('kota') }}" placeholder="Cth: Surabaya"
                                class="w-full bg-slate-50 border border-slate-300 rounded-xl text-xs font-bold text-slate-700 pl-9 focus:ring-2 focus:ring-blue-900 transition-all">
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex flex-col gap-2 justify-end">
                        <button type="submit"
                            class="w-full bg-blue-950 text-white py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-orange-500 transition-all shadow-md active:scale-95">
                            Terapkan Filter
                        </button>

                        @if(request('search') || request('mapel') || request('kota'))
                            <a href="{{ route('admin.katalog-tutor') }}"
                                class="w-full bg-slate-100 text-slate-500 hover:text-rose-500 hover:bg-rose-50 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all border border-slate-200 text-center flex items-center justify-center gap-1.5">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Reset Filter
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="max-w-7xl mx-auto px-6 md:px-8 relative z-10">    
        {{-- GRID KATALOG --}}
        <div class="mt-12 pb-12 relative z-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($tutors ?? [] as $tutor)
                    <div class="bg-white rounded-3xl border-2 border-slate-200 shadow-lg shadow-black/10 hover:shadow-2xl hover:-translate-y-1 hover:border-blue-400 transition-all duration-300 overflow-hidden flex flex-col">
                        
                        {{-- Ambil Data Dinamis dari Tabel Packages (Paket) milik Tutor ini --}}
                        @php 
                            $activePackages = $tutor->packages->where('is_active', true);
                            $metodes = $activePackages->pluck('metode')->unique();
                            $jenjangs = $activePackages->pluck('jenjang')->unique();
                            $hargaTermurah = $activePackages->min('harga_nett');
                        @endphp

                        {{-- Bagian Atas Kartu --}}
                        <div class="p-5 pb-0 flex justify-between items-start">
                            <span class="bg-slate-100 text-slate-600 text-[10px] font-black px-3 py-1.5 rounded-lg uppercase border border-slate-200 shadow-sm">
                                ID: {{ str_pad($tutor->id, 4, '0', STR_PAD_LEFT) }}
                            </span>
                            
                            {{-- Indikator Titik Metode Dinamis (Sesuai Paket yg ia miliki) --}}
                            <div class="flex gap-1.5 pt-1">
                                @if($metodes->contains('Online'))
                                    <span class="w-3 h-3 rounded-full shadow-sm bg-blue-500" title="Menyediakan Kelas Online"></span>
                                @endif
                                @if($metodes->contains('Offline'))
                                    <span class="w-3 h-3 rounded-full shadow-sm bg-emerald-500" title="Menyediakan Kelas Tatap Muka (Offline)"></span>
                                @endif
                            </div>
                        </div>

                        {{-- Info Utama --}}
                        <div class="p-6 text-center flex-grow">
                            <div class="w-20 h-20 mx-auto mb-5 flex items-center justify-center text-3xl font-black text-blue-700 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full border-4 border-white shadow-md ring-2 ring-slate-100 overflow-hidden">
                                @if($tutor->user && $tutor->user->profile_photo_path)
                                    <img src="{{ Storage::url($tutor->user->profile_photo_path) }}" class="w-full h-full object-cover" alt="Foto">
                                @else
                                    {{ strtoupper(substr($tutor->user->name ?? 'T', 0, 1)) }}
                                @endif
                            </div>
                            
                            <h3 class="font-black text-slate-800 text-base leading-tight mb-1 truncate px-2" title="{{ $tutor->user->name ?? 'Nama Tutor' }}">
                                {{ $tutor->user->name ?? 'Nama Tutor' }}
                            </h3>
                            <p class="text-[10px] font-bold text-orange-500 uppercase tracking-widest mb-4 truncate px-2">
                                {{ $tutor->bidang ?? 'Umum' }}
                            </p>
                            
                            {{-- Tags Tingkat Siswa (Berdasarkan Paket) --}}
                            <div class="flex flex-wrap justify-center gap-2 mb-2 min-h-[24px]">
                                @forelse($jenjangs as $j)
                                    <span class="bg-blue-50 border border-blue-100 text-blue-700 text-[9px] font-black px-2 py-1 rounded-md shadow-sm">{{ $j }}</span>
                                @empty
                                    <span class="text-[9px] font-bold text-slate-400 italic">Belum buat paket</span>
                                @endforelse
                            </div>
                        </div>

                        {{-- Footer Kartu --}}
                        <div class="px-6 py-4 bg-slate-50 border-t-2 border-slate-100 flex justify-between items-center mt-auto">
                            <div class="text-left">
                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Tarif Mulai Dari</p>
                                <p class="text-sm font-black text-blue-950">
                                    @if($hargaTermurah)
                                        Rp {{ number_format($hargaTermurah, 0, ',', '.') }}
                                    @else
                                        <span class="text-xs text-rose-500">Belum diatur</span>
                                    @endif
                                </p>
                            </div>
                            {{-- Karena kita belum buat halaman show khusus katalog tutor, arahkan ke Modal Detail yang ada di Dashboard --}}
                            <a href="{{ route('admin.tutor.detail', $tutor->id) }}" class="flex items-center justify-center w-9 h-9 bg-blue-950 text-white rounded-xl hover:bg-orange-500 hover:text-white transition-all shadow-md hover:shadow-orange-500/30" title="Lihat Profil Lengkap">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-200 shadow-sm">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"/></svg>
                        </div>
                        <p class="text-slate-500 font-black">Belum ada katalog tutor yang aktif.</p>
                        <p class="text-xs font-medium text-slate-400">Pastikan ada tutor dengan status Akun "Aktif".</p>
                    </div>
                @endforelse
            </div>
            
            {{-- Pagination --}}
            <div class="mt-10">
                @if(isset($tutors) && method_exists($tutors, 'links')) 
                    {{ $tutors->links() }} 
                @endif
            </div>
        </div>
    </div>

    {{-- TELEPORT MODALS KE BODY AGAR Z-INDEX AMAN --}}
    <template x-teleport="body">
        <div>
            {{-- 1. MODAL IMPORT EXCEL / CSV  --}}
            <div x-data="{ open: false, fileName: '', loading: false }" 
                @open-modal-import.window="open = true; fileName = ''" 
                x-show="open" 
                x-cloak
                class="relative z-[150]" 
                role="dialog"
                aria-modal="true">
                
                {{-- Latar Belakang Gelap Ringan (Backdrop) --}}
                <div x-show="open" 
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
                
                {{-- Posisi Tengah Modal Container --}}
                <div class="fixed inset-0 z-10 flex items-center justify-center p-4">
                    
                    <div x-show="open" 
                        @click.away="open = false" 
                        x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-95 translate-y-4 sm:translate-y-0"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 scale-95 translate-y-4 sm:translate-y-0"
                        class="relative w-full max-w-md bg-white rounded-[2rem] p-6 md:p-8 shadow-2xl border border-slate-100">
                        
                        {{-- Tombol Close Pojok Atas --}}
                        <button type="button" @click="open = false" 
                                class="absolute top-6 right-6 w-9 h-9 flex items-center justify-center bg-slate-50 hover:bg-rose-50 text-slate-400 hover:text-rose-500 rounded-xl border border-slate-200/60 hover:border-rose-200 transition-colors shadow-sm active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        {{-- Header Modal --}}
                        <div class="text-left mb-6 pr-10 border-b border-slate-100 pb-4">
                            <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight">Import Massal Data Tutor</h3>
                            <p class="text-xs text-slate-400 font-medium mt-1">Unggah dokumen spreadsheet untuk mendaftarkan banyak pengajar sekaligus ke dalam sistem.</p>
                        </div>
                        
                        {{-- Form Upload --}}
                        <form action="{{ route('admin.tutor.import') }}" method="POST" enctype="multipart/form-data" @submit="loading = true">
                            @csrf
                            
                            <div class="my-5">
                                {{-- Area Dropzone Interaktif --}}
                                <label class="relative flex flex-col items-center justify-center w-full h-44 border-2 border-dashed border-slate-300 rounded-2xl cursor-pointer bg-slate-50/50 hover:bg-blue-50/40 hover:border-blue-500 transition-all group p-4 text-center">
                                    
                                    {{-- Ikon default jika belum pilih file --}}
                                    <div x-show="!fileName" class="w-12 h-12 bg-white text-slate-400 rounded-xl flex items-center justify-center border border-slate-200 mb-3 group-hover:text-blue-600 group-hover:scale-110 transition-all shadow-sm">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>

                                    {{-- Ikon sukses jika file terekam --}}
                                    <div x-show="fileName" x-cloak class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-xl flex items-center justify-center border border-emerald-200 mb-3 shadow-sm animate-bounce-short">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>

                                    {{-- Teks Panduan Dokumen --}}
                                    <div class="space-y-1">
                                        <p x-show="!fileName" class="text-xs font-black text-slate-700"><span class="text-blue-600 group-hover:underline">Klik untuk pilih berkas</span> atau seret dokumen</p>
                                        <p x-show="fileName" x-cloak class="text-xs font-black text-emerald-600 truncate max-w-[280px]" x-text="fileName"></p>
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Excel / CSV (Maksimal. 5MB)</p>
                                    </div>

                                    {{-- Input Berkas Tersembunyi --}}
                                    <input type="file" name="file" class="hidden" accept=".xlsx,.xls,.csv" required @change="fileName = $event.target.files[0].name">
                                </label>
                            </div>

                            {{-- Tombol Aksi Bawah --}}
                            <div class="flex items-center gap-3 pt-2">
                                <button type="button" @click="open = false" 
                                        class="flex-1 py-3.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-500 font-black text-[10px] uppercase tracking-widest transition-all shadow-sm active:scale-95">
                                    Batal
                                </button>
                                
                                <button type="submit" 
                                        :disabled="loading"
                                        class="flex-1 py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-black text-[10px] uppercase tracking-widest shadow-lg shadow-emerald-500/20 disabled:bg-slate-400 disabled:shadow-none transition-all flex items-center justify-center gap-2 active:scale-95">
                                    
                                    {{-- Kondisi Normal --}}
                                    <span x-show="!loading" class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                        Import Data
                                    </span>

                                    {{-- Kondisi Loading Berkas --}}
                                    <span x-show="loading" x-cloak class="flex items-center justify-center">
                                        <svg class="animate-spin h-4 w-4 mr-2 text-white" viewBox="0 0 24 24" fill="none">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                        </svg>
                                        Memproses...
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- ======================================================== --}}
            {{-- 2. MODAL TAMBAH TUTOR MANUAL (Disaring dari atribut Paket) --}}
            {{-- ======================================================== --}}
            <div x-data="{ open: {{ $errors->any() ? 'true' : 'false' }} }" @open-modal-manual.window="open = true" x-show="open" style="display: none;" class="relative z-[100]" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div x-show="open" x-transition.opacity class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div x-show="open" @click.away="open = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-4xl border border-slate-100">
                            
                            <div class="bg-white px-6 pb-6 pt-8 sm:p-8">
                                <div class="flex justify-between items-start mb-6 pb-4 border-b border-slate-100 sticky top-0 bg-white z-10">
                                    <div>
                                        <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight">Input Data Tutor Manual</h3>
                                        <p class="text-xs text-slate-500 mt-1">Isi formulir dasar. Pengaturan Paket/Tarif akan dilakukan oleh Tutor.</p>
                                    </div>
                                    <button @click="open = false" class="text-slate-400 hover:text-rose-500 transition-colors bg-slate-50 p-2 rounded-xl">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                    </button>
                                </div>

                                <form action="{{ route('admin.tutor.store-manual') }}" method="POST" class="space-y-8 max-h-[60vh] overflow-y-auto pr-2 custom-scrollbar">
                                    @csrf
                                    
                                    {{-- SECTION 1: DATA AKUN & PRIBADI --}}
                                    <div>
                                        <h4 class="text-[11px] font-black text-blue-600 uppercase tracking-widest mb-4 flex items-center gap-2 border-b border-slate-100 pb-2">1. Data Pribadi & Kontak</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="md:col-span-2">
                                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Nama Lengkap</label>
                                                <input type="text" name="name" value="{{ old('name') }}" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600" required>
                                                @error('name')
                                                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div>
                                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Email Aktif</label>
                                                <input type="email" name="email" value="{{ old('email') }}" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600" required>
                                                @error('email')
                                                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div>
                                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Password Sementara</label>
                                                <input type="password" name="password" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600" required>
                                                @error('password')
                                                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div>
                                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Nomor WhatsApp</label>
                                                <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600" required>
                                                @error('phone_number')
                                                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div>
                                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Jenis Kelamin</label>
                                                <select name="jenis_kelamin" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="grid grid-cols-2 gap-2">
                                                <div>
                                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Tempat Lahir</label>
                                                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                                                </div>
                                                <div>
                                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Tanggal Lahir</label>
                                                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                                                </div>
                                            </div>
                                            <div class="md:col-span-2">
                                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Alamat Domisili</label>
                                                <textarea name="alamat_domisili" rows="2" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">{{ old('alamat_domisili') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- SECTION 2: LATAR BELAKANG --}}
                                    <div>
                                        <h4 class="text-[11px] font-black text-blue-600 uppercase tracking-widest mb-4 flex items-center gap-2 border-b border-slate-100 pb-2">2. Latar Belakang & Pendidikan</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Pendidikan Terakhir</label>
                                                <input type="text" name="pendidikan_terakhir" value="{{ old('pendidikan_terakhir') }}" placeholder="Cth: S1 Teknik Informatika" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                                            </div>
                                            <div>
                                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Asal Kampus / Sekolah</label>
                                                <input type="text" name="instansi" value="{{ old('instansi') }}" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                                            </div>
                                            <div class="md:col-span-2">
                                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Pengalaman Mengajar</label>
                                                <textarea name="pengalaman" rows="2" placeholder="Jelaskan pengalaman..." class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">{{ old('pengalaman') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- SECTION 3: PREFERENSI MENGAJAR --}}
                                    <div>
                                        <h4 class="text-[11px] font-black text-blue-600 uppercase tracking-widest mb-4 flex items-center gap-2 border-b border-slate-100 pb-2">3. Kemampuan Dasar</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="md:col-span-2">
                                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Spesialisasi Bidang</label>
                                                <input type="text" name="bidang" value="{{ old('bidang') }}" placeholder="Cth: Matematika, Bahasa Inggris" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600" required>
                                                @error('bidang')
                                                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            
                                            <div>
                                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Status Akun</label>
                                                <select name="status_akun" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                                                    <option value="aktif" {{ old('status_akun') == 'aktif' ? 'selected' : '' }}>Aktif (Tampil di Katalog)</option>
                                                    <option value="menunggu_mou" {{ old('status_akun') == 'menunggu_mou' ? 'selected' : '' }}>Menunggu MoU (Disembunyikan)</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Link G-Drive (Silabus/KTP)</label>
                                                <input type="url" name="link_gdrive" value="{{ old('link_gdrive') }}" placeholder="Opsional" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                                            </div>
                                        </div>
                                        <p class="text-[10px] mt-4 font-bold text-slate-400 p-3 bg-slate-50 rounded-xl border border-slate-100">*Catatan: Untuk pengaturan Harga Paket, Jam, Hari, Tingkat Siswa, dan Area Mengajar akan dilakukan mandiri oleh Tutor yang bersangkutan melalui menu "Paket Saya".</p>
                                    </div>

                                    <div class="pt-4 mt-2 border-t border-slate-100 flex justify-end gap-3 sticky bottom-0 bg-white pb-2">
                                        <button type="button" @click="open = false" class="bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 px-6 py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">Batalkan</button>
                                        <button type="submit" class="bg-blue-950 hover:bg-orange-500 text-white px-6 py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg transition-all">Simpan Akun Tutor</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ======================================================== --}}
            {{-- 3. MODAL NOTIFIKASI (SUKSES / GAGAL) --}}
            {{-- ======================================================== --}}
            @if(session('success') || session('error'))
            <div x-data="{ open: true }" x-show="open" style="display: none;" class="relative z-[150]" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div x-show="open" x-transition.opacity class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                        <div x-show="open" @click.away="open = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-3xl bg-white text-center shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-sm border border-slate-100">
                            <div class="bg-white px-6 pb-6 pt-8 sm:p-8">
                                @if(session('success'))
                                    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-emerald-50 border-4 border-emerald-100 mb-5">
                                        <svg class="h-10 w-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight mb-2">Berhasil!</h3>
                                    <p class="text-sm text-slate-500 font-medium leading-relaxed">{{ session('success') }}</p>
                                @endif
                                @if(session('error'))
                                    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-rose-50 border-4 border-rose-100 mb-5">
                                        <svg class="h-10 w-10 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </div>
                                    <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight mb-2">Terjadi Kesalahan</h3>
                                    <p class="text-sm text-slate-500 font-medium leading-relaxed">{{ session('error') }}</p>
                                @endif
                                <div class="mt-8">
                                    <button type="button" @click="open = false" class="w-full bg-blue-950 hover:bg-blue-800 text-white px-6 py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg transition-all">Mengerti</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </template>
</x-app-layout>