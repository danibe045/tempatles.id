<x-app-layout>
    {{-- ========================================================================= --}}
    {{-- HEADER STICKY                                                             --}}
    {{-- ========================================================================= --}}
    <div class="sticky top-0 z-[40] w-full pb-4">
        <div class="bg-white backdrop-blur-xl border-b border-slate-200/60 pt-6 pb-6 px-6 md:px-8 shadow-sm">
            <div class="max-w-[1400px] mx-auto flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
                
                {{-- Kiri: Tombol Back & Judul --}}
                <div class="flex items-center gap-5">
                    <a href="{{ route('admin.katalog-tutor') }}"
                        class="w-12 h-12 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-slate-500 hover:bg-slate-900 hover:text-white hover:border-slate-900 transition-all shadow-sm shrink-0 group">
                        <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <div>
                        <div class="inline-flex items-center gap-2 bg-orange-50 border border-orange-100 px-3 py-1.5 rounded-lg mb-2 shadow-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span>
                            <p class="text-[9px] font-black text-orange-600 uppercase tracking-[0.2em]">Manajemen Tutor</p>
                        </div>
                        <h2 class="font-black text-2xl text-slate-900 leading-tight tracking-tight">
                            Profil Lengkap Pengajar
                        </h2>
                    </div>
                </div>

                {{-- Kanan: Tombol Edit --}}
                <a href="{{ route('admin.tutor.edit', $tutor->id) }}"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg shadow-blue-600/20 active:scale-95 border border-blue-600 group">
                    <svg class="w-4 h-4 group-hover:-rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Edit Data Tutor
                </a>
            </div>
        </div>
    </div>

    {{-- ========================================================================= --}}
    {{-- KONTEN UTAMA                                                              --}}
    {{-- ========================================================================= --}}
    <div class="py-8 relative z-10">
        <div class="max-w-[1400px] mx-auto px-6 md:px-8">

            {{-- Flash Message --}}
            @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 shadow-sm rounded-2xl flex items-center gap-4 mb-8 animate-bounce-short">
                <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center shrink-0 shadow-md shadow-emerald-500/20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                </div>
                <span class="font-black text-sm text-emerald-800 uppercase tracking-wide">{{ session('success') }}</span>
            </div>
            @endif

            @php
                $totalPaket  = $tutor->packages?->count() ?? 0;
                $paketAktif  = $tutor->packages ? $tutor->packages->where('is_active', true)->count() : 0;
                
                $avgRating   = $tutor->reviews?->avg('rating') ?? 0;
                $totalUlasan = $tutor->reviews?->count() ?? 0;
                
                $totalStrike = $tutor->user->strike ?? 0; 
            @endphp

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

                {{-- ========================================== --}}
                {{-- KOLOM KIRI (PROFIL & KONTAK)               --}}
                {{-- ========================================== --}}
                <div class="xl:col-span-1 space-y-6">

                    {{-- Profile Card Premium --}}
                    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="h-28 bg-gradient-to-br from-slate-800 to-slate-900 relative">
                            <div class="absolute inset-0 opacity-20 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
                        </div>

                        <div class="px-6 pb-8 text-center relative -mt-14">
                            <div class="inline-flex justify-center mb-4">
                                <div class="w-28 h-28 rounded-[2rem] bg-slate-100 flex items-center justify-center border-4 border-white shadow-xl shadow-blue-900/10 ring-4 ring-slate-50 relative group overflow-hidden">
                                    
                                    {{-- Logika Tampilkan Foto atau Inisial --}}
                                    @if($tutor->user->profile_photo_path)
                                        <img src="{{ asset('storage/' . $tutor->user->profile_photo_path) }}" 
                                            alt="{{ $tutor->user->name }}" 
                                            class="w-full h-full object-cover">
                                    @else
                                        {{-- Fallback ke Inisial jika foto tidak ada --}}
                                        <div class="w-full h-full bg-gradient-to-br from-blue-600 to-indigo-700 text-white flex items-center justify-center text-4xl font-black">
                                            {{ strtoupper(substr($tutor->user->name ?? 'T', 0, 1)) }}
                                        </div>
                                    @endif
                                    
                                    <div class="absolute inset-0 rounded-[1.75rem] bg-white/0 group-hover:bg-white/10 transition-colors"></div>
                                </div>
                            </div>
                            
                            <h3 class="text-xl font-black text-slate-900 tracking-tight">{{ $tutor->user->name }}</h3>
                            <!-- <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-1 mb-6">{{ $tutor->user->email }}</p> -->

                            <div class="bg-blue-50/50 rounded-2xl p-4 mb-6 border border-blue-100/50 hover:bg-blue-50 transition-colors">
                                <p class="text-[9px] font-black text-blue-400 uppercase tracking-widest mb-1">Spesialisasi Bidang</p>
                                <p class="text-base font-black text-blue-700 tracking-tight">{{ $tutor->bidang ?? 'Umum' }}</p>
                            </div>

                            @php
                                $statusConfig = [
                                    'menunggu_mou' => ['bg' => 'bg-blue-50',    'text' => 'text-blue-700',    'border' => 'border-blue-200',   'dot' => 'bg-blue-500',    'pulse' => true],
                                    'aktif'        => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200','dot' => 'bg-emerald-500', 'pulse' => false],
                                ];
                                $cfg = $statusConfig[strtolower($tutor->status_akun)] ?? ['bg' => 'bg-slate-50', 'text' => 'text-slate-600', 'border' => 'border-slate-200', 'dot' => 'bg-slate-400', 'pulse' => false];
                            @endphp
                            <div class="inline-flex items-center justify-center gap-2 w-full px-5 py-3.5 rounded-xl border text-[10px] font-black uppercase tracking-widest transition-all shadow-sm {{ $cfg['bg'] }} {{ $cfg['text'] }} {{ $cfg['border'] }}">
                                <span class="w-2 h-2 rounded-full {{ $cfg['dot'] }} {{ $cfg['pulse'] ? 'animate-pulse' : '' }}"></span>
                                Status: {{ str_replace('_', ' ', $tutor->status_akun) }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ========================================== --}}
                {{-- KOLOM KANAN (DATA LENGKAP & PAKET)         --}}
                {{-- ========================================== --}}
                <div class="xl:col-span-2 space-y-6">

                    {{-- 1. Biodata + Latar Belakang --}}
                    <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-200">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
    
                            {{-- Biodata Pribadi --}}
                            <div class="space-y-5">
                                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2 border-b border-slate-100 pb-3">
                                    <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    Biodata Pribadi
                                </h4>
                                <div class="space-y-4">
                                    {{-- Jenis Kelamin --}}
                                    <div class="flex items-center gap-4 bg-slate-50/50 p-3.5 rounded-xl border border-slate-100 hover:border-orange-200 transition-all">
                                        <div class="w-9 h-9 rounded-xl bg-white shadow-sm border border-slate-200 flex items-center justify-center text-slate-400 shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Jenis Kelamin</p>
                                            <p class="text-sm font-bold text-slate-900 truncate">{{ $tutor->jenis_kelamin ?? '-' }}</p>
                                        </div>
                                    </div>
                                    {{-- Tanggal Lahir --}}
                                    <div class="flex items-center gap-4 bg-slate-50/50 p-3.5 rounded-xl border border-slate-100 hover:border-orange-200 transition-all">
                                        <div class="w-9 h-9 rounded-xl bg-white shadow-sm border border-slate-200 flex items-center justify-center text-slate-400 shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-0.5">TTL</p>
                                            <p class="text-sm font-bold text-slate-900 truncate">
                                                {{ $tutor->tempat_lahir ?? '-' }}, {{ $tutor->tanggal_lahir ? \Carbon\Carbon::parse($tutor->tanggal_lahir)->translatedFormat('d M Y') : '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Kontak & Email --}}
                            <div class="space-y-5">
                                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2 border-b border-slate-100 pb-3">
                                    <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    Kontak & Email
                                </h4>
                                <div class="space-y-4">
                                    {{-- Email --}}
                                    <div class="flex items-center gap-4 bg-slate-50/50 p-3.5 rounded-xl border border-slate-100 hover:border-emerald-200 transition-all">
                                        <div class="w-9 h-9 rounded-xl bg-white shadow-sm border border-slate-200 flex items-center justify-center text-emerald-600 shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Alamat Email</p>
                                            <p class="text-sm font-bold text-slate-900 truncate">{{ $tutor->user->email ?? '-' }}</p>
                                        </div>
                                    </div>
                                    {{-- WhatsApp --}}
                                    <div class="flex items-center gap-4 bg-slate-50/50 p-3.5 rounded-xl border border-slate-100 hover:border-emerald-200 transition-all group">
                                        <div class="w-9 h-9 rounded-xl bg-white shadow-sm border border-slate-200 flex items-center justify-center text-emerald-600 shrink-0 group-hover:scale-110 transition-transform">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-0.5">WhatsApp</p>
                                            <p class="text-sm font-bold text-slate-900 truncate">{{ $tutor->user->phone_number ?? 'Belum diisi' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 mt-5 pt-6 border-t border-slate-100">    
                            {{-- Domisili --}}
                            <div class="mt-6 md:mt-0">
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    Alamat Domisili Lengkap
                                </p>
                                <p class="text-sm font-bold text-slate-700 leading-relaxed bg-slate-50 p-4 rounded-xl border border-slate-100">{{ $tutor->alamat_domisili ?? 'Belum diisi' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Daftar Konten Lainnya --}}
                <div class="xl:col-span-3 space-y-6">
                    {{-- 2. Pengalaman Mengajar & Akademik --}}
                    <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-200 space-y-8">
                        
                        {{-- Bagian Akademik --}}
                        <div>
                            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2 border-b border-slate-100 pb-3 mb-6">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                                Latar Belakang Akademik
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-center gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                    <div class="w-10 h-10 rounded-xl bg-white shadow-sm border border-slate-200 flex items-center justify-center text-slate-400 shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15M9 11l3 3L22 4"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Pendidikan Terakhir</p>
                                        <p class="text-sm font-bold text-slate-900">{{ $tutor->pendidikan_terakhir ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                    <div class="w-10 h-10 rounded-xl bg-white shadow-sm border border-slate-200 flex items-center justify-center text-slate-400 shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Asal Instansi / Univ</p>
                                        <p class="text-sm font-bold text-slate-900">{{ $tutor->instansi ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Bagian Pengalaman --}}
                        <div class="relative">
                            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2 border-b border-slate-100 pb-3 mb-6">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                Riwayat & Pengalaman Mengajar
                            </h4>
                            <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 relative overflow-hidden">
                                <div class="absolute right-0 top-0 p-4 opacity-10">
                                    <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                                </div>
                                <p class="text-sm font-medium text-slate-700 leading-relaxed whitespace-pre-wrap relative z-10">{{ $tutor->pengalaman ?? 'Tutor belum mengisi riwayat pengalaman mengajarnya.' }}</p>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2 mb-5">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Berkas Lampiran & MoU
                            </h4>

                            @if($tutor->link)
                                {{-- Kartu Dokumen (Tautan Tersedia) --}}
                                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5 flex items-center gap-4 group hover:bg-blue-100/50 transition-colors">
                                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-blue-600 border border-blue-100 shrink-0 group-hover:scale-110 transition-transform shadow-sm">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/></svg>
                                    </div>
                                    
                                    <div class="min-w-0 flex-1">
                                        <p class="font-black text-slate-900 text-sm">Folder Google Drive</p>
                                        <p class="text-[11px] text-blue-600 font-medium mt-0.5 truncate">{{ $tutor->link }}</p>
                                    </div>

                                    {{-- Tombol Buka di dalam kartu agar rapi --}}
                                    <a href="{{ $tutor->link }}" target="_blank"
                                        class="shrink-0 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all active:scale-95 flex items-center gap-1.5 shadow-md shadow-blue-600/20">
                                        Buka
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>
                                </div>
                            @else
                                {{-- Placeholder (Tautan Kosong) --}}
                                <div class="bg-slate-50 border border-dashed border-slate-300 rounded-2xl p-8 flex flex-col items-center justify-center text-center">
                                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-slate-400 border border-slate-200 mb-3 shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    </div>
                                    <p class="text-[11px] font-black text-slate-500 uppercase tracking-widest">Belum Melampirkan Tautan</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- 3. Paket Mengajar (Fixed Sesuai Model TutorPackage) --}}
                    <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-200">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                                <svg class="w-4 h-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                                Paket Mengajar
                            </h4>
                            <span class="inline-block text-[10px] font-black text-slate-500 bg-slate-100 border border-slate-200 px-3 py-1.5 rounded-lg w-max">
                                {{ $paketAktif }} aktif dari {{ $totalPaket }} paket
                            </span>
                        </div>

                        @if($tutor->packages && $tutor->packages->count() > 0)
                        <div class="space-y-3">
                            @foreach($tutor->packages as $paket)
                            <div class="flex items-center gap-4 p-4 rounded-2xl border {{ $paket->is_active ? 'border-slate-200 bg-white hover:border-violet-300 hover:shadow-sm' : 'border-slate-100 bg-slate-50 opacity-60' }} transition-all group">
                                <div class="w-12 h-12 rounded-xl {{ $paket->is_active ? 'bg-violet-50 group-hover:scale-105 transition-transform' : 'bg-slate-100' }} flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6 {{ $paket->is_active ? 'text-violet-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0 text-left">
                                    {{-- FIX: Menggunakan kolom 'nama_mapel' dari database --}}
                                    <p class="text-sm font-black text-slate-900 truncate">{{ $paket->nama_mapel }}</p>
                                    <p class="text-[10px] font-bold text-slate-400 mt-0.5 truncate">
                                        {{ $paket->jumlah_sesi ?? 0 }} Sesi <span class="mx-1">•</span> Jenjang {{ $paket->jenjang ?? 'Semua' }}
                                        @if($paket->metode) <span class="mx-1">•</span> {{ $paket->metode }} @endif
                                        @if($paket->kuota) <span class="mx-1">•</span> Sisa Kuota: {{ $paket->kuota }} @endif
                                    </p>
                                </div>
                                <div class="text-right shrink-0">
                                    {{-- FIX: Menggunakan kolom 'harga_nett' dari database --}}
                                    <p class="text-sm font-black {{ $paket->is_active ? 'text-violet-700' : 'text-slate-400' }}">
                                        Rp {{ number_format($paket->harga_nett ?? 0, 0, ',', '.') }}
                                    </p>
                                    {{-- FIX: Mengecek boolean 'is_active' dari database --}}
                                    <div class="inline-flex items-center gap-1.5 mt-1 px-2.5 py-1 rounded-lg text-[8px] font-black uppercase tracking-widest border
                                        {{ $paket->is_active ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-slate-100 text-slate-500 border-slate-200' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $paket->is_active ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                        {{ $paket->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="bg-slate-50 border border-dashed border-slate-300 rounded-2xl p-10 flex flex-col items-center justify-center text-center">
                            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-slate-400 border border-slate-200 mb-3 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            </div>
                            <p class="text-[11px] font-black text-slate-500 uppercase tracking-widest">Tutor Belum Memiliki Paket Mengajar</p>
                        </div>
                        @endif
                    </div>

                    {{-- 4. Rating + Strike --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Rating & Ulasan Tutor (Fixed Menggunakan Model Review) --}}
                        <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-200">
                            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2 mb-6">
                                <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                                Rating & Ulasan
                            </h4>

                            <div class="flex items-end gap-4 mb-6 text-left">
                                <p class="text-5xl font-black text-slate-900 leading-none">
                                    {{ $totalUlasan > 0 ? number_format($avgRating, 1) : '0.0' }}
                                </p>
                                <div class="pb-1">
                                    <div class="flex gap-0.5 mb-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= round($avgRating))
                                                <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            @else
                                                <svg class="w-4 h-4 text-slate-220" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <p class="text-[10px] font-bold text-slate-400">{{ $totalUlasan }} ulasan masuk</p>
                                </div>
                            </div>

                            <div class="space-y-2.5 mb-6">
                                @foreach([5, 4, 3, 2, 1] as $star)
                                    @php
                                        // FIX: Saring data koleksi menggunakan relasi 'reviews' bawaan model asli
                                        $count = $tutor->reviews ? $tutor->reviews->where('rating', (int)$star)->count() : 0;
                                        $pct   = $totalUlasan > 0 ? ($count / $totalUlasan) * 100 : 0;
                                    @endphp
                                    <div class="flex items-center gap-3 group">
                                        <span class="text-[10px] font-black text-slate-400 w-2">{{ $star }}</span>
                                        <div class="flex-1 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                            <div class="h-full bg-amber-400 rounded-full transition-all duration-1000" style="width: {{ $pct }}%"></div>
                                        </div>
                                        <span class="text-[10px] font-bold text-slate-400 w-4 text-right">{{ $count }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Strike Panel --}}
                        <div class="bg-white rounded-[2rem] p-8 shadow-sm border {{ $totalStrike > 0 ? 'border-rose-300 bg-rose-50/10' : 'border-slate-200' }}">
                            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2 mb-6">
                                <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                Status Pelanggaran Akun
                            </h4>

                            <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100 mb-6 text-center">
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-4">Poin Pelanggaran (Strike)</p>
                                <div class="flex justify-center gap-3 mb-3">
                                    {{-- Loop dinamis menggambar indikator petir berdasarkan data angka database --}}
                                    @for($i = 1; $i <= 3; $i++)
                                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-inner
                                        {{ $i <= $totalStrike
                                            ? 'bg-rose-100 border-2 border-rose-400 text-rose-500 shadow-sm animate-pulse' 
                                            : 'bg-white border-2 border-dashed border-slate-300 text-slate-300' }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                    </div>
                                    @endfor
                                </div>
                                <p class="text-xs font-black {{ $totalStrike >= 3 ? 'text-rose-600' : ($totalStrike > 0 ? 'text-amber-600' : 'text-emerald-600') }}">
                                    {{ $totalStrike }} dari 3 Poin Strike
                                </p>
                            </div>

                            @if($totalStrike >= 3)
                                <div class="bg-rose-100 border border-rose-200 text-rose-700 font-bold p-4 rounded-xl text-xs text-center uppercase tracking-wider animate-bounce">
                                    🚨 Akun Ditangguhkan (Suspend Otomatis)
                                </div>
                            @else
                                <div class="bg-emerald-50 border border-emerald-100 p-4 rounded-xl flex items-center gap-3 text-left">
                                    <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center shadow-sm text-emerald-500 border border-emerald-200 shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <p class="text-[11px] font-bold text-emerald-700 leading-tight">Tutor memiliki performa yang baik dan aman dari ambang pemblokiran sistem.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>