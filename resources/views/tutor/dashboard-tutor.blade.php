<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Tutor - tempatles.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="bg-[#F8FAFC] text-slate-900 antialiased flex flex-col min-h-screen">

    {{-- NAVBAR PREMIUM --}}
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-6 md:px-12 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <a href="/" class="flex items-center gap-2 group">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-9 transition-transform group-hover:scale-110">
                    <span class="font-black text-blue-950 text-xl tracking-tighter">tempatles<span class="text-orange-500">.id</span></span>
                </a>
            </div>
            
            <div class="flex items-center gap-6">
                <div class="hidden md:flex flex-col text-right border-r border-slate-200 pr-4">
                    <span class="text-xs font-black text-slate-900 leading-none mb-1">{{ $user->name }}</span>
                    <span class="text-[10px] font-bold text-orange-500 uppercase tracking-widest">Tutor Berlisensi</span>
                </div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="group flex items-center gap-2 bg-rose-50 hover:bg-rose-500 text-rose-500 hover:text-white px-4 py-2 rounded-xl font-bold text-xs transition-all duration-300">
                        <span>Keluar</span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto w-full px-6 pt-10 pb-20">
        
        {{-- HERO WELCOME --}}
        <div class="relative bg-white rounded-[2.5rem] p-8 md:p-14 mb-10 border border-slate-200 shadow-sm overflow-hidden group">
            {{-- Decorative Background --}}
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-orange-100 rounded-full blur-[100px] opacity-50 group-hover:opacity-80 transition-opacity"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-blue-100 rounded-full blur-[100px] opacity-50 group-hover:opacity-80 transition-opacity"></div>

            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="text-center md:text-left">
                    <div class="inline-flex items-center gap-2 bg-orange-50 text-orange-600 px-4 py-1.5 rounded-full mb-6 border border-orange-100">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                        </span>
                        <span class="text-[10px] font-black uppercase tracking-[0.2em]">Panel Kendali Pengajar</span>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-black text-slate-900 mb-4 tracking-tight">Halo, Guru <span class="text-blue-600">{{ explode(' ', $user->name)[0] }}!</span></h1>
                    <p class="text-slate-500 font-medium max-w-xl text-lg leading-relaxed">Senang melihatmu kembali. Siapkan materi terbaikmu dan bantu muridmu meraih masa depannya hari ini.</p>
                </div>
                
                <div class="grid grid-cols-1 gap-3 w-full md:w-auto">
                    <button class="bg-blue-950 hover:bg-blue-900 text-white px-8 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-xl shadow-blue-950/20 active:scale-95">
                        Update Jadwal Libur
                    </button>
                    <button class="bg-white border-2 border-slate-100 hover:border-orange-500 text-slate-600 hover:text-orange-600 px-8 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all">
                        Edit Profil Publik
                    </button>
                </div>
            </div>
        </div>

        {{-- STATS GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            {{-- Status Akun --}}
            <div class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm hover:border-orange-300 transition-all duration-300 group">
                <div class="w-14 h-14 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Status Akun</p>
                <div class="flex items-center gap-2">
                    <span class="text-xl font-black text-slate-800 uppercase leading-none">{{ $user->tutorProfile->status_akun ?? 'Menunggu Verifikasi' }}</span>
                </div>
            </div>

            {{-- Bidang Mengajar --}}
            <div class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm hover:border-blue-300 transition-all duration-300 group">
                <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Spesialisasi</p>
                <span class="text-xl font-black text-slate-800 leading-none">{{ $user->tutorProfile->bidang ?? 'Belum Diatur' }}</span>
            </div>

            {{-- Rating --}}
            <div class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm hover:border-yellow-400 transition-all duration-300 group">
                <div class="w-14 h-14 bg-yellow-50 text-yellow-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                </div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Rating Rata-rata</p>
                <div class="flex items-center gap-2">
                    <span class="text-3xl font-black text-slate-800 leading-none">5.0</span>
                    <span class="text-sm font-bold text-slate-400">/ 5.0</span>
                </div>
            </div>
        </div>

        {{-- EMPTY STATE / CONTENT --}}
        <div class="relative group">
            <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-orange-500 rounded-[3rem] blur opacity-10 group-hover:opacity-20 transition duration-1000 group-hover:duration-200"></div>
            <div class="relative bg-white p-12 md:p-20 rounded-[2.5rem] border border-slate-200 text-center flex flex-col items-center">
                <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-8 border border-slate-100">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-2xl font-black text-slate-800 mb-4 tracking-tight">Agenda Masih Kosong</h3>
                <p class="text-slate-500 font-medium max-w-sm mb-10 leading-relaxed">Saat ini belum ada jadwal mengajar atau absensi yang perlu diproses. Yuk, terus tingkatkan profilmu agar lebih menarik bagi murid!</p>
                <a href="{{ route('katalog.publik') }}" class="inline-flex items-center gap-3 text-blue-600 font-black text-xs uppercase tracking-widest hover:gap-5 transition-all">
                    Lihat Penampilan Profil Kamu 
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>

    </main>

    <footer class="mt-auto py-10 border-t border-slate-200 bg-white">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em]">Hak Cipta Pengajar &copy; {{ date('Y') }} tempatles.id</p>
        </div>
    </footer>

</body>
</html>