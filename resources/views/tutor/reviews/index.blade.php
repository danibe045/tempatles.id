<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan Murid - tempatles.id</title>
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
        
        @keyframes fillBar {
            from { width: 0; }
        }
        .animate-fill-bar {
            animation: fillBar 1s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }
    </style>
</head>

<body class="bg-[#F8FAFC] text-slate-900 antialiased flex flex-col min-h-screen relative overflow-x-hidden">
    {{-- Latar Belakang Pattern Tipis --}}
    <div class="fixed inset-0 bg-pattern opacity-30 z-[-1] pointer-events-none"></div>

    {{-- NAVBAR SUB-PAGE (Sama seperti Manajemen Pesanan) --}}
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
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            {{-- HEADER HALAMAN (Gaya Premium) --}}
            <div class="bg-blue-950 border border-blue-900 shadow-2xl shadow-blue-900/20 rounded-[2.5rem] p-8 md:p-10 mb-8 relative overflow-hidden">
                <div class="absolute -top-20 -right-20 w-80 h-80 bg-yellow-500 rounded-full blur-[80px] opacity-20 pointer-events-none"></div>
                <div class="absolute -bottom-20 -left-10 w-64 h-64 bg-blue-500 rounded-full blur-[80px] opacity-30 pointer-events-none"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6 w-full">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-yellow-400 px-4 py-2 rounded-full mb-4 backdrop-blur-md">
                            <span class="text-[10px] font-black uppercase tracking-[0.25em] text-white">Reputasi Pengajar</span>
                        </div>
                        <h2 class="font-black text-3xl md:text-4xl text-white leading-tight tracking-tight mb-3">Ulasan & Penilaian</h2>
                        <p class="text-sm text-blue-200 font-medium max-w-xl leading-relaxed">Lihat apa kata murid tentang gaya mengajar Anda. Reputasi yang baik membantu Anda mendapatkan lebih banyak pesanan.</p>
                    </div>
                    <div class="hidden md:flex items-center justify-center w-28 h-28 bg-white/5 backdrop-blur-md rounded-full border border-white/10 shadow-inner shrink-0 text-white">
                        <span class="text-5xl">⭐</span>
                    </div>
                </div>
            </div>

            {{-- RINGKASAN RATING (SUMMARY) --}}
            <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm p-6 md:p-10 mb-8 flex flex-col md:flex-row items-center gap-10 md:gap-16">
                
                {{-- Angka Rata-rata Besar --}}
                <div class="flex flex-col items-center justify-center w-full md:w-1/3 text-center border-b md:border-b-0 md:border-r border-slate-100 pb-8 md:pb-0 md:pr-16">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Penilaian Rata-Rata</p>
                    <div class="flex items-center justify-center gap-3 mb-2">
                        <h1 class="text-7xl font-black text-slate-900 tracking-tighter">{{ number_format($avgRating ?? 0, 1) }}</h1>
                    </div>
                    <div class="flex text-yellow-400 text-xl justify-center mb-3">
                        @php $ratingValue = round($avgRating ?? 0); @endphp
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $ratingValue)
                                <span>★</span>
                            @else
                                <span class="text-slate-200">★</span>
                            @endif
                        @endfor
                    </div>
                    <p class="text-xs font-bold text-slate-500 bg-slate-50 px-4 py-2 rounded-xl border border-slate-100">Dari <b>{{ $totalReviews ?? 0 }}</b> Ulasan Murid</p>
                </div>

                {{-- Bar Breakdown Bintang --}}
                <div class="w-full md:w-2/3 flex flex-col gap-3">
                    @php
                        // Set default ke 0% jika belum ada data dari controller
                        // Nanti di backend (Controller), Anda tinggal hitung persentase aslinya
                        // dan lempar variabel $ratingStats ke view ini.
                        $ratingStats = $ratingStats ?? [
                            5 => 0,
                            4 => 0,
                            3 => 0,
                            2 => 0,
                            1 => 0
                        ];
                    @endphp

                    @foreach([5, 4, 3, 2, 1] as $star)
                    <div class="flex items-center gap-4 group">
                        <div class="flex items-center justify-end gap-1.5 w-10 shrink-0">
                            <span class="text-sm font-black text-slate-600 group-hover:text-slate-900 transition-colors">{{ $star }}</span>
                            <span class="text-sm text-yellow-400">★</span>
                        </div>
                        <div class="w-full bg-slate-100 h-3.5 rounded-full overflow-hidden shadow-inner">
                            <div class="h-full bg-yellow-400 rounded-full animate-fill-bar" style="width: {{ $ratingStats[$star] }}%;"></div>
                        </div>
                        <span class="text-[10px] font-bold text-slate-400 w-8 text-right">{{ $ratingStats[$star] }}%</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- DAFTAR ULASAN MURID --}}
            <div class="flex items-center justify-between mb-6 px-1">
                <h3 class="text-xl font-black text-slate-800">Semua Ulasan</h3>
                <div class="bg-white border border-slate-200 rounded-xl px-4 py-2 text-[10px] font-black uppercase tracking-widest text-slate-500 shadow-sm flex items-center gap-2">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Terbaru
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 items-start">
                @forelse($reviews ?? [] as $review)
                <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm p-6 hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:border-blue-200 hover:-translate-y-1 transition-all duration-300 flex flex-col h-full group">
                    
                    {{-- Header Card Ulasan --}}
                    <div class="flex justify-between items-start mb-5 pb-5 border-b border-slate-100">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 font-black text-lg shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                {{ strtoupper(substr($review->murid->name ?? 'M', 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="font-black text-slate-900 text-sm mb-0.5 line-clamp-1">{{ $review->murid->name ?? 'Murid' }}</h4>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ $review->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        
                        {{-- Bintang di Pojok Kanan --}}
                        <div class="bg-yellow-50 px-2.5 py-1 rounded-xl flex items-center gap-1 border border-yellow-100 shrink-0">
                            <span class="text-yellow-500 text-[10px]">⭐</span>
                            <span class="font-black text-yellow-700 text-xs">{{ number_format($review->rating, 1) }}</span>
                        </div>
                    </div>

                    {{-- Isi Komentar --}}
                    <div class="flex-grow mb-5">
                        <p class="text-sm text-slate-600 font-medium leading-relaxed italic">
                            "{{ $review->komentar ?? 'Murid ini memberikan bintang tanpa meninggalkan komentar tertulis.' }}"
                        </p>
                    </div>

                    {{-- Footer Card: Info Paket --}}
                    <div class="mt-auto bg-slate-50 px-4 py-3 rounded-xl border border-slate-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center border border-slate-200 shrink-0 text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Paket yang diambil</p>
                            <p class="text-[11px] font-bold text-slate-700 line-clamp-1">{{ $review->order->mata_pelajaran ?? 'Paket Belajar Reguler' }}</p>
                        </div>
                    </div>

                </div>
                @empty
                <div class="col-span-full bg-white rounded-[3rem] border border-slate-200 border-dashed p-16 md:p-24 text-center shadow-sm">
                    <div class="w-20 h-20 bg-yellow-50 rounded-full flex items-center justify-center mx-auto mb-6 border border-yellow-100 shadow-sm">
                        <span class="text-4xl">🌟</span>
                    </div>
                    <h3 class="text-2xl font-black text-slate-800 mb-2">Belum Ada Ulasan</h3>
                    <p class="text-slate-500 text-sm max-w-md mx-auto font-medium leading-relaxed">Selesaikan sesi kelas dengan sangat baik untuk mulai mendapatkan bintang dan ulasan dari murid-murid Anda!</p>
                </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            @if(isset($reviews) && $reviews->hasPages())
            <div class="mt-10">
                {{ $reviews->links() }}
            </div>
            @endif

        </div>
    </main>
    
    <footer class="mt-auto py-10 border-t border-slate-200 bg-white relative z-10">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em]">Hak Cipta Pengajar &copy; {{ date('Y') }} tempatles.id</p>
        </div>
    </footer>
</body>
</html>