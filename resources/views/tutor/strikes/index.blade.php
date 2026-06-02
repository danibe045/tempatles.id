<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catatan Pelanggaran - tempatles.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        .bg-pattern {
            background-image: radial-gradient(#cbd5e1 1.5px, transparent 1.5px);
            background-size: 28px 28px;
        }

        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 20px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background-color: #94a3b8; }
    </style>
</head>

<body class="bg-[#F8FAFC] text-slate-900 antialiased flex flex-col min-h-screen relative overflow-x-hidden">
    {{-- Latar Belakang Pattern Tipis --}}
    <div class="fixed inset-0 bg-pattern opacity-30 z-[-1] pointer-events-none"></div>

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

    {{-- MAIN CONTENT --}}
    <main class="py-8 md:py-12 relative z-10 flex-grow">
        <div class="max-w-5xl mx-auto px-6 lg:px-8">

            {{-- HEADER HALAMAN (Gaya Premium) --}}
            <div class="bg-blue-950 border border-blue-900 shadow-2xl shadow-blue-900/20 rounded-[2.5rem] p-8 md:p-10 mb-8 relative overflow-hidden flex flex-col md:flex-row justify-between items-center gap-8">
                
                @if(($activeStrikes ?? 0) > 0)
                    <div class="absolute -top-20 -right-20 w-80 h-80 bg-rose-500 rounded-full blur-[80px] opacity-20 pointer-events-none"></div>
                    <div class="absolute -bottom-20 -left-10 w-64 h-64 bg-orange-500 rounded-full blur-[80px] opacity-20 pointer-events-none"></div>
                @else
                    <div class="absolute -top-20 -right-20 w-80 h-80 bg-emerald-500 rounded-full blur-[80px] opacity-20 pointer-events-none"></div>
                    <div class="absolute -bottom-20 -left-10 w-64 h-64 bg-blue-500 rounded-full blur-[80px] opacity-30 pointer-events-none"></div>
                @endif

                <div class="relative z-10 w-full">
                    <div class="inline-flex items-center gap-2 {{ ($activeStrikes ?? 0) > 0 ? 'bg-rose-500/20 border-rose-500/30 text-rose-300' : 'bg-emerald-500/20 border-emerald-500/30 text-emerald-300' }} border px-4 py-2 rounded-full mb-4 backdrop-blur-md">
                        <span class="text-[10px] font-black uppercase tracking-[0.25em] text-white">Pusat Kendali Mutu</span>
                    </div>
                    <h2 class="font-black text-3xl md:text-4xl text-white leading-tight tracking-tight mb-3">Catatan Pelanggaran</h2>
                    <p class="text-sm text-blue-200 font-medium max-w-xl leading-relaxed">Daftar teguran dari admin terkait pelanggaran aturan platform. Jaga kualitas mengajar Anda untuk menghindari pemblokiran akun.</p>
                </div>

                {{-- Widget Counter Strike --}}
                <div class="relative z-10 {{ ($activeStrikes ?? 0) > 0 ? 'bg-rose-500 border-rose-400' : 'bg-emerald-500 border-emerald-400' }} text-white p-6 rounded-[2rem] text-center shrink-0 shadow-xl border border-white/20 min-w-[160px]">
                    <p class="text-6xl font-black tracking-tighter">{{ $activeStrikes ?? 0 }}<span class="text-3xl opacity-50">/3</span></p>
                    <p class="text-[10px] font-black uppercase tracking-widest text-white mt-2 bg-white/20 px-3 py-1.5 rounded-lg">Strike Aktif</p>
                </div>
            </div>

            {{-- INFO BANNED WARNING --}}
            @if(($activeStrikes ?? 0) >= 2)
            <div class="bg-rose-50 border-l-[6px] border-l-rose-500 border-y border-r border-rose-200 p-6 rounded-2xl flex gap-5 mb-8 shadow-sm animate-pulse-slow">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-rose-500 shrink-0 border border-rose-100 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <div>
                    <h4 class="text-base font-black text-rose-900 tracking-tight mb-1">Peringatan Keras Terakhir!</h4>
                    <p class="text-sm text-rose-700 font-medium leading-relaxed">Anda sudah memiliki {{ $activeStrikes }} strike aktif. Jika mencapai 3 strike, akun Anda akan <b>diblokir secara permanen (Banned)</b> oleh sistem.</p>
                </div>
            </div>
            @endif

            {{-- DAFTAR STRIKE --}}
            <div class="flex items-center justify-between mb-6 px-1">
                <h3 class="text-xl font-black text-slate-800">Riwayat Teguran</h3>
            </div>

            <div class="flex flex-col gap-5">
                @forelse($strikes as $strike)
                
                @php
                    $isPending = in_array($strike->status, ['pending', 'ditinjau']);
                    $isActive = $strike->status == 'aktif';
                    $cardClass = $isActive 
                        ? 'border-l-rose-500 hover:shadow-md' 
                        : ($isPending 
                            ? 'border-l-orange-400 hover:shadow-md' 
                            : 'border-l-slate-300 opacity-70 hover:opacity-100 grayscale-[20%]');
                    $iconBg = $isActive ? 'bg-rose-50 text-rose-600 border-rose-100' : ($isPending ? 'bg-orange-50 text-orange-600 border-orange-100' : 'bg-slate-50 text-slate-400 border-slate-200');
                @endphp

                <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm p-6 md:p-8 flex flex-col md:flex-row gap-6 items-start transition-all duration-300 border-l-[6px] {{ $cardClass }}">

                    <div class="shrink-0">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center border shadow-inner {{ $iconBg }}">
                            @if($isActive)
                                <span class="text-2xl font-black">!</span>
                            @elseif($isPending)
                                <svg class="w-6 h-6 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            @else
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                            @endif
                        </div>
                    </div>

                    <div class="flex-grow w-full">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-3">
                            <h3 class="text-lg font-black text-slate-900 leading-tight">{{ $strike->alasan_pelanggaran }}</h3>
                            
                            @if($isActive)
                                <span class="bg-rose-100 text-rose-700 px-3 py-1.5 rounded-lg text-[9px] font-black uppercase tracking-widest border border-rose-200 shadow-sm w-fit shrink-0">Berlaku</span>
                            @elseif($isPending)
                                <span class="bg-orange-100 text-orange-700 px-3 py-1.5 rounded-lg text-[9px] font-black uppercase tracking-widest border border-orange-200 shadow-sm w-fit flex items-center gap-1.5 shrink-0"><span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span> Sedang Ditinjau</span>
                            @else
                                <span class="bg-slate-100 text-slate-500 px-3 py-1.5 rounded-lg text-[9px] font-black uppercase tracking-widest border border-slate-200 shadow-sm w-fit shrink-0">Dimaafkan / Dicabut</span>
                            @endif
                        </div>
                        
                        <div class="bg-slate-50 border border-slate-100 rounded-2xl p-4 mb-4">
                            @if($isPending)
                                <p class="text-sm text-orange-600 font-bold mb-1">Laporan masuk & sedang diinvestigasi oleh Admin.</p>
                            @endif
                            <p class="text-sm text-slate-600 font-medium leading-relaxed italic">
                                "{{ $strike->keterangan_detail ?? 'Menunggu hasil peninjauan dari tim Admin.' }}"
                            </p>
                        </div>
                        
                        <div class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            Diberikan pada: {{ $strike->created_at->format('d M Y • H:i') }} WIB
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full bg-white rounded-[3rem] border border-slate-200 border-dashed p-16 text-center shadow-sm">
                    <div class="w-20 h-20 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center mx-auto mb-6 border border-emerald-100 shadow-sm">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-800 mb-2">Akun Bersih dari Pelanggaran!</h3>
                    <p class="text-slate-500 text-sm max-w-md mx-auto font-medium leading-relaxed">Luar biasa! Pertahankan terus kualitas mengajarmu dan selalu patuhi SOP Tempatles.id untuk membangun reputasi yang sempurna.</p>
                </div>
                @endforelse
            </div>
        </div>
    </main>

    <footer class="mt-auto py-10 border-t border-slate-200 bg-white relative z-10">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em]">Hak Cipta Pengajar &copy; {{ date('Y') }} tempatles.id</p>
        </div>
    </footer>
</body>
</html>