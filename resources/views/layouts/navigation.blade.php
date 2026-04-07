{{-- Layar Gelap (Backdrop) saat menu HP terbuka --}}
<div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false" class="fixed inset-0 z-[90] bg-slate-900/60 backdrop-blur-sm md:hidden" style="display: none;"></div>

{{-- Sidebar Utama --}}
<aside class="fixed inset-y-0 left-0 w-64 bg-white border-r border-slate-100 flex flex-col z-[100] transition-transform duration-300 md:translate-x-0"
    :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">

    {{-- Logo & Tombol Close untuk HP --}}
    <div class="h-20 flex items-center justify-between px-6 border-b border-slate-50 flex-shrink-0">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-14 w-auto drop-shadow-sm">
            <div class="flex items-baseline">
                <span class="font-black text-blue-950 text-lg tracking-tight leading-none">tempatles</span>
                <span class="font-black text-orange-500 text-lg tracking-tight leading-none">.id</span>
            </div>
        </a>
        
        {{-- Tombol Close (X) hanya di HP --}}
        <button @click="sidebarOpen = false" class="md:hidden text-slate-300 hover:text-rose-500 transition focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 mt-6 overflow-y-auto px-3 space-y-6 pb-6">

        {{-- Main --}}
        @can('access-admin')
        <div>
            <p class="px-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] mb-2">Main</p>
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-3 py-2.5 text-[10px] font-black uppercase tracking-widest transition-all duration-200 rounded-xl
                {{ request()->routeIs('admin.dashboard') ? 'bg-blue-950 text-white shadow-md shadow-blue-950/20' : 'text-slate-500 hover:text-blue-950 hover:bg-slate-50' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>
        </div>

        {{-- Manajemen Pengguna --}}
        <div>
            <p class="px-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] mb-2">Manajemen Pengguna</p>
            <div class="space-y-1">
                {{-- Menu Tutor (Eksisting) --}}
                <a href="{{ route('admin.katalog-tutor') ?? '#' }}"
                    class="flex items-center gap-3 px-3 py-2.5 text-[10px] font-black uppercase tracking-widest transition-all duration-200 rounded-xl
                    {{ request()->routeIs('admin.katalog-tutor') ? 'bg-blue-950 text-white shadow-md shadow-blue-950/20' : 'text-slate-500 hover:text-blue-950 hover:bg-slate-50' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    Katalog Tutor
                </a>
                {{-- Menu Silabus (Eksisting) --}}
                <a href="{{ route('admin.silabus') ?? '#' }}"
                    class="flex items-center gap-3 px-3 py-2.5 text-[10px] font-black uppercase tracking-widest transition-all duration-200 rounded-xl
                    {{ request()->routeIs('admin.silabus') ? 'bg-blue-950 text-white shadow-md shadow-blue-950/20' : 'text-slate-500 hover:text-blue-950 hover:bg-slate-50' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    Monitoring Silabus
                </a>
                {{-- Menu Siswa (BARU) --}}
                <a href="{{ route('admin.siswa.index') ?? '#' }}"
                    class="flex items-center gap-3 px-3 py-2.5 text-[10px] font-black uppercase tracking-widest transition-all duration-200 rounded-xl
                    {{ request()->routeIs('admin.siswa.*') ? 'bg-blue-950 text-white shadow-md shadow-blue-950/20' : 'text-slate-500 hover:text-blue-950 hover:bg-slate-50' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Data Siswa
                </a>
            </div>
        </div>

        {{-- Operasional --}}
        <div>
            <p class="px-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] mb-2">Operasional</p>
            <div class="space-y-1">
                <a href="{{ route('admin.orders') ?? '#' }}"
                    class="flex items-center gap-3 px-3 py-2.5 text-[10px] font-black uppercase tracking-widest transition-all duration-200 rounded-xl
                    {{ request()->routeIs('admin.orders') ? 'bg-blue-950 text-white shadow-md shadow-blue-950/20' : 'text-slate-500 hover:text-blue-950 hover:bg-slate-50' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                    Manajemen Pesanan
                </a>
                <a href="{{ route('admin.absensi') ?? '#' }}"
                    class="flex items-center gap-3 px-3 py-2.5 text-[10px] font-black uppercase tracking-widest transition-all duration-200 rounded-xl
                    {{ request()->routeIs('admin.absensi') ? 'bg-blue-950 text-white shadow-md shadow-blue-950/20' : 'text-slate-500 hover:text-blue-950 hover:bg-slate-50' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2m-6 9l2 2 4-4" /></svg>
                    Absensi & Jurnal Mengajar
                </a>
                <a href="{{ route('admin.resolusi') ?? '#' }}"
                    class="flex items-center gap-3 px-3 py-2.5 text-[10px] font-black uppercase tracking-widest transition-all duration-200 rounded-xl
                    {{ request()->routeIs('admin.resolusi') ? 'bg-blue-950 text-white shadow-md shadow-blue-950/20' : 'text-slate-500 hover:text-blue-950 hover:bg-slate-50' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                    Resolusi Komplain
                </a>
            </div>
        </div>

        {{-- Kendali Mutu --}}
        <div>
            <p class="px-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] mb-2">Kendali Mutu</p>
            <a href="{{ route('admin.strike') ?? '#' }}"
                class="flex items-center gap-3 px-3 py-2.5 text-[10px] font-black uppercase tracking-widest transition-all duration-200 rounded-xl
                {{ request()->routeIs('admin.strike') ? 'bg-blue-950 text-white shadow-md shadow-blue-950/20' : 'text-slate-500 hover:text-blue-950 hover:bg-slate-50' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                Manajemen Strike
            </a>
        </div>

        {{-- Keuangan --}}
        <div>
            <p class="px-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] mb-2">Keuangan</p>
            <div class="space-y-1">
                <a href="{{ route('admin.escrow') ?? '#' }}"
                    class="flex items-center gap-3 px-3 py-2.5 text-[10px] font-black uppercase tracking-widest transition-all duration-200 rounded-xl
                    {{ request()->routeIs('admin.escrow') ? 'bg-blue-950 text-white shadow-md shadow-blue-950/20' : 'text-slate-500 hover:text-blue-950 hover:bg-slate-50' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                    Monitoring Escrow
                </a>
                <a href="{{ route('admin.payout') ?? '#' }}"
                    class="flex items-center gap-3 px-3 py-2.5 text-[10px] font-black uppercase tracking-widest transition-all duration-200 rounded-xl
                    {{ request()->routeIs('admin.payout') ? 'bg-blue-950 text-white shadow-md shadow-blue-950/20' : 'text-slate-500 hover:text-blue-950 hover:bg-slate-50' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    Pencairan Dana (Payout)
                </a>
            </div>
        </div>
        @endcan

        {{-- Personal --}}
        <div>
            <p class="px-3 text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] mb-2">Personal</p>
            <a href="{{ route('profile.edit') }}"
                class="flex items-center gap-3 px-3 py-2.5 text-[10px] font-black uppercase tracking-widest transition-all duration-200 rounded-xl
                {{ request()->routeIs('profile.edit') ? 'bg-blue-950 text-white shadow-md shadow-blue-950/20' : 'text-slate-500 hover:text-blue-950 hover:bg-slate-50' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                Profil Saya
            </a>
        </div>

    </nav>

    {{-- User Footer --}}
    <div class="p-4 border-t border-slate-100 flex-shrink-0">
        <div class="flex items-center gap-3 px-2 mb-3">
            <div class="w-8 h-8 rounded-xl bg-blue-950 flex items-center justify-center text-white font-black text-xs shadow-sm flex-shrink-0">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="overflow-hidden flex-1 min-w-0">
                <p class="text-xs font-bold text-slate-800 truncate leading-tight">{{ Auth::user()->name }}</p>
                <p class="text-[9px] text-slate-400 uppercase font-black tracking-wider">{{ Auth::user()->role }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center justify-center gap-2 w-full px-3 py-2.5 text-[9px] font-black uppercase tracking-widest text-rose-500 hover:text-rose-700 bg-rose-50/50 hover:bg-rose-100 rounded-xl transition-all duration-200">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                Log Out
            </button>
        </form>
    </div>
</aside>