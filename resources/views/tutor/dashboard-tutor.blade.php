<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Tutor - tempatles.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
    }

    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    .bg-pattern {
        background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
        background-size: 20px 20px;
    }
    </style>
</head>

<body class="bg-[#F8FAFC] text-slate-900 antialiased flex flex-col min-h-screen">

    {{-- NAVBAR PREMIUM --}}
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200/60 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 md:px-12 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <a href="/" class="flex items-center gap-2 group">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo"
                        class="h-9 transition-transform group-hover:scale-110">
                    <span class="font-black text-blue-950 text-xl tracking-tighter hidden sm:block">tempatles<span
                            class="text-orange-500">.id</span></span>
                </a>
            </div>

            <div class="flex items-center gap-5">
                <div class="hidden md:flex flex-col text-right border-r border-slate-200 pr-4">
                    <span
                        class="text-xs font-black text-slate-900 leading-none mb-1">{{ $user->name ?? 'Tutor' }}</span>
                    <div class="flex items-center justify-end gap-1.5">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest">Online</p>
                    </div>
                </div>

                {{-- TOMBOL LOGOUT --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="group flex items-center gap-2 bg-rose-50 hover:bg-rose-500 text-rose-500 hover:text-white px-4 py-2 rounded-xl font-bold text-xs transition-all duration-300 border border-rose-100 shadow-sm">
                        <span>Keluar</span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M17 16l4-4m0 0l-4-4m4 4H7" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    {{-- TUTUP NAVBAR DI SINI (PENTING!) --}}

    {{-- KONTEN UTAMA --}}
    <main class="max-w-7xl mx-auto w-full px-6 lg:px-8 pt-8 pb-20">

        @if(($user->tutorProfile->status_akun ?? 'pending') !== 'aktif')
        {{-- ========================================== --}}
        {{-- RUANG KARANTINA (WAITING ROOM) FULL PAGE --}}
        {{-- ========================================== --}}
        <div
            class="bg-white rounded-[3rem] p-10 md:p-20 text-center border border-slate-200 shadow-sm max-w-3xl mx-auto mt-10">
            <div class="relative w-32 h-32 mx-auto mb-8">
                <div class="absolute inset-0 bg-orange-100 rounded-full animate-ping opacity-50"></div>
                <div
                    class="relative w-full h-full bg-orange-50 text-orange-500 rounded-full flex items-center justify-center border border-orange-100 shadow-inner">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <h1 class="text-3xl md:text-4xl font-black text-slate-900 mb-4 tracking-tight">Akun Sedang Divalidasi</h1>
            <p class="text-slate-500 text-base md:text-lg mb-8 leading-relaxed">
                Terima kasih telah melengkapi profil Anda! Saat ini <span class="font-bold text-slate-800">Admin</span>
                sedang meninjau dokumen legalitas dan data diri Anda. Proses ini biasanya memakan waktu
                1x24 Jam kerja.
            </p>

            <div
                class="bg-slate-50 border border-slate-100 rounded-2xl p-6 mb-8 text-left inline-block w-full md:w-auto">
                <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Status Berkas Anda:</p>
                <ul class="space-y-3">
                    <li class="flex items-center gap-3 text-sm font-bold text-emerald-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Formulir Biodata Diterima
                    </li>
                    <li class="flex items-center gap-3 text-sm font-bold text-emerald-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Link GDrive Tersimpan
                    </li>
                    <li class="flex items-center gap-3 text-sm font-bold text-orange-500 animate-pulse">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Pengecekan Manual oleh Admin
                    </li>
                </ul>
            </div>

            <p class="text-xs text-slate-400">Seluruh fitur pengajaran akan otomatis terbuka setelah akun Anda berstatus
                <span class="font-bold text-emerald-500">AKTIF</span>.
            </p>
        </div>

        @else
        {{-- ========================================== --}}
        {{-- DASHBOARD UTAMA (JIKA SUDAH AKTIF) --}}
        {{-- ========================================== --}}

        {{-- HERO WELCOME BANNER (Kompak, Bersih & Elegan) --}}
        <div
            class="bg-blue-950 rounded-[2rem] p-6 lg:p-8 mb-8 relative overflow-hidden shadow-xl shadow-blue-950/10 border border-blue-900">
            <div class="absolute inset-0 bg-pattern opacity-10"></div>
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-orange-500 rounded-full blur-[100px] opacity-20"></div>
            <div class="absolute -bottom-20 -left-20 w-72 h-72 bg-blue-500 rounded-full blur-[80px] opacity-20"></div>

            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="text-center md:text-left">
                    <p class="text-orange-400 font-bold mb-1 uppercase tracking-[0.2em] text-[10px]">Dashboard Pengajar
                    </p>
                    <h1 class="text-2xl lg:text-3xl font-black text-white mb-2">Siap Menginspirasi Hari Ini?</h1>
                    <p class="text-blue-200 font-medium text-xs lg:text-sm max-w-xl">Jadilah versi terbaik dirimu. Atur
                        jadwal, kelola kelas, dan pantau penghasilanmu dengan mudah.</p>
                </div>
                <div class="relative z-10 flex w-full md:w-auto shrink-0">
                    <a href="{{ route('katalog.publik') }}"
                        class="text-center flex-1 md:flex-none bg-white/10 hover:bg-white/20 border border-white/20 text-white px-6 py-3.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all backdrop-blur-sm">
                        Lihat Profil
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- KIRI: PESANAN, JURNAL, & ETALASE PAKET --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- ETALASE PAKET --}}
                <a href="{{ route('tutor.packages.index') }}"
                    class="block bg-white p-6 rounded-[2rem] border border-slate-200 shadow-sm hover:border-blue-300 transition-all group">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-black text-slate-800 text-lg">Kelola Etalase Paket</p>
                                <p class="text-sm text-slate-500">Anda memiliki <span
                                        class="font-bold text-blue-600">{{ $totalPaket ?? 0 }} kelas aktif</span> yang
                                    siap dipesan murid.</p>
                            </div>
                        </div>
                        <div
                            class="w-10 h-10 bg-slate-50 rounded-full flex items-center justify-center text-slate-400 group-hover:bg-blue-50 group-hover:text-blue-600 transition-all">
                            <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>
                {{-- 2. MANAJEMEN PESANAN --}}
                <a href="{{ route('tutor.orders.index') }}"
                    class="bg-blue-950 p-6 rounded-[2rem] border border-blue-900 shadow-xl shadow-blue-900/10 hover:bg-blue-900 transition-all group flex flex-col justify-between hover:-translate-y-1">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 bg-white/10 text-blue-200 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                        <div
                            class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center text-blue-200 group-hover:bg-white group-hover:text-blue-950 transition-all">
                            <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-white leading-tight">Manajemen Pesanan</h3>
                        <p class="text-xs font-medium text-blue-200 mt-1">Terima, tolak, & cek jadwal.</p>
                    </div>
                </a>
                {{-- RADAR PESANAN --}}
                <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm p-6 lg:p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="font-black text-slate-800 text-lg">Radar Pesanan</h2>
                            <p class="text-xs text-slate-500 font-medium">Permintaan masuk dari calon murid</p>
                        </div>
                    </div>

                    @forelse($pesananBaru ?? [] as $pesanan)
                    <div
                        class="flex flex-col md:flex-row items-center justify-between gap-4 p-4 mb-4 border border-orange-100 bg-orange-50/30 rounded-2xl transition-all hover:bg-orange-50">
                        <div>
                            <h3 class="font-bold text-slate-900">{{ $pesanan->murid->name ?? 'Siswa' }} <span
                                    class="text-xs font-normal text-slate-500">ingin memesan</span></h3>
                            <p class="text-sm font-medium text-blue-700">
                                {{ $pesanan->paket->nama_paket ?? 'Paket Belajar' }}</p>
                            <p class="text-xs text-slate-500 mt-1">Total: Rp
                                {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex gap-2 w-full md:w-auto">
                            <button
                                class="flex-1 md:flex-none bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg text-xs font-bold transition-all shadow-md shadow-emerald-500/20">Terima</button>
                            <button
                                class="flex-1 md:flex-none bg-white border border-rose-200 text-rose-500 hover:bg-rose-50 px-4 py-2 rounded-lg text-xs font-bold transition-all">Tolak</button>
                        </div>
                    </div>
                    @empty
                    <div class="bg-slate-50/50 border border-dashed border-slate-200 rounded-[1.5rem] p-8">
                        <div class="flex flex-col md:flex-row items-center gap-8">
                            <div
                                class="w-32 h-32 bg-white rounded-2xl shadow-sm border border-slate-100 flex items-center justify-center shrink-0 relative">
                                <div
                                    class="absolute -top-3 -right-3 w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center text-white text-lg shadow-md rotate-12">
                                    🚀</div>
                                <svg class="w-16 h-16 text-slate-200" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                                </svg>
                            </div>
                            <div class="text-center md:text-left">
                                <h3 class="text-lg font-black text-slate-800 mb-2">Toko Anda Sedang Sepi!</h3>
                                <p class="text-slate-500 text-sm mb-4 leading-relaxed">Belum ada murid yang mengetuk
                                    pintu. Pastikan Anda melakukan 3 langkah ini agar profil Anda dilirik oleh ratusan
                                    murid:</p>
                                <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                                    <span
                                        class="px-3 py-1 bg-white border border-slate-200 text-xs font-bold text-slate-600 rounded-full">1.
                                        Lengkapi Biodata</span>
                                    <span
                                        class="px-3 py-1 bg-white border border-slate-200 text-xs font-bold text-slate-600 rounded-full">2.
                                        Buat Paket Menarik</span>
                                    <span
                                        class="px-3 py-1 bg-white border border-slate-200 text-xs font-bold text-slate-600 rounded-full">3.
                                        Pasang Foto Profesional</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>

                {{-- JURNAL MENGAJAR (JADWAL HARI INI) --}}
                <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm p-6 lg:p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="font-black text-slate-800 text-lg">Tugas & Jurnal</h2>
                            <p class="text-xs text-slate-500 font-medium">Sesi yang menunggu konfirmasimu</p>
                        </div>
                    </div>

                    @forelse($jurnalTertunda ?? [] as $jurnal)
                    <div
                        class="flex flex-col md:flex-row items-center justify-between gap-4 p-4 mb-4 border border-slate-100 rounded-2xl hover:border-blue-200 transition-all">
                        <div class="flex items-start gap-4">
                            <div
                                class="bg-blue-50 text-blue-600 w-12 h-12 rounded-xl flex flex-col items-center justify-center shrink-0">
                                <span class="text-[10px] font-bold uppercase">Sesi</span>
                                <span class="font-black text-lg leading-none">#{{ $jurnal->pertemuan_ke ?? 1 }}</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900">{{ $jurnal->paket->nama_paket ?? 'Paket' }}</h3>
                                <p class="text-xs font-medium text-rose-500 mt-1 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Segera isi jurnal untuk mencegah Strike!
                                </p>
                            </div>
                        </div>
                        <button
                            class="w-full md:w-auto bg-blue-50 hover:bg-blue-600 text-blue-600 hover:text-white px-4 py-2 rounded-lg text-xs font-bold transition-all border border-blue-200">
                            Isi Jurnal & Absen
                        </button>
                    </div>
                    @empty
                    <div
                        class="flex items-center justify-center gap-4 bg-emerald-50 border border-emerald-100 rounded-[1.5rem] p-6">
                        <div
                            class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-emerald-800">Semua Terkendali!</h3>
                            <p class="text-emerald-600 text-xs">Kamu tidak memiliki tanggungan jurnal absensi hari ini.
                            </p>
                        </div>
                    </div>
                    @endforelse
                </div>

                {{-- DAFTAR PAKET BELAJAR AKTIF (ESCROW) --}}
                <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden mb-12">
                    <div class="p-6 lg:p-8 border-b border-slate-100">
                        <h2 class="font-black text-slate-800 text-lg">Paket Belajar Aktif (Escrow)</h2>
                        <p class="text-xs text-slate-500 font-medium mt-1">Pantau progress kelas dan cairkan dana Anda.
                        </p>
                    </div>

                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50 border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    Informasi Paket</th>
                                <th
                                    class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                    Progress Sesi</th>
                                <th
                                    class="px-6 py-4 text-right text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($activeOrders ?? [] as $order)
                            @php
                            $completedJournals = $order->sessions->whereNotNull('teachingJournal')->count();
                            $isCompleted = ($completedJournals >= $order->jumlah_sesi);
                            @endphp
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-5">
                                    <p class="text-sm font-black text-slate-900">{{ $order->mata_pelajaran }}</p>
                                    <p class="text-[11px] font-bold text-blue-600 uppercase mt-1">Murid:
                                        {{ $order->murid->name }}</p>
                                    <p class="text-[9px] text-slate-400 font-mono mt-0.5">
                                        #ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</p>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex flex-col items-center gap-2">
                                        <div class="w-32 bg-slate-100 h-2 rounded-full overflow-hidden">
                                            <div class="bg-emerald-500 h-full transition-all duration-500"
                                                style="width: {{ ($order->jumlah_sesi > 0) ? ($completedJournals / $order->jumlah_sesi) * 100 : 0 }}%">
                                            </div>
                                        </div>
                                        <span
                                            class="text-[10px] font-black text-slate-700 uppercase">{{ $completedJournals }}/{{ $order->jumlah_sesi }}
                                            Sesi Selesai</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    @if($isCompleted)
                                    <button
                                        class="bg-emerald-500 text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-emerald-600 transition-all shadow-lg shadow-emerald-500/20 whitespace-nowrap">
                                        Tarik Dana (Rp {{ number_format($order->total_harga_sesi, 0, ',', '.') }})
                                    </button>
                                    @else
                                    <button
                                        onclick="document.getElementById('modal-daftar-sesi-{{ $order->id }}').showModal()"
                                        class="bg-blue-950 text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-orange-500 transition-all shadow-md whitespace-nowrap">
                                        Lihat & Isi Jurnal
                                    </button>
                                    @endif
                                </td>
                            </tr>

                            {{-- MODAL DAFTAR SESI PER PAKET --}}
                            <dialog id="modal-daftar-sesi-{{ $order->id }}"
                                class="rounded-[2.5rem] p-0 border border-slate-200 shadow-2xl backdrop:bg-slate-900/60 backdrop:backdrop-blur-sm m-auto w-full max-w-xl">
                                <div class="w-full bg-white relative">
                                    <button type="button" onclick="this.closest('dialog').close()"
                                        class="absolute top-6 right-6 w-10 h-10 flex items-center justify-center bg-slate-50 hover:bg-rose-50 text-slate-400 hover:text-rose-500 rounded-full transition-colors z-20">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>

                                    <div class="p-8 md:p-10 relative z-10">
                                        <div class="mb-8">
                                            <h3 class="text-2xl font-black text-slate-900 tracking-tight">Daftar Sesi
                                                Pertemuan</h3>
                                            <p class="text-xs font-bold text-blue-600 uppercase mt-1">
                                                {{ $order->mata_pelajaran }}</p>
                                        </div>

                                        <div class="space-y-4 max-h-[50vh] overflow-y-auto pr-2 custom-scrollbar">
                                            @foreach($order->sessions as $session)
                                            <div
                                                class="p-4 rounded-2xl border {{ $session->teachingJournal ? 'bg-emerald-50 border-emerald-100' : 'bg-slate-50 border-slate-100' }} flex justify-between items-center transition-all">
                                                <div>
                                                    <p class="text-xs font-black text-slate-900 uppercase mb-1">
                                                        Pertemuan Ke-{{ $session->pertemuan_ke }}</p>
                                                    <p class="text-[10px] font-medium text-slate-500">
                                                        {{ \Carbon\Carbon::parse($session->tanggal_jadwal)->translatedFormat('d M Y') }}
                                                        • {{ $session->waktu_mulai }} WIB</p>
                                                </div>
                                                @if($session->teachingJournal)
                                                <span
                                                    class="text-[9px] font-black text-emerald-600 uppercase tracking-widest bg-white px-3 py-1 rounded-lg border border-emerald-100 shadow-sm">Selesai</span>
                                                @else
                                                <button
                                                    onclick="openJournalModal({{ $session->id }}, '{{ $order->mata_pelajaran }}')"
                                                    class="bg-blue-950 text-white px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-orange-500 transition-all shadow-sm">
                                                    Isi Jurnal
                                                </button>
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </dialog>
                            @empty
                            <tr>
                                <td colspan="3"
                                    class="px-6 py-12 text-center text-slate-400 font-medium italic text-sm">
                                    <p>Belum ada paket belajar yang aktif.</p>
                                    <p class="text-[10px] not-italic mt-1 text-slate-400 font-normal">Uang murid akan
                                        muncul di sini setelah pembayaran divalidasi admin.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- KANAN: PROFIL, FINANSIAL & REPUTASI --}}
            <div class="space-y-6">

                {{-- KARTU PROFIL TUTOR --}}
                <div
                    class="bg-white rounded-[2rem] border border-slate-200 shadow-sm p-6 relative overflow-hidden group">
                    <div class="absolute top-0 left-0 w-full h-20 bg-gradient-to-r from-blue-50 to-orange-50"></div>

                    <div class="relative z-10 flex flex-col items-center mt-2">
                        <div class="relative mb-3">
                            <div class="w-20 h-20 bg-white rounded-full p-1 shadow-sm border border-slate-100">
                                <div
                                    class="w-full h-full bg-slate-200 rounded-full flex items-center justify-center overflow-hidden">
                                    @if($user->tutorProfile->foto ?? false)
                                    <img src="{{ asset('storage/' . $user->tutorProfile->foto) }}" alt="Profil"
                                        class="w-full h-full object-cover">
                                    @else
                                    <span
                                        class="text-2xl font-black text-slate-400">{{ substr($user->name ?? 'T', 0, 1) }}</span>
                                    @endif
                                </div>
                            </div>
                            @if(($user->tutorProfile->status_akun ?? '') === 'aktif')
                            <div class="absolute bottom-1 right-1 w-6 h-6 bg-emerald-500 rounded-full flex items-center justify-center border-2 border-white text-white shadow-sm"
                                title="Terverifikasi">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            @endif
                        </div>

                        <h3 class="text-lg font-black text-slate-800 text-center">{{ $user->name ?? 'Nama Tutor' }}</h3>
                        <p class="text-xs font-bold text-orange-500 uppercase tracking-widest mt-1 mb-4 text-center">
                            {{ $user->tutorProfile->bidang ?? 'Belum ada spesialisasi' }}
                        </p>

                        <div class="w-full grid grid-cols-2 gap-2 border-t border-slate-100 pt-4">
                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center justify-center gap-1.5 text-xs font-bold text-slate-600 bg-slate-50 hover:bg-slate-100 py-2.5 rounded-xl transition-colors border border-slate-100">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                Edit Profil
                            </a>
                            <a href="{{ route('katalog.publik') }}"
                                class="flex items-center justify-center gap-1.5 text-xs font-bold text-blue-600 bg-blue-50 hover:bg-blue-100 py-2.5 rounded-xl transition-colors border border-blue-100">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Pratinjau
                            </a>
                        </div>
                    </div>
                </div>

                {{-- KARTU DOMPET PREMIUM --}}
                <div
                    class="relative bg-gradient-to-tr from-slate-900 via-blue-950 to-slate-800 rounded-[2rem] p-7 shadow-xl shadow-blue-900/20 overflow-hidden">
                    <div class="absolute top-0 right-0 w-40 h-40 bg-white opacity-5 rounded-full blur-2xl"></div>
                    <div class="flex justify-between items-start mb-8 relative z-10">
                        <div class="w-10 h-8 bg-gradient-to-br from-yellow-200 to-yellow-500 rounded-md opacity-80">
                        </div>
                        <span class="text-white/50 text-[10px] font-black uppercase tracking-[0.3em]">Dompet
                            Digital</span>
                    </div>

                    <div class="relative z-10 mb-6">
                        <p class="text-slate-400 text-xs font-medium mb-1">Saldo Tersedia</p>
                        <h3 class="text-3xl font-black text-white tracking-tight">Rp
                            {{ number_format($saldoCair ?? 0, 0, ',', '.') }}</h3>
                    </div>

                    <div
                        class="flex items-center justify-between p-3 bg-white/10 rounded-xl backdrop-blur-sm border border-white/10 relative z-10 mb-6">
                        <div>
                            <p class="text-[10px] text-slate-300 font-bold uppercase tracking-widest">Dana Escrow</p>
                            <p class="text-sm font-black text-white">Rp
                                {{ number_format($danaTertahan ?? 0, 0, ',', '.') }}</p>
                        </div>
                        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>

                    <button
                        class="relative z-10 w-full bg-orange-500 hover:bg-orange-400 text-white py-3.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all {{ ($saldoCair ?? 0) <= 0 ? 'opacity-50 cursor-not-allowed' : 'shadow-lg shadow-orange-500/30' }}"
                        {{ ($saldoCair ?? 0) <= 0 ? 'disabled' : '' }}>
                        Tarik Saldo
                    </button>
                </div>

                {{-- MINI WIDGETS GRID --}}
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white p-5 rounded-[2rem] border border-slate-200 shadow-sm text-center">
                        <div
                            class="w-10 h-10 bg-yellow-50 text-yellow-500 rounded-full flex items-center justify-center mx-auto mb-2 text-lg">
                            ⭐</div>
                        <p class="font-black text-slate-800 text-xl leading-none">{{ number_format($rating ?? 0, 1) }}
                        </p>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Rating</p>
                    </div>
                    <div class="bg-white p-5 rounded-[2rem] border border-slate-200 shadow-sm text-center">
                        <div
                            class="w-10 h-10 bg-rose-50 text-rose-500 rounded-full flex items-center justify-center mx-auto mb-2 text-lg font-black">
                            !</div>
                        <p class="font-black text-slate-800 text-xl leading-none">{{ $strike ?? 0 }}/3</p>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Strike</p>
                    </div>
                </div>

            </div>
        </div>

        @endif
    </main>

    {{-- MODAL INPUT JURNAL & ABSENSI --}}
    <dialog id="modal-jurnal"
        class="rounded-[2.5rem] p-0 border border-slate-200 shadow-2xl backdrop:bg-slate-900/60 backdrop:backdrop-blur-sm m-auto w-full max-w-xl">
        <div class="w-full bg-white relative">
            <button type="button" onclick="this.closest('dialog').close()"
                class="absolute top-6 right-6 w-10 h-10 flex items-center justify-center bg-slate-50 hover:bg-rose-50 text-slate-400 hover:text-rose-500 rounded-full transition-colors z-20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="p-8 md:p-10 relative z-10">
                <div class="mb-8">
                    <h3 class="text-2xl font-black text-slate-900 tracking-tight">Laporan Jurnal Mengajar</h3>
                    <p id="label-mapel" class="text-xs font-bold text-blue-600 uppercase mt-1"></p>
                </div>

                <form action="{{ route('tutor.journal.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    <input type="hidden" name="order_session_id" id="input-session-id">

                    <div>
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-widest mb-2">Catatan
                            Materi</label>
                        <textarea name="materi_pembahasan" rows="3" required
                            placeholder="Contoh: Pembahasan limit fungsi aljabar dan latihan soal nomor 1-10..."
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-medium text-slate-900 focus:ring-2 focus:ring-blue-900 transition-all outline-none resize-none"></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-widest mb-2">Upload
                            Foto Absensi</label>
                        <div
                            class="relative bg-slate-50 border border-slate-200 rounded-2xl p-2 focus-within:ring-2 focus-within:ring-blue-900 transition-all">
                            <input type="file" name="foto_bukti" required
                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 cursor-pointer">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-widest mb-2">Modul /
                            Materi Belajar (PDF - Opsional)</label>
                        <div
                            class="relative bg-orange-50/50 border border-orange-100 rounded-2xl p-2 focus-within:ring-2 focus-within:ring-orange-500 transition-all">
                            <input type="file" name="file_materi" accept=".pdf,.ppt,.pptx,.doc,.docx"
                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-orange-100 file:text-orange-700 hover:file:bg-orange-200 cursor-pointer">
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit"
                            class="w-full bg-blue-950 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-blue-950/20 hover:bg-orange-500 transition-all active:scale-95">
                            Kirim Laporan Sesi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>

    <footer class="mt-auto py-10 border-t border-slate-200 bg-white">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em]">Hak Cipta Pengajar &copy;
                {{ date('Y') }} tempatles.id</p>
        </div>
    </footer>

    <script>
    function openJournalModal(sessionId, mapel) {
        // Tutup modal daftar sesi jika sedang terbuka
        const dialogs = document.querySelectorAll('dialog');
        dialogs.forEach(d => {
            if (d.hasAttribute('open')) {
                d.close();
            }
        });

        // Set data ke modal jurnal
        document.getElementById('input-session-id').value = sessionId;
        document.getElementById('label-mapel').innerText = mapel;

        // Buka modal jurnal
        document.getElementById('modal-jurnal').showModal();
    }
    </script>

</body>

</html>