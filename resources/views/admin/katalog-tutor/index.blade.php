<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pb-8">
            <div>
                <p class="text-[10px] font-black text-orange-500 uppercase tracking-[0.25em] mb-1">Manajemen Tutor</p>
                <h2 class="font-black text-2xl text-slate-900 leading-tight tracking-tight">
                    Katalog Pengajar Aktif
                </h2>
                <p class="text-sm text-slate-400 font-medium mt-0.5">Cari, kelola, dan rekomendasikan tutor terbaik untuk murid.</p>
            </div>

            {{-- KELOMPOK TOMBOL AKSI --}}
            <div class="flex flex-wrap gap-3 mt-4 md:mt-0">
                <button @click="$dispatch('open-modal-import')" type="button" class="inline-flex items-center gap-2 bg-white hover:bg-emerald-50 border border-slate-200 hover:border-emerald-300 text-slate-600 hover:text-emerald-700 px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                    Import Data
                </button>
                <button @click="$dispatch('open-modal-manual')" type="button" class="inline-flex items-center gap-2 bg-blue-950 hover:bg-orange-500 text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    Tambah Manual
                </button>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 md:px-8">
        
        {{-- AREA FILTER --}}
        <div class="sticky top-[73px] z-40 -mt-10 mb-10">
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xl -mt-12 relative z-40">
                <form action="{{ route('admin.katalog-tutor') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Mata Pelajaran</label>
                        <input type="text" name="mapel" value="{{ request('mapel') }}" placeholder="Cth: Matematika" class="w-full bg-slate-50 border border-slate-300 rounded-xl text-xs font-bold text-slate-700 focus:ring-2 focus:ring-blue-900 placeholder:font-normal">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Domisili (Kota)</label>
                        <input type="text" name="kota" value="{{ request('kota') }}" placeholder="Cth: Surabaya" class="w-full bg-slate-50 border border-slate-300 rounded-xl text-xs font-bold text-slate-700 focus:ring-2 focus:ring-blue-900 placeholder:font-normal">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Tingkat Siswa</label>
                        <select name="tingkat" class="w-full bg-slate-50 border border-slate-300 rounded-xl text-xs font-bold text-slate-700 focus:ring-2 focus:ring-blue-900">
                            <option value="">Semua Tingkat</option>
                            <option value="SD" {{ request('tingkat') == 'SD' ? 'selected' : '' }}>SD</option>
                            <option value="SMP" {{ request('tingkat') == 'SMP' ? 'selected' : '' }}>SMP</option>
                            <option value="SMA" {{ request('tingkat') == 'SMA' ? 'selected' : '' }}>SMA</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Metode Belajar</label>
                        <select name="metode" class="w-full bg-slate-50 border border-slate-300 rounded-xl text-xs font-bold text-slate-700 focus:ring-2 focus:ring-blue-900">
                            <option value="">Semua Metode</option>
                            <option value="Offline (Datang ke Rumah)" {{ request('metode') == 'Offline (Datang ke Rumah)' ? 'selected' : '' }}>Offline</option>
                            <option value="Online (Zoom/Meet)" {{ request('metode') == 'Online (Zoom/Meet)' ? 'selected' : '' }}>Online</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-blue-950 text-white py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-orange-500 transition-all shadow-lg">Terapkan Filter</button>
                    </div>
                </form>
            </div>
        </div>
        
        {{-- GRID KATALOG --}}
        <div class="mt-12 pb-12 relative z-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($tutors ?? [] as $tutor)
                    <div class="bg-white rounded-3xl border-2 border-slate-200 shadow-lg shadow-black/10 hover:shadow-2xl hover:-translate-y-1 hover:border-blue-400 transition-all duration-300 overflow-hidden flex flex-col">
                        
                        {{-- Bagian Atas Kartu --}}
                        <div class="p-5 pb-0 flex justify-between items-start">
                            <span class="bg-slate-100 text-slate-600 text-[10px] font-black px-3 py-1.5 rounded-lg uppercase border border-slate-200 shadow-sm">
                                ID: {{ str_pad($tutor->id, 4, '0', STR_PAD_LEFT) }}
                            </span>
                            <div class="flex gap-1.5 pt-1">
                                @php $metodes = is_array($tutor->metode) ? $tutor->metode : json_decode($tutor->metode, true) ?? []; @endphp
                                @foreach($metodes as $m)
                                    <span class="w-3 h-3 rounded-full shadow-sm {{ str_contains($m, 'Online') ? 'bg-blue-500' : 'bg-emerald-500' }}" title="{{ $m }}"></span>
                                @endforeach
                            </div>
                        </div>

                        {{-- Info Utama --}}
                        <div class="p-6 text-center flex-grow">
                            {{-- Avatar Bulat dengan Gradasi (Dipertegas) --}}
                            <div class="w-20 h-20 mx-auto mb-5 flex items-center justify-center text-3xl font-black text-blue-700 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full border-4 border-white shadow-md ring-2 ring-slate-100">
                                {{ strtoupper(substr($tutor->user->name ?? 'T', 0, 1)) }}
                            </div>
                            
                            <h3 class="font-black text-slate-800 text-base leading-tight mb-1 truncate px-2" title="{{ $tutor->user->name ?? 'Nama Tutor' }}">
                                {{ $tutor->user->name ?? 'Nama Tutor' }}
                            </h3>
                            <p class="text-[10px] font-bold text-orange-500 uppercase tracking-widest mb-4 truncate px-2">
                                {{ $tutor->bidang ?? 'Umum' }}
                            </p>
                            
                            {{-- Tags Tingkat Siswa --}}
                            <div class="flex flex-wrap justify-center gap-2 mb-2">
                                @php $tingkat = is_array($tutor->tingkat_siswa) ? $tutor->tingkat_siswa : json_decode($tutor->tingkat_siswa, true) ?? []; @endphp
                                @foreach($tingkat as $t)
                                    <span class="bg-blue-50 border border-blue-100 text-blue-700 text-[10px] font-bold px-2.5 py-1 rounded-md shadow-sm">{{ $t }}</span>
                                @endforeach
                            </div>
                        </div>

                        {{-- Footer Kartu --}}
                        <div class="px-6 py-4 bg-slate-50 border-t-2 border-slate-100 flex justify-between items-center mt-auto">
                            <div class="text-left">
                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Tarif Sesi</p>
                                <p class="text-sm font-black text-blue-950">
                                    Rp {{ number_format($tutor->tarif_per_sesi ?? 0, 0, ',', '.') }}
                                </p>
                            </div>
                            <a href="{{ route('admin.tutor.detail', $tutor->id) }}" class="flex items-center justify-center w-9 h-9 bg-blue-950 text-white rounded-xl hover:bg-orange-500 hover:text-white transition-all shadow-md hover:shadow-orange-500/30">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center">
                        <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-4 border border-white/20">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"/></svg>
                        </div>
                        <p class="text-slate-300 font-medium text-sm">Belum ada data tutor yang tersedia.</p>
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

    {{-- ======================================================== --}}
    {{-- 1. MODAL IMPORT EXCEL / CSV --}}
    {{-- ======================================================== --}}
    <div x-data="{ open: false, fileName: '' }" 
        @open-modal-import.window="open = true; fileName = ''" 
        x-show="open" 
        style="display: none;" 
        class="relative z-[100]" 
        aria-labelledby="modal-title" role="dialog" aria-modal="true">
        
        <div x-show="open" x-transition.opacity class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="open" @click.away="open = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-slate-100">
                    <div class="bg-white px-6 pb-6 pt-8 sm:p-8">
                        <div class="flex justify-between items-start mb-5">
                            <div>
                                <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight">Import Data Tutor</h3>
                                <p class="text-xs text-slate-500 mt-1">Upload file .xlsx atau .csv untuk menambahkan banyak tutor sekaligus.</p>
                            </div>
                            <button @click="open = false" class="text-slate-400 hover:text-rose-500 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                        <form action="{{ route('admin.tutor.import') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            <div class="flex items-center justify-center w-full">
                                <label :class="fileName ? 'border-emerald-400 bg-emerald-50' : 'border-slate-200 bg-slate-50 hover:bg-blue-50 hover:border-blue-300'" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed rounded-2xl cursor-pointer transition-all group">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                                        <svg x-show="!fileName" class="w-8 h-8 mb-3 text-slate-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                        <svg x-show="fileName" style="display: none;" class="w-8 h-8 mb-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <div x-show="!fileName">
                                            <p class="mb-1 text-sm text-slate-600 font-bold"><span class="text-blue-600">Klik untuk upload</span> atau drag and drop</p>
                                            <p class="text-[10px] text-slate-400 uppercase tracking-widest font-bold">XLSX, XLS, atau CSV</p>
                                        </div>
                                        <div x-show="fileName" style="display: none;">
                                            <p class="mb-1 text-sm text-emerald-700 font-bold truncate max-wxs" x-text="fileName"></p>
                                            <p class="text-[10px] text-emerald-600/70 uppercase tracking-widest font-bold">File siap diproses</p>
                                        </div>
                                    </div>
                                    <input type="file" name="file" class="hidden" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''" />
                                </label>
                            </div>
                            <div class="pt-2 border-t border-slate-100 flex gap-3">
                                <button type="button" @click="open = false" class="flex-1 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 px-4 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">Batal</button>
                                <button type="submit" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-emerald-600/30 transition-all">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ======================================================== --}}
    {{-- 2. MODAL TAMBAH TUTOR MANUAL --}}
    {{-- ======================================================== --}}
    <div x-data="{ open: false }" @open-modal-manual.window="open = true" x-show="open" style="display: none;" class="relative z-[100]" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div x-show="open" x-transition.opacity class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="open" @click.away="open = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-4xl border border-slate-100">
                    
                    <div class="bg-white px-6 pb-6 pt-8 sm:p-8">
                        <div class="flex justify-between items-start mb-6 pb-4 border-b border-slate-100 sticky top-0 bg-white z-10">
                            <div>
                                <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight">Input Data Tutor Manual</h3>
                                <p class="text-xs text-slate-500 mt-1">Isi formulir lengkap sesuai standar pendaftaran tempatles.id.</p>
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
                                        <input type="text" name="name" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600" required>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Email Aktif</label>
                                        <input type="email" name="email" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600" required>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Password Sementara</label>
                                        <input type="password" name="password" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600" required>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Nomor WhatsApp</label>
                                        <input type="text" name="phone_number" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600" required>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2">
                                        <div>
                                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Alamat Domisili</label>
                                        <textarea name="alamat_domisili" rows="2" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600"></textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- SECTION 2: LATAR BELAKANG --}}
                            <div>
                                <h4 class="text-[11px] font-black text-blue-600 uppercase tracking-widest mb-4 flex items-center gap-2 border-b border-slate-100 pb-2">2. Latar Belakang & Pendidikan</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Pendidikan Terakhir</label>
                                        <input type="text" name="pendidikan_terakhir" placeholder="Cth: S1 Teknik Informatika" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Asal Kampus / Sekolah</label>
                                        <input type="text" name="instansi" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Pengalaman Mengajar</label>
                                        <textarea name="pengalaman" rows="2" placeholder="Jelaskan pengalaman..." class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600"></textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- SECTION 3: PREFERENSI MENGAJAR --}}
                            <div>
                                <h4 class="text-[11px] font-black text-blue-600 uppercase tracking-widest mb-4 flex items-center gap-2 border-b border-slate-100 pb-2">3. Preferensi & Area Mengajar</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="md:col-span-2">
                                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Bidang Keahlian / Mata Pelajaran</label>
                                        <input type="text" name="bidang" placeholder="Cth: Matematika, Fisika" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600" required>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Tingkat Siswa</label>
                                        <input type="text" name="tingkat_siswa" placeholder="Cth: SD, SMP (Pisahkan koma)" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Metode Mengajar</label>
                                        <input type="text" name="metode" placeholder="Cth: Online, Offline" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Hari Tersedia</label>
                                        <input type="text" name="hari" placeholder="Cth: Senin, Rabu" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Jam Tersedia</label>
                                        <input type="text" name="jam" placeholder="Cth: 15.00 - 18.00" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Area Mengajar (Kecamatan)</label>
                                        <input type="text" name="area" placeholder="Cth: Bangkalan, Kamal" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Status Akun</label>
                                        <select name="status_akun" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                                            <option value="aktif">Aktif (Langsung Bisa Mengajar)</option>
                                            <option value="pending">Pending (Review)</option>
                                        </select>
                                    </div>
                                </div>
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
    <div x-data="{ open: true }" 
         x-show="open" 
         style="display: none;" 
         class="relative z-[150]" 
         aria-labelledby="modal-title" role="dialog" aria-modal="true">
        
        <div x-show="open" x-transition.opacity class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
        
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div x-show="open" 
                     @click.away="open = false" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="relative transform overflow-hidden rounded-3xl bg-white text-center shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-sm border border-slate-100">
                    
                    <div class="bg-white px-6 pb-6 pt-8 sm:p-8">
                        {{-- Tampilan Jika Sukses --}}
                        @if(session('success'))
                            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-emerald-50 border-4 border-emerald-100 mb-5">
                                <svg class="h-10 w-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight mb-2">Berhasil!</h3>
                            <p class="text-sm text-slate-500 font-medium leading-relaxed">{{ session('success') }}</p>
                        @endif

                        {{-- Tampilan Jika Error/Gagal --}}
                        @if(session('error'))
                            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-rose-50 border-4 border-rose-100 mb-5">
                                <svg class="h-10 w-10 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                            </div>
                            <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight mb-2">Terjadi Kesalahan</h3>
                            <p class="text-sm text-slate-500 font-medium leading-relaxed">{{ session('error') }}</p>
                        @endif
                        
                        <div class="mt-8">
                            <button type="button" @click="open = false" class="w-full bg-blue-950 hover:bg-blue-800 text-white px-6 py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg transition-all">
                                Mengerti
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>