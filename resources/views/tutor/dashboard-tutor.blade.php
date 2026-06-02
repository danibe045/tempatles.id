<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Tutor - tempatles.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .bg-pattern { background-image: radial-gradient(#cbd5e1 1.5px, transparent 1.5px); background-size: 28px 28px; }
        
        /* Animasi Modal Premium */
        dialog[open] { animation: modalScaleUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        @keyframes modalScaleUp {
            from { opacity: 0; transform: scale(0.95) translateY(20px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
        
        /* Timeline Line */
        .timeline-line { position: absolute; left: 1.75rem; top: 2rem; bottom: 2rem; width: 2px; background: #e2e8f0; z-index: 0; }
    </style>
</head>

<body class="bg-[#F8FAFC] text-slate-900 antialiased flex flex-col min-h-screen relative overflow-x-hidden">

    {{-- Latar Belakang Pattern Tipis --}}
    <div class="fixed inset-0 bg-pattern opacity-40 z-[-1] pointer-events-none"></div>

    {{-- NAVBAR PREMIUM --}}
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-200/60 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 md:px-12 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <a href="/" class="flex items-center gap-2 group">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-8 md:h-9 transition-transform group-hover:scale-110">
                    <span class="font-black text-blue-950 text-xl tracking-tighter hidden sm:block">tempatles<span class="text-orange-500">.id</span></span>
                </a>
            </div>

            <div class="flex items-center gap-5">
                <div class="hidden md:flex flex-col text-right border-r border-slate-200 pr-4">
                    <span class="text-xs font-black text-slate-900 leading-none mb-1">{{ $user->name ?? 'Tutor' }}</span>
                    <div class="flex items-center justify-end gap-1.5">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest">Online</p>
                    </div>
                </div>

                {{-- TOMBOL LOGOUT (SUDAH TERINTEGRASI SWEETALERT2) --}}
                <form id="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="button" onclick="confirmTutorLogout()" class="group flex items-center gap-2 bg-rose-50 hover:bg-rose-500 text-rose-500 hover:text-white px-5 py-2.5 rounded-full font-bold text-xs transition-all duration-300 border border-rose-200 shadow-sm">
                        <span class="hidden sm:inline">Keluar</span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7" /></svg>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- KONTEN UTAMA --}}
    <nav class="py-8 md:py-12 min-h-screen relative z-10 flex-grow">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            @if(($user->tutorProfile->status_akun ?? 'pending') !== 'aktif')
                {{-- RUANG KARANTINA (WAITING ROOM) --}}
                <div class="bg-white rounded-[3rem] p-10 md:p-20 text-center border border-slate-200 shadow-sm max-w-3xl mx-auto mt-10">
                    <div class="relative w-32 h-32 mx-auto mb-8">
                        <div class="absolute inset-0 bg-orange-100 rounded-full animate-ping opacity-50"></div>
                        <div class="relative w-full h-full bg-orange-50 text-orange-500 rounded-full flex items-center justify-center border border-orange-100 shadow-inner">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-black text-slate-900 mb-4 tracking-tight">Akun Sedang Divalidasi</h1>
                    <p class="text-slate-500 text-base md:text-lg mb-8 leading-relaxed">Terima kasih telah melengkapi profil Anda! Saat ini <span class="font-bold text-slate-800">Admin</span> sedang meninjau dokumen legalitas dan data diri Anda.</p>
                    <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 mb-8 text-left inline-block w-full md:w-auto">
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Status Berkas Anda:</p>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3 text-sm font-bold text-emerald-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> Formulir Biodata Diterima</li>
                            <li class="flex items-center gap-3 text-sm font-bold text-emerald-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> Link GDrive Tersimpan</li>
                            <li class="flex items-center gap-3 text-sm font-bold text-orange-500 animate-pulse"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg> Pengecekan Manual oleh Admin</li>
                        </ul>
                    </div>
                </div>
            @else
                
                {{-- MAIN GRID LAYOUT KIRI KANAN --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8 items-start">

                    {{-- ========================================================== --}}
                    {{-- KOLOM KIRI (UTAMA)                                         --}}
                    {{-- ========================================================== --}}
                    <div class="lg:col-span-2 space-y-6 lg:space-y-8">

                        {{-- HERO WELCOME BANNER (DARK PREMIUM) --}}
                        <div class="bg-blue-950 rounded-[2.5rem] p-8 md:p-10 relative overflow-hidden shadow-2xl shadow-blue-900/20 border border-blue-900 flex flex-col justify-center">
                            <div class="absolute -top-40 -right-40 w-96 h-96 bg-orange-500 rounded-full blur-[100px] opacity-30 pointer-events-none"></div>
                            <div class="absolute -bottom-20 -left-20 w-72 h-72 bg-blue-500 rounded-full blur-[80px] opacity-30 pointer-events-none"></div>

                            <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                                <div class="text-left">
                                    <p class="text-orange-400 font-bold mb-1.5 uppercase tracking-[0.2em] text-[10px] flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 bg-orange-400 rounded-full animate-pulse"></span> Halo, {{ explode(' ', trim($user->name))[0] }}!
                                    </p>
                                    <h1 class="text-3xl lg:text-4xl font-black text-white mb-2 tracking-tight">Siap Menginspirasi Hari Ini?</h1>
                                    <p class="text-blue-200 font-medium text-sm max-w-md leading-relaxed">Kelola kelas, cek pesanan baru, dan pantau penghasilan dengan mudah dari dashboard Anda.</p>
                                </div>
                            </div>
                        </div>

                        {{-- QUICK STATS PANEL --}}
                        <div class="grid grid-cols-2 gap-4 md:gap-5">
                            {{-- Stat 1: Etalase Aktif --}}
                            <a href="{{ route('tutor.packages.index') }}" class="bg-white border border-slate-200 shadow-sm rounded-[2rem] p-6 lg:p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/10 hover:border-blue-300 group flex flex-col justify-between">
                                <div class="flex items-center gap-4 mb-6">
                                    <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors shadow-sm">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest mb-0.5 group-hover:text-blue-500 transition-colors">Toko Aktif</p>
                                        <p class="text-sm font-bold text-slate-800">Etalase Paket</p>
                                    </div>
                                </div>
                                <div class="text-left mt-auto">
                                    <h3 class="text-4xl lg:text-5xl font-black text-slate-900 leading-none tracking-tight">{{ $totalPaket ?? 0 }}<span class="text-sm font-bold text-slate-400 uppercase tracking-widest ml-1">Paket</span></h3>
                                </div>
                            </a>

                            {{-- Stat 2: Pesanan Baru --}}
                            @php $adaPesananBaru = count($pesananBaru ?? []) > 0; @endphp
                            <a href="{{ route('tutor.orders.index') }}" class="bg-white border {{ $adaPesananBaru ? 'border-orange-300 shadow-[0_4px_20px_rgba(249,115,22,0.15)]' : 'border-slate-200 shadow-sm' }} rounded-[2rem] p-6 lg:p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-orange-500/10 hover:border-orange-400 group relative overflow-hidden flex flex-col justify-between">
                                @if($adaPesananBaru)
                                    <span class="absolute top-6 right-6 flex h-4 w-4">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-4 w-4 bg-rose-500 border-2 border-white"></span>
                                    </span>
                                @endif
                                
                                <div class="flex items-center gap-4 mb-6 relative z-10">
                                    <div class="w-12 h-12 rounded-2xl {{ $adaPesananBaru ? 'bg-orange-100 text-orange-600' : 'bg-slate-50 text-slate-500' }} flex items-center justify-center transition-colors group-hover:bg-orange-500 group-hover:text-white shadow-sm">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] {{ $adaPesananBaru ? 'text-orange-500' : 'text-slate-400' }} font-black uppercase tracking-widest mb-0.5 group-hover:text-orange-600 transition-colors">Tinjau Segera</p>
                                        <p class="text-sm font-bold text-slate-800">Pesanan Baru</p>
                                    </div>
                                </div>
                                <div class="text-left mt-auto relative z-10">
                                    <h3 class="text-4xl lg:text-5xl font-black text-slate-900 leading-none tracking-tight">{{ count($pesananBaru ?? []) }}<span class="text-sm font-bold text-slate-400 uppercase tracking-widest ml-1">Siswa</span></h3>
                                </div>
                            </a>
                        </div>

                        {{-- KELAS BERJALAN --}}
                        <div>
                            <div class="flex items-end justify-between mb-4 px-1">
                                <div class="text-left">
                                    <h2 class="font-black text-slate-800 text-lg">Kelas Berjalan</h2>
                                    <p class="text-xs text-slate-500 font-medium mt-1">Isi absen, pantau progress, dan cairkan dana.</p>
                                </div>
                                <a href="{{ route('tutor.orders.index') }}" class="text-[10px] font-black text-slate-400 hover:text-blue-600 uppercase tracking-widest transition-colors border border-slate-200 px-3 py-1.5 rounded-lg bg-white shadow-sm hover:shadow-md">Semua Kelas</a>
                            </div>

                            <div class="grid grid-cols-1 gap-5 max-h-[600px] overflow-y-auto custom-scrollbar pr-2 block pb-4 pt-1">
                                @forelse($activeOrders ?? [] as $order)
                                    @php
                                    $completedJournals = $order->sessions->whereNotNull('teachingJournal')->count();
                                    $isCompleted = ($completedJournals >= $order->jumlah_sesi);
                                    $progressPercentage = ($order->jumlah_sesi > 0) ? ($completedJournals / $order->jumlah_sesi) * 100 : 0;
                                    @endphp
                                    
                                    {{-- CARD KELAS BERJALAN --}}
                                    <div class="bg-white p-6 lg:p-7 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-200 rounded-[2rem] hover:shadow-xl hover:border-blue-200 transition-all duration-300 flex flex-col justify-between group">
                                        
                                        <div class="flex flex-col md:flex-row justify-between gap-6 mb-6">
                                            {{-- Kiri: Informasi Badges & Judul --}}
                                            <div class="flex-grow text-left">
                                                <div class="flex items-center gap-3 mb-4 flex-wrap">
                                                    <span class="text-[9px] font-mono font-bold text-slate-500 bg-slate-100 border border-slate-200 px-2.5 py-1 rounded-md tracking-wider">
                                                        #ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                                                    </span>
                                                    
                                                    @if($isCompleted && $order->status_pesanan != 'selesai')
                                                        <span class="text-[9px] font-black text-orange-600 bg-orange-50 px-3 py-1 rounded-full uppercase tracking-widest flex items-center gap-1.5 border border-orange-100">
                                                            <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span> Menunggu Review
                                                        </span>
                                                    @elseif($order->status_pesanan == 'selesai')
                                                        <span class="text-[9px] font-black text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full uppercase tracking-widest flex items-center gap-1.5 border border-emerald-100">
                                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Selesai
                                                        </span>
                                                    @else
                                                        <span class="text-[9px] font-black text-blue-600 bg-blue-50 px-3 py-1 rounded-full uppercase tracking-widest flex items-center gap-1.5 border border-blue-100">
                                                            <span class="relative flex h-1.5 w-1.5"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span><span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-blue-600"></span></span> Sedang Berjalan
                                                        </span>
                                                    @endif
                                                </div>
                                                
                                                <h3 class="text-lg lg:text-xl font-black text-slate-900 mb-4 group-hover:text-blue-600 transition-colors line-clamp-1">
                                                    {{ $order->paket->nama_paket ?? $order->mata_pelajaran }}
                                                </h3>

                                                <div class="inline-flex items-center gap-2.5 border border-slate-100 bg-slate-50/50 rounded-full pr-4 p-1 w-max">
                                                    <div class="w-7 h-7 bg-white rounded-full flex items-center justify-center text-[10px] font-black text-slate-500 border border-slate-200 shadow-sm">
                                                        {{ strtoupper(substr($order->murid->name ?? 'M', 0, 1)) }}
                                                    </div>
                                                    <p class="text-xs font-bold text-slate-700">Murid: {{ $order->murid->name }}</p>
                                                </div>
                                            </div>

                                            {{-- Kanan: Aksi (Jurnal / Tarik Dana) --}}
                                            <div class="flex flex-col items-start md:items-end justify-between shrink-0 min-w-[160px]">
                                                @if($order->status_pesanan == 'selesai')
                                                    <div class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center mb-4 md:mb-0 border border-emerald-100 hidden md:flex shrink-0">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    </div>
                                                    <form action="{{ route('tutor.wallet.claim', $order->id) }}" method="POST" class="w-full">
                                                        @csrf
                                                        <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg shadow-emerald-500/30 active:scale-95 flex items-center justify-center gap-2">
                                                            Tarik Rp {{ number_format($order->total_harga_sesi ?? 0, 0, ',', '.') }}
                                                        </button>
                                                    </form>
                                                @elseif($isCompleted)
                                                    <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mb-4 md:mb-0 border border-orange-100 hidden md:flex shrink-0">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    </div>
                                                    <button class="w-full bg-slate-100 text-slate-400 px-6 py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest cursor-not-allowed text-center border border-slate-200" disabled>
                                                        Menunggu Siswa
                                                    </button>
                                                @else
                                                    {{-- KONDISI JIKA KELAS SEDANG BERJALAN --}}
                                                    @php
                                                        // Cek apakah ada sesi di dalam order ini yang belum ditentukan tanggal_jadwal-nya
                                                        $adaJadwalKosong = $order->sessions->whereNull('tanggal_jadwal')->count() > 0;
                                                    @endphp

                                                    @if($adaJadwalKosong)
                                                        {{-- TAMPILAN JIKA BELUM DIATUR JADWALNYA (IKON KALENDER WARNA ORANGE) --}}
                                                        <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mb-4 md:mb-0 border border-orange-100 hidden md:flex shrink-0">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                        </div>
                                                        <button onclick="openScheduleModal({{ $order->sessions->whereNull('tanggal_jadwal')->first()->id }}, '{{ $order->paket->nama_paket ?? $order->mata_pelajaran }}')" class="w-full bg-orange-500 hover:bg-orange-600 text-white px-6 py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all flex items-center justify-center gap-2 shadow-xl shadow-orange-500/20 active:scale-95 border border-orange-400">
                                                            Atur Jadwal <svg class="w-3.5 h-3.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                                                        </button>
                                                    @else
                                                        {{-- TAMPILAN DEFAULT JIKA SEMUA JADWAL SESI SUDAH AMAN DIKUNCI (IKON SEPERTI BAWAANMU) --}}
                                                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mb-4 md:mb-0 border border-blue-100 hidden md:flex shrink-0">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                        </div>
                                                        <button onclick="document.getElementById('modal-daftar-sesi-{{ $order->id }}').showModal()" class="w-full bg-slate-900 hover:bg-blue-600 text-white px-6 py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all flex items-center justify-center gap-2 shadow-xl shadow-slate-900/20 active:scale-95 border border-slate-800 hover:border-blue-500">
                                                            Jurnal Sesi <svg class="w-3.5 h-3.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                                                        </button>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Progress Bar --}}
                                        <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 shadow-inner text-left">
                                            <div class="flex justify-between items-end mb-2">
                                                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Progress Kelas</span>
                                                <span class="text-[11px] font-black {{ $isCompleted ? 'text-emerald-600' : 'text-blue-600' }}">{{ $completedJournals }} dari {{ $order->jumlah_sesi }} Sesi Selesai</span>
                                            </div>
                                            <div class="w-full bg-slate-200 h-2.5 rounded-full overflow-hidden">
                                                <div class="h-full rounded-full transition-all duration-1000 ease-out {{ $isCompleted ? 'bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)]' : 'bg-blue-500 shadow-[0_0_10px_rgba(59,130,246,0.5)]' }}" style="width: {{ $progressPercentage }}%"></div>
                                            </div>
                                        </div>

                                    </div>
                                @empty
                                    <div class="bg-white border border-dashed border-slate-300 rounded-[2.5rem] p-12 flex flex-col items-center justify-center text-center shadow-sm h-full min-h-[300px]">
                                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100 shadow-sm relative">
                                            <div class="absolute -right-2 -top-2 w-8 h-8 bg-blue-100 rounded-full animate-ping opacity-60"></div>
                                            <span class="text-3xl relative z-10">🚀</span>
                                        </div>
                                        <h3 class="text-xl font-black text-slate-800 mb-2">Belum Ada Kelas Berjalan</h3>
                                        <p class="text-slate-500 text-sm max-w-sm mx-auto font-medium leading-relaxed">Persiapkan materi terbaik Anda! Kelas akan muncul di sini setelah pesanan dibayar.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                    </div> {{-- PENUTUP KOLOM KIRI --}}

                    {{-- ========================================================== --}}
                    {{-- KOLOM KANAN (SIDEBAR)                                      --}}
                    {{-- ========================================================== --}}
                    <div class="space-y-6 lg:space-y-8 flex flex-col">

                        {{-- KARTU PROFIL TUTOR (DIPERBAIKI PREVIEW GAMBARNYA) --}}
                        <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm p-6 relative overflow-hidden group hover:shadow-lg transition-all duration-300 hover:border-blue-200">
                            <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-slate-100 group-hover:h-28 transition-all duration-500"></div>
                            <div class="relative z-10 flex flex-col items-center mt-6">
                                <div class="relative mb-4 group-hover:-translate-y-2 transition-transform duration-300">
                                    <div class="w-24 h-24 bg-white rounded-full p-1.5 shadow-md border border-slate-100">
                                        <div class="w-full h-full bg-slate-200 rounded-full flex items-center justify-center overflow-hidden">
                                            {{-- FIX BARIS INI: Menggunakan profile_photo_path dari Users --}}
                                            @if($user->profile_photo_path)
                                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Profil" class="w-full h-full object-cover">
                                            @else
                                                <span class="text-3xl font-black text-slate-400">{{ strtoupper(substr($user->name ?? 'T', 0, 1)) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    @if(($user->tutorProfile->status_akun ?? '') === 'aktif')
                                    <div class="absolute bottom-1 right-1 w-7 h-7 bg-emerald-500 rounded-full flex items-center justify-center border-4 border-white text-white shadow-sm" title="Terverifikasi">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                    </div>
                                    @endif
                                </div>
                                <h3 class="text-xl font-black text-slate-900 text-center">{{ $user->name ?? 'Nama Tutor' }}</h3>
                                <p class="text-[10px] font-bold text-blue-600 uppercase tracking-widest mt-1 mb-6 text-center bg-blue-50 px-3 py-1 rounded-full border border-blue-100">{{ $user->tutorProfile->bidang ?? 'Tutor Tempatles' }}</p>

                                <div class="w-full border-t border-slate-100 pt-5">
                                    <a href="{{ route('tutor.profile.edit') }}" class="flex items-center justify-center gap-3 text-xs font-black text-white bg-slate-900 hover:bg-blue-600 py-4 rounded-2xl transition-all duration-300 uppercase tracking-[0.15em] shadow-lg shadow-slate-900/20 active:scale-95">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg> 
                                        Edit Profil
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- KARTU DOMPET PREMIUM --}}
                        <div class="relative bg-gradient-to-tr from-slate-900 via-blue-950 to-slate-800 rounded-[2rem] p-7 shadow-2xl shadow-blue-900/20 overflow-hidden border border-slate-700 hover:border-blue-500 transition-colors duration-500 text-left">
                            <div class="absolute top-0 right-0 w-40 h-40 bg-white opacity-5 rounded-full blur-2xl"></div>
                            <div class="flex justify-between items-start mb-8 relative z-10">
                                <div class="w-10 h-8 bg-gradient-to-br from-yellow-200 to-yellow-500 rounded-md opacity-90 shadow-inner flex items-center justify-center">
                                    <div class="w-4 h-1 bg-white/50 rounded-full"></div>
                                </div>
                                <span class="text-white/50 text-[10px] font-black uppercase tracking-[0.3em]">Dompet Digital</span>
                            </div>
                            <div class="relative z-10 mb-6">
                                <p class="text-slate-400 text-xs font-medium mb-1">Saldo Tersedia</p>
                                <h3 class="text-3xl font-black text-white tracking-tight">Rp {{ number_format($saldoCair ?? 0, 0, ',', '.') }}</h3>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-white/5 rounded-xl backdrop-blur-md border border-white/10 relative z-10 mb-6 shadow-inner">
                                <div>
                                    <p class="text-[10px] text-slate-300 font-bold uppercase tracking-widest mb-0.5">Dana Tertahan</p>
                                    <p class="text-sm font-black text-white">Rp {{ number_format($danaTertahan ?? 0, 0, ',', '.') }}</p>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                </div>
                            </div>
                            
                            <div class="relative z-10 flex flex-col gap-2.5">
                                <button onclick="document.getElementById('modal-payout').showModal()" class="w-full bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 text-white py-3.5 rounded-xl text-[11px] font-black uppercase tracking-widest transition-all {{ ($saldoCair ?? 0) <= 0 ? 'opacity-50 cursor-not-allowed' : 'shadow-lg shadow-orange-500/30 active:scale-95' }}" {{ ($saldoCair ?? 0) <= 0 ? 'disabled' : '' }}>
                                    Tarik Saldo
                                </button>
                                <button onclick="document.getElementById('modal-riwayat-penarikan').showModal()" class="w-full bg-white/5 hover:bg-white/10 text-white py-3.5 rounded-xl text-[10px] font-bold uppercase tracking-widest transition-all backdrop-blur-sm border border-white/10 text-center active:scale-95">
                                    Riwayat Penarikan
                                </button>
                            </div>
                        </div>

                        {{-- MINI WIDGETS GRID --}}
                        <div class="grid grid-cols-2 gap-4">
                            {{-- KARTU RATING --}}
                            <a href="{{ Route::has('tutor.reviews') ? route('tutor.reviews') : '#' }}" class="bg-white p-5 rounded-[2rem] border border-slate-200 shadow-sm text-center hover:shadow-lg hover:border-yellow-400 hover:-translate-y-1 transition-all group block">
                                <div class="w-12 h-12 bg-yellow-50 text-yellow-500 rounded-full flex items-center justify-center mx-auto mb-3 text-xl group-hover:scale-110 group-hover:bg-yellow-100 transition-all shadow-sm">⭐</div>
                                <p class="font-black text-slate-900 text-2xl leading-none">{{ number_format($rating ?? 0, 1) }}</p>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mt-1.5 group-hover:text-yellow-600 transition-colors">Lihat Ulasan</p>
                            </a>
                            {{-- KARTU STRIKE --}}
                            <a href="{{ Route::has('tutor.strikes') ? route('tutor.strikes') : '#' }}" class="bg-white p-5 rounded-[2rem] border border-slate-200 shadow-sm text-center hover:shadow-lg hover:border-rose-400 hover:-translate-y-1 transition-all group block">
                                <div class="w-12 h-12 bg-rose-50 text-rose-500 rounded-full flex items-center justify-center mx-auto mb-3 text-xl font-black group-hover:scale-110 group-hover:bg-rose-100 transition-all shadow-sm">!</div>
                                <p class="font-black text-slate-900 text-2xl leading-none">{{ $strike ?? 0 }}<span class="text-sm text-slate-400">/3</span></p>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mt-1.5 group-hover:text-rose-600 transition-colors">Peringatan</p>
                            </a>
                        </div>

                    </div> {{-- PENUTUP KOLOM KANAN --}}

                </div>
            @endif
        </div>
    </nav>

    {{-- ================================================================= --}}
    {{-- SEMUA KUMPULAN MODAL (POPUPS) ADA DI SINI                         --}}
    {{-- ================================================================= --}}

    {{-- 1. MODAL RIWAYAT PENARIKAN --}}
    <dialog id="modal-riwayat-penarikan" class="rounded-[2.5rem] p-0 border border-slate-200 shadow-2xl backdrop:bg-slate-900/70 backdrop:backdrop-blur-sm m-auto w-full max-w-3xl overflow-hidden transition-all">
        <div class="w-full bg-white relative flex flex-col max-h-[85vh]">
            <div class="px-8 py-6 bg-slate-50 border-b border-slate-100 shrink-0 sticky top-0 z-20 flex justify-between items-center text-left">
                <div>
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Riwayat Penarikan Dana</h3>
                    <p class="text-[10px] font-medium text-slate-500 mt-1">Catatan seluruh transaksi pencairan saldo Anda.</p>
                </div>
                <button type="button" onclick="this.closest('dialog').close()" class="w-10 h-10 flex items-center justify-center bg-white border border-slate-200 hover:bg-rose-50 text-slate-400 hover:text-rose-500 hover:border-rose-200 rounded-full transition-colors shadow-sm active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            
            <div class="overflow-y-auto flex-grow custom-scrollbar">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-white border-b border-slate-100 sticky top-0 z-10 shadow-sm">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Waktu & Tiket</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tujuan Penarikan</th>
                            <th class="px-6 py-4 text-right text-[10px] font-black text-slate-400 uppercase tracking-widest">Detail Pencairan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($riwayatPayout ?? [] as $payout)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-5 text-left">
                                <p class="text-[10px] text-slate-500 font-bold mb-0.5 whitespace-nowrap">{{ $payout->created_at->format('d M Y • H:i') }}</p>
                                <p class="text-[10px] font-mono font-medium text-slate-400 uppercase">#{{ $payout->kode_pencairan }}</p>
                            </td>
                            <td class="px-6 py-5 text-left">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 border border-slate-200 shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-black text-slate-800 uppercase">{{ $payout->nama_bank }}</p>
                                        <p class="text-[10px] font-bold text-slate-500 mt-0.5">{{ $payout->nomor_rekening }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-right whitespace-nowrap">
                                <p class="text-base font-black text-slate-900 mb-1.5">Rp {{ number_format($payout->nominal, 0, ',', '.') }}</p>
                                @if($payout->status == 'pending' || $payout->status == 'diproses')
                                    <span class="inline-flex items-center justify-end gap-1 text-[10px] font-black text-orange-500 uppercase tracking-widest bg-orange-50 px-2.5 py-1 rounded-md border border-orange-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span> Diproses
                                    </span>
                                @elseif($payout->status == 'berhasil')
                                    <span class="inline-flex items-center justify-end gap-1 text-[10px] font-black text-emerald-500 uppercase tracking-widest bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-100">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Berhasil
                                    </span>
                                    @if($payout->bukti_transfer_path)
                                        <a href="{{ asset('storage/' . $payout->bukti_transfer_path) }}" target="_blank" class="block mt-1.5 text-[9px] font-bold text-blue-600 hover:text-blue-800 transition-colors">Lihat Bukti Transfer &rarr;</a>
                                    @endif
                                @else
                                    <span class="inline-flex items-center justify-end gap-1 text-[10px] font-black text-rose-500 uppercase tracking-widest bg-rose-50 px-2.5 py-1 rounded-md border border-rose-100">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg> Ditolak
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-16 text-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3 border border-slate-200 shadow-sm">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <p class="text-sm font-bold text-slate-700">Belum ada riwayat penarikan.</p>
                                <p class="text-[10px] text-slate-400 mt-1 font-medium">Transaksi Anda akan muncul di sini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </dialog>

    {{-- 2. MODAL DAFTAR SESI --}}
    @foreach($activeOrders ?? [] as $order)
        <dialog id="modal-daftar-sesi-{{ $order->id }}" class="rounded-[2.5rem] p-0 border border-slate-200 shadow-2xl backdrop:bg-slate-900/70 backdrop:backdrop-blur-sm m-auto w-full max-w-2xl overflow-hidden transition-all">
            <div class="w-full bg-white relative flex flex-col max-h-[85vh]">
                
                {{-- Header Premium Gradient --}}
                <div class="px-8 py-7 bg-gradient-to-r from-slate-900 to-blue-900 shrink-0 sticky top-0 z-20 flex justify-between items-center shadow-md relative overflow-hidden text-left">
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                    <div class="relative z-10">
                        <p class="text-[10px] font-black text-orange-400 uppercase tracking-widest mb-1 shadow-sm">{{ $order->paket->nama_paket ?? $order->mata_pelajaran }}</p>
                        <h3 class="text-2xl font-black text-white tracking-tight leading-none">Daftar Sesi & Jurnal</h3>
                    </div>
                    <button type="button" onclick="this.closest('dialog').close()" class="relative z-10 w-10 h-10 flex items-center justify-center bg-white/10 border border-white/20 hover:bg-rose-500 hover:border-rose-500 text-white rounded-full transition-all shadow-sm active:scale-95">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                {{-- List Sesi: Timeline Design --}}
                <div class="p-8 overflow-y-auto flex-grow custom-scrollbar bg-slate-50 relative">
                    {{-- Garis Latar Timeline --}}
                    @if(count($order->sessions) > 1)
                        <div class="timeline-line hidden md:block"></div>
                    @endif

                    <div class="space-y-6 relative z-10">
                        @forelse($order->sessions as $session)
                            <div class="relative flex flex-col md:flex-row items-start md:items-center gap-6 group">
                                
                                {{-- Kiri: Timeline Node & Teks (Desktop) --}}
                                <div class="hidden md:flex items-center gap-6 w-1/3 shrink-0 relative">
                                    <div class="w-5 h-5 rounded-full border-4 border-slate-50 {{ $session->teachingJournal ? 'bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)]' : 'bg-slate-300' }} flex items-center justify-center z-10 shrink-0 transition-colors"></div>
                                    <div class="text-right flex-grow">
                                        <p class="text-[11px] font-black text-slate-800 uppercase tracking-widest mb-0.5">Pertemuan {{ $session->pertemuan_ke }}</p>
                                        <p class="text-[10px] font-medium text-slate-500">{{ \Carbon\Carbon::parse($session->tanggal_jadwal)->translatedFormat('d M') }} • {{ $session->waktu_mulai }} WIB</p>
                                    </div>
                                </div>

                                {{-- Kartu Sesi (Mobile & Desktop) --}}
                                <div class="bg-white p-5 rounded-[1.5rem] border {{ $session->teachingJournal ? 'border-emerald-200 shadow-sm bg-emerald-50/20' : 'border-slate-200 shadow-sm hover:border-blue-300' }} flex-grow w-full transition-all duration-300 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                    
                                    {{-- Tampilan Header Mobile --}}
                                    <div class="md:hidden flex items-center gap-3 border-b border-slate-100 pb-3 mb-1 text-left">
                                        <div class="w-3 h-3 rounded-full {{ $session->teachingJournal ? 'bg-emerald-500' : 'bg-slate-300' }}"></div>
                                        <p class="text-xs font-black text-slate-800 uppercase tracking-widest">Pertemuan {{ $session->pertemuan_ke }}</p>
                                        <span class="text-[9px] text-slate-400 font-medium ml-auto">{{ \Carbon\Carbon::parse($session->tanggal_jadwal)->format('d/m') }}</span>
                                    </div>

                                    {{-- Info Text Card --}}
                                    <div class="flex items-center gap-3 text-left">
                                        <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 border {{ $session->teachingJournal ? 'bg-emerald-100 text-emerald-600 border-emerald-200' : 'bg-slate-100 text-slate-400 border-slate-200 group-hover:bg-blue-100 group-hover:text-blue-600 group-hover:border-blue-200' }} transition-colors">
                                            @if($session->teachingJournal)
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                            @else
                                                <span class="font-black text-lg">{{ $session->pertemuan_ke }}</span>
                                            @endif
                                        </div>
                                        <div>
                                            @if($session->teachingJournal)
                                                <p class="text-sm font-black text-emerald-700 mb-0.5">Jurnal Selesai</p>
                                                <p class="text-[10px] font-bold text-emerald-600/70">Terima kasih atas dedikasinya.</p>
                                            @else
                                                <p class="text-sm font-black text-slate-800 mb-0.5">Belum Dilaporkan</p>
                                                <p class="text-[10px] font-bold text-slate-400">Jadwal: {{ $session->waktu_mulai }} WIB</p>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Tombol Aksi Kanan --}}
                                    <div class="shrink-0 mt-2 sm:mt-0">
                                        @if($session->teachingJournal)
                                            <div class="w-full text-center sm:text-right">
                                                <span class="inline-flex items-center justify-center gap-1.5 w-8 h-8 rounded-full bg-emerald-100 text-emerald-600">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                                </span>
                                            </div>
                                        @else
                                            <button type="button" onclick="openJournalModal({{ $session->id }}, '{{ $order->paket->nama_paket ?? $order->mata_pelajaran }}')" class="w-full sm:w-auto bg-slate-900 text-white px-5 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 transition-all shadow-md active:scale-95 flex items-center justify-center gap-2 border border-slate-800 hover:border-blue-500">
                                                Isi Jurnal <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-12 text-center bg-white rounded-3xl border border-dashed border-slate-300 shadow-sm relative z-10">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-200">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <p class="text-base font-black text-slate-800 mb-1">Jadwal Sesi Kosong</p>
                                <p class="text-xs text-slate-500 font-medium">Belum ada pertemuan yang dijadwalkan.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </dialog>
    @endforeach

    {{-- 3. MODAL INPUT JURNAL & ABSENSI --}}
    <dialog id="modal-jurnal" class="rounded-[2.5rem] p-0 border border-slate-200 shadow-2xl backdrop:bg-slate-900/70 backdrop:backdrop-blur-sm m-auto w-full max-w-xl overflow-hidden transition-all">
        <div class="w-full bg-white relative flex flex-col max-h-[90vh]">
            
            {{-- Header Premium Gradient --}}
            <div class="px-8 py-7 bg-gradient-to-r from-blue-600 to-indigo-700 shrink-0 sticky top-0 z-20 flex justify-between items-center shadow-md relative overflow-hidden text-left">
                <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/10 rounded-full blur-xl"></div>
                <div class="relative z-10">
                    <p class="text-[10px] font-black text-blue-200 uppercase tracking-widest mb-1 shadow-sm">Formulir Laporan</p>
                    <h3 class="text-2xl font-black text-white tracking-tight leading-none">Jurnal Sesi Mengajar</h3>
                </div>
                <button type="button" onclick="this.closest('dialog').close()" class="relative z-10 w-10 h-10 flex items-center justify-center bg-white/10 border border-white/20 hover:bg-rose-500 hover:border-rose-500 text-white rounded-full transition-all shadow-sm active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            {{-- Form Body --}}
            <div class="p-8 overflow-y-auto flex-grow custom-scrollbar bg-slate-50/30">
                
                {{-- Info Box --}}
                <div class="bg-white border border-slate-200 p-5 rounded-2xl mb-6 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4 text-left">
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Mata Pelajaran / Paket</p>
                        <p id="label-mapel" class="text-sm font-black text-slate-800">NAMA PAKET</p>
                    </div>
                    <div class="bg-blue-50 text-blue-700 border border-blue-100 px-3 py-2 rounded-xl flex items-center gap-2 text-[10px] font-bold shrink-0">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Pastikan data valid
                    </div>
                </div>

                <form action="{{ route('tutor.journal.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 text-left">
                    @csrf
                    <input type="hidden" name="order_session_id" id="input-session-id">
                    
                    {{-- Textarea Materi --}}
                    <div class="bg-white p-6 rounded-[1.5rem] border border-slate-200 shadow-sm">
                        <label class="flex items-center gap-2 text-[10px] font-black text-slate-800 uppercase tracking-widest mb-3">
                            <span class="w-5 h-5 rounded border border-slate-200 bg-slate-50 flex items-center justify-center text-slate-500">1</span>
                            Catatan & Pembahasan Materi <span class="text-rose-500 text-sm leading-none">*</span>
                        </label>
                        <textarea name="materi_pembahasan" rows="4" required placeholder="Tuliskan materi yang diajarkan, respon murid, dan progress hari ini..." class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl p-4 text-sm font-medium text-slate-800 focus:bg-white focus:ring-0 focus:border-blue-500 transition-all outline-none resize-none placeholder:text-slate-400 placeholder:font-normal"></textarea>
                    </div>

                    {{-- Upload Foto --}}
                    <div class="bg-white p-6 rounded-[1.5rem] border border-slate-200 shadow-sm">
                        <label class="flex items-center gap-2 text-[10px] font-black text-slate-800 uppercase tracking-widest mb-3">
                            <span class="w-5 h-5 rounded border border-slate-200 bg-slate-50 flex items-center justify-center text-slate-500">2</span>
                            Upload Foto Absensi / Zoom <span class="text-rose-500 text-sm leading-none">*</span>
                        </label>
                        
                        <label class="relative flex flex-col items-center justify-center w-full py-8 px-4 border-2 border-slate-300 border-dashed hover:border-blue-500 rounded-xl cursor-pointer bg-slate-50/50 hover:bg-blue-50/50 transition-all group">
                            <div class="w-14 h-14 bg-white text-slate-400 rounded-full flex items-center justify-center border border-slate-200 mb-3 group-hover:text-blue-600 group-hover:scale-110 transition-all shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <p class="text-sm font-bold text-slate-700 mb-1"><span class="text-blue-600 group-hover:underline">Klik untuk upload</span> foto</p>
                            <p class="text-[10px] font-medium text-slate-400 uppercase tracking-widest">JPG, PNG atau JPEG (Max. 2MB)</p>
                            <input type="file" name="foto_bukti" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="this.parentElement.querySelector('p.text-sm').innerHTML = '<span class=\'text-emerald-600\'>✅ File dipilih: </span>' + this.files[0].name">
                        </label>
                    </div>

                    {{-- Upload Materi --}}
                    <div class="bg-white p-6 rounded-[1.5rem] border border-slate-200 shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 right-0 bg-orange-100 text-orange-600 text-[9px] font-black uppercase px-3 py-1.5 rounded-bl-xl border-b border-l border-orange-200">Opsional</div>
                        
                        <label class="flex items-center gap-2 text-[10px] font-black text-slate-800 uppercase tracking-widest mb-3">
                            <span class="w-5 h-5 rounded border border-slate-200 bg-slate-50 flex items-center justify-center text-slate-500">3</span>
                            Modul / Materi Belajar
                        </label>
                        
                        <label class="relative flex flex-col items-center justify-center w-full py-6 px-4 border-2 border-slate-200 border-dashed hover:border-orange-400 rounded-xl cursor-pointer bg-white hover:bg-orange-50/50 transition-all group">
                            <div class="flex items-center gap-4 w-full">
                                <div class="w-12 h-12 bg-slate-50 text-slate-400 rounded-xl flex items-center justify-center border border-slate-200 shrink-0 group-hover:text-orange-500 group-hover:bg-white transition-all shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <div class="text-left flex-grow">
                                    <p class="text-sm font-bold text-slate-700 mb-0.5" id="file-materi-text">Upload file tugas/modul</p>
                                    <p class="text-[10px] font-medium text-slate-400 uppercase tracking-widest">PDF, PPT, DOC (Max. 5MB)</p>
                                </div>
                            </div>
                            <input type="file" name="file_materi" accept=".pdf,.ppt,.pptx,.doc,.docx" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="document.getElementById('file-materi-text').innerHTML = '<span class=\'text-emerald-600\'>✅ ' + this.files[0].name + '</span>'">
                        </label>
                    </div>

                    {{-- Action Button --}}
                    <div class="pt-4">
                        <button type="submit" class="w-full bg-slate-900 hover:bg-blue-600 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-slate-900/20 active:scale-95 transition-all flex items-center justify-center gap-3 border border-slate-800 hover:border-blue-500">
                            Kirim Laporan Ke Siswa 
                            <div class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>

    {{-- 5. MODAL ATUR JADWAL SESI (KUSTOM BARU) --}}
    <dialog id="modal-jadwal" class="rounded-[2.5rem] p-0 border border-slate-200 shadow-2xl backdrop:bg-slate-900/70 backdrop:backdrop-blur-sm m-auto w-full max-w-md overflow-hidden transition-all">
        <div class="w-full bg-white relative flex flex-col max-h-[90vh]">
            
            {{-- Header Modal --}}
            <div class="px-8 py-7 bg-gradient-to-r from-orange-500 to-amber-600 shrink-0 sticky top-0 z-20 flex justify-between items-center shadow-md text-left">
                <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/10 rounded-full blur-xl"></div>
                <div class="relative z-10">
                    <p class="text-[10px] font-black text-amber-100 uppercase tracking-widest mb-1 shadow-sm">Kesepakatan WA</p>
                    <h3 class="text-2xl font-black text-white tracking-tight leading-none">Atur Jadwal Pertemuan</h3>
                </div>
                <button type="button" onclick="this.closest('dialog').close()" class="relative z-10 w-10 h-10 flex items-center justify-center bg-white/10 border border-white/20 hover:bg-rose-500 hover:border-rose-500 text-white rounded-full transition-all shadow-sm active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            {{-- Form Body --}}
            <div class="p-8 overflow-y-auto flex-grow custom-scrollbar bg-slate-50/30">
                
                {{-- Info Paket --}}
                <div class="bg-white border border-slate-200 p-5 rounded-2xl mb-6 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4 text-left">
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Kelas Paket / Mapel</p>
                        <p id="label-jadwal-mapel" class="text-sm font-black text-slate-800">NAMA PAKET</p>
                    </div>
                </div>

                {{-- Form Pengisian --}}
                <form action="{{ route('tutor.schedule.update') }}" method="POST" class="space-y-5 text-left">
                    @csrf
                    {{-- ID Sesi Tersembunyi --}}
                    <input type="hidden" name="order_session_id" id="input-jadwal-session-id">
                    
                    {{-- Input Tanggal --}}
                    <div class="bg-white p-5 rounded-[1.5rem] border border-slate-200 shadow-sm">
                        <label class="block text-[10px] font-black text-slate-800 uppercase tracking-widest mb-2.5 pl-1">Tanggal Sesi Belajar <span class="text-rose-500">*</span></label>
                        <input type="date" name="tanggal_jadwal" required min="{{ date('Y-m-d') }}"
                            class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl p-4 text-sm font-bold text-slate-800 focus:bg-white focus:ring-0 focus:border-orange-500 transition-all outline-none shadow-inner">
                    </div>

                    {{-- Input Jam Mulai --}}
                    <div class="bg-white p-5 rounded-[1.5rem] border border-slate-200 shadow-sm">
                        <label class="block text-[10px] font-black text-slate-800 uppercase tracking-widest mb-2.5 pl-1">Jam Mulai Mengajar <span class="text-rose-500">*</span></label>
                        <input type="time" name="waktu_mulai" required
                            class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl p-4 text-sm font-bold text-slate-800 focus:bg-white focus:ring-0 focus:border-orange-500 transition-all outline-none shadow-inner">
                        <p class="text-[9px] font-medium text-slate-400 mt-2 ml-1">Format waktu mengikuti zona WIB setempat.</p>
                    </div>

                    {{-- Submit Button --}}
                    <div class="pt-2">
                        <button type="submit" class="w-full bg-slate-900 hover:bg-orange-500 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-slate-900/20 active:scale-95 transition-all flex items-center justify-center gap-2 border border-slate-800 hover:border-orange-400">
                            Kunci Jadwal Sesi
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>

    {{-- 4. MODAL PENCAIRAN DANA (PAYOUT) VERSI FINTECH PREMIUM --}}
    <dialog id="modal-payout" class="rounded-[2.5rem] p-0 border border-slate-200 shadow-2xl backdrop:bg-slate-900/80 backdrop:backdrop-blur-sm m-auto w-full max-w-md overflow-hidden transition-all">
        
        {{-- HALAMAN 1: KONFIRMASI TARIK SALDO --}}
        <div id="payout-page-1" class="w-full bg-slate-50 relative flex flex-col h-[560px]">
            {{-- Header --}}
            <div class="px-8 pt-8 pb-6 bg-white rounded-b-[2rem] shadow-sm shrink-0 relative z-20">
                <button type="button" onclick="this.closest('dialog').close()" class="absolute top-6 right-6 w-10 h-10 flex items-center justify-center bg-slate-50 border border-slate-200 hover:bg-rose-50 text-slate-400 hover:text-rose-500 rounded-full transition-colors z-20 shadow-sm active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
                <h3 class="text-xl font-black text-slate-900 tracking-tight flex items-center gap-2.5">
                    <span class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                    </span>
                    Tarik Saldo
                </h3>
            </div>

            {{-- Body --}}
            <div class="p-6 md:p-8 flex-grow overflow-y-auto custom-scrollbar">
                
                {{-- Kartu Saldo (Gaya Credit Card / Fintech) --}}
                <div class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-[2rem] p-7 text-white mb-6 shadow-xl shadow-slate-900/20 overflow-hidden border border-slate-700">
                    {{-- Dekorasi Kartu --}}
                    <div class="absolute -top-24 -right-10 w-48 h-48 bg-emerald-500/20 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-blue-500/20 rounded-full blur-2xl"></div>
                    <svg class="absolute right-4 bottom-4 w-24 h-24 text-white/5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.97-1.31-3.26-3.06-3.41V4h-2v2.16c-1.94.15-3.62 1.44-3.62 3.32 0 2.01 1.63 2.84 3.75 3.39 1.93.5 2.22 1.13 2.22 1.84 0 .71-.62 1.48-2.22 1.48-1.52 0-2.34-.73-2.45-1.75H6.62c.11 1.96 1.47 3.3 3.03 3.55V20h2v-2.03c1.96-.21 3.65-1.48 3.65-3.39.02-1.99-1.39-2.82-3.32-3.33z"/></svg>

                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-1.5 relative z-10 flex items-center gap-2">
                        Total Saldo Bisa Ditarik
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    </p>
                    <h3 class="text-3xl font-black relative z-10 tracking-tight">Rp {{ number_format($saldoCair ?? 0, 0, ',', '.') }}</h3>
                </div>

                {{-- Form Info & Tujuan Bank --}}
                <form action="{{ route('tutor.wallet.payout') }}" method="POST" id="form-payout" class="flex flex-col">
                    @csrf
                    <input type="hidden" name="nominal" value="{{ $saldoCair ?? 0 }}">
                    <input type="hidden" name="nama_pemilik_rekening" value="{{ $user->name }}">
                    <input type="hidden" name="nama_bank" id="input_nama_bank" required>
                    <input type="hidden" name="nomor_rekening" id="input_nomor_rekening" required>
                    
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2.5 px-1">Transfer Ke Rekening</label>
                    <div onclick="showPage2()" class="bg-white border-2 border-slate-200 hover:border-emerald-400 rounded-[1.5rem] p-4 flex items-center justify-between cursor-pointer shadow-sm hover:shadow-md transition-all group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-slate-50 text-slate-400 rounded-xl flex items-center justify-center border border-slate-200 group-hover:text-emerald-500 group-hover:bg-emerald-50 group-hover:border-emerald-200 transition-colors shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                            </div>
                            <div>
                                <p id="display_bank_name" class="text-sm font-black text-slate-800 transition-colors">Pilih Bank / E-Wallet</p>
                                <p id="display_bank_rek" class="text-[10px] font-bold text-rose-500 mt-0.5 uppercase tracking-widest">Belum Diatur</p>
                            </div>
                        </div>
                        <div class="w-8 h-8 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center group-hover:border-emerald-200 group-hover:bg-emerald-50 transition-colors shrink-0">
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-emerald-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" /></svg>
                        </div>
                    </div>

                    {{-- Info Tambahan --}}
                    <div class="mt-6 flex items-start gap-3 bg-emerald-50/50 border border-emerald-100 p-4 rounded-2xl">
                        <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <p class="text-[10px] font-medium text-emerald-700/80 leading-relaxed">Pencairan dana akan diproses secara manual demi keamanan. Maksimal proses adalah <b class="font-black text-emerald-700">1x24 Jam Kerja</b>.</p>
                    </div>
                </form>
            </div>

            {{-- Footer Aksi --}}
            <div class="p-6 bg-white border-t border-slate-100 shrink-0 rounded-b-[2.5rem]">
                <button type="button" id="btn-submit-payout" onclick="submitPayout()" disabled class="w-full bg-slate-900 hover:bg-emerald-600 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-slate-900/20 active:scale-95 transition-all opacity-50 cursor-not-allowed border border-slate-800 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Konfirmasi Tarik Dana
                </button>
            </div>
        </div>

        {{-- HALAMAN 2: PILIH BANK (DAFTAR BANK & E-WALLET DENGAN GAMBAR KUSTOM) --}}
        <div id="payout-page-2" class="w-full bg-slate-50 relative flex-col h-[560px] hidden">
            <div class="px-6 py-6 border-b border-slate-200 flex items-center gap-4 bg-white shadow-sm shrink-0 sticky top-0 z-20 rounded-t-[2.5rem]">
                <button type="button" onclick="showPage1()" class="text-slate-400 hover:text-slate-900 transition-colors p-2 -ml-2 rounded-xl hover:bg-slate-100 border border-transparent hover:border-slate-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" /></svg>
                </button>
                <h3 class="text-lg font-black text-slate-900 tracking-tight">Pilih Tujuan Dana</h3>
            </div>
            
            <div class="p-6 overflow-y-auto flex-grow custom-scrollbar">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 pl-2">Daftar Bank & E-Wallet Resmi</p>
                <div class="bg-white rounded-[1.5rem] border border-slate-200 shadow-sm overflow-hidden mb-6">
                    @php
                    $banks = [
                        // Ekstensi disesuaikan menjadi .jpg huruf kecil sesuai dengan folder public/logo_bank kamu
                        ['id' => 'BRI', 'name' => 'Bank BRI', 'img' => 'BRI.jpg'],
                        ['id' => 'Mandiri', 'name' => 'Bank Mandiri', 'img' => 'MANDIRI.jpg'],
                        ['id' => 'BNI', 'name' => 'Bank BNI', 'img' => 'BNI.jpg'],
                        ['id' => 'GoPay', 'name' => 'GoPay', 'img' => 'GOPAY.jpg'],
                        ['id' => 'DANA', 'name' => 'DANA', 'img' => 'DANA.jpg'],
                        ['id' => 'ShopeePay', 'name' => 'ShopeePay', 'img' => 'SHOPEEPAY.jpg']
                    ];
                    @endphp
                    
                    @foreach($banks as $bank)
                    <div class="border-b border-slate-100 last:border-0 group">
                        <div class="p-4 flex items-center justify-between cursor-pointer hover:bg-slate-50 transition-colors" onclick="toggleBankInput('{{ $bank['id'] }}')">
                            <div class="flex items-center gap-4">
                                {{-- Jalur asset diarahkan ke folder logo_bank/ --}}
                                <div class="w-12 h-8 rounded-lg overflow-hidden border border-slate-200/80 bg-white flex items-center justify-center p-1 shrink-0 shadow-sm">
                                    <img src="{{ asset('logo_bank/' . $bank['img']) }}" alt="Logo {{ $bank['name'] }}" class="w-full h-full object-contain">
                                </div>
                                <span class="text-sm font-bold text-slate-800">{{ $bank['name'] }}</span>
                            </div>
                            <div id="radio_{{ $bank['id'] }}" class="w-5 h-5 rounded-full border-2 border-slate-300 flex items-center justify-center transition-all bank-radio bg-white shadow-inner">
                                <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 scale-0 transition-transform"></div>
                            </div>
                        </div>
                        
                        {{-- Input Hidden Area --}}
                        <div id="input_area_{{ $bank['id'] }}" class="hidden p-5 bg-slate-50/80 border-t border-slate-100 bank-input-area shadow-inner">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Nomor Rekening / No. HP <span class="text-orange-500">*</span></label>
                            <input type="number" id="rek_{{ $bank['id'] }}" placeholder="Contoh: 08123456789 atau 872019..." class="w-full bg-white border border-slate-200 rounded-xl p-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none mb-3 placeholder:font-medium placeholder:text-slate-300 shadow-sm transition-all">
                            <button type="button" onclick="confirmBank('{{ $bank['name'] }}', '{{ $bank['id'] }}')" class="w-full bg-emerald-500 text-white py-3.5 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-emerald-600 transition-all shadow-md shadow-emerald-500/30 active:scale-95 border border-emerald-600">Simpan Rekening Ini</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </dialog>

    <footer class="mt-auto py-10 border-t border-slate-200 bg-white relative z-10">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em]">Hak Cipta Pengajar &copy; {{ date('Y') }} tempatles.id</p>
        </div>
    </footer>

    {{-- SCRIPT PENDUKUNG --}}
    <script>
    // Konfigurasi Style Global SweetAlert agar Senada dengan Dashboard
    const customSwalClasses = {
        popup: 'rounded-[2rem] p-6 border border-slate-100 shadow-2xl',
        title: 'text-2xl font-black text-slate-800 tracking-tight',
        htmlContainer: 'text-sm font-medium text-slate-500 mt-2',
        confirmButton: 'bg-rose-500 hover:bg-rose-600 text-white px-8 py-3.5 rounded-xl text-sm font-bold tracking-wide transition-all shadow-lg shadow-rose-500/30 w-full sm:w-auto',
        cancelButton: 'bg-slate-100 hover:bg-slate-200 text-slate-600 px-8 py-3.5 rounded-xl text-sm font-bold tracking-wide transition-all w-full sm:w-auto',
        actions: 'flex flex-col sm:flex-row gap-3 w-full sm:w-auto justify-center mt-6'
    };

    // Fungsi Konfirmasi Keluar Menggunakan SweetAlert2
    function confirmTutorLogout() {
        Swal.fire({
            title: 'Ingin mengakhiri sesi?',
            text: "Anda akan keluar dari panel Dashboard Kerja Tutor.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Keluar',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: customSwalClasses,
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Memproses...',
                    text: 'Sedang menutup sesi kerja Anda',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => { Swal.showLoading(); }
                });
                document.getElementById('logout-form').submit();
            }
        });
    }

    function openJournalModal(sessionId, mapel) {
        const dialogs = document.querySelectorAll('dialog');
        dialogs.forEach(d => { if (d.hasAttribute('open')) { d.close(); } });
        document.getElementById('input-session-id').value = sessionId;
        document.getElementById('label-mapel').innerText = mapel;
        document.getElementById('modal-jurnal').showModal();
    }
    
    function showPage2() {
        document.getElementById('payout-page-1').classList.add('hidden'); document.getElementById('payout-page-1').classList.remove('flex');
        document.getElementById('payout-page-2').classList.remove('hidden'); document.getElementById('payout-page-2').classList.add('flex');
    }
    function showPage1() {
        document.getElementById('payout-page-2').classList.add('hidden'); document.getElementById('payout-page-2').classList.remove('flex');
        document.getElementById('payout-page-1').classList.remove('hidden'); document.getElementById('payout-page-1').classList.add('flex');
    }
    function toggleBankInput(bankId) {
        document.querySelectorAll('.bank-input-area').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.bank-radio').forEach(el => {
            el.classList.remove('border-orange-500'); el.classList.add('border-slate-300');
            el.firstElementChild.classList.remove('scale-100'); el.firstElementChild.classList.add('scale-0');
        });
        document.getElementById('input_area_' + bankId).classList.remove('hidden');
        let radio = document.getElementById('radio_' + bankId);
        radio.classList.remove('border-slate-300'); radio.classList.add('border-orange-500');
        radio.firstElementChild.classList.remove('scale-0'); radio.firstElementChild.classList.add('scale-100');
    }
    function confirmBank(bankName, bankId) {
        let noRek = document.getElementById('rek_' + bankId).value;
        if (noRek.trim() === '') { alert('Silakan masukkan nomor rekening.'); return; }
        document.getElementById('input_nama_bank').value = bankName; document.getElementById('input_nomor_rekening').value = noRek;
        document.getElementById('display_bank_name').innerText = bankName; document.getElementById('display_bank_rek').innerText = noRek;
        let btn = document.getElementById('btn-submit-payout');
        btn.classList.remove('opacity-50', 'cursor-not-allowed'); btn.disabled = false;
        showPage1();
    }
    function submitPayout() {
        let bank = document.getElementById('input_nama_bank').value;
        if (!bank) { alert('Silakan pilih bank.'); return; }
        document.getElementById('form-payout').submit();
    }

    function openScheduleModal(sessionId, mapel) {
        const dialogs = document.querySelectorAll('dialog');
        dialogs.forEach(d => { if (d.hasAttribute('open')) { d.close(); } });
        
        // 1. Suntikkan data dinamis ke elemen modal
        document.getElementById('input-jadwal-session-id').value = sessionId;
        document.getElementById('label-jadwal-mapel').innerText = mapel;
        
        // 2. Buka modal (Action form tidak perlu diubah lagi karena sudah dikunci route)
        document.getElementById('modal-jadwal').showModal();
    }

    // Tambahkan di dalam <script> utama Anda
    const journalForm = document.querySelector('form[action="{{ route('tutor.journal.store') }}"]');
    journalForm.addEventListener('submit', function() {
        const btn = this.querySelector('button[type="submit"]');
        btn.disabled = true;
        btn.innerHTML = `
            <svg class="animate-spin h-4 w-4 text-white" viewBox="0 0 24 24" fill="none">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
            </svg>
            Mengirim...
        `;
    });
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
                customClass: { 
                    popup: 'rounded-[2rem]',
                    confirmButton: 'bg-emerald-500 hover:bg-emerald-600 text-white px-8 py-3 rounded-xl text-sm font-bold shadow-md transition-all' 
                },
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
                customClass: { 
                    popup: 'rounded-[2rem]',
                    confirmButton: 'bg-rose-500 hover:bg-rose-600 text-white px-8 py-3 rounded-xl text-sm font-bold shadow-md transition-all' 
                },
                buttonsStyling: false
            });
        });
    </script>
    @endif
</body>
</html>