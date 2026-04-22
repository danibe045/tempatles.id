<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'tempatles.id - Platform Les Privat')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    {{-- Alpine.js untuk fitur Dropdown Mobile Menu --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .hide-scroll::-webkit-scrollbar { display: none; }
        .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 antialiased flex flex-col min-h-screen overflow-x-hidden" x-data="{ mobileMenuOpen: false }">

    {{-- NAVBAR --}}
    <nav @click.outside="mobileMenuOpen = false" class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-100 shadow-sm">
        <div class="flex items-center justify-between px-6 md:px-12 py-4 max-w-7xl mx-auto w-full">
            {{-- Kiri: Logo --}}
            <div class="flex items-center gap-2">
                <a href="/" class="flex items-center gap-3 group">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-12 w-auto transition-transform group-hover:scale-105">
                    <div class="hidden sm:block">
                        <span class="font-black text-blue-950 text-xl tracking-tight leading-none">tempatles</span>
                        <span class="font-black text-orange-500 text-xl tracking-tight leading-none">.id</span>
                    </div>
                </a>
            </div>

            {{-- Tengah: Menu Desktop --}}
            <div class="hidden lg:flex items-center space-x-10 text-[13px] font-bold uppercase tracking-widest text-slate-500">
                <a href="/" class="{{ request()->is('/') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'hover:text-blue-600 transition-colors' }}">Home</a>
                <a href="{{ route('katalog.publik') }}" class="{{ request()->routeIs('katalog.publik') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'hover:text-blue-600 transition-colors' }}">Cari Tutor</a>
                
                @auth
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'hover:text-blue-600 transition-colors' }}">Ruang Belajar</a>
                @else
                    <a href="{{ route('layanan') }}" class="{{ request()->routeIs('layanan') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'hover:text-blue-600 transition-colors' }}">Layanan Kami</a>
                    <a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'hover:text-blue-600 transition-colors' }}">Tentang</a>
                @endauth
            </div>

            {{-- Kanan: Auth / Guest --}}
            <div class="flex items-center gap-4">
                @auth
                    <div class="hidden md:flex flex-col items-end justify-center">
                        <p class="text-xs font-black text-slate-900 leading-none">{{ explode(' ', auth()->user()->name ?? 'User')[0] }}</p>
                        <p class="text-[9px] font-bold text-emerald-500 mt-1 uppercase tracking-widest flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span> Online
                        </p>
                    </div>
                    <div class="w-11 h-11 bg-gradient-to-br from-blue-600 to-blue-800 text-white rounded-xl flex items-center justify-center font-black text-base shadow-lg shadow-blue-200 border-2 border-white">
                        {{ strtoupper(substr(auth()->user()->name ?? 'M', 0, 1)) }}
                    </div>
                    <div class="hidden md:block h-8 w-px bg-slate-200 mx-1"></div>
                    <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
                        @csrf
                        <button type="submit" class="group flex items-center justify-center w-10 h-10 bg-white border border-slate-200 text-slate-400 rounded-xl hover:bg-rose-50 hover:text-rose-500 hover:border-rose-200 transition-all shadow-sm" title="Keluar">
                            <svg class="w-5 h-5 ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                @else
                    <div class="hidden lg:flex items-center gap-4">
                        <a href="{{ route('login') }}" class="text-xs font-black uppercase tracking-widest text-slate-600 hover:text-blue-600 transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-blue-950 text-white px-7 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-orange-500 transition-all shadow-lg shadow-blue-950/20">Daftar Gratis</a>
                    </div>
                @endauth

                {{-- Hamburger Menu Button (Mobile) --}}
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="block lg:hidden p-2 text-slate-600 hover:text-blue-600 focus:outline-none">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="mobileMenuOpen" style="display:none;" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Dropdown Mobile Menu --}}
        <div x-show="mobileMenuOpen" style="display:none;" x-transition class="lg:hidden bg-white border-t border-slate-100 shadow-xl absolute w-full left-0 z-40">
            <div class="flex flex-col px-6 py-4 space-y-4 text-sm font-bold uppercase tracking-widest text-slate-500">
                <a href="/" class="{{ request()->is('/') ? 'text-blue-600' : 'hover:text-blue-600' }}">Home</a>
                <a href="{{ route('katalog.publik') }}" class="{{ request()->routeIs('katalog.publik') ? 'text-blue-600' : 'hover:text-blue-600' }}">Cari Tutor</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'text-blue-600' : 'hover:text-blue-600' }}">Ruang Belajar</a>
                    <hr class="border-slate-100">
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="text-rose-500 hover:text-rose-700 text-left w-full font-bold uppercase tracking-widest">Keluar Akun</button>
                    </form>
                @else
                    <a href="{{ route('layanan') }}" class="{{ request()->routeIs('layanan') ? 'text-blue-600' : 'hover:text-blue-600' }}">Layanan Kami</a>
                    <a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'text-blue-600' : 'hover:text-blue-600' }}">Tentang</a>
                    <hr class="border-slate-100">
                    <a href="{{ route('login') }}" class="hover:text-blue-600">Masuk Akun</a>
                    <a href="{{ route('register') }}" class="text-blue-600">Daftar Gratis</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- KONTEN DINAMIS --}}
    <div class="flex-grow flex flex-col">
        @yield('content')
    </div>

    {{-- FOOTER GLOBAL --}}
    <footer class="bg-slate-50 pt-16 border-t border-slate-200 mt-auto">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <a href="/" class="inline-block mb-6">
                <img src="{{ asset('img/logo.png') }}" alt="tempatles.id Logo" class="h-16 mx-auto transition-transform hover:scale-105">
            </a>
            <p class="text-slate-500 text-sm leading-relaxed mb-8 max-w-2xl mx-auto font-medium">
                Tempatles.id membantu tutor mendapatkan murid les tanpa perlu pasang iklan. Daftar gratis, fleksibel memilih murid, dan sistem kerja transparan untuk tutor di seluruh Indonesia.
            </p>
            <div class="flex items-center justify-center gap-4 mb-10">
                <a href="#" class="w-10 h-10 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center hover:bg-blue-700 hover:text-white transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path></svg></a>
                <a href="https://wa.me/6285859222500" class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg></a>
            </div>
            
            {{-- LINK SEO FOOTER --}}
            <div class="flex flex-wrap items-center justify-center gap-x-8 gap-y-4 text-xs font-bold text-slate-600 mb-8">
                <a href="{{ route('layanan') }}" class="hover:text-blue-600 transition-colors">Layanan Kami</a>
                <a href="{{ route('tentang') }}" class="hover:text-blue-600 transition-colors">Tentang Kami</a>
                <a href="#" class="hover:text-blue-600 transition-colors">Kebijakan Privasi</a>
                <a href="#" class="hover:text-blue-600 transition-colors">Syarat & Ketentuan</a>
            </div>
        </div>
        <div class="bg-slate-200/50 py-5 text-center text-xs font-bold text-slate-500">
            Copyright &copy; {{ date('Y') }} <span class="text-blue-600">tempatles.id</span>
        </div>
    </footer>
</body>
</html>