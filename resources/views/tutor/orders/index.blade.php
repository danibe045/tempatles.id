<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pesanan - tempatles.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        .bg-pattern {
            background-image: radial-gradient(#cbd5e1 1.5px, transparent 1.5px);
            background-size: 28px 28px;
        }

        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

        .tab-content {
            display: none;
            animation: fadeIn 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        #tab-1:checked ~ .tab-nav label[for="tab-1"],
        #tab-2:checked ~ .tab-nav label[for="tab-2"],
        #tab-3:checked ~ .tab-nav label[for="tab-3"],
        #tab-4:checked ~ .tab-nav label[for="tab-4"] {
            background-color: #0f172a; 
            color: #ffffff;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transform: scale(1.02);
            border-color: #0f172a;
        }
        
        #tab-1:checked ~ .tab-nav label[for="tab-1"] span,
        #tab-2:checked ~ .tab-nav label[for="tab-2"] span,
        #tab-3:checked ~ .tab-nav label[for="tab-3"] span,
        #tab-4:checked ~ .tab-nav label[for="tab-4"] span {
            background-color: #ffffff;
            color: #0f172a;
        }

        #tab-1:checked ~ #content-1,
        #tab-2:checked ~ #content-2,
        #tab-3:checked ~ #content-3,
        #tab-4:checked ~ #content-4 {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
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
    <div class="fixed inset-0 bg-pattern opacity-40 z-[-1] pointer-events-none"></div>

    {{-- NAVBAR SUB-PAGE --}}
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-200/60 shadow-sm shrink-0">
        <div class="max-w-7xl mx-auto px-6 md:px-12 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <a href="/" class="flex items-center gap-2 group">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-8 md:h-9 transition-transform group-hover:scale-110">
                    <span class="font-black text-blue-950 text-xl tracking-tighter hidden sm:block">tempatles<span class="text-orange-500">.id</span></span>
                </a>
            </div>

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
    </nav>

    {{-- MAIN CONTENT (Natural Flow - Scroll Normal Halaman) --}}
    <main class="py-8 md:py-12 relative z-10 flex-grow">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 w-full flex flex-col">

            {{-- HEADER HALAMAN (Gaya Premium) --}}
            <div class="bg-blue-950 border border-blue-900 shadow-2xl shadow-blue-900/20 rounded-[2.5rem] p-8 md:p-10 mb-8 relative overflow-hidden shrink-0">
                <div class="absolute -top-20 -right-20 w-80 h-80 bg-blue-500 rounded-full blur-[80px] opacity-40 pointer-events-none"></div>
                <div class="absolute -bottom-20 -left-10 w-64 h-64 bg-orange-500 rounded-full blur-[80px] opacity-30 pointer-events-none"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6 w-full">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-orange-400 px-4 py-2 rounded-full mb-4 backdrop-blur-md">
                            <span class="text-[10px] font-black uppercase tracking-[0.25em] text-white">Riwayat Transaksi</span>
                        </div>
                        <h2 class="font-black text-3xl md:text-4xl text-white leading-tight tracking-tight mb-3">Manajemen Pesanan</h2>
                        <p class="text-sm text-blue-200 font-medium max-w-xl leading-relaxed">Kelola permintaan murid baru, pantau kelas yang sedang berjalan, dan riwayat pesanan Anda di satu tempat.</p>
                    </div>
                    <div class="hidden md:flex items-center justify-center w-28 h-28 bg-white/5 backdrop-blur-md rounded-full border border-white/10 shadow-inner shrink-0 text-white">
                        <span class="text-5xl">💼</span>
                    </div>
                </div>
            </div>

            @if(session('success'))
            <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 shadow-sm rounded-2xl flex items-center gap-4 animate-bounce-short w-fit shrink-0">
                <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center shrink-0 shadow-md shadow-emerald-500/20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                </div>
                <div>
                    <h4 class="font-black text-sm text-emerald-900">Aksi Berhasil!</h4>
                    <span class="font-medium text-xs text-emerald-700">{{ session('success') }}</span>
                </div>
            </div>
            @endif

            {{-- BUNGKUSAN TABS & KONTEN --}}
            <div class="relative w-full">
                
                <input type="radio" name="tabs" id="tab-1" class="hidden" checked>
                <input type="radio" name="tabs" id="tab-2" class="hidden">
                <input type="radio" name="tabs" id="tab-3" class="hidden">
                <input type="radio" name="tabs" id="tab-4" class="hidden">

                {{-- Container Tab Menu --}}
                <div class="tab-nav flex gap-2 bg-slate-200/50 p-2 rounded-[1.5rem] overflow-x-auto hide-scrollbar w-max max-w-full border border-slate-200/60 shadow-inner mb-6 shrink-0 sticky top-24 z-20 backdrop-blur-md">
                    <label for="tab-1" class="cursor-pointer px-6 py-3 rounded-xl border border-transparent text-[11px] font-black uppercase tracking-widest text-slate-500 hover:text-slate-800 transition-all select-none whitespace-nowrap flex items-center gap-2">
                        Pesanan Baru
                        <span class="bg-slate-200 text-slate-600 px-2 py-0.5 rounded-md text-[9px] transition-colors">{{ count($pesananBaru ?? []) }}</span>
                    </label>
                    <label for="tab-2" class="cursor-pointer px-6 py-3 rounded-xl border border-transparent text-[11px] font-black uppercase tracking-widest text-slate-500 hover:text-slate-800 transition-all select-none whitespace-nowrap flex items-center gap-2">
                        Sedang Berjalan
                        <span class="bg-slate-200 text-slate-600 px-2 py-0.5 rounded-md text-[9px] transition-colors">{{ count($pesananBerjalan ?? []) }}</span>
                    </label>
                    <label for="tab-3" class="cursor-pointer px-6 py-3 rounded-xl border border-transparent text-[11px] font-black uppercase tracking-widest text-slate-500 hover:text-slate-800 transition-all select-none whitespace-nowrap flex items-center gap-2">
                        Selesai
                        <span class="bg-slate-200 text-slate-600 px-2 py-0.5 rounded-md text-[9px] transition-colors">{{ count($pesananSelesai ?? []) }}</span>
                    </label>
                    <label for="tab-4" class="cursor-pointer px-6 py-3 rounded-xl border border-transparent text-[11px] font-black uppercase tracking-widest text-slate-500 hover:text-slate-800 transition-all select-none whitespace-nowrap flex items-center gap-2">
                        Batal / Komplain
                        <span class="bg-slate-200 text-slate-600 px-2 py-0.5 rounded-md text-[9px] transition-colors">{{ count($pesananDibatalkan ?? []) }}</span>
                    </label>
                </div>

                {{-- ========================================== --}}
                {{-- KONTEN TAB 1: PESANAN BARU                 --}}
                {{-- ========================================== --}}
                <div id="content-1" class="tab-content w-full pb-8">
                    <div class="flex flex-col gap-5">
                        @forelse($pesananBaru ?? [] as $order)
                        <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm hover:shadow-[0_8px_30px_rgb(249,115,22,0.08)] hover:border-orange-200 transition-all duration-300 p-5 md:p-6 flex flex-col lg:flex-row lg:items-center justify-between gap-6 group relative overflow-hidden border-l-[6px] border-l-orange-400">
                            
                            {{-- Ornamen Latar Tipis (Biar kesan premium) --}}
                            <div class="absolute -right-10 -top-10 w-32 h-32 bg-orange-50 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                            {{-- Info Kiri: Murid & Mapel --}}
                            <div class="flex items-start md:items-center gap-5 lg:w-[40%] relative z-10">
                                <div class="w-14 h-14 bg-gradient-to-br from-orange-50 to-orange-100 rounded-[1.2rem] flex items-center justify-center text-orange-600 font-black text-xl border border-orange-200 shrink-0 shadow-inner">
                                    {{ substr($order->murid->name ?? 'M', 0, 1) }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 mb-1.5">
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest bg-slate-50 px-2 py-0.5 rounded-md border border-slate-100">#ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</p>
                                        <span class="flex h-2 w-2 relative" title="Pesanan Baru">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                                        </span>
                                    </div>
                                    <h3 class="text-lg font-black text-slate-900 leading-tight line-clamp-1 group-hover:text-orange-600 transition-colors">{{ $order->mata_pelajaran }}</h3>
                                    <p class="text-[11px] font-bold text-slate-500 mt-1 flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        {{ $order->murid->name }}
                                    </p>
                                </div>
                            </div>

                            {{-- Info Tengah: Harga & Sesi --}}
                            <div class="flex items-center justify-between lg:justify-center gap-4 lg:gap-8 bg-slate-50 rounded-2xl p-4 lg:w-[35%] border border-slate-100 relative z-10">
                                <div class="text-left lg:text-center">
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Pendapatan Bersih</p>
                                    <p class="text-base font-black text-emerald-600 tracking-tight">Rp {{ number_format($order->total_harga_sesi, 0, ',', '.') }}</p>
                                </div>
                                <div class="w-px h-8 bg-slate-200 hidden lg:block"></div>
                                <div class="text-right lg:text-center">
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Pertemuan</p>
                                    <p class="text-base font-black text-slate-700 tracking-tight">{{ $order->jumlah_sesi }} <span class="text-xs font-bold text-slate-500">Sesi</span></p>
                                </div>
                            </div>

                            {{-- Info Kanan: Tombol Aksi --}}
                            <div class="flex flex-col sm:flex-row items-center gap-3 lg:w-[25%] relative z-10">
                                {{-- Tombol Tolak --}}
                                <button type="button" 
                                        onclick="confirmAction(document.getElementById('form-tolak-{{ $order->id }}'), 'Yakin ingin menolak pesanan ini?')"
                                        class="w-full bg-white border border-slate-200 text-slate-400 hover:bg-rose-50 hover:border-rose-200 hover:text-rose-500 py-3 lg:px-4 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all active:scale-95 text-center">
                                    Tolak
                                </button>
                                <form id="form-tolak-{{ $order->id }}" action="{{ route('tutor.orders.reject', $order->id) }}" method="POST">
                                    @csrf
                                </form>

                                {{-- Tombol Terima --}}
                                <form id="form-terima-{{ $order->id }}" action="{{ route('tutor.orders.accept', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="button" 
                                            onclick="confirmAction(document.getElementById('form-terima-{{ $order->id }}'), 'Pesanan akan disetujui. Lanjutkan?')"
                                            class="w-full bg-slate-900 hover:bg-emerald-500 text-white py-3 lg:px-6 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-md active:scale-95 flex items-center justify-center gap-2 border border-slate-800 hover:border-emerald-500">
                                        Terima <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg> 
                                    </button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full bg-white border border-dashed border-slate-300 rounded-[2rem] p-16 flex flex-col items-center justify-center text-center shadow-sm">
                            <div class="w-16 h-16 bg-orange-50 rounded-full flex items-center justify-center mb-4 border border-orange-100 shadow-sm"><span class="text-3xl">📭</span></div>
                            <h3 class="text-lg font-black text-slate-800 mb-1">Belum Ada Pesanan Baru</h3>
                            <p class="text-slate-500 text-xs font-medium">Saat ini tidak ada permintaan pesanan kelas dari murid.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                {{-- ========================================== --}}
                {{-- KONTEN TAB 2: SEDANG BERJALAN              --}}
                {{-- ========================================== --}}
                <div id="content-2" class="tab-content w-full pb-8">
                    <div class="flex flex-col gap-4">
                        @forelse($pesananBerjalan ?? [] as $order)
                        @php
                            $completedJournals = $order->sessions->whereNotNull('teachingJournal')->count();
                            $isCompleted = ($completedJournals >= $order->jumlah_sesi);
                            $progressPercentage = ($order->jumlah_sesi > 0) ? ($completedJournals / $order->jumlah_sesi) * 100 : 0;
                        @endphp
                        
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all p-5 flex flex-col lg:flex-row lg:items-center justify-between gap-5 border-l-[6px] {{ $order->status_pesanan == 'menunggu_pembayaran' ? 'border-l-orange-400' : 'border-l-blue-500' }} group">
                            
                            {{-- Info Kiri: Murid, Mapel, Status --}}
                            <div class="flex items-center gap-4 lg:w-[40%]">
                                <div class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center text-slate-600 font-black text-lg border border-slate-200 shrink-0">
                                    {{ substr($order->murid->name ?? 'S', 0, 1) }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 mb-0.5">
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">#ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</p>
                                        @if($order->status_pesanan == 'menunggu_pembayaran')
                                            <span class="bg-orange-50 text-orange-600 px-1.5 py-0.5 rounded text-[8px] font-black uppercase tracking-widest border border-orange-100">Belum Bayar</span>
                                        @else
                                            <span class="bg-blue-50 text-blue-600 px-1.5 py-0.5 rounded text-[8px] font-black uppercase tracking-widest flex items-center gap-1 border border-blue-100"><span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span> Aktif</span>
                                        @endif
                                    </div>
                                    <h3 class="text-base font-black text-slate-900 leading-tight line-clamp-1 group-hover:text-blue-600 transition-colors">{{ $order->mata_pelajaran }}</h3>
                                    <p class="text-[10px] font-bold text-slate-500 mt-1">Siswa: <span class="text-slate-700">{{ $order->murid->name }}</span></p>
                                </div>
                            </div>

                            {{-- Info Tengah: Progress Bar --}}
                            <div class="flex-1 lg:px-6 py-3 bg-slate-50 rounded-xl border border-slate-100 my-2 lg:my-0 w-full lg:w-auto">
                                <div class="flex justify-between items-end mb-1.5">
                                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Progress Sesi</span>
                                    <span class="text-[10px] font-black {{ $isCompleted ? 'text-emerald-600' : 'text-blue-600' }}">{{ $completedJournals }} / {{ $order->jumlah_sesi }} Sesi Selesai</span>
                                </div>
                                <div class="w-full bg-slate-200 h-2 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full transition-all duration-1000 ease-out {{ $isCompleted ? 'bg-emerald-500' : 'bg-blue-500' }}" style="width: {{ $progressPercentage }}%"></div>
                                </div>
                            </div>

                            {{-- Info Kanan: Tombol Aksi --}}
                            <div class="flex items-center gap-2 lg:w-auto justify-end w-full">
                                @if($order->status_pesanan == 'selesai')
                                    <form action="{{ route('tutor.wallet.claim', $order->id) }}" method="POST" class="w-full lg:w-auto">
                                        @csrf
                                        <button type="submit" class="w-full lg:w-auto bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-md active:scale-95 flex items-center justify-center gap-2">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Tarik Dana
                                        </button>
                                    </form>
                                @elseif($isCompleted)
                                    <button class="w-full lg:w-auto bg-slate-100 text-slate-400 border border-slate-200 px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest cursor-not-allowed text-center" disabled>Menunggu Siswa</button>
                                @elseif($order->status_pesanan == 'menunggu_pembayaran')
                                    <button class="w-full lg:w-auto bg-orange-50 text-orange-400 border border-orange-100 px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest cursor-not-allowed text-center" disabled>Menunggu Transfer</button>
                                @else
                                    <button onclick="document.getElementById('modal-daftar-sesi-{{ $order->id }}').showModal()" class="w-full lg:w-auto bg-slate-900 hover:bg-blue-600 text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-md active:scale-95 flex items-center justify-center gap-2">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg> Jurnal Sesi
                                    </button>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full bg-white border border-dashed border-slate-300 rounded-[2rem] p-16 flex flex-col items-center justify-center text-center shadow-sm">
                            <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mb-4 border border-blue-100 shadow-sm"><span class="text-3xl">☕</span></div>
                            <h3 class="text-lg font-black text-slate-800 mb-1">Belum Ada Kelas Berjalan</h3>
                            <p class="text-slate-500 text-xs font-medium">Kelas akan muncul setelah Anda menerima pesanan dan murid membayar.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                {{-- ========================================== --}}
                {{-- KONTEN TAB 3: SELESAI                      --}}
                {{-- ========================================== --}}
                <div id="content-3" class="tab-content w-full pb-8">
                    <div class="flex flex-col gap-4">
                        @forelse($pesananSelesai ?? [] as $order)
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-l-[6px] border-l-emerald-400 opacity-90 hover:opacity-100 transition-opacity">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 font-black text-lg shrink-0 border border-emerald-100">
                                    {{ substr($order->murid->name ?? 'S', 0, 1) }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 mb-0.5">
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">#ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                    <h3 class="text-base font-black text-slate-900 leading-tight">{{ $order->mata_pelajaran }}</h3>
                                    <p class="text-[10px] font-bold text-slate-500 mt-1">Siswa: {{ $order->murid->name }}</p>
                                </div>
                            </div>
                            <div class="text-right flex items-center justify-between sm:justify-end gap-6 bg-slate-50 sm:bg-transparent p-3 sm:p-0 rounded-xl border border-slate-100 sm:border-transparent">
                                <div class="text-left sm:text-right">
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Total</p>
                                    <p class="text-sm font-black text-slate-800">Rp {{ number_format($order->total_harga_sesi, 0, ',', '.') }}</p>
                                </div>
                                <span class="bg-emerald-50 text-emerald-600 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest border border-emerald-200 text-center shadow-sm">Selesai</span>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full py-16 text-center bg-white rounded-[2rem] border border-slate-200 border-dashed">
                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3"><span class="text-3xl">📜</span></div>
                            <p class="text-slate-500 font-bold text-sm">Riwayat pesanan selesai masih kosong.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                {{-- ========================================== --}}
                {{-- KONTEN TAB 4: BATAL / KOMPLAIN             --}}
                {{-- ========================================== --}}
                <div id="content-4" class="tab-content w-full pb-8">
                    <div class="flex flex-col gap-4">
                        @forelse($pesananDibatalkan ?? [] as $order)
                        <div class="bg-rose-50/50 rounded-2xl border border-rose-100 shadow-sm p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-l-[6px] border-l-rose-500 opacity-80 hover:opacity-100 transition-all grayscale-[20%] hover:grayscale-0 group">
                            
                            <div class="flex items-center gap-4 lg:w-1/2">
                                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-rose-500 font-black text-lg shrink-0 border border-rose-200">
                                    {{ substr($order->murid->name ?? 'S', 0, 1) }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 mb-0.5">
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">#ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                    <h3 class="text-base font-black text-slate-700 leading-tight line-clamp-1 line-through decoration-rose-300 decoration-2 group-hover:text-rose-700 transition-colors">{{ $order->mata_pelajaran }}</h3>
                                    <p class="text-[11px] font-bold text-rose-800/80 mt-1">Siswa: {{ $order->murid->name }}</p>
                                </div>
                            </div>

                            <div class="hidden md:flex items-center justify-center w-full lg:w-1/4">
                                <p class="text-[10px] font-medium text-slate-500 italic bg-white px-3 py-1.5 rounded-lg border border-slate-200">
                                    Transaksi dibatalkan
                                </p>
                            </div>

                            <div class="flex justify-end lg:w-1/4">
                                <span class="bg-rose-50 text-rose-600 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest border border-rose-200 w-full md:w-auto text-center shadow-sm">
                                    Dibatalkan
                                </span>
                            </div>

                        </div>
                        @empty
                        <div class="col-span-full py-16 text-center bg-white rounded-[2rem] border border-slate-200 border-dashed">
                            <div class="w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-3 border border-emerald-100 shadow-sm"><span class="text-3xl">✨</span></div>
                            <p class="text-slate-500 font-bold text-sm">Luar biasa! Tidak ada riwayat kelas yang dibatalkan.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </main>

    <footer class="mt-auto py-10 border-t border-slate-200 bg-white relative z-10">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em]">Hak Cipta Pengajar &copy; {{ date('Y') }} tempatles.id</p>
        </div>
    </footer>

    {{-- ================================================================= --}}
    {{-- SEMUA KUMPULAN MODAL (POPUPS) ADA DI SINI                         --}}
    {{-- ================================================================= --}}

    {{-- MODAL DAFTAR SESI (DI-UPGRADE DENGAN DESAIN TIMELINE MODERN) --}}
    @foreach($pesananBerjalan ?? [] as $order)
        @if($order->status_pesanan == 'berjalan')
        <dialog id="modal-daftar-sesi-{{ $order->id }}" class="rounded-[2.5rem] p-0 border border-slate-200 shadow-2xl backdrop:bg-slate-900/70 backdrop:backdrop-blur-sm m-auto w-full max-w-2xl overflow-hidden transition-all">
            <div class="w-full bg-white relative flex flex-col max-h-[85vh]">
                
                {{-- Header Premium Gradient --}}
                <div class="px-8 py-7 bg-gradient-to-r from-slate-900 to-blue-900 shrink-0 sticky top-0 z-20 flex justify-between items-center shadow-md relative overflow-hidden">
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
                                    <div class="w-5 h-5 rounded-full border-4 border-slate-50 {{ $session->teachingJournal ? 'bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)]' : (is_null($session->tanggal_jadwal) ? 'bg-orange-400 animate-pulse' : 'bg-slate-300') }} flex items-center justify-center z-10 shrink-0 transition-colors"></div>
                                    <div class="text-right flex-grow">
                                        <p class="text-[11px] font-black text-slate-800 uppercase tracking-widest mb-0.5">Pertemuan {{ $session->pertemuan_ke }}</p>
                                        <p class="text-[10px] font-medium text-slate-500">
                                            @if($session->tanggal_jadwal)
                                                {{ \Carbon\Carbon::parse($session->tanggal_jadwal)->translatedFormat('d M Y') }} • {{ \Carbon\Carbon::parse($session->waktu_mulai)->format('H:i') }} WIB
                                            @else
                                                <span class="text-orange-500 italic">Belum diatur</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                {{-- Kartu Sesi (Mobile & Desktop) --}}
                                <div class="bg-white p-5 rounded-[1.5rem] border {{ $session->teachingJournal ? 'border-emerald-200 shadow-sm bg-emerald-50/30' : (is_null($session->tanggal_jadwal) ? 'border-orange-200 bg-orange-50/30' : 'border-slate-200 shadow-sm hover:border-blue-300 hover:shadow-md') }} flex-grow w-full transition-all duration-300 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                    
                                    {{-- Tampilan Header Mobile --}}
                                    <div class="md:hidden flex items-center gap-3 border-b border-slate-100 pb-3 mb-1">
                                        <div class="w-3 h-3 rounded-full {{ $session->teachingJournal ? 'bg-emerald-500' : (is_null($session->tanggal_jadwal) ? 'bg-orange-400' : 'bg-slate-300') }}"></div>
                                        <p class="text-xs font-black text-slate-800 uppercase tracking-widest">Pertemuan {{ $session->pertemuan_ke }}</p>
                                        <span class="text-[9px] text-slate-400 font-medium ml-auto">
                                            {{ $session->tanggal_jadwal ? \Carbon\Carbon::parse($session->tanggal_jadwal)->format('d/m') : '-' }}
                                        </span>
                                    </div>

                                    {{-- Info Text Card --}}
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 border {{ $session->teachingJournal ? 'bg-emerald-100 text-emerald-600 border-emerald-200' : (is_null($session->tanggal_jadwal) ? 'bg-orange-100 text-orange-600 border-orange-200' : 'bg-slate-100 text-slate-400 border-slate-200 group-hover:bg-blue-100 group-hover:text-blue-600 group-hover:border-blue-200') }} transition-colors">
                                            @if($session->teachingJournal)
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                            @elseif(is_null($session->tanggal_jadwal))
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            @else
                                                <span class="font-black text-lg">{{ $session->pertemuan_ke }}</span>
                                            @endif
                                        </div>
                                        <div>
                                            @if($session->teachingJournal)
                                                <p class="text-sm font-black text-emerald-700 mb-0.5">Jurnal Selesai</p>
                                                <p class="text-[10px] font-bold text-emerald-600/70">Terima kasih atas dedikasinya.</p>
                                            @elseif(is_null($session->tanggal_jadwal))
                                                <p class="text-sm font-black text-orange-600 mb-0.5">Belum Dijadwalkan</p>
                                                <p class="text-[10px] font-bold text-orange-500/80">Sepakati jadwal dengan murid.</p>
                                            @else
                                                <p class="text-sm font-black text-slate-800 mb-0.5">Belum Dilaporkan</p>
                                                <p class="text-[10px] font-bold text-slate-400">Jadwal: {{ \Carbon\Carbon::parse($session->waktu_mulai)->format('H:i') }} WIB</p>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Tombol Aksi Kanan (Logika Cerdas) --}}
                                    <div class="shrink-0 mt-2 sm:mt-0">
                                        @if($session->teachingJournal)
                                            <div class="w-full text-center sm:text-right">
                                                <span class="inline-flex items-center justify-center gap-1.5 w-8 h-8 rounded-full bg-emerald-100 text-emerald-600">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                                </span>
                                            </div>
                                        @elseif(is_null($session->tanggal_jadwal))
                                            <button type="button" onclick="openJadwalModal({{ $session->id }}, {{ $session->pertemuan_ke }})" class="w-full sm:w-auto bg-orange-500 text-white px-5 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-orange-600 transition-all shadow-md active:scale-95 flex items-center justify-center gap-2 border border-orange-600">
                                                Atur Jadwal <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                            </button>
                                        @else
                                            <button type="button" onclick="openJournalModal({{ $session->id }}, '{{ addslashes($order->paket->nama_paket ?? $order->mata_pelajaran) }}')" class="w-full sm:w-auto bg-slate-900 text-white px-5 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 transition-all shadow-md active:scale-95 flex items-center justify-center gap-2 border border-slate-800 hover:border-blue-500">
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
        @endif
    @endforeach

    {{-- MODAL INPUT JURNAL & ABSENSI (DI-UPGRADE DENGAN FORM PREMIUM & DROPZONE) --}}
    <dialog id="modal-jurnal" class="rounded-[2.5rem] p-0 border border-slate-200 shadow-2xl backdrop:bg-slate-900/70 backdrop:backdrop-blur-sm m-auto w-full max-w-xl overflow-hidden transition-all">
        <div class="w-full bg-white relative flex flex-col max-h-[90vh]">
            
            {{-- Header Premium Gradient --}}
            <div class="px-8 py-7 bg-gradient-to-r from-blue-600 to-indigo-700 shrink-0 sticky top-0 z-20 flex justify-between items-center shadow-md relative overflow-hidden">
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
                
                {{-- Info Box / Mapel Badge --}}
                <div class="bg-white border border-slate-200 p-5 rounded-2xl mb-6 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Mata Pelajaran / Paket</p>
                        <p id="label-mapel" class="text-sm font-black text-slate-800">NAMA PAKET</p>
                    </div>
                    <div class="bg-blue-50 text-blue-700 border border-blue-100 px-3 py-2 rounded-xl flex items-center gap-2 text-[10px] font-bold shrink-0">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Pastikan data valid
                    </div>
                </div>

                <form action="{{ route('tutor.journal.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <input type="hidden" name="order_session_id" id="input-session-id">
                    
                    {{-- Textarea Materi --}}
                    <div class="bg-white p-6 rounded-[1.5rem] border border-slate-200 shadow-sm">
                        <label class="flex items-center gap-2 text-[10px] font-black text-slate-800 uppercase tracking-widest mb-3">
                            <span class="w-5 h-5 rounded border border-slate-200 bg-slate-50 flex items-center justify-center text-slate-500">1</span>
                            Catatan & Pembahasan Materi <span class="text-rose-500 text-sm leading-none">*</span>
                        </label>
                        <textarea name="materi_pembahasan" rows="4" required placeholder="Tuliskan materi yang diajarkan, respon murid, dan progress hari ini..." class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl p-4 text-sm font-medium text-slate-800 focus:bg-white focus:ring-0 focus:border-blue-500 transition-all outline-none resize-none shadow-inner placeholder:text-slate-400 placeholder:font-normal"></textarea>
                    </div>

                    {{-- Upload Foto (Dropzone Design) --}}
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
                            
                            {{-- Input Asli disembunyikan pakai CSS --}}
                            <input type="file" name="foto_bukti" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="this.parentElement.querySelector('p.text-sm').innerHTML = '<span class=\'text-emerald-600\'>✅ File dipilih: </span>' + this.files[0].name">
                        </label>
                    </div>

                    {{-- Upload Materi (Dropzone Design) --}}
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
                                    <p class="text-sm font-bold text-slate-700 mb-0.5" id="file-materi-text-orders">Upload file tugas/modul</p>
                                    <p class="text-[10px] font-medium text-slate-400 uppercase tracking-widest">PDF, PPT, DOC (Max. 5MB)</p>
                                </div>
                            </div>
                            <input type="file" name="file_materi" accept=".pdf,.ppt,.pptx,.doc,.docx" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="document.getElementById('file-materi-text-orders').innerHTML = '<span class=\'text-emerald-600\'>✅ ' + this.files[0].name + '</span>'">
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

    {{-- MODAL INPUT JADWAL SESI --}}
    <dialog id="modal-atur-jadwal" class="rounded-[2.5rem] p-0 border border-slate-200 shadow-2xl backdrop:bg-slate-900/70 backdrop:backdrop-blur-sm m-auto w-full max-w-md overflow-hidden transition-all">
        <div class="w-full bg-white relative flex flex-col">
            
            <div class="px-8 py-6 bg-gradient-to-r from-orange-500 to-amber-500 flex justify-between items-center shadow-md relative overflow-hidden">
                <div class="absolute -right-5 -top-5 w-24 h-24 bg-white/20 rounded-full blur-lg"></div>
                <div class="relative z-10">
                    <p class="text-[10px] font-black text-orange-100 uppercase tracking-widest mb-0.5">Penetapan Jadwal</p>
                    <h3 class="text-xl font-black text-white tracking-tight leading-none">Sesi Ke-<span id="label-pertemuan-jadwal">X</span></h3>
                </div>
                <button type="button" onclick="this.closest('dialog').close()" class="relative z-10 w-8 h-8 flex items-center justify-center bg-white/10 border border-white/20 hover:bg-rose-500 text-white rounded-full transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <div class="p-8 bg-slate-50">
                <form id="form-atur-jadwal" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black text-slate-800 uppercase tracking-widest mb-2">Pilih Tanggal <span class="text-rose-500">*</span></label>
                        <input type="date" name="tanggal_jadwal" required class="w-full bg-white border border-slate-200 rounded-xl p-4 text-sm font-bold text-slate-800 focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none shadow-sm cursor-pointer">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-800 uppercase tracking-widest mb-2">Jam Mulai <span class="text-rose-500">*</span></label>
                        <input type="time" name="waktu_mulai" required class="w-full bg-white border border-slate-200 rounded-xl p-4 text-sm font-bold text-slate-800 focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none shadow-sm cursor-pointer">
                    </div>
                    
                    <button type="submit" class="w-full mt-4 bg-slate-900 hover:bg-orange-500 text-white py-4 rounded-xl text-xs font-black uppercase tracking-widest shadow-xl active:scale-95 transition-all flex items-center justify-center gap-2">
                        Simpan Jadwal
                    </button>
                </form>
            </div>
        </div>
    </dialog>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Fungsi buka modal jurnal
        function openJournalModal(sessionId, mapel) {
            const dialogs = document.querySelectorAll('dialog');
            dialogs.forEach(d => { if (d.hasAttribute('open')) { d.close(); } });
            document.getElementById('input-session-id').value = sessionId;
            document.getElementById('label-mapel').innerText = mapel;
            document.getElementById('modal-jurnal').showModal();
        }

        // FUNGSI BARU: Buka modal Atur Jadwal
        function openJadwalModal(sessionId, pertemuanKe) {
            const dialogs = document.querySelectorAll('dialog');
            dialogs.forEach(d => { if (d.hasAttribute('open')) { d.close(); } }); // Tutup modal lain
            
            document.getElementById('label-pertemuan-jadwal').innerText = pertemuanKe;
            
            // Ubah URL Action Form ke ID sesi yang spesifik
            const form = document.getElementById('form-atur-jadwal');
            form.action = '/tutor/sesi/' + sessionId + '/atur-jadwal'; 
            
            document.getElementById('modal-atur-jadwal').showModal();
        }

        function confirmAction(formElement, message) {
            Swal.fire({
                title: 'Konfirmasi Aksi',
                text: message,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0f172a',
                cancelButtonColor: '#cbd5e1',
                confirmButtonText: 'Lanjutkan',
                cancelButtonText: 'Batal',
                customClass: { 
                    popup: 'rounded-[3rem]',
                    confirmButton: 'bg-slate-900 text-white px-8 py-3 rounded-xl text-sm font-black mx-2',
                    cancelButton: 'bg-slate-100 text-slate-600 px-8 py-3 rounded-xl text-sm font-black'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tampilkan loading agar user tahu proses sedang berjalan
                    Swal.fire({ title: 'Memproses...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
                    formElement.submit(); 
                }
            });
        }
    </script>

    @if($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'error',
                title: 'Data Belum Lengkap!',
                html: '<ul class="text-left text-sm font-medium text-slate-500">{!! implode("", $errors->all("<li>- :message</li>")) !!}</ul>',
                confirmButtonText: 'Oke',
                customClass: { popup: 'rounded-3xl', confirmButton: 'bg-rose-500 text-white px-6 py-2 rounded-xl' },
                buttonsStyling: false
            });
        });
    </script>
    @endif
</body>
</html>