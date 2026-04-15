<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Tutor - tempatles.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 antialiased overflow-x-hidden flex flex-col min-h-screen">

    {{-- NAVBAR (Sama dengan Homepage) --}}
    <nav class="sticky top-0 z-50 flex items-center justify-between px-6 md:px-12 py-4 bg-white/80 backdrop-blur-md border-b border-slate-100 shadow-sm">
        <div class="flex items-center gap-2">
            <a href="/" class="flex items-center gap-3 group">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-12 w-auto transition-transform group-hover:scale-105">
                <div class="hidden sm:block">
                    <span class="font-black text-blue-950 text-xl tracking-tight leading-none">tempatles</span>
                    <span class="font-black text-orange-500 text-xl tracking-tight leading-none">.id</span>
                </div>
            </a>
        </div>

        <div class="hidden lg:flex items-center space-x-10 text-[13px] font-bold uppercase tracking-widest text-slate-500">
            <a href="/" class="hover:text-blue-600 transition-colors">Home</a>
            <a href="{{ route('layanan') }}" class="hover:text-blue-600 transition-colors">Layanan Kami</a>
            <a href="{{ route('tentang') }}" class="hover:text-blue-600 transition-colors">Tentang</a>
            <a href="{{ route('katalog.publik') }}" class="text-blue-600 border-b-2 border-blue-600 pb-1">Cari Tutor</a>
        </div>

        <div>
            @auth
                <a href="{{ url('/dashboard') }}" class="bg-blue-950 text-white px-7 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-orange-500 transition-all shadow-lg shadow-blue-950/20">Dashboard</a>
            @else
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="text-xs font-black uppercase tracking-widest text-slate-600 hover:text-blue-600 transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-blue-950 text-white px-7 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-orange-500 transition-all shadow-lg shadow-blue-950/20">Daftar Gratis</a>
                </div>
            @endauth
        </div>
    </nav>

    {{-- HEADER & SEARCH BAR --}}
    <div class="bg-blue-950 pt-16 pb-32 relative overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10">
            <div class="absolute top-[-10%] left-[10%] w-[30%] h-[60%] bg-blue-600/30 blur-[100px] rounded-full"></div>
            <div class="absolute bottom-[10%] right-[10%] w-[20%] h-[50%] bg-orange-500/20 blur-[80px] rounded-full"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 text-center relative z-10">
            <h1 class="text-3xl md:text-5xl font-black text-white tracking-tight mb-4">Temukan Tutor Idealmu</h1>
            <p class="text-blue-200/80 font-medium text-lg max-w-2xl mx-auto mb-10">Pilih dari puluhan tutor terverifikasi yang siap membantumu meraih target belajar di kotamu.</p>

            {{-- Form Pencarian --}}
            <form action="{{ route('katalog.publik') }}" method="GET" class="max-w-4xl mx-auto bg-white p-3 rounded-3xl shadow-2xl flex flex-col md:flex-row gap-3">
                <div class="flex-1 relative flex items-center bg-slate-50 rounded-2xl border border-slate-100 hover:border-blue-300 focus-within:border-blue-500 focus-within:bg-white transition-all">
                    <svg class="w-5 h-5 text-slate-400 absolute left-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    <input type="text" name="mapel" value="{{ request('mapel') }}" placeholder="Mata Pelajaran (Contoh: Matematika, Mengaji)" class="w-full bg-transparent border-none text-sm font-bold text-slate-800 focus:ring-0 pl-12 pr-4 py-4 placeholder:font-medium placeholder:text-slate-400">
                </div>
                
                <div class="flex-1 relative flex items-center bg-slate-50 rounded-2xl border border-slate-100 hover:border-blue-300 focus-within:border-blue-500 focus-within:bg-white transition-all">
                    <svg class="w-5 h-5 text-slate-400 absolute left-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <input type="text" name="lokasi" value="{{ request('lokasi') }}" placeholder="Lokasi Kecamatan / Kota" class="w-full bg-transparent border-none text-sm font-bold text-slate-800 focus:ring-0 pl-12 pr-4 py-4 placeholder:font-medium placeholder:text-slate-400">
                </div>

                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all md:w-auto w-full shadow-lg shadow-orange-500/30">
                    Cari Tutor
                </button>
            </form>
        </div>
    </div>

    {{-- KATALOG TUTOR GRID --}}
    <main class="flex-grow max-w-7xl mx-auto px-6 md:px-8 w-full -mt-16 mb-24 relative z-20">
        
        {{-- Pesan Hasil Pencarian --}}
        @if(request('mapel') || request('lokasi'))
        <div class="bg-white px-6 py-4 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between mb-8">
            <p class="text-sm font-medium text-slate-600">
                Menampilkan hasil untuk: 
                @if(request('mapel')) <span class="font-black text-blue-950 bg-blue-50 px-3 py-1 rounded-lg ml-1">{{ request('mapel') }}</span> @endif
                @if(request('lokasi')) <span class="font-black text-blue-950 bg-blue-50 px-3 py-1 rounded-lg ml-1">📍 {{ request('lokasi') }}</span> @endif
            </p>
            <a href="{{ route('katalog.publik') }}" class="text-xs font-black text-rose-500 hover:text-rose-600 uppercase tracking-widest">Hapus Filter</a>
        </div>
        @endif

        @if($tutors->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($tutors as $tutor)
                    {{-- Parsing Array Tingkat & Metode --}}
                    @php
                        $tingkatStr = is_array($tutor->tingkat_siswa) ? implode(', ', $tutor->tingkat_siswa) : (is_array(json_decode($tutor->tingkat_siswa, true)) ? implode(', ', json_decode($tutor->tingkat_siswa, true)) : $tutor->tingkat_siswa);
                        $metodeStr = is_array($tutor->metode) ? implode(', ', $tutor->metode) : (is_array(json_decode($tutor->metode, true)) ? implode(', ', json_decode($tutor->metode, true)) : $tutor->metode);
                    @endphp

                    {{-- Tutor Card --}}
                    <div class="bg-white rounded-[2rem] border border-slate-200 p-6 shadow-xl shadow-slate-200/40 hover:-translate-y-2 transition-transform duration-300 flex flex-col h-full">
                        
                        {{-- Header Card: Inisial & Nama --}}
                        <div class="flex items-start gap-4 mb-6">
                            <div class="w-16 h-16 shrink-0 bg-gradient-to-br from-blue-500 to-blue-700 text-white rounded-2xl flex items-center justify-center font-black text-2xl shadow-lg shadow-blue-500/30">
                                {{ substr($tutor->user->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="text-lg font-black text-slate-900 leading-tight">{{ $tutor->user->name }}</h3>
                                <p class="text-xs font-bold text-blue-600 uppercase tracking-widest mt-1">{{ $tutor->bidang }}</p>
                            </div>
                        </div>

                        {{-- Info Details --}}
                        <div class="space-y-4 mb-8 flex-grow">
                            {{-- Area --}}
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Area Mengajar</p>
                                    <p class="text-sm font-bold text-slate-700">{{ $tutor->area ?: 'Seluruh Area (Online)' }}</p>
                                </div>
                            </div>
                            
                            {{-- Tingkat --}}
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tingkat Siswa</p>
                                    <p class="text-sm font-bold text-slate-700">{{ $tingkatStr ?: '-' }}</p>
                                </div>
                            </div>

                            {{-- Metode --}}
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Metode Belajar</p>
                                    <div class="flex flex-wrap gap-2 mt-1">
                                        @foreach(explode(',', $metodeStr) as $metode)
                                            @if(trim($metode))
                                                <span class="bg-purple-100 text-purple-700 text-[10px] font-black px-2 py-1 rounded-md uppercase">{{ trim($metode) }}</span>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tombol CTA --}}
                        <div class="mt-auto pt-6 border-t border-slate-100">
                            <a href="{{ route('register') }}?role=murid" class="flex items-center justify-center w-full bg-slate-50 hover:bg-blue-950 text-blue-600 hover:text-white px-6 py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all group">
                                Daftar & Pesan Tutor 
                                <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-12">
                {{ $tutors->links() }}
            </div>

        @else
            {{-- Empty State (Jika Tutor Tidak Ditemukan) --}}
            <div class="bg-white rounded-[2.5rem] border border-slate-200 p-12 text-center max-w-2xl mx-auto shadow-sm">
                <div class="w-24 h-24 mx-auto bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-2xl font-black text-slate-900 mb-2">Tutor Tidak Ditemukan</h3>
                <p class="text-slate-500 font-medium mb-8 text-sm leading-relaxed">
                    Maaf, kami belum menemukan tutor yang cocok dengan kata kunci atau lokasi tersebut. Coba gunakan kata kunci yang lebih umum.
                </p>
                <a href="{{ route('katalog.publik') }}" class="inline-block bg-blue-950 hover:bg-blue-800 text-white px-8 py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg shadow-blue-900/20">
                    Tampilkan Semua Tutor
                </a>
            </div>
        @endif

    </main>

    {{-- ========================================== --}}
    {{-- FOOTER MENDETAIL (SESUAI DESAIN) --}}
    {{-- ========================================== --}}
    <footer class="bg-slate-50 pt-20">
        <div class="max-w-4xl mx-auto px-6 text-center">
            
            {{-- Logo --}}
            <a href="/" class="inline-block mb-6">
                <img src="{{ asset('img/logo.png') }}" alt="tempatles.id Logo" class="h-20 mx-auto transition-transform hover:scale-105">
            </a>

            {{-- Deskripsi --}}
            <p class="text-slate-500 text-sm md:text-base leading-relaxed mb-8 max-w-2xl mx-auto font-medium">
                Tempatles.id membantu tutor mendapatkan murid les tanpa perlu pasang iklan. Daftar gratis, fleksibel memilih murid, dan sistem kerja transparan untuk tutor di seluruh Indonesia.
            </p>

            {{-- Social Media Icons --}}
            <div class="flex items-center justify-center gap-4 mb-10">
                <a href="#" class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors duration-300">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                </a>
                <a href="#" class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors duration-300">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.951-7.252 4.105 0 7.287 2.931 7.287 6.839 0 4.084-2.583 7.373-6.175 7.373-1.2 0-2.328-.624-2.715-1.362l-.741 2.825c-.268 1.024-1.001 2.302-1.493 3.082 1.306.398 2.686.611 4.109.611 6.621 0 11.988-5.367 11.988-11.987C24 5.367 18.638 0 12.017 0z"/></svg>
                </a>
                <a href="#" class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors duration-300">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
                <a href="#" class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors duration-300">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                </a>
                <a href="#" class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors duration-300">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z"/></svg>
                </a>
            </div>
            {{-- Links --}}
            <div class="flex flex-wrap items-center justify-center gap-x-10 gap-y-4 text-sm font-semibold text-slate-700 mb-12">
                <a href="#" class="hover:text-blue-600 transition-colors">Kebijakan Privasi</a>
                <a href="#" class="hover:text-blue-600 transition-colors">Kebijakan Hak Cipta</a>
                <a href="#" class="hover:text-blue-600 transition-colors">Kebijakan Biaya dan Tarif</a>
                <a href="#" class="hover:text-blue-600 transition-colors">Syarat dan Ketentuan</a>
            </div>
        </div>

        {{-- Bottom Copyright Bar --}}
        <div class="bg-slate-200/50 py-6 text-center text-sm font-medium text-slate-500">
            Copyright &copy; <span class="text-blue-600">tempatles.id</span> | Belajar jadi lebih mudah
        </div>
    </footer>

</body>
</html>