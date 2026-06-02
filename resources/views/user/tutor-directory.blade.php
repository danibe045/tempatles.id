@extends('layouts.main')

{{-- OPTIMASI SEO: Title & Meta Description yang kaya kata kunci --}}
@section('title', 'Katalog Tutor Les Privat & Guru Ngaji Terbaik - tempatles.id')

@section('meta')
    <meta name="description" content="Platform cari guru les privat SD, SMP, SMA, Bahasa Inggris, dan Guru Mengaji terdekat. Jadwal fleksibel, tutor terverifikasi, and bagi hasil transparan.">
    <meta name="keywords" content="les privat, guru ngaji, tutor sd smp sma, les bahasa inggris, cari guru privat">
@endsection

@section('content')
    {{-- ======================================================== --}}
    {{-- HEADER & SEARCH BAR (DESAIN PREMIUM) --}}
    {{-- ======================================================== --}}
    <div class="bg-blue-950 pt-16 pb-32 relative overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10">
            <div class="absolute top-[-10%] left-[10%] w-[30%] h-[60%] bg-blue-600/30 blur-[100px] rounded-full"></div>
            <div class="absolute bottom-[10%] right-[10%] w-[20%] h-[50%] bg-orange-500/20 blur-[80px] rounded-full"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 text-center relative z-10">
            <h1 class="text-3xl md:text-5xl font-black text-white tracking-tight mb-4">Temukan Tutor Idealmu</h1>
            <p class="text-blue-200/80 font-medium text-base md:text-lg max-w-2xl mx-auto mb-10">Pilih dari puluhan tutor terverifikasi yang siap membantumu meraih target belajar di kotamu.</p>

            {{-- Form Pencarian --}}
            <form action="{{ route('katalog.publik') }}" method="GET" class="max-w-4xl mx-auto bg-white p-3 rounded-3xl shadow-2xl flex flex-col md:flex-row gap-3">
                <div class="flex-1 relative flex items-center bg-slate-50 rounded-2xl border border-slate-100 hover:border-blue-300 focus-within:border-blue-500 focus-within:bg-white transition-all">
                    <svg class="w-5 h-5 text-slate-400 absolute left-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    <input type="text" name="mapel" value="{{ request('mapel') }}" placeholder="Mata Pelajaran (Contoh: Matematika)" class="w-full bg-transparent border-none text-sm font-bold text-slate-800 focus:ring-0 pl-12 pr-4 py-4 placeholder:font-medium placeholder:text-slate-400 outline-none">
                </div>
                
                <div class="flex-1 relative flex items-center bg-slate-50 rounded-2xl border border-slate-100 hover:border-blue-300 focus-within:border-blue-500 focus-within:bg-white transition-all">
                    <svg class="w-5 h-5 text-slate-400 absolute left-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <input type="text" name="lokasi" value="{{ request('lokasi') }}" placeholder="Lokasi Kecamatan / Kota" class="w-full bg-transparent border-none text-sm font-bold text-slate-800 focus:ring-0 pl-12 pr-4 py-4 placeholder:font-medium placeholder:text-slate-400 outline-none">
                </div>

                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all md:w-auto w-full shadow-lg shadow-orange-500/30">
                    Cari Tutor
                </button>
            </form>
        </div>
    </div>

    {{-- ======================================================== --}}
    {{-- KATALOG TUTOR GRID (VERSI VERTIKAL KUSTOM BERSIH V5) --}}
    {{-- ======================================================== --}}
    <main class="flex-grow max-w-7xl mx-auto px-6 md:px-8 w-full -mt-16 mb-24 relative z-20">
        
        {{-- Pesan Hasil Pencarian --}}
        @if(request('mapel') || request('lokasi'))
        <div class="bg-white px-6 py-4 rounded-2xl border border-slate-200 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-3 mb-8">
            <p class="text-sm font-medium text-slate-600 text-center sm:text-left">
                Menampilkan hasil pencarian untuk: 
                @if(request('mapel')) <span class="font-black text-blue-950 bg-blue-50 border border-blue-100/50 px-3 py-1 rounded-lg ml-1">{{ request('mapel') }}</span> @endif
                @if(request('lokasi')) <span class="font-black text-blue-950 bg-blue-50 border border-blue-100/50 px-3 py-1 rounded-lg ml-1">📍 {{ request('lokasi') }}</span> @endif
            </p>
            <a href="{{ route('katalog.publik') }}" class="text-xs font-black text-rose-500 hover:text-rose-600 uppercase tracking-widest transition-colors">Hapus Filter X</a>
        </div>
        @endif

        @if(isset($tutors) && $tutors->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($tutors as $tutor)
                    @php
                        // --- PROSES DATA PAKET AKTIF ---
                        $activePackages = $tutor->packages->where('is_active', true);
                        $metodes = $activePackages->pluck('metode')->unique();
                        $minPrice = $activePackages->min('harga_nett') ?? 0;
                        
                        // --- INTEGRASI REPUTASI REVIEWS ---
                        $avgRating = \App\Models\Review::where('tutor_id', $tutor->user_id)->avg('rating') ?? 0;
                        $totalReview = \App\Models\Review::where('tutor_id', $tutor->user_id)->count();
                    @endphp

                    {{-- PERBAIKAN SAKTI: Di klik selalu mengarah ke halaman detail (Baik guest maupun terdaftar) --}}
                    <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-xl shadow-slate-100 hover:shadow-2xl hover:border-blue-200 hover:-translate-y-2 transition-all duration-300 flex flex-col h-full relative overflow-hidden group cursor-pointer"
                        onclick="window.location.href='{{ route('katalog.detail', $tutor->id) }}'">
                        
                        {{-- AREA ATAS: FOTO PORTRAIT PROPORSIONAL --}}
                        <div class="relative h-60 w-full overflow-hidden bg-slate-50 shrink-0 shadow-sm">
                            @if($tutor->user->profile_photo_path)
                                <img src="{{ asset('storage/'.$tutor->user->profile_photo_path) }}" alt="{{ $tutor->user->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-700 via-blue-800 to-indigo-950 flex items-center justify-center text-white font-black text-5xl group-hover:scale-105 transition-transform duration-500">
                                    {{ strtoupper(substr($tutor->user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>

                        {{-- AREA BAWAH: DATA SPESIFIK --}}
                        <div class="p-6 flex flex-col flex-grow justify-between min-w-0 bg-white">
                            
                            <div class="space-y-3">
                                {{-- Rating Bintang Emas --}}
                                <div class="flex items-center gap-1.5 flex-wrap">
                                    <span class="text-amber-400 text-sm">★</span>
                                    <span class="text-xs font-black text-slate-800">{{ $totalReview > 0 ? number_format($avgRating, 1) : '0.0' }}</span>
                                    <span class="text-[10px] text-slate-400 font-bold">({{ $totalReview }} ulasan)</span>
                                </div>

                                {{-- Nama Lengkap Tutor --}}
                                <h3 class="text-lg font-black text-slate-900 leading-tight truncate group-hover:text-blue-600 transition-colors duration-200" title="{{ $tutor->user->name }}">
                                    {{ $tutor->user->name }}
                                </h3>

                                {{-- Bidang Keahlian / Spesialisasi --}}
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider truncate">
                                    {{ $tutor->bidang ?? 'Pengajar Privat' }}
                                </p>

                                {{-- Keterangan (Cuplikan Pengalaman / Slogan) --}}
                                <p class="text-slate-500 text-xs font-medium leading-relaxed line-clamp-2 pt-0.5">
                                    {{ $tutor->pengalaman ?? 'Siap membantu mendampingi siswa belajar secara privat dan terstruktur.' }}
                                </p>

                                {{-- Metode Belajar (Online / Offline) --}}
                                <div class="flex flex-wrap gap-1 pt-1">
                                    @forelse($metodes as $metode)
                                        <span class="bg-purple-50 text-purple-700 text-[10px] font-black px-2.5 py-0.5 rounded border border-purple-100/60 uppercase tracking-wide">
                                            {{ $metode }}
                                        </span>
                                    @empty
                                        <span class="text-slate-400 text-[11px] font-bold">-</span>
                                    @endforelse
                                </div>
                            </div>

                            {{-- Bagian Paling Bawah: Harga Mulai Dari & Tombol Aksi Minimalis --}}
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between gap-2 mt-5">
                                <div class="min-w-0">
                                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest block leading-none mb-1">Mulai Dari</span>
                                    <p class="text-base font-black text-blue-600 leading-none truncate">
                                        @if($minPrice > 0)
                                            Rp{{ number_format($minPrice, 0, ',', '.') }}
                                        @else
                                            <span class="text-xs text-slate-400 font-bold">Belum Diatur</span>
                                        @endif
                                    </p>
                                </div>
                                
                                {{-- Tombol Panah Minimalis bawaan Mas Dani yang elegan --}}
                                <span class="w-10 h-10 rounded-xl bg-slate-50 text-blue-600 group-hover:bg-blue-600 group-hover:text-white flex items-center justify-center transition-all duration-300 shadow-sm border border-slate-100 font-black text-sm shrink-0">
                                    ➔
                                </span>
                            </div>

                        </div>

                    </div>
                @endforeach
            </div>

            {{-- Komponen Pagination --}}
            @if(method_exists($tutors, 'links'))
                <div class="mt-14 flex justify-center">
                    {{ $tutors->links() }}
                </div>
            @endif

        @else
            {{-- Empty State (Jika Pencarian Nihil) --}}
            <div class="bg-white rounded-[2.5rem] border border-slate-200 p-12 text-center max-w-2xl mx-auto shadow-sm">
                <div class="w-20 h-20 mx-auto bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mb-5 border border-slate-100">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-xl font-black text-slate-900 mb-2">Tutor Tidak Ditemukan</h3>
                <p class="text-slate-500 font-medium mb-8 text-xs md:text-sm leading-relaxed max-w-md mx-auto">
                    Maaf, kami tidak menemukan data pengajar yang cocok dengan mata pelajaran atau lokasi tersebut. Silakan coba cari menggunakan kata kunci umum lainnya.
                </p>
                <a href="{{ route('katalog.publik') }}" class="inline-block bg-blue-950 hover:bg-blue-900 text-white px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-md">
                    Reset & Lihat Semua Tutor
                </a>
            </div>
        @endif

    </main>
@endsection