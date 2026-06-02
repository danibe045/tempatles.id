@extends('layouts.main')

@section('title', 'Ruang Belajar - tempatles.id')

@section('content')
<main class="flex-grow w-full pt-8 pb-24 font-['Plus_Jakarta_Sans'] bg-[#F8FAFC] relative overflow-x-hidden min-h-screen">
    
    {{-- Background Pattern & Glow --}}
    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="absolute inset-0 bg-[radial-gradient(#cbd5e1_1px,transparent_1px)] [background-size:24px_24px] opacity-40"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-500/10 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-orange-500/10 blur-[120px] rounded-full"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 md:px-12 relative z-10 space-y-12">

        {{-- ======================================================= --}}
        {{-- 1. SECTION: HERO & ACTION REQUIRED (GRID SEIMBANG)      --}}
        {{-- ======================================================= --}}
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:h-[380px] items-stretch">
            
            {{-- Hero Banner (Kiri - 8 Kolom) --}}
            <div class="lg:col-span-8 h-full bg-gradient-to-br from-blue-950 to-blue-900 rounded-[2.5rem] p-8 md:p-12 relative overflow-hidden flex flex-col justify-center shadow-2xl shadow-blue-900/20 group">
                <div class="absolute right-0 top-0 w-80 h-80 bg-orange-500 rounded-full blur-[100px] opacity-20 translate-x-1/3 -translate-y-1/3 group-hover:opacity-30 transition-all duration-700 pointer-events-none"></div>
                <div class="absolute left-0 bottom-0 w-72 h-72 bg-blue-400 rounded-full blur-[80px] opacity-30 -translate-x-1/3 translate-y-1/3 pointer-events-none"></div>
                
                <div class="relative z-10 max-w-2xl">
                    <div class="inline-flex items-center gap-2 bg-blue-900/60 border border-blue-800 text-blue-200 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-[0.2em] mb-5 backdrop-blur-md shadow-sm">
                        👋 Selamat Datang
                    </div>
                    <h1 class="text-3xl md:text-5xl font-black text-white mb-4 leading-[1.1] tracking-tight">
                        Semangat Belajar, <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-yellow-400">{{ explode(' ', auth()->user()->name ?? 'Siswa')[0] }}!</span>
                    </h1>
                    <p class="text-blue-200/90 font-medium text-sm md:text-base max-w-md mb-6 leading-relaxed">
                        Ada target baru hari ini? Telusuri katalog kami untuk menemukan tutor yang tepat untukmu.
                    </p>
                    
                    {{-- TOMBOL HERO SECTION (Hanya Tombol Cari Tutor) --}}
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ route('katalog.publik') }}" class="inline-flex items-center gap-3 bg-orange-500 hover:bg-orange-400 text-white px-8 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all duration-300 shadow-xl shadow-orange-500/30 active:scale-95 border border-orange-400 w-fit hover:-translate-y-1">
                            Cari Tutor Baru
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Action Required Card (Kanan - 4 Kolom) --}}
            @if(isset($pesanan_aktif) && count($pesanan_aktif) > 0)
            <div class="lg:col-span-4 h-full bg-white rounded-[2.5rem] border border-slate-200 p-8 flex flex-col shadow-sm">
                <div class="flex items-center justify-between mb-6 shrink-0 border-b border-slate-100 pb-4">
                    <div class="flex items-center gap-3">
                        <div class="relative flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-rose-500"></span>
                        </div>
                        <h2 class="text-sm font-black text-slate-800 uppercase tracking-widest">Perlu Tindakan</h2>
                    </div>
                    <span class="bg-rose-50 text-rose-600 text-[10px] font-black px-3 py-1.5 rounded-lg border border-rose-100">{{ count($pesanan_aktif) }}</span>
                </div>
                
                <div class="flex-grow space-y-4 overflow-y-auto custom-scrollbar pr-2">
                    @foreach($pesanan_aktif as $pesanan)
                    @php
                        $isBayar = $pesanan->status_pesanan == 'menunggu_pembayaran';
                        $sudahUpload = !empty($pesanan->bukti_bayar);
                    @endphp

                    <div class="p-5 rounded-2xl transition-all border {{ $isBayar && !$sudahUpload ? 'bg-orange-50 border-orange-200 shadow-md shadow-orange-500/5' : 'bg-slate-50 border-slate-200 hover:border-slate-300' }}">
                        <h3 class="font-black text-slate-900 text-sm mb-2 line-clamp-1">Paket {{ $pesanan->mata_pelajaran }}</h3>

                        @if($isBayar && !$sudahUpload)
                            <p class="text-xs font-medium text-slate-600 mb-4 leading-relaxed bg-white p-3 rounded-xl border border-orange-100">
                                Tutor menyetujui. Lunasi tagihan <b class="text-orange-600 block text-sm mt-1">Rp {{ number_format($pesanan->grand_total, 0, ',', '.') }}</b>
                            </p>
                            <button onclick="openPaymentModal('{{ $pesanan->id }}', '{{ number_format($pesanan->grand_total, 0, ',', '.') }}')" class="w-full text-center bg-slate-900 text-white py-3.5 rounded-xl text-[10px] font-black uppercase tracking-[0.15em] shadow-lg shadow-slate-900/20 hover:bg-orange-500 transition-all active:scale-95 flex items-center justify-center gap-2">
                                Bayar Sekarang
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                            </button>
                        @elseif($isBayar && $sudahUpload)
                            <div class="flex items-center gap-3 bg-blue-50 text-blue-700 p-3.5 rounded-xl border border-blue-100">
                                <svg class="w-5 h-5 animate-spin shrink-0 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                                <div>
                                    <p class="text-[9px] font-black uppercase tracking-widest text-blue-500 mb-0.5">Sedang Dicek</p>
                                    <p class="text-[11px] font-bold leading-tight">Menunggu Verifikasi Admin</p>
                                </div>
                            </div>
                        @else
                            <div class="flex items-center gap-3 p-3.5 bg-white rounded-xl border border-slate-200 mt-2">
                                <span class="w-2 h-2 rounded-full bg-slate-400 animate-pulse shrink-0"></span>
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Menunggu Respons Tutor...</p>
                            </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            {{-- Empty State Jika Tidak Ada Tindakan --}}
            <div class="lg:col-span-4 h-full bg-white/50 backdrop-blur-sm rounded-[2.5rem] border-2 border-dashed border-slate-200 p-8 flex flex-col items-center justify-center text-center">
                <span class="text-5xl grayscale opacity-30 mb-4">☕</span>
                <h3 class="font-black text-slate-700 text-lg mb-1">Semua Beres!</h3>
                <p class="text-xs font-medium text-slate-500">Tidak ada antrean tugas atau pembayaran saat ini.</p>
            </div>
            @endif
        </section>

        {{-- ======================================================= --}}
        {{-- 2. SECTION: JADWAL KELAS MENDATANG (MINIMALIST ELEGANT) --}}
        {{-- ======================================================= --}}
        <section>
            <div class="flex justify-between items-end mb-6 px-2">
                <div>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight mb-1 flex items-center gap-3">
                        <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-blue-100 text-blue-600 shadow-inner border border-blue-200/50">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </span>
                        Jadwal Belajar
                    </h2>
                    <p class="text-sm font-medium text-slate-500 ml-[3.25rem]">Persiapkan dirimu untuk sesi kelas berikutnya.</p>
                </div>
            </div>
            
            @if(empty($jadwal_les) || count($jadwal_les) == 0)
            <div class="bg-white/80 backdrop-blur-md border border-slate-200 rounded-[2rem] p-12 text-center shadow-sm">
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100 shadow-inner">
                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
                <h3 class="text-lg font-black text-slate-800 mb-1">Jadwal Masih Kosong</h3>
                <p class="text-slate-500 font-medium text-xs max-w-sm mx-auto leading-relaxed">Tunggu konfirmasi dari tutor, jadwal kelasmu akan otomatis tersusun rapi di sini.</p>
            </div>
            @else
            <div class="flex overflow-x-auto gap-5 pb-8 pt-2 custom-scrollbar snap-x">
                @foreach($jadwal_les as $jadwal)
                <div class="snap-start shrink-0 w-[300px] bg-white rounded-3xl border border-slate-200/80 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(59,130,246,0.12)] hover:border-blue-300 hover:-translate-y-1 transition-all duration-500 p-6 flex flex-col group relative overflow-hidden">
                    
                    {{-- Efek Glow Halus di Pojok (Muncul saat Hover) --}}
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-500 rounded-full blur-[60px] opacity-0 group-hover:opacity-20 transition-opacity duration-700 pointer-events-none z-0"></div>

                    <div class="flex justify-between items-start mb-5 relative z-10">
                        <div class="flex items-center gap-4">
                            {{-- Ikon Kalender Estetik --}}
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex flex-col items-center justify-center border border-blue-100 shadow-inner group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                                <span class="text-[9px] font-black uppercase tracking-widest mb-0.5">{{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('M') }}</span>
                                <span class="text-lg font-black leading-none">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d') }}</span>
                            </div>
                            
                            {{-- Info Jam --}}
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Jam Mulai</p>
                                <p class="text-sm font-bold text-slate-800 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} WIB
                                </p>
                            </div>
                        </div>

                        {{-- Badge Metode (Online/Offline) --}}
                        <span class="px-2.5 py-1 bg-slate-100 text-slate-500 rounded-lg text-[9px] font-black uppercase tracking-widest border border-slate-200/80">{{ $jadwal->metode }}</span>
                    </div>

                    {{-- Nama Mata Pelajaran --}}
                    <div class="flex-grow relative z-10">
                        <h3 class="font-black text-slate-900 text-lg line-clamp-2 leading-snug group-hover:text-blue-700 transition-colors duration-300">{{ $jadwal->mapel }}</h3>
                    </div>

                    {{-- Footer: Info Tutor --}}
                    <div class="mt-6 pt-5 border-t border-slate-100 flex items-center gap-3 relative z-10">
                        <div class="w-9 h-9 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center text-xs font-black border border-orange-100 shrink-0 shadow-inner group-hover:bg-orange-500 group-hover:text-white transition-colors duration-300">
                            {{ strtoupper(substr($jadwal->tutor->name ?? 'T', 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Pengajar</p>
                            <p class="text-sm font-bold text-slate-800 truncate">{{ $jadwal->tutor->name ?? 'Tutor' }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </section>

        {{-- ======================================================= --}}
        {{-- 3. SECTION: KELAS AKTIF & RIWAYAT (GRID 7:5)            --}}
        {{-- ======================================================= --}}
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            {{-- KOLOM KIRI: Kelas Berjalan --}}
            <div class="lg:col-span-7 bg-white rounded-[2.5rem] border border-slate-200 p-6 md:p-8 shadow-sm flex flex-col h-full">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100 shrink-0">
                    <h2 class="text-lg md:text-xl font-black text-slate-900 flex items-center gap-3">
                        <span class="flex items-center justify-center w-9 h-9 rounded-xl bg-orange-100 text-orange-600 shadow-inner border border-orange-200/50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </span>
                        Kelas Aktif
                    </h2>
                    <span class="bg-slate-100 text-slate-500 text-[10px] font-black uppercase tracking-widest px-3 py-1.5 rounded-lg border border-slate-200">{{ count($activeOrdersMurid ?? []) }} Kelas</span>
                </div>
                
                {{-- AREA SCROLL (Terkunci maksimal 550px) --}}
                <div class="space-y-4 overflow-y-auto custom-scrollbar pr-2 flex-grow max-h-[550px]">
                    @forelse($activeOrdersMurid ?? [] as $order)
                    @php
                        $tutor = $order->tutor;
                        $completedSessions = $order->sessions->whereNotNull('teachingJournal')->count();
                        $isAllDone = $completedSessions >= $order->jumlah_sesi;
                        $progress = ($order->jumlah_sesi > 0) ? ($completedSessions / $order->jumlah_sesi) * 100 : 0;
                    @endphp
                    
                    {{-- KARTU KELAS (DESAIN COMPACT / RAMPING) --}}
                    <div class="p-5 bg-white border rounded-[1.5rem] {{ $isAllDone ? 'border-emerald-200 bg-emerald-50/20' : 'border-slate-200 hover:border-blue-300' }} shadow-sm hover:shadow-md transition-all duration-300">
                        
                        {{-- Bagian Atas: Info & Progress --}}
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-4 min-w-0">
                                <div class="w-12 h-12 rounded-xl overflow-hidden bg-slate-100 shrink-0 border border-slate-200">
                                    @if($tutor->tutorProfile->foto ?? false)
                                    <img src="{{ asset('storage/'.$tutor->tutorProfile->foto) }}" alt="{{ $tutor->name }}" class="w-full h-full object-cover">
                                    @else
                                    <div class="w-full h-full flex items-center justify-center font-black text-lg text-slate-400">{{ strtoupper(substr($tutor->name ?? 'T', 0, 1)) }}</div>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-0.5 truncate">Tutor: {{ $tutor->name ?? 'Tutor' }}</p>
                                    <h4 class="font-black text-slate-900 text-sm line-clamp-1">{{ $order->mata_pelajaran }}</h4>
                                </div>
                            </div>
                            <div class="shrink-0 ml-3">
                                <span class="inline-block px-2.5 py-1 bg-blue-50 text-blue-700 text-[10px] font-black rounded-lg border border-blue-100 whitespace-nowrap">
                                    {{ $completedSessions }} / {{ $order->jumlah_sesi }} Sesi
                                </span>
                            </div>
                        </div>

                        {{-- Progress Bar Tipis --}}
                        <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden mb-5">
                            <div class="h-full rounded-full transition-all duration-1000 ease-out {{ $isAllDone ? 'bg-emerald-500' : 'bg-blue-500' }}" style="width: {{ $progress }}%"></div>
                        </div>

                        {{-- Bagian Bawah: Action Buttons Sebaris --}}
                        <div class="flex flex-wrap sm:flex-nowrap items-center gap-2">
                            @php $pesanWA = "Halo Kak " . ($tutor->name ?? '') . ", saya murid dari tempatles.id. Saya mau diskusi jadwal les ya!"; @endphp
                            
                            <a href="https://wa.me/{{ $tutor->phone_number ?? '' }}?text={{ urlencode($pesanWA) }}" target="_blank" class="flex-1 flex items-center justify-center gap-1.5 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl text-[10px] font-bold hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200 transition-all">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.353-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.13.57-.072 1.758-.711 2.003-1.403.243-.693.243-1.288.17-1.403-.074-.075-.271-.15-.568-.3z"/></svg>
                                Chat
                            </a>
                            
                            <button onclick="document.getElementById('modal-jurnal-{{ $order->id }}').showModal()" class="flex-1 flex items-center justify-center gap-1.5 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl text-[10px] font-bold hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition-all">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                Jurnal
                            </button>

                            @if($isAllDone)
                            <button onclick="openReviewModal('{{ $order->id }}', '{{ $tutor->name ?? '' }}')" class="flex-[1.5] w-full sm:w-auto py-2.5 bg-slate-900 text-white rounded-xl text-[10px] font-black uppercase tracking-[0.1em] hover:bg-orange-500 transition-all shadow-md">
                                Selesaikan ⭐
                            </button>
                            @else
                            <button onclick="document.getElementById('modal-komplain-{{ $order->id }}').showModal()" class="flex-1 w-full sm:w-auto py-2.5 bg-white border border-slate-200 text-rose-500 rounded-xl text-[10px] font-bold hover:bg-rose-50 transition-all">
                                Komplain
                            </button>
                            @endif
                        </div>
                    </div>

                    {{-- ========================================== --}}
                    {{-- MODAL PANTAU JURNAL KELAS AKTIF            --}}
                    {{-- ========================================== --}}
                    <dialog id="modal-jurnal-{{ $order->id }}" class="rounded-[2.5rem] p-0 border border-slate-200 shadow-2xl backdrop:bg-slate-900/70 backdrop:backdrop-blur-sm m-auto w-full max-w-xl overflow-hidden transition-all duration-300">
                        <div class="bg-white relative flex flex-col max-h-[85vh]">
                            
                            {{-- Header Modal --}}
                            <div class="p-8 pb-6 border-b border-slate-100 bg-white sticky top-0 z-20 flex justify-between items-start">
                                <div>
                                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest mb-3">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                        Jurnal Sesi Belajar
                                    </div>
                                    <h3 class="text-2xl font-black text-slate-900 tracking-tight leading-none mb-1">{{ $order->mata_pelajaran ?? 'Mata Pelajaran' }}</h3>
                                    <p class="text-xs font-medium text-slate-500">Bersama Kak {{ $tutor->name ?? 'Tutor' }}</p>
                                </div>
                                <button type="button" onclick="this.closest('dialog').close()" class="w-10 h-10 shrink-0 flex items-center justify-center bg-slate-50 border border-slate-200 hover:bg-rose-50 text-slate-400 hover:text-rose-500 hover:border-rose-200 rounded-full transition-all shadow-sm active:scale-95">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </div>

                            {{-- Area Scroll Content --}}
                            <div class="p-8 overflow-y-auto custom-scrollbar bg-slate-50/50 relative">
                                
                                {{-- Garis Timeline Vertikal di Kiri --}}
                                <div class="absolute left-[3.25rem] top-8 bottom-8 w-0.5 bg-slate-200 rounded-full z-0"></div>

                                <div class="space-y-8 relative z-10">
                                    @foreach($order->sessions as $session)
                                    <div class="relative flex gap-5">
                                        
                                        {{-- Ikon Timeline --}}
                                        <div class="relative z-10 shrink-0 mt-1">
                                            @if($session->teachingJournal)
                                                <div class="w-10 h-10 bg-emerald-500 rounded-full border-4 border-white shadow-md flex items-center justify-center text-white">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                                </div>
                                            @else
                                                <div class="w-10 h-10 bg-white rounded-full border-4 border-white shadow-md flex items-center justify-center relative">
                                                    <div class="w-full h-full rounded-full border-2 border-dashed border-slate-300 animate-spin-slow"></div>
                                                    <div class="w-3 h-3 bg-slate-300 rounded-full absolute"></div>
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Kartu Konten --}}
                                        <div class="flex-grow bg-white border border-slate-200 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden group">
                                            
                                            {{-- Header Sesi --}}
                                            <div class="px-5 py-3 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center group-hover:bg-blue-50/30 transition-colors">
                                                <div class="flex items-center gap-2">
                                                    <span class="text-[10px] font-black text-slate-800 uppercase tracking-widest">Sesi {{ $session->pertemuan_ke }}</span>
                                                    @if($session->teachingJournal)
                                                        <span class="px-2 py-0.5 rounded text-[8px] font-black uppercase tracking-wider bg-emerald-100 text-emerald-700">Selesai</span>
                                                    @else
                                                        <span class="px-2 py-0.5 rounded text-[8px] font-black uppercase tracking-wider bg-slate-200 text-slate-600">Menunggu</span>
                                                    @endif
                                                </div>
                                                <p class="text-[10px] font-bold text-slate-500">{{ \Carbon\Carbon::parse($session->tanggal_jadwal)->translatedFormat('d M Y') }}</p>
                                            </div>

                                            {{-- Body Sesi --}}
                                            <div class="p-5">
                                                @if($session->teachingJournal)
                                                    <div class="mb-4">
                                                        <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-2">Catatan Pengajar</p>
                                                        <div class="relative">
                                                            <svg class="absolute -top-2 -left-2 w-6 h-6 text-slate-100" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                                                            <p class="text-xs text-slate-700 leading-relaxed font-medium italic pl-6">"{{ $session->teachingJournal->catatan_materi }}"</p>
                                                        </div>
                                                    </div>

                                                    <div class="flex gap-2 pt-4 border-t border-slate-100">
                                                        <a href="{{ asset('storage/' . $session->teachingJournal->foto_bukti_path) }}" target="_blank" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 text-[10px] font-black text-blue-600 bg-blue-50 border border-blue-100 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm uppercase tracking-widest active:scale-95">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                            Bukti Foto
                                                        </a>
                                                        @if($session->teachingJournal->file_materi)
                                                        <a href="{{ asset('storage/' . $session->teachingJournal->file_materi) }}" target="_blank" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 text-[10px] font-black text-orange-600 bg-orange-50 border border-orange-100 rounded-xl hover:bg-orange-500 hover:text-white transition-all shadow-sm uppercase tracking-widest active:scale-95">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                                            Modul
                                                        </a>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="flex flex-col items-center justify-center py-4 text-center opacity-60">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400 animate-pulse mb-2"></span>
                                                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Tutor Belum Mengisi Jurnal</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </dialog>

                    {{-- ========================================== --}}
                    {{-- MODAL AJUKAN KOMPLAIN                      --}}
                    {{-- ========================================== --}}
                    <dialog id="modal-komplain-{{ $order->id }}" class="rounded-[2.5rem] p-0 border border-slate-200 shadow-2xl backdrop:bg-slate-900/70 backdrop:backdrop-blur-sm m-auto w-full max-w-md overflow-hidden transition-all duration-300">
                        <div class="bg-white relative p-6 md:p-8 max-h-[85vh] overflow-y-auto custom-scrollbar">
                            
                            {{-- Tombol Close --}}
                            <button type="button" onclick="this.closest('dialog').close()" class="absolute top-6 right-6 w-10 h-10 flex items-center justify-center bg-white border border-slate-200 hover:bg-rose-50 text-slate-400 hover:text-rose-500 rounded-full transition-colors shadow-sm active:scale-95 z-10">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                            
                            {{-- Header Modal --}}
                            <div class="mb-6 flex flex-col items-center text-center mt-2">
                                <div class="w-16 h-16 bg-rose-50 text-rose-500 rounded-full flex items-center justify-center mx-auto mb-4 border border-rose-100 shadow-inner">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                </div>
                                <h3 class="text-2xl font-black text-slate-900 tracking-tight mb-1.5">Ajukan Komplain</h3>
                                <p class="text-xs font-medium text-slate-500">Laporkan kendala belajar Anda di sini.</p>
                            </div>

                            {{-- Alert Info Dana Aman --}}
                            <div class="bg-gradient-to-r from-orange-50 to-rose-50 border border-rose-100 p-4 rounded-2xl flex gap-3 items-start mb-6 shadow-sm">
                                <svg class="w-5 h-5 text-rose-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                                <div>
                                    <p class="text-[10px] font-black text-rose-700 uppercase tracking-widest mb-1">Dana Anda Aman</p>
                                    <p class="text-[11px] text-rose-600/80 font-medium leading-relaxed">Dana pesanan ini akan otomatis ditahan oleh Admin dan <b>tidak akan</b> diteruskan ke Tutor sampai kendala ini selesai.</p>
                                </div>
                            </div>

                            {{-- Form Input --}}
                            <form id="form-komplain-{{ $order->id }}" action="{{ route('murid.orders.komplain', $order->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                                @csrf
                                
                                {{-- Select Input Custom --}}
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Jenis Kendala <span class="text-rose-500">*</span></label>
                                    <div class="relative">
                                        <select name="jenis_komplain" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-bold text-slate-800 focus:bg-white focus:ring-4 focus:ring-rose-500/20 focus:border-rose-400 outline-none appearance-none cursor-pointer transition-all shadow-inner">
                                            <option value="" disabled selected>Pilih kendala yang dialami...</option>
                                            <option value="Tutor tidak hadir tanpa kabar">Tutor tidak hadir tanpa kabar</option>
                                            <option value="Tutor sering terlambat">Tutor sering terlambat</option>
                                            <option value="Materi menyimpang / tidak sesuai">Materi tidak sesuai kesepakatan</option>
                                            <option value="Sikap tidak profesional">Sikap tidak profesional</option>
                                            <option value="Lainnya">Kendala Lainnya</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg>
                                        </div>
                                    </div>
                                </div>

                                {{-- Textarea Custom --}}
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Jelaskan Detail Masalah <span class="text-rose-500">*</span></label>
                                    <textarea name="deskripsi" rows="3" required placeholder="Ceritakan kronologi masalah secara jelas..." class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-medium text-slate-800 focus:bg-white focus:ring-4 focus:ring-rose-500/20 focus:border-rose-400 outline-none resize-none transition-all shadow-inner placeholder:text-slate-400"></textarea>
                                </div>

                                {{-- File Input Custom --}}
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Bukti Pendukung (Opsional)</label>
                                    <div class="relative">
                                        <input type="file" name="bukti_komplain" accept="image/*" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-rose-100 file:text-rose-600 hover:file:bg-rose-200 cursor-pointer bg-slate-50 border border-slate-200 rounded-2xl p-2 transition-all outline-none focus:border-rose-400 shadow-inner">
                                    </div>
                                    <p class="text-[9px] font-medium text-slate-400 mt-2 ml-1">Screenshot chat WA atau bukti foto lainnya (JPG/PNG).</p>
                                </div>

                                {{-- Submit Button --}}
                                <button type="button" onclick="confirmComplain('{{ $order->id }}')" class="w-full bg-slate-900 hover:bg-rose-600 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-slate-900/20 hover:shadow-rose-600/30 transition-all mt-2 active:scale-95 border border-slate-800 hover:border-rose-500 flex justify-center items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                                    Kirim Laporan
                                </button>
                            </form>
                        </div>
                    </dialog>
                    @empty
                    <div class="h-full min-h-[300px] flex flex-col items-center justify-center text-center py-10 bg-slate-50 rounded-[2rem] border-2 border-dashed border-slate-200">
                        <span class="text-5xl grayscale opacity-30 mb-4 block">📚</span>
                        <p class="text-slate-500 font-black text-sm">Belum ada kelas yang berjalan.</p>
                        <p class="text-[10px] font-medium text-slate-400 mt-1 uppercase tracking-widest">Ayo cari tutor dan mulai belajar!</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- KOLOM KANAN: Riwayat Belajar & Transaksi --}}
            <div class="lg:col-span-5 bg-white rounded-[2.5rem] border border-slate-200 p-6 md:p-8 shadow-sm flex flex-col h-[650px] lg:h-auto">
                
                {{-- HEADER RIWAYAT DENGAN TOMBOL LIHAT SEMUA --}}
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100 shrink-0">
                    <h2 class="text-lg md:text-xl font-black text-slate-900 flex items-center gap-3">
                        <span class="flex items-center justify-center w-9 h-9 rounded-xl bg-emerald-100 text-emerald-600 shadow-inner border border-emerald-200/50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                        </span>
                        Riwayat Belajar
                    </h2>
                    <a href="{{ route('murid.riwayat') }}" class="group flex items-center gap-1 text-[10px] font-black text-blue-600 hover:text-blue-800 uppercase tracking-widest transition-colors">
                        Lihat Semua
                        <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" /></svg>
                    </a>
                </div>
                
                {{-- AREA SCROLL Riwayat (Dibatasi 550px maksimal) --}}
                <div class="space-y-4 overflow-y-auto pr-2 custom-scrollbar flex-grow max-h-[550px]">
                    @forelse($riwayat_transaksi ?? [] as $transaksi)
                    @php
                        $isSelesai = $transaksi->status_pesanan == 'selesai';
                        $isBatal = $transaksi->status_pesanan == 'dibatalkan';
                        
                        if($isSelesai) {
                            $badgeTheme = 'bg-emerald-100 text-emerald-700 border-emerald-200';
                        } elseif($isBatal) {
                            $badgeTheme = 'bg-slate-100 text-slate-600 border-slate-200';
                        } else {
                            $badgeTheme = 'bg-rose-100 text-rose-700 border-rose-200';
                        }
                    @endphp

                    <div class="bg-white border border-slate-200 shadow-sm rounded-[1.5rem] hover:border-blue-300 hover:shadow-md transition-all duration-300 overflow-hidden group flex flex-col">
                        <div class="p-5 flex-grow">
                            
                            {{-- Header Kartu: Status & Tanggal --}}
                            <div class="flex justify-between items-start mb-3">
                                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg {{ $badgeTheme }} border text-[9px] font-black uppercase tracking-widest">
                                    {{ str_replace('_', ' ', $transaksi->status_pesanan) }}
                                </div>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">{{ \Carbon\Carbon::parse($transaksi->created_at)->translatedFormat('d M Y') }}</p>
                            </div>

                            {{-- Info Pelajaran & Tutor --}}
                            <h3 class="font-black text-slate-900 text-base mb-2 group-hover:text-blue-600 transition-colors line-clamp-1">{{ $transaksi->mata_pelajaran }}</h3>
                            
                            <div class="flex items-center gap-2 text-[11px] font-bold text-slate-500 mb-2">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    Kak {{ $transaksi->tutor->name ?? 'Tutor' }}
                                </span>
                                <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                <span>{{ $transaksi->jumlah_sesi ?? 0 }} Sesi</span>
                            </div>
                        </div>

                        {{-- Footer Kartu: Harga & Tombol --}}
                        <div class="px-5 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-between mt-auto group-hover:bg-blue-50/50 transition-colors">
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Total Biaya</p>
                                <p class="font-black text-slate-800 text-sm">Rp {{ number_format($transaksi->grand_total, 0, ',', '.') }}</p>
                            </div>
                            
                            @if($isSelesai)
                            <button onclick="document.getElementById('modal-jurnal-riwayat-{{ $transaksi->id }}').showModal()" class="text-[10px] font-black text-blue-600 bg-white border border-blue-200 hover:bg-blue-600 hover:text-white px-4 py-2 rounded-xl uppercase tracking-widest shadow-sm transition-all flex items-center gap-1.5 active:scale-95">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477-4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                Arsip Materi
                            </button>

                            {{-- MODAL ARSIP JURNAL --}}
                            <dialog id="modal-jurnal-riwayat-{{ $transaksi->id }}" class="rounded-[2.5rem] p-0 border border-slate-200 shadow-2xl backdrop:bg-slate-900/70 backdrop:backdrop-blur-sm m-auto w-full max-w-lg overflow-hidden transition-all duration-300">
                                <div class="bg-white relative flex flex-col max-h-[85vh]">
                                    <div class="p-8 pb-6 border-b border-slate-100 bg-slate-50 sticky top-0 z-20 flex justify-between items-center">
                                        <div>
                                            <h3 class="text-xl font-black text-slate-900 tracking-tight">Arsip Jurnal Belajar</h3>
                                            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-1">Paket {{ $transaksi->mata_pelajaran }}</p>
                                        </div>
                                        <button type="button" onclick="this.closest('dialog').close()" class="w-10 h-10 flex items-center justify-center bg-white border border-slate-200 hover:bg-rose-50 text-slate-400 hover:text-rose-500 rounded-full transition-colors shadow-sm active:scale-95">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                                        </button>
                                    </div>
                                    <div class="p-8 overflow-y-auto custom-scrollbar bg-white">
                                        <div class="space-y-4">
                                            @foreach($transaksi->sessions ?? [] as $session)
                                            <div class="p-5 bg-slate-50 rounded-2xl border border-slate-200">
                                                <div class="flex justify-between items-center mb-3">
                                                    <p class="font-black text-xs text-slate-800 uppercase">Sesi {{ $session->pertemuan_ke }}</p>
                                                    <p class="text-[10px] font-bold text-slate-500">{{ \Carbon\Carbon::parse($session->tanggal_jadwal)->format('d M Y') }}</p>
                                                </div>
                                                @if($session->teachingJournal)
                                                <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm mb-4">
                                                    <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1.5">Catatan Tutor</p>
                                                    <p class="text-xs text-slate-700 leading-relaxed font-medium italic">"{{ $session->teachingJournal->catatan_materi }}"</p>
                                                </div>
                                                <div class="flex gap-2">
                                                    @if($session->teachingJournal->foto_bukti_path)
                                                    <a href="{{ asset('storage/' . $session->teachingJournal->foto_bukti_path) }}" target="_blank" class="flex-1 flex items-center justify-center gap-1.5 py-2 text-[10px] font-black text-blue-600 bg-blue-50 rounded-xl hover:bg-blue-600 hover:text-white border border-blue-100 transition-colors uppercase tracking-widest">
                                                        📸 Bukti Foto
                                                    </a>
                                                    @endif
                                                    @if($session->teachingJournal->file_materi)
                                                    <a href="{{ asset('storage/' . $session->teachingJournal->file_materi) }}" target="_blank" class="flex-1 flex items-center justify-center gap-1.5 py-2 text-[10px] font-black text-orange-600 bg-orange-50 rounded-xl hover:bg-orange-500 hover:text-white border border-orange-100 transition-colors uppercase tracking-widest">
                                                        📄 Modul
                                                    </a>
                                                    @endif
                                                </div>
                                                @else
                                                <p class="text-[10px] font-bold text-slate-400 italic">Tidak ada catatan untuk sesi ini.</p>
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </dialog>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="h-full min-h-[300px] flex flex-col items-center justify-center text-center py-10 opacity-70">
                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3 border border-slate-200 shadow-inner">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        </div>
                        <h3 class="text-sm font-black text-slate-700 mb-1">Belum Ada Riwayat</h3>
                        <p class="text-[10px] text-slate-500 font-medium">Transaksi kelas yang telah selesai akan tampil di sini.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- ========================================================== --}}
        {{-- MODALS GLOBAL (PEMBAYARAN & REVIEW SAJA)                   --}}
        {{-- ========================================================== --}}

        {{-- 1. MODAL PEMBAYARAN --}}
        <dialog id="modal-bayar" class="rounded-[2.5rem] p-0 border border-slate-200 shadow-2xl backdrop:bg-slate-900/70 backdrop:backdrop-blur-sm m-auto w-full max-w-md overflow-hidden transition-all duration-300">
            <div class="bg-white relative p-6 md:p-8 max-h-[85vh] overflow-y-auto custom-scrollbar">
                
                {{-- Tombol Close --}}
                <button type="button" onclick="this.closest('dialog').close()" class="absolute top-6 right-6 w-10 h-10 flex items-center justify-center bg-white border border-slate-200 hover:bg-rose-50 text-slate-400 hover:text-rose-500 rounded-full transition-colors active:scale-95 shadow-sm z-20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
                
                {{-- Header Modal --}}
                <div class="mb-6">
                    <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4 border border-blue-100 shadow-inner">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 tracking-tight mb-1">Selesaikan Pembayaran</h3>
                    <p class="text-xs font-medium text-slate-500 leading-relaxed pr-6">Transfer sesuai nominal ke rekening sistem Escrow kami untuk keamanan pesanan Anda.</p>
                </div>

                {{-- Kartu Rekening (Fintech Style) --}}
                <div class="bg-gradient-to-br from-slate-900 to-blue-950 p-6 rounded-[1.5rem] mb-6 shadow-xl shadow-blue-900/20 relative overflow-hidden text-white border border-slate-800">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-white/5 rounded-full blur-2xl"></div>
                    <div class="absolute -left-4 -bottom-4 w-24 h-24 bg-blue-500/20 rounded-full blur-xl"></div>
                    
                    <div class="relative z-10">
                        <p class="text-[10px] font-black text-blue-300 uppercase tracking-widest mb-1">Total Tagihan</p>
                        <p id="modal-tagihan" class="text-3xl font-black tracking-tight mb-5">Rp 0</p>
                        
                        {{-- Box Nomor VA --}}
                        <div class="p-4 bg-white/10 backdrop-blur-md rounded-xl border border-white/20">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <div class="px-2 py-1 bg-white text-blue-900 text-[9px] font-black rounded uppercase tracking-wider shadow-sm">BCA</div>
                                    <p class="text-[10px] font-bold text-blue-100 uppercase tracking-widest">Tempat Les Indonesia</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between mt-1">
                                <p id="nomor-va" class="text-xl sm:text-2xl font-black tracking-[0.15em] font-mono">[NO VA]</p>
                                <button type="button" onclick="copyVA()" class="flex items-center gap-1.5 px-3 py-2 bg-blue-500 hover:bg-blue-400 text-white rounded-lg transition-colors active:scale-95 shadow-md">
                                    <svg id="icon-copy" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2-2v-8a2 2 0 002 2z" /></svg>
                                    <span id="text-copy" class="text-[10px] font-black uppercase tracking-widest">Salin</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Form Input Bukti --}}
                <form id="form-pembayaran" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2.5">Upload Bukti Transfer <span class="text-rose-500">*</span></label>
                        <div class="relative group">
                            <input type="file" name="bukti_bayar" accept="image/*" required class="block w-full text-xs text-slate-500 file:mr-4 file:py-3 file:px-5 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 cursor-pointer bg-slate-50 border border-slate-200 rounded-2xl p-2 transition-all outline-none focus:border-blue-500 shadow-inner group-hover:border-blue-300">
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-[0.15em] shadow-xl shadow-blue-600/20 transition-all active:scale-95 border border-blue-600 flex justify-center items-center gap-2 mt-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Konfirmasi Pembayaran
                    </button>
                </form>
            </div>
        </dialog>

        {{-- 2. MODAL SELESAI & REVIEW --}}
        <dialog id="modal-review" class="rounded-[2.5rem] p-0 border border-slate-200 shadow-2xl backdrop:bg-slate-900/70 backdrop:backdrop-blur-sm m-auto w-full max-w-md overflow-hidden transition-all duration-300">
            <div class="bg-white relative p-6 md:p-8 max-h-[90vh] overflow-y-auto custom-scrollbar">
                
                {{-- Tombol Close --}}
                <button type="button" onclick="this.closest('dialog').close()" class="absolute top-6 right-6 w-10 h-10 flex items-center justify-center bg-white border border-slate-200 hover:bg-rose-50 text-slate-400 hover:text-rose-500 rounded-full transition-colors active:scale-95 shadow-sm z-10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
                
                <div class="text-center mb-8 mt-2">
                    <div class="w-20 h-20 bg-yellow-50 text-yellow-500 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl shadow-inner border border-yellow-100 animate-bounce-short">⭐</div>
                    <h3 class="text-2xl font-black text-slate-900 tracking-tight">Selesaikan Kelas</h3>
                    <p class="text-xs font-medium text-slate-500 mt-1">Berikan ulasan untuk pengalaman belajarmu.</p>
                </div>

                {{-- Info Singkat Tutor --}}
                <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-100 mb-8">
                    <div class="w-12 h-12 rounded-xl bg-blue-600 flex items-center justify-center text-white font-black text-lg shadow-md">
                        <span id="modal-tutor-initial">T</span>
                    </div>
                    <div class="text-left">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pengajar Anda</p>
                        <p id="modal-tutor-name" class="font-bold text-slate-800">Nama Tutor</p>
                    </div>
                </div>

                <form id="form-review" method="POST" class="space-y-6">
                    @csrf
                    
                    {{-- Bintang Interaktif --}}
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 text-center">Berapa bintang untuk Kak Tutor?</label>
                        <div class="flex flex-row-reverse justify-center gap-2">
                            {{-- Input Radio Hidden untuk Rating --}}
                            @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="hidden peer" required />
                                <label for="star{{ $i }}" class="cursor-pointer text-slate-200 peer-hover:text-yellow-400 peer-checked:text-yellow-400 transition-colors duration-200">
                                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                </label>
                            @endfor
                        </div>
                    </div>

                    {{-- Ceritakan Pengalaman --}}
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2.5">Tulis Pesan/Ulasan (Opsional)</label>
                        <textarea name="komentar" rows="4" class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-medium text-slate-900 focus:bg-white focus:ring-4 focus:ring-yellow-500/10 focus:border-yellow-500 transition-all outline-none resize-none shadow-inner placeholder:text-slate-400" placeholder="Contoh: Penjelasan kakak sangat mudah dimengerti, terima kasih!"></textarea>
                    </div>

                    {{-- Box Warning Krusial --}}
                    <div class="bg-orange-50 border border-orange-100 p-4 rounded-2xl flex gap-3 items-start shadow-sm">
                        <svg class="w-5 h-5 text-orange-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <p class="text-[10px] text-orange-800 font-medium leading-relaxed">PENTING: Setelah ulasan dikirim, status pesanan menjadi <b class="font-black">Selesai</b> dan dana akan diteruskan ke Tutor. Tindakan ini tidak bisa dibatalkan.</p>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="w-full bg-slate-900 hover:bg-orange-500 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-slate-900/20 transition-all active:scale-95 border border-slate-800 hover:border-orange-400">
                        Selesaikan & Kirim Ulasan
                    </button>
                </form>
            </div>
        </dialog>

    </div>
</main>

{{-- SweetAlert2 & CSS Utilities --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    /* 1. FONT & BASE RENDERING */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap');
    
    body { 
        font-family: 'Plus Jakarta Sans', sans-serif !important; 
        -webkit-font-smoothing: antialiased;
        text-rendering: optimizeLegibility;
    }

    /* 2. CUSTOM SCROLLBAR (Elegan & Tipis) */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    
    /* 3. MODAL ANIMATION (Smooth Entrance) */
    dialog::backdrop { 
        background: rgba(15, 23, 42, 0.7); 
        backdrop-filter: blur(8px); 
    }
    dialog[open] { 
        animation: modal-show 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards; 
    }
    @keyframes modal-show { 
        0% { opacity: 0; transform: scale(0.95) translateY(20px); } 
        100% { opacity: 1; transform: scale(1) translateY(0); } 
    }

    /* 4. STAR RATING ANIMATION (Interaktif) */
    .star-rating input:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #facc15 !important;
        transform: scale(1.1);
    }

    /* 5. INPUT & FORM FOCUS EFFECTS */
    /* Menghilangkan border biru bawaan browser yang kasar */
    input:focus, textarea:focus, select:focus {
        outline: none !important;
    }

    /* SweetAlert2 Overrides (Agar senada dengan tema UI) */
    div:where(.swal2-container) div:where(.swal2-popup) {
        border-radius: 2rem !important;
        padding: 2rem !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
    }

    /* 6. UTILITY UNTUK EFEK HOVER KARTU */
    .hover-lift {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .hover-lift:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* 7. LOADING SPINNER (Untuk tombol submit) */
    .animate-spin-slow {
        animation: spin 3s linear infinite;
    }
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>

<script>
    // JS Functions untuk membuka modal
    function openPaymentModal(id, harga) {
        document.getElementById('modal-tagihan').innerText = 'Rp ' + harga;
        document.getElementById('form-pembayaran').action = '/murid/orders/' + id + '/bayar';
        document.getElementById('modal-bayar').showModal();
    }

    function openReviewModal(id, tutorName) {
        document.getElementById('modal-tutor-name').innerText = tutorName;
        // Ambil huruf pertama nama tutor untuk avatar
        document.getElementById('modal-tutor-initial').innerText = tutorName.charAt(0).toUpperCase();
        document.getElementById('form-review').action = '/murid/orders/' + id + '/selesai';
        document.getElementById('modal-review').showModal();
    }

    // Fungsi Salin Nomor VA
    function copyVA() {
        const vaNumber = document.getElementById('nomor-va').innerText;
        
        navigator.clipboard.writeText(vaNumber.replace(/\s+/g, '')).then(() => {
            const iconCopy = document.getElementById('icon-copy');
            const textCopy = document.getElementById('text-copy');
            
            iconCopy.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />';
            textCopy.innerText = 'Disalin!';
            
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Nomor VA berhasil disalin!',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                customClass: {
                    popup: 'rounded-2xl shadow-lg border border-slate-100'
                }
            });

            setTimeout(() => {
                iconCopy.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2-2v-8a2 2 0 002 2z" />';
                textCopy.innerText = 'Salin';
            }, 2000);
        }).catch(err => {
            console.error('Gagal menyalin text: ', err);
            alert('Gagal menyalin, silakan block dan copy manual.');
        });
    }

    // SweetAlert2 Confirm untuk Komplain
    function confirmComplain(orderId) {
        const form = document.getElementById('form-komplain-' + orderId);
        const modal = document.getElementById('modal-komplain-' + orderId);

        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        modal.close();

        Swal.fire({
            title: 'Yakin Ajukan Komplain?',
            text: "Dana pesanan akan dibekukan sementara untuk ditinjau oleh Admin.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f43f5e',
            cancelButtonColor: '#cbd5e1',
            confirmButtonText: 'Ya, Laporkan!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                confirmButton: 'bg-rose-500 hover:bg-rose-600 text-white px-6 py-3 rounded-xl text-sm font-bold shadow-md transition-all',
                cancelButton: 'bg-slate-100 hover:bg-slate-200 text-slate-600 px-6 py-3 rounded-xl text-sm font-bold transition-all'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Memproses...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => { Swal.showLoading(); }
                });
                form.submit();
            } else {
                modal.showModal();
            }
        });
    }
</script>

{{-- PENGGANTI ALERT HTML (Murni pakai SweetAlert2) --}}
@if(session('success'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonText: 'Tutup',
            customClass: { confirmButton: 'bg-emerald-500 hover:bg-emerald-600 text-white px-8 py-3 rounded-xl text-sm font-bold shadow-md transition-all' },
            buttonsStyling: false
        });
    });
</script>
@endif

@if(session('error'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: 'error',
            title: 'Oops, Gagal!',
            text: "{{ session('error') }}",
            confirmButtonText: 'Coba Lagi',
            customClass: { confirmButton: 'bg-rose-500 hover:bg-rose-600 text-white px-8 py-3 rounded-xl text-sm font-bold shadow-md transition-all' },
            buttonsStyling: false
        });
    });
</script>
@endif

@endsection