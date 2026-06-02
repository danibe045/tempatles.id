<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etalase Paket - tempatles.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .bg-pattern { background-image: radial-gradient(#cbd5e1 1.5px, transparent 1.5px); background-size: 24px 24px; }
        
        /* Transisi mulus untuk modal */
        dialog[open] { animation: modalFadeIn 0.3s cubic-bezier(0.4, 0, 0.2, 1) normal; }
        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(20px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
    </style>
</head>

<body class="bg-[#F8FAFC] text-slate-900 antialiased flex flex-col min-h-screen relative overflow-x-hidden">

    {{-- Latar Belakang Pattern Tipis --}}
    <div class="fixed inset-0 bg-pattern opacity-40 z-[-1] pointer-events-none"></div>

    {{-- NAVBAR PREMIUM --}}
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200/60 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 md:px-12 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <a href="/" class="flex items-center gap-2 group">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-9 transition-transform group-hover:scale-110">
                    <span class="font-black text-blue-950 text-xl tracking-tighter hidden sm:block">tempatles<span class="text-orange-500">.id</span></span>
                </a>
            </div>

            <div class="flex items-center gap-5">
                {{-- TOMBOL KEMBALI DI NAVBAR --}}
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="group flex items-center gap-2 bg-white hover:bg-slate-100 text-slate-700 px-5 py-2.5 rounded-full font-bold text-xs transition-all duration-300 border border-slate-200 shadow-sm">
                        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span class="hidden sm:inline">Kembali ke Dashboard</span>
                        <span class="sm:hidden">Kembali</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-8 md:py-12 min-h-screen relative z-10 flex-grow">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            {{-- HEADER BERGAYA KARTU (DARK MODE CONTRAST) --}}
            <div class="bg-blue-950 border border-blue-900 shadow-2xl shadow-blue-900/20 rounded-[2.5rem] p-8 md:p-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 relative overflow-hidden mb-10 md:mb-14">
                {{-- Efek Glow/Blur --}}
                <div class="absolute -top-20 -right-20 w-80 h-80 bg-blue-500 rounded-full blur-[80px] opacity-40 pointer-events-none"></div>
                <div class="absolute -bottom-20 -left-10 w-64 h-64 bg-orange-500 rounded-full blur-[80px] opacity-30 pointer-events-none"></div>

                <div class="relative z-10">
                    <div class="flex flex-col items-start">
                        <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-orange-400 px-4 py-2 rounded-full mb-4 backdrop-blur-md">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                            </span>
                            <span class="text-[10px] font-black uppercase tracking-[0.25em] text-white">Produk Unggulan Anda</span>
                        </div>
                        <h2 class="font-black text-3xl md:text-4xl text-white leading-tight tracking-tight mb-3">
                            Etalase Paket Belajar
                        </h2>
                        <p class="text-sm text-blue-200 font-medium max-w-xl leading-relaxed">
                            Susun dan kelola daftar mata pelajaran Anda di sini. Aktifkan paket yang siap dipesan dan atur batas kuota murid agar lebih efisien.
                        </p>
                    </div>
                </div>

                {{-- Tombol Buka Modal --}}
                <button onclick="document.getElementById('modal-tambah-paket').showModal()" class="relative z-10 flex-shrink-0 inline-flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-400 text-white px-8 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-lg shadow-orange-500/30 active:scale-95 group border border-orange-400">
                    <span class="text-lg leading-none transition-transform group-hover:rotate-90">+</span> Buat Paket Baru
                </button>
            </div>

            {{-- GRID DAFTAR PAKET --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @forelse($packages as $package)
                <div class="group relative flex flex-col bg-white rounded-[2.5rem] border border-slate-200 shadow-sm hover:shadow-2xl hover:shadow-blue-900/5 transition-all duration-500 hover:-translate-y-2 overflow-hidden {{ !$package->is_active ? 'saturate-[0.4] opacity-90' : '' }}">
                    
                    {{-- Header Kartu --}}
                    <div class="p-8 pb-6 border-b border-slate-100 flex-grow">
                        <div class="flex justify-between items-start mb-6">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $package->is_active ? 'bg-blue-50 text-blue-700' : 'bg-slate-100 text-slate-500' }}">
                                {{ $package->jenjang }}
                            </span>
                            @if(!$package->is_active)
                                <span class="text-[9px] font-black text-rose-500 bg-rose-50 px-3 py-1 rounded-full uppercase tracking-widest border border-rose-100">Draft</span>
                            @endif
                        </div>

                        <h3 class="text-xl font-black text-slate-900 leading-snug mb-3 group-hover:text-blue-600 transition-colors">
                            {{ $package->nama_mapel }}
                        </h3>
                        <p class="text-xs text-slate-500 font-medium leading-relaxed mb-6 h-10 line-clamp-2">
                            {{ $package->deskripsi }}
                        </p>

                        <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Harga Paket (Pendapatan Anda)</p>
                            <div class="flex items-baseline gap-1">
                                <span class="text-sm font-bold text-slate-400">Rp</span>
                                <span class="text-3xl font-black text-slate-900 tracking-tight">{{ number_format($package->harga_nett, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Fitur Paket --}}
                    <div class="px-8 pb-6 space-y-3">
                        <div class="flex items-center gap-3 text-[11px] font-bold text-slate-600">
                            <div class="w-6 h-6 rounded-full bg-blue-50 flex items-center justify-center text-blue-600"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                            {{ $package->jumlah_sesi }} Sesi Pertemuan
                        </div>
                        <div class="flex items-center gap-3 text-[11px] font-bold text-slate-600">
                            <div class="w-6 h-6 rounded-full bg-orange-50 text-orange-500 flex items-center justify-center"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg></div>
                            Kuota: {{ $package->kuota }} Murid
                        </div>
                    </div>

                    {{-- Footer Action Bar --}}
                    <div class="px-8 py-6 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                        <form action="{{ route('tutor.packages.toggle', $package->id) }}" method="POST" class="flex items-center gap-3 cursor-pointer" onclick="this.submit()">
                            @csrf @method('PATCH')
                            <div class="relative inline-flex h-7 w-12 items-center rounded-full transition-colors {{ $package->is_active ? 'bg-emerald-500' : 'bg-slate-300' }}">
                                <span class="inline-block h-5 w-5 transform rounded-full bg-white transition-transform {{ $package->is_active ? 'translate-x-6' : 'translate-x-1' }}"></span>
                            </div>
                            <span class="text-[10px] font-black uppercase tracking-widest {{ $package->is_active ? 'text-emerald-700' : 'text-slate-500' }}">
                                {{ $package->is_active ? 'Aktif' : 'Draft' }}
                            </span>
                        </form>

                        {{-- Tombol Hapus (Di dalam foreach $packages) --}}
                        <form id="delete-form-{{ $package->id }}" action="{{ route('tutor.packages.destroy', $package->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="button" onclick="confirmDelete({{ $package->id }})" class="p-2.5 rounded-xl bg-white border border-slate-200 text-slate-400 hover:text-rose-500 hover:border-rose-200 transition-all shadow-sm" title="Hapus Paket">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                {{-- EMPTY STATE --}}
                <div class="col-span-full bg-white rounded-[3rem] p-16 md:p-24 text-center border border-slate-200 shadow-sm">
                    <div class="w-28 h-28 bg-orange-50 rounded-full flex items-center justify-center mx-auto mb-6 border-8 border-white shadow-lg">
                        <span class="text-5xl">🛍️</span>
                    </div>
                    <h3 class="text-2xl font-black text-slate-800 mb-3">Etalase Anda Masih Kosong</h3>
                    <p class="text-slate-500 font-medium max-w-md mx-auto text-sm leading-relaxed mb-8">
                        Tarik perhatian murid dengan membuat paket belajar yang menarik. Tentukan materi, jumlah sesi, dan harga yang kompetitif sekarang juga!
                    </p>
                    <button onclick="document.getElementById('modal-tambah-paket').showModal()" class="inline-flex items-center gap-2 bg-orange-500 hover:bg-orange-400 text-white px-8 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-lg shadow-orange-500/30 active:scale-95 group">
                        <span class="text-lg leading-none transition-transform group-hover:rotate-90">+</span> Buat Paket Pertama
                    </button>
                </div>
                @endforelse
            </div>
        </div>
    </main>

    {{-- ======================================================== --}}
    {{-- MODAL TAMBAH PAKET (VERSI PREMIUM)                       --}}
    {{-- ======================================================== --}}
    <dialog id="modal-tambah-paket" class="rounded-[2.5rem] p-0 border border-slate-200 shadow-2xl backdrop:bg-slate-900/80 backdrop:backdrop-blur-sm m-auto w-full max-w-2xl overflow-hidden transition-all">
        <div class="bg-white relative flex flex-col max-h-[90vh]">
            
            {{-- Header Modal (Sticky & Gradient) --}}
            <div class="px-8 py-7 bg-gradient-to-r from-blue-600 to-indigo-700 border-b border-blue-800 flex items-center justify-between sticky top-0 z-20 relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/10 rounded-full blur-xl"></div>
                
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-12 h-12 bg-white/20 text-white rounded-xl flex items-center justify-center shadow-inner border border-white/30 backdrop-blur-md">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" /></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-blue-200 uppercase tracking-widest mb-0.5">Penawaran Baru</p>
                        <h3 class="text-2xl font-black text-white tracking-tight leading-none">Rancang Paket</h3>
                    </div>
                </div>
                
                <button type="button" onclick="this.closest('dialog').close()" class="relative z-10 w-10 h-10 flex items-center justify-center bg-white/10 border border-white/20 hover:bg-rose-500 hover:border-rose-500 text-white rounded-full transition-all shadow-sm active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            {{-- Form Konten (Scrollable Area) --}}
            <div class="p-8 overflow-y-auto custom-scrollbar bg-slate-50/50">
                <form action="{{ route('tutor.packages.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    {{-- 1. Nama Mata Pelajaran --}}
                    <div class="bg-white p-5 rounded-[1.5rem] border border-slate-200 shadow-sm transition-all hover:border-blue-200">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2.5">
                            Nama Program / Mata Pelajaran <span class="text-rose-500 text-sm leading-none">*</span>
                        </label>
                        <input type="text" name="nama_mapel" placeholder="Contoh: Matematika Dasar / TOEFL Preparation" required 
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-sm font-bold text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none shadow-inner placeholder:font-medium placeholder:text-slate-400">
                    </div>

                    {{-- 2. Deskripsi Paket --}}
                    <div class="bg-white p-5 rounded-[1.5rem] border border-slate-200 shadow-sm transition-all hover:border-blue-200">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2.5">
                            Deskripsi Singkat / Silabus <span class="text-rose-500 text-sm leading-none">*</span>
                        </label>
                        <textarea name="deskripsi" rows="3" placeholder="Jelaskan keunggulan paket ini, materi yang diajarkan, metode yang dipakai..." required 
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-sm font-medium text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none shadow-inner resize-none placeholder:text-slate-400 leading-relaxed"></textarea>
                    </div>

                    {{-- 3. Detail Sesi (Grid 2 Kolom) --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        {{-- Jenjang --}}
                        <div class="bg-white p-5 rounded-[1.5rem] border border-slate-200 shadow-sm transition-all hover:border-blue-200">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2.5">
                                Jenjang Siswa <span class="text-rose-500 text-sm leading-none">*</span>
                            </label>
                            <div class="relative">
                                <select name="jenjang" required class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-sm font-bold text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none shadow-inner cursor-pointer appearance-none">
                                    <option value="" disabled selected>Pilih Tingkat</option>
                                    <option value="SD">SD / MI</option>
                                    <option value="SMP">SMP / MTs</option>
                                    <option value="SMA">SMA / SMK</option>
                                    <option value="Umum">Umum / Kuliah</option>
                                </select>
                            </div>
                        </div>

                        {{-- Jumlah Sesi --}}
                        <div class="bg-white p-5 rounded-[1.5rem] border border-slate-200 shadow-sm transition-all hover:border-blue-200">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2.5">
                                Total Pertemuan <span class="text-rose-500 text-sm leading-none">*</span>
                            </label>
                            <input type="number" name="jumlah_sesi" min="1" placeholder="Misal: 8 Sesi" required 
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-sm font-bold text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none shadow-inner placeholder:font-medium placeholder:text-slate-400">
                        </div>
                    </div>

                    {{-- 4. Pengaturan Kelas (Grid 2 Kolom) --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        {{-- Metode Belajar --}}
                        <div class="bg-white p-5 rounded-[1.5rem] border border-slate-200 shadow-sm transition-all hover:border-blue-200">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2.5">
                                Sistem Belajar <span class="text-rose-500 text-sm leading-none">*</span>
                            </label>
                            <div class="relative">
                                <select name="metode" required class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-sm font-bold text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none shadow-inner cursor-pointer appearance-none">
                                    <option value="" disabled selected>Pilih Metode</option>
                                    <option value="Online">Online (Zoom/Meet)</option>
                                    <option value="Offline">Offline (Tatap Muka)</option>
                                </select>
                            </div>
                        </div>


                        {{-- Input Hari --}}
                        <div class="bg-white p-5 rounded-[1.5rem] border border-slate-200 shadow-sm">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2.5">
                                Jadwal Hari <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="hari" placeholder="Contoh: Senin, Rabu" required 
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-sm font-bold text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500/20 outline-none shadow-inner">
                        </div>
                        {{-- Input Jam --}}
                        <div class="bg-white p-5 rounded-[1.5rem] border border-slate-200 shadow-sm">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2.5">
                                Jam Pertemuan <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="jam" placeholder="Contoh: 16:00 - 18:00" required 
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-sm font-bold text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500/20 outline-none shadow-inner">
                        </div>


                        {{-- Kuota Murid --}}
                        <div class="bg-white p-5 rounded-[1.5rem] border border-slate-200 shadow-sm transition-all hover:border-blue-200">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2.5">
                                Maksimal Murid <span class="text-rose-500 text-sm leading-none">*</span>
                            </label>
                            <input type="number" name="kuota" min="1" placeholder="Misal: 10 Murid" required 
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-sm font-bold text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none shadow-inner placeholder:font-medium placeholder:text-slate-400">
                        </div>
                    </div>

                    {{-- 5. Wilayah Jangkauan --}}
                    <div class="bg-white p-5 rounded-[1.5rem] border border-slate-200 shadow-sm transition-all hover:border-blue-200">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2.5">
                            Cakupan Wilayah / Kota <span class="text-rose-500 text-sm leading-none">*</span>
                        </label>
                        <input type="text" name="domisili" placeholder="Cth: Surabaya (Offline) / Seluruh Indonesia (Online)" required 
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-sm font-bold text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none shadow-inner placeholder:font-medium placeholder:text-slate-400">
                    </div>

                    {{-- 6. PENGATURAN HARGA (HIGHLIGHT AREA) --}}
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 p-6 rounded-[1.5rem] shadow-sm relative overflow-hidden mt-4">
                        {{-- Dekorasi Card Harga --}}
                        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-blue-500/10 rounded-full blur-xl"></div>
                        
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shadow-inner">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <label class="block text-[11px] font-black text-blue-900 uppercase tracking-widest">
                                Harga Paket (Total Pendapatan Anda) <span class="text-rose-500 text-sm leading-none">*</span>
                            </label>
                        </div>

                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                <span class="text-blue-600 font-black text-xl">Rp</span>
                            </div>
                            <input type="number" name="harga_nett" min="50000" placeholder="500000" required 
                                class="w-full bg-white border border-blue-200 rounded-2xl p-5 pl-14 text-2xl font-black text-blue-900 focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none shadow-sm placeholder:font-bold placeholder:text-blue-200">
                        </div>
                        <p class="text-[10px] text-blue-600 font-medium mt-3 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Pastikan harga sudah mencakup semua sesi pertemuan.
                        </p>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="pt-6 flex flex-col sm:flex-row justify-end gap-3 mt-4 border-t border-slate-200/60">
                        <button type="button" onclick="this.closest('dialog').close()" 
                            class="px-8 py-3.5 rounded-xl text-xs font-black uppercase tracking-widest text-slate-500 bg-slate-100 hover:bg-slate-200 hover:text-slate-700 transition-all text-center">
                            Batal
                        </button>
                        <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-3.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-xl shadow-blue-600/30 active:scale-95 flex items-center justify-center gap-2 border border-blue-700">
                            Simpan ke Etalase
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>

    <footer class="mt-auto py-10 border-t border-slate-200 bg-white">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em]">Hak Cipta Pengajar &copy; {{ date('Y') }} tempatles.id</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // --- NOTIFIKASI SUCCESS/ERROR DARI CONTROLLER ---
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    confirmButtonText: 'Tutup',
                    buttonsStyling: false,
                    customClass: {
                        popup: 'rounded-[2rem] border border-slate-100 shadow-2xl',
                        confirmButton: 'bg-emerald-500 hover:bg-emerald-600 text-white px-8 py-3 rounded-xl text-xs font-black uppercase tracking-widest shadow-lg'
                    }
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: "{{ session('error') }}",
                    confirmButtonText: 'Coba Lagi',
                    buttonsStyling: false,
                    customClass: {
                        popup: 'rounded-[2rem] border border-slate-100 shadow-2xl',
                        confirmButton: 'bg-rose-500 hover:bg-rose-600 text-white px-8 py-3 rounded-xl text-xs font-black uppercase tracking-widest shadow-lg'
                    }
                });
            @endif
        }); 

        // --- FUNGSI KONFIRMASI HAPUS ---
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin Hapus Paket?',
                text: "Data ini tidak dapat dikembalikan lagi.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f43f5e',
                cancelButtonColor: '#cbd5e1',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                buttonsStyling: false,
                customClass: {
                    popup: 'rounded-[2rem] p-6 border border-slate-100 shadow-2xl',
                    confirmButton: 'bg-rose-500 hover:bg-rose-600 text-white px-8 py-3.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-lg shadow-rose-500/20',
                    cancelButton: 'bg-slate-100 hover:bg-slate-200 text-slate-600 px-8 py-3.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all',
                    actions: 'flex gap-3 mt-6'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tampilkan loading sebelum submit
                    Swal.fire({ title: 'Menghapus...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

    // FUNGSI UNTUK MENGUBAH TOMBOL MENJADI LOADING
        function showLoadingState(button) {
            const originalText = button.innerHTML;
            button.disabled = true;
            button.classList.add('opacity-70', 'cursor-not-allowed');
            button.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Memproses...
            `;
        }

        // Tambahkan Event Listener ke form
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    showLoadingState(submitBtn);
                }
            });
        });
    </script>
</body>

</html>