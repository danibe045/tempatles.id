@extends('layouts.main')

@section('title', 'Detail Tutor & Pemesanan - tempatles.id')

@section('content')
<div class="bg-slate-50 flex-grow pt-8 pb-24">
    <div class="max-w-7xl mx-auto px-6 md:px-8">

        {{-- Tombol Kembali --}}
        <a href="{{ route('katalog.publik') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 text-xs font-bold text-slate-500 rounded-xl hover:bg-slate-100 hover:text-blue-600 transition-colors shadow-sm mb-8">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Katalog
        </a>

        @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 p-4 rounded-2xl mb-8 font-bold text-sm flex items-center gap-3 shadow-sm">
            <svg class="w-6 h-6 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ session('success') }}
        </div>
        @endif

        @php
            // --- LOGIKA AGGREGATE REPUTASI RATING & PAKET ---
            $avgRating = \App\Models\Review::where('tutor_id', $tutor->user_id)->avg('rating') ?? 0;
            $totalReview = \App\Models\Review::where('tutor_id', $tutor->user_id)->count();
            $packages = $tutor->packages->where('is_active', true);
        @endphp

        <div class="flex flex-col lg:flex-row gap-8 items-start">

            {{-- ======================================================== --}}
            {{-- KOLOM KIRI: BIODATA, ETALASE PAKET, & DAFTAR ULASAN --}}
            {{-- ======================================================== --}}
            <div class="w-full lg:w-3/5 space-y-6">

                {{-- 1. Card Profil Utama --}}
                <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden relative">
                    <div class="h-32 w-full bg-gradient-to-r from-blue-950 via-blue-900 to-blue-700 relative">
                        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                    </div>

                    <div class="px-8 pb-8 relative">
                        <div class="flex flex-col sm:flex-row gap-5 items-start sm:items-end -mt-12 sm:-mt-16 mb-6">
                            <div class="w-28 h-28 sm:w-36 sm:h-36 shrink-0 bg-white border-4 border-white shadow-lg text-blue-600 rounded-[1.5rem] flex items-center justify-center font-black text-4xl sm:text-5xl overflow-hidden relative z-10">
                                @if($tutor->user->profile_photo_path)
                                    <img src="{{ asset('storage/'.$tutor->user->profile_photo_path) }}" alt="{{ $tutor->user->name }}" class="w-full h-full object-cover">
                                @else
                                    {{ strtoupper(substr($tutor->user->name, 0, 1)) }}
                                @endif
                            </div>
                            
                            <div class="pb-1 flex-grow">
                                <div class="flex flex-wrap items-center gap-2 mb-1.5">
                                    <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 border border-emerald-100 rounded-lg text-[10px] font-black text-emerald-600 uppercase tracking-widest">
                                        ✓ Terverifikasi
                                    </div>
                                    <div class="inline-flex items-center gap-1 px-2.5 py-1 bg-amber-50 border border-amber-200 rounded-lg text-[11px] font-black text-amber-700">
                                        ⭐ {{ number_format($avgRating, 1) }} <span class="text-slate-400 font-bold text-[10px]">({{ $totalReview }} Ulasan)</span>
                                    </div>
                                </div>
                                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 leading-tight flex items-center gap-2">
                                    {{ $tutor->user->name }}
                                </h1>
                                <p class="text-sm font-bold text-slate-500 mt-1">Spesialisasi Bidang: <span class="text-slate-800 font-extrabold">{{ $tutor->bidang ?? 'Pengajar Umum' }}</span></p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="bg-slate-50 border border-slate-100 rounded-2xl p-4">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">🎓 Latar Belakang Pendidikan</p>
                                <p class="text-xs font-extrabold text-slate-800">{{ $tutor->pendidikan_terakhir ?? '-' }}</p>
                                <p class="text-[11px] font-medium text-slate-500">{{ $tutor->instansi ?? 'Universitas' }}</p>
                            </div>
                            <div class="bg-slate-50 border border-slate-100 rounded-2xl p-4">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">📍 Alamat Domisili Asal</p>
                                <p class="text-xs font-extrabold text-slate-800 line-clamp-2 leading-relaxed">{{ $tutor->alamat_domisili ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 2. Deskripsi Tentang Pengajar --}}
                <div class="bg-white rounded-[2rem] border border-slate-200 p-8 shadow-sm">
                    <h2 class="text-lg font-black text-blue-950 mb-4">Tentang Pengajar & Pengalaman</h2>
                    <div class="prose prose-sm prose-slate text-slate-600 font-medium leading-relaxed bg-slate-50 p-6 rounded-2xl border border-slate-100">
                        {!! nl2br(e($tutor->pengalaman ?? 'Belum ada pengisian penjelasan profil.')) !!}
                    </div>
                </div>

                {{-- 3. ETALASE DAFTAR PROGRAM BELAJAR --}}
                <div class="bg-white rounded-[2rem] border border-slate-200 p-8 shadow-sm">
                    <h2 class="text-lg font-black text-blue-950 mb-1">Program & Paket Mengajar</h2>
                    <p class="text-xs font-bold text-slate-400 mb-5 uppercase tracking-wider">Pilihan materi bimbel yang disediakan oleh tutor</p>
                    
                    <div class="space-y-4">
                        @forelse($packages as $paket)
                            <div class="bg-slate-50 border border-slate-150 rounded-2xl p-6 relative overflow-hidden">
                                <div class="flex flex-col sm:flex-row justify-between items-start gap-2 mb-3">
                                    <div>
                                        <span class="px-2 py-0.5 rounded bg-blue-100 text-blue-800 font-black text-[9px] uppercase tracking-wider">
                                            {{ $paket->jenjang ?: 'UMUM' }}
                                        </span>
                                        <h3 class="text-base font-black text-slate-800 mt-1 uppercase">{{ $paket->nama_mapel }}</h3>
                                    </div>
                                    <p class="text-lg font-black text-blue-600 shrink-0">
                                        Rp {{ number_format($paket->harga_nett ?? 0, 0, ',', '.') }}
                                    </p>
                                </div>
                                <p class="text-slate-500 text-xs font-medium leading-relaxed mb-4">
                                    {{ $paket->deskripsi ?? 'Belum ada deskripsi cakupan materi untuk paket ini.' }}
                                </p>
                                <div class="border-t border-slate-200/60 pt-3 grid grid-cols-2 sm:grid-cols-4 gap-3 text-[11px] font-bold text-slate-600 bg-white -mx-6 -mb-6 p-4 rounded-b-2xl border-t">
                                    <div>🗓️ {{ $paket->hari }}</div>
                                    <div>⏰ {{ $paket->jam }}</div>
                                    <div class="uppercase text-[10px]">💻 {{ $paket->metode }}</div>
                                    <div>👥 {{ $paket->jumlah_sesi }} Sesi (Sisa: {{ $paket->kuota }} Anak)</div>
                                </div>
                            </div>
                        @empty
                            <div class="bg-slate-50 border border-slate-100 p-6 rounded-2xl text-center text-xs font-bold text-slate-400">
                                ⚠️ Tutor belum mendaftarkan paket mengajar aktif.
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- 4. Komponen Ulasan & Testimoni Murid --}}
                <div class="bg-white rounded-[2rem] border border-slate-200 p-8 shadow-sm">
                    <h2 class="text-lg font-black text-blue-950 mb-1">Ulasan & Testimoni Murid</h2>
                    <p class="text-xs font-bold text-slate-400 mb-5 uppercase tracking-wider">Kesan jujur dari para siswa belajar</p>
                    
                    @php
                        $reviewsList = \App\Models\Review::with('murid')->where('tutor_id', $tutor->user_id)->latest()->take(4)->get();
                    @endphp

                    <div class="space-y-4">
                        @forelse($reviewsList as $reviewItem)
                            <div class="bg-slate-50 border border-slate-100 p-5 rounded-2xl flex flex-col gap-2">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-blue-600 text-white font-black text-xs flex items-center justify-center uppercase">
                                            {{ substr($reviewItem->murid->name ?? 'M', 0, 1) }}
                                        </div>
                                        <div>
                                            <h4 class="text-xs font-black text-slate-800 leading-none">{{ $reviewItem->murid->name ?? 'Siswa' }}</h4>
                                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tight">{{ $reviewItem->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    <div class="px-2 py-0.5 bg-amber-50 border border-amber-200 text-amber-600 rounded-lg text-xs font-black">
                                        ⭐ {{ $reviewItem->rating }}
                                    </div>
                                </div>
                                <p class="text-slate-600 text-xs font-medium leading-relaxed italic pl-1">
                                    "{!! nl2br(e($reviewItem->komentar ?? 'Siswa tidak menyertakan ulasan tertulis.')) !!}"
                                </p>
                            </div>
                        @empty
                            <div class="bg-slate-50 border border-slate-100 p-6 rounded-2xl text-center text-xs font-bold text-slate-400">
                                🍃 Belum memiliki ulasan bintang dari siswa di platform ini.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- ======================================================== --}}
            {{-- KOLOM KANAN: ACTION CENTER & FORM RESERVASI ULTRA-CLEAN  --}}
            {{-- ======================================================== --}}
            <div class="w-full lg:w-2/5 lg:sticky lg:top-24">
                
                @auth
                @if($errors->any())
                    <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl text-xs font-bold shadow-sm">
                        <p class="mb-1 uppercase tracking-widest font-black">Validasi Gagal:</p>
                        <ul class="list-disc pl-4">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    {{-- KONDISI 1: JIKA USER SUDAH LOGIN (FORMULIR UTAMA AKTIF) --}}
                    <form action="{{ route('katalog.pesan', $tutor->id) }}" method="POST" onsubmit="return checkPackageSelected()"
                        class="bg-white rounded-[2.5rem] border border-slate-200/60 p-8 shadow-2xl shadow-slate-200/40 relative">
                        @csrf
                        
                        {{-- Header Form --}}
                        <div class="mb-6 pb-5 border-b border-slate-100 flex items-center justify-between gap-4">
                            <div>
                                <span class="inline-flex items-center px-2.5 py-1 bg-blue-50 border border-blue-100/70 rounded-lg text-[9px] font-black text-blue-700 uppercase tracking-wider">
                                    Reservasi Langsung
                                </span>
                                <h2 class="text-2xl font-black text-slate-900 tracking-tight mt-2.5 leading-none">Konfirmasi Kelas</h2>
                            </div>
                        </div>

                        <div class="space-y-5 mb-6">
                            
                            {{-- 1. TOMBOL TRIGGER PILIH PAKET (PENGGANTI DROPDOWN) --}}
                            <div class="group">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1 group-focus-within:text-blue-600 transition-colors">1. Program Belajar Dipilih <span class="text-rose-500">*</span></label>
                                
                                {{-- Input Hidden untuk menyimpan ID paket yang akan disubmit --}}
                                <input type="hidden" name="tutor_package_id" id="selected_paket_id">
                                
                                <button type="button" onclick="openPackageModal()" class="relative flex items-center justify-between w-full bg-white border-2 border-slate-200/80 rounded-2xl p-3 sm:p-4 text-left hover:border-blue-500 hover:bg-blue-50/30 focus:outline-none focus:ring-4 focus:ring-blue-600/10 transition-all duration-300 shadow-sm group/btn">
                                    
                                    <div class="flex items-center gap-4 min-w-0">
                                        {{-- Ikon Vektor Buku (Pengganti Emoji) --}}
                                        <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100/50 border border-blue-200/50 text-blue-600 flex items-center justify-center shrink-0 group-hover/btn:scale-105 transition-transform duration-300">
                                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                            </svg>
                                        </div>
                                        
                                        {{-- Area Teks yang Akan Digantikan oleh JavaScript --}}
                                        <div id="selected_paket_display" class="min-w-0 flex flex-col justify-center">
                                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Status Pilihan</span>
                                            <span class="text-xs sm:text-sm font-bold text-slate-800">Pilih paket belajar...</span>
                                        </div>
                                    </div>

                                    {{-- Ikon Panah Kanan (Indikator Klik) --}}
                                    <div class="shrink-0 pl-3">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-slate-50 border border-slate-200 text-slate-400 group-hover/btn:bg-blue-600 group-hover/btn:border-blue-600 group-hover/btn:text-white transition-colors duration-300 shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                            </svg>
                                        </span>
                                    </div>

                                </button>
                            </div>

                            {{-- 2. Input Request Jadwal --}}
                            <div class="group">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1 group-focus-within:text-blue-600 transition-colors">2. Preferensi Jadwal Belajar <span class="text-rose-500">*</span></label>
                                <div class="relative flex items-center">
                                    <span class="absolute left-4 text-slate-400 text-sm pointer-events-none">🗓️</span>
                                    <input type="text" name="jadwal_request" placeholder="Cth: Setiap Selasa & Kamis, Pukul 16.00 WIB" class="w-full bg-slate-50/60 border border-slate-200 rounded-2xl pl-11 pr-4 py-4 text-xs font-bold text-slate-800 border-2 border-transparent focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition-all shadow-sm outline-none placeholder:font-medium placeholder:text-slate-400" required>
                                </div>
                            </div>
                            
                            {{-- 3. Input Textarea Target Belajar & Catatan Alamat --}}
                            <div class="group">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1 group-focus-within:text-blue-600 transition-colors">3. Catatan Tambahan</label>
                                <div class="relative flex items-start">
                                    <span class="absolute left-4 top-4 text-slate-400 text-sm pointer-events-none">🎯</span>
                                    <textarea name="catatan" rows="3" placeholder="Ceritakan kendala/target belajarmu. (Jika les Offline, wajib cantumkan alamat rumah lengkap di sini)..." class="w-full bg-slate-50/60 border border-slate-200 rounded-2xl pl-11 pr-4 py-4 text-xs font-medium text-slate-800 border-2 border-transparent focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition-all shadow-sm resize-none outline-none placeholder:text-slate-400 leading-relaxed"></textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Button Submit --}}
                        @if($packages->count() > 0)
                            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white px-6 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-xl shadow-orange-500/30 transform hover:-translate-y-0.5 active:translate-y-0 duration-200">
                                Kirim Pemesanan
                            </button>
                        @endif
                    </form>
                @else
                    {{-- ======================================================== --}}
                    {{-- KONDISI 2: JIKA USER ADALAH GUEST (CARD TEASER LOCKED)    --}}
                    {{-- ======================================================== --}}
                    <div class="bg-gradient-to-b from-white to-slate-50/50 rounded-[2.5rem] border border-slate-200 p-8 shadow-2xl shadow-slate-200/40 text-center relative overflow-hidden">
                        {{-- Bulatan Hiasan Soft BG --}}
                        <div class="absolute top-[-20%] right-[-20%] w-32 h-32 bg-orange-100 blur-2xl rounded-full -z-10"></div>
                        
                        {{-- Icon Gembok Minimalis --}}
                        <div class="w-14 h-14 mx-auto bg-orange-50 text-orange-500 border border-orange-100/70 rounded-2xl flex items-center justify-center shadow-sm mb-5 transform -rotate-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                            </svg>
                        </div>

                        <h3 class="text-xl font-black text-slate-900 tracking-tight mb-2">Tertarik Belajar Bersama?</h3>
                        <p class="text-slate-500 text-xs font-medium leading-relaxed max-w-xs mx-auto mb-6">
                            Jika Anda tertarik untuk mulai belajar, bergabunglah sebagai murid sekarang untuk bisa mereservasi paket pilihan Anda.
                        </p>

                        {{-- CTA Utama Pendaftaran Baru Murid --}}
                        <div class="space-y-4">
                            <a href="{{ route('register') }}?role=murid" class="flex items-center justify-center w-full bg-orange-500 hover:bg-orange-600 text-white px-6 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-xl shadow-orange-500/30 text-center transform hover:-translate-y-0.5 duration-200">
                                Daftar Akun Murid (Gratis)
                            </a>
                            <p class="text-[11px] font-bold text-slate-400">
                                Sudah memiliki akun? <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-black tracking-wide hover:underline transition-colors">Masuk di sini</a>
                            </p>
                        </div>
                    </div>
                @endauth

            </div>

        </div>
    </div>
</div>
{{-- ======================================================== --}}
{{-- MODAL PILIH PAKET (VERSI SUPER MINIMALIS & CLEAN)        --}}
{{-- ======================================================== --}}
@auth
<div id="packageModal" class="fixed inset-0 z-[100] flex items-end sm:items-center justify-center p-0 sm:p-6 opacity-0 pointer-events-none transition-all duration-400 ease-out">
    {{-- Backdrop Hitam Blur --}}
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closePackageModal()"></div>
    
    {{-- Kotak Modal --}}
    <div class="relative bg-slate-50 w-full max-w-xl rounded-t-[2.5rem] sm:rounded-[2.5rem] shadow-2xl overflow-hidden transform translate-y-full sm:translate-y-8 sm:scale-95 transition-all duration-400 ease-out flex flex-col max-h-[90vh] sm:max-h-[85vh]">
        
        {{-- Modal Header --}}
        <div class="p-6 md:px-8 md:py-7 bg-gradient-to-b from-white to-slate-50 border-b border-slate-200/60 flex items-center justify-between shrink-0 relative overflow-hidden z-10">
            <div class="absolute top-[-50%] right-[-10%] w-32 h-32 bg-blue-100/60 blur-2xl rounded-full pointer-events-none"></div>
            
            <div class="relative z-10">
                <span class="inline-block px-2.5 py-1 bg-blue-100 text-blue-700 text-[9px] font-black uppercase tracking-widest rounded-lg mb-2">
                    Langkah 1
                </span>
                <h3 class="text-2xl font-black text-slate-900 tracking-tight">Pilih Paket Belajar</h3>
                <p class="text-xs font-medium text-slate-500 mt-1">Tentukan program yang paling pas buatmu.</p>
            </div>
            
            <button type="button" onclick="closePackageModal()" class="relative z-10 w-11 h-11 bg-white border border-slate-200 text-slate-400 hover:text-rose-500 hover:bg-rose-50 hover:border-rose-100 rounded-2xl flex items-center justify-center transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        
        {{-- List Paket yang bisa diklik --}}
        <div class="p-5 md:p-6 overflow-y-auto hide-scroll flex-grow space-y-4">
            @forelse($packages as $paket)
                <div onclick="selectPackage('{{ $paket->id }}', '{{ addslashes($paket->nama_mapel) }}', '{{ number_format($paket->harga_nett, 0, ',', '.') }}', '{{ $paket->jenjang ?: 'UMUM' }}', '{{ $paket->jumlah_sesi }}')" 
                    class="group relative flex items-center justify-between p-5 sm:p-6 cursor-pointer rounded-2xl border-2 border-slate-100 bg-white hover:border-blue-400 hover:bg-blue-50/30 transition-all duration-300 shadow-sm hover:shadow-xl hover:shadow-blue-600/10 hover:-translate-y-0.5 overflow-hidden">
                    
                    {{-- Aksen Garis Biru Menyala di Kiri saat Hover --}}
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-blue-500 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300 rounded-l-2xl"></div>

                    <div class="min-w-0 leading-tight pl-2 sm:pl-1">
                        <div class="flex items-center gap-2 mb-2.5">
                            <span class="px-2 py-0.5 rounded bg-orange-50 border border-orange-100/50 text-orange-600 font-black text-[9px] uppercase tracking-wider shadow-sm">
                                {{ $paket->jenjang ?: 'UMUM' }}
                            </span>
                            <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-500 font-black text-[8px] uppercase tracking-wider">
                                💻 {{ $paket->metode }}
                            </span>
                        </div>
                        <h4 class="text-sm sm:text-base font-black text-slate-800 uppercase truncate tracking-tight group-hover:text-blue-900 transition-colors">
                            {{ $paket->nama_mapel }}
                        </h4>
                        <p class="text-[11px] font-bold text-slate-400 mt-1.5">
                            👥 {{ $paket->jumlah_sesi }} Sesi Pertemuan
                        </p>
                    </div>

                    <div class="text-right shrink-0 pl-4 relative z-10">
                        <p class="text-base sm:text-lg font-black text-blue-600 leading-none">Rp {{ number_format($paket->harga_nett ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center py-10 opacity-60">
                    <span class="text-4xl mb-3">🍃</span>
                    <p class="text-center text-xs font-black text-slate-500 uppercase tracking-widest">Paket Tidak Tersedia</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

{{-- MODAL NOTIFIKASI PEMESANAN --}}
@if(session('success') || session('error'))
<div id="notifModal" class="fixed inset-0 z-[200] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white rounded-3xl p-8 w-full max-w-sm text-center shadow-2xl">
        @if(session('success'))
            <div class="w-20 h-20 bg-emerald-100 text-emerald-500 rounded-full flex items-center justify-center mx-auto mb-5">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            </div>
            <h3 class="text-xl font-black text-slate-900 mb-2">Berhasil Membuat Pesanan!</h3>
            <p class="text-sm text-slate-500 mb-6">{{ session('success') }}</p>
        @else
            <div class="w-20 h-20 bg-rose-100 text-rose-500 rounded-full flex items-center justify-center mx-auto mb-5">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </div>
            <h3 class="text-xl font-black text-slate-900 mb-2">Terjadi Kesalahan!Gagal Membuat Pesanan</h3>
            <p class="text-sm text-slate-500 mb-6">{{ session('error') }}</p>
        @endif
        <button onclick="document.getElementById('notifModal').remove()" class="w-full bg-slate-900 text-white py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-slate-800 transition-all">
            Mengerti
        </button>
    </div>
</div>
@endif

<script>
    // FUNGSI MEMBUKA MODAL
    function openPackageModal() {
        const modal = document.getElementById('packageModal');
        const modalBox = modal.children[1];
        modal.classList.remove('opacity-0', 'pointer-events-none');
        setTimeout(() => { modalBox.classList.remove('translate-y-full', 'sm:translate-y-8', 'sm:scale-95'); }, 10);
    }

    // FUNGSI MENUTUP MODAL
    function closePackageModal() {
        const modal = document.getElementById('packageModal');
        const modalBox = modal.children[1];
        modalBox.classList.add('translate-y-full', 'sm:translate-y-8', 'sm:scale-95');
        setTimeout(() => { modal.classList.add('opacity-0', 'pointer-events-none'); }, 300);
    }

    // FUNGSI SAAT PAKET DIPILIH DARI MODAL
    function selectPackage(id, name, price, badge, sesi) {
        // 1. Isi input hidden dengan ID paket
        document.getElementById('selected_paket_id').value = id;
        
        // 2. Ubah tampilan teks box menjadi info paket
        document.getElementById('selected_paket_display').innerHTML = `
            <span class="inline-block px-2 py-0.5 rounded bg-orange-100 text-orange-700 font-black text-[8px] uppercase tracking-wider mb-1.5 shadow-sm">${badge}</span>
            <h4 class="text-sm font-black text-slate-900 uppercase truncate tracking-tight leading-none mb-1.5">${name}</h4>
            <p class="text-[10px] font-black text-blue-600">Rp ${price} <span class="text-slate-400 font-bold ml-1">• ${sesi} Sesi</span></p>
        `;
        
        // 3. Ubah gaya kotak trigger agar terlihat sukses terpilih
        const triggerBtn = document.querySelector('button[onclick="openPackageModal()"]');
        triggerBtn.classList.remove('border-slate-200/80', 'border-rose-400', 'bg-rose-50/30');
        triggerBtn.classList.add('border-blue-400', 'bg-blue-50/20');
        
        closePackageModal();
    }

    // FUNGSI VALIDASI SEBELUM FORM DIKIRIM (SUBMIT)
    function checkPackageSelected() {
        const selectedId = document.getElementById('selected_paket_id').value;
        const submitBtn = document.querySelector('button[type="submit"]');
        
        // Jika ID paket masih kosong
        if (!selectedId) {
            const triggerBtn = document.querySelector('button[onclick="openPackageModal()"]');
            const displayBox = document.getElementById('selected_paket_display');
            
            // Beri efek visual "Error" (Warna Merah) pada tombol trigger
            triggerBtn.classList.remove('border-slate-200/80', 'bg-white');
            triggerBtn.classList.add('border-rose-400', 'bg-rose-50/30');
            
            displayBox.innerHTML = `
                <span class="text-[10px] font-black text-rose-500 uppercase tracking-widest mb-0.5 animate-pulse">⚠️ Wajib Diisi</span>
                <span class="text-xs sm:text-sm font-bold text-rose-700">Silakan pilih paket dahulu!</span>
            `;
            
            // Otomatis buka modal paket untuk memaksa murid memilih
            openPackageModal();
            
            return false; // Mencegah form terkirim
        }
        
        // MENGUBAH TOMBOL MENJADI LOADING
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg class="animate-spin h-4 w-4 text-white" viewBox="0 0 24 24" fill="none">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
            </svg>
            Mengirim...
        `;
        return true;
    }
</script>
@endauth
@endsection