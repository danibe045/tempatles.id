<x-app-layout>
    <x-slot name="header">
        <div class="w-full">
            <p class="text-[10px] font-black text-orange-500 uppercase tracking-[0.25em] mb-1">Admin Panel</p>
            <h2 class="font-black text-2xl text-slate-900 leading-tight tracking-tight">
                Management Center
            </h2>
            <p class="text-sm text-slate-400 font-medium mt-0.5">Pantau pendaftaran dan legalitas mitra tutor Tempatles.id</p>
        </div>
    </x-slot>

    <div class="py-6 md:py-8">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 md:px-12 space-y-6 md:space-y-8">

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 mb-6 md:mb-10">

                {{-- Pending --}}
                <div class="bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl shadow-lg shadow-orange-500/20 p-5 md:p-6 relative overflow-hidden group border border-orange-400/50">
                    <div class="absolute top-0 right-0 w-24 h-24 md:w-32 md:h-32 bg-white/10 rounded-bl-[4rem] -translate-y-4 translate-x-4 transition group-hover:scale-110 duration-500"></div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-start">
                            <div class="inline-flex items-center justify-center w-10 h-10 md:w-12 md:h-12 bg-white/20 backdrop-blur-sm rounded-xl mb-3 md:mb-4 shadow-sm border border-white/20">
                                <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                        </div>
                        <p class="text-[9px] md:text-[10px] font-black text-orange-100 uppercase tracking-[0.2em]">Pending Review</p>
                        {{-- PERBAIKAN DI SINI: Panggil variabel $countPending --}}
                        <p class="text-3xl md:text-4xl font-black text-white mt-1 leading-none">{{ $countPending }}</p>
                    </div>
                </div>

                {{-- MoU --}}
                <div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl shadow-lg shadow-blue-600/20 p-5 md:p-6 relative overflow-hidden group border border-blue-400/50">
                    <div class="absolute top-0 right-0 w-24 h-24 md:w-32 md:h-32 bg-white/10 rounded-bl-[4rem] -translate-y-4 translate-x-4 transition group-hover:scale-110 duration-500"></div>
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-10 h-10 md:w-12 md:h-12 bg-white/20 backdrop-blur-sm rounded-xl mb-3 md:mb-4 shadow-sm border border-white/20">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        </div>
                        <p class="text-[9px] md:text-[10px] font-black text-blue-100 uppercase tracking-[0.2em]">Tahap MoU</p>
                        {{-- PERBAIKAN DI SINI: Panggil variabel $countMou --}}
                        <p class="text-3xl md:text-4xl font-black text-white mt-1 leading-none">{{ $countMou }}</p>
                    </div>
                </div>

                {{-- Aktif --}}
                <div class="bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-2xl shadow-lg shadow-emerald-500/20 p-5 md:p-6 relative overflow-hidden group border border-emerald-400/50 sm:col-span-2 md:col-span-1">
                    <div class="absolute top-0 right-0 w-24 h-24 md:w-32 md:h-32 bg-white/10 rounded-bl-[4rem] -translate-y-4 translate-x-4 transition group-hover:scale-110 duration-500"></div>
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-10 h-10 md:w-12 md:h-12 bg-white/20 backdrop-blur-sm rounded-xl mb-3 md:mb-4 shadow-sm border border-white/20">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </div>
                        <p class="text-[9px] md:text-[10px] font-black text-emerald-100 uppercase tracking-[0.2em]">Total Mitra Aktif</p>
                        {{-- PERBAIKAN DI SINI: Panggil variabel $countAktif --}}
                        <p class="text-3xl md:text-4xl font-black text-white mt-1 leading-none">{{ $countAktif }}</p>
                    </div>
                </div>
            </div>

            {{-- ========================================== --}}
            {{-- TABLE CARD (DENGAN FILTER DI DALAMNYA) --}}
            {{-- ========================================== --}}
            <div class="bg-white shadow-sm rounded-2xl overflow-hidden border border-gray-100">

                {{-- Header Tabel & Filter --}}
                <div class="px-5 py-5 md:px-6 border-b border-gray-100 flex flex-col xl:flex-row xl:items-center justify-between gap-5 bg-white">
                    
                    {{-- Kiri: Judul Tabel --}}
                    <div class="flex items-center gap-3">
                        <div class="w-1.5 h-6 bg-blue-950 rounded-full"></div>
                        <div>
                            <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest">Data Pendaftar Terbaru</h3>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-0.5">
                                Menampilkan {{ $tutors->count() }} entri
                            </p>
                        </div>
                    </div>

                    {{-- Kanan: Form Filter --}}
                    <form action="{{ route('admin.dashboard') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-2.5 w-full xl:w-auto">
                        
                        {{-- Select Mapel --}}
                        <div class="relative w-full sm:w-40">
                            <select name="mapel" class="appearance-none w-full pl-9 pr-8 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-600 focus:ring-2 focus:ring-blue-950 transition-all outline-none">
                                <option value="">Semua Mapel</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                            </div>
                        </div>

                        {{-- Input Pencarian --}}
                        <div class="relative w-full sm:w-64 lg:w-72">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama tutor..." 
                                class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-600 focus:ring-2 focus:ring-blue-950 transition-all outline-none placeholder:font-medium placeholder:text-slate-400">
                            <div class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            </div>
                        </div>

                        {{-- Tombol Filter --}}
                        <button type="submit" class="w-full sm:w-auto px-5 py-2 bg-blue-950 hover:bg-black text-white text-xs font-black uppercase tracking-widest rounded-xl transition-all shadow-md shadow-blue-900/20 flex justify-center items-center gap-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z" /></svg>
                            Filter
                        </button>
                    </form>
                </div>

                {{-- TAMPILAN MOBILE: KARTU BERSUSUN --}}
                <div class="block md:hidden divide-y divide-gray-100">
                    @forelse($tutors as $tutor)
                        @php
                            $statusConfig = [
                                'pending' => ['class' => 'bg-orange-50 text-orange-600 border-orange-200', 'dot' => 'bg-orange-400'],
                                'menunggu_mou' => ['class' => 'bg-blue-50 text-blue-700 border-blue-200', 'dot' => 'bg-blue-500'],
                                'aktif' => ['class' => 'bg-emerald-50 text-emerald-700 border-emerald-200', 'dot' => 'bg-emerald-500'],
                            ];
                            $cfg = $statusConfig[strtolower($tutor->status_akun)] ?? ['class' => 'bg-gray-50 text-gray-600 border-gray-200', 'dot' => 'bg-gray-400'];
                        @endphp
                        
                        <div class="p-4 space-y-4 hover:bg-slate-50 transition-colors">
                            <div class="flex justify-between items-start gap-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-blue-950 flex items-center justify-center text-white font-black text-sm flex-shrink-0 shadow-sm">
                                        {{ strtoupper(substr($tutor->user->name ?? 'T', 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-sm leading-tight line-clamp-1">{{ $tutor->user->name ?? 'Tanpa Nama' }}</p>
                                        <p class="text-[10px] text-slate-400 font-mono mt-0.5 truncate max-w-[120px]">{{ $tutor->user->email ?? '-' }}</p>
                                    </div>
                                </div>
                                <span class="flex-shrink-0 inline-flex items-center gap-1 px-2 py-1 rounded-md border {{ $cfg['class'] }} text-[8px] font-black uppercase tracking-wider shadow-sm">
                                    <span class="w-1 h-1 rounded-full {{ $cfg['dot'] }}"></span>
                                    {{ $tutor->status_akun }}
                                </span>
                            </div>

                            <div class="bg-slate-50 border border-slate-100 rounded-xl p-3 flex justify-between items-center">
                                <div>
                                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mb-0.5">Spesialisasi</p>
                                    <p class="text-xs font-black text-blue-950">{{ $tutor->bidang ?? 'Umum' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mb-0.5">Tarif Sesi</p>
                                    <p class="text-xs font-black text-emerald-600">Rp {{ number_format($tutor->tarif_per_sesi ?? 0, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <div class="flex gap-2 w-full">
                                <a href="https://wa.me/{{ $tutor->user->phone_number ?? '' }}" target="_blank"
                                    class="flex-1 inline-flex justify-center items-center gap-1.5 bg-emerald-50 text-emerald-600 font-black py-2 rounded-xl text-[10px] uppercase tracking-widest border border-emerald-100">
                                    WhatsApp
                                </a>
                                <a href="{{ route('admin.tutor.detail', $tutor->id) }}"
                                    class="flex-1 inline-flex justify-center items-center gap-1.5 bg-blue-950 text-white font-black py-2 rounded-xl text-[10px] uppercase tracking-widest shadow-sm">
                                    Detail
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <p class="text-sm font-bold text-slate-500">Belum ada data pendaftar</p>
                        </div>
                    @endforelse
                </div>

                {{-- TAMPILAN DESKTOP: TABEL STANDAR --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="bg-slate-50/50 text-slate-400 uppercase text-[9px] tracking-[0.18em] font-black border-b border-gray-100">
                                <th class="px-6 py-4">Tutor &amp; Kontak</th>
                                <th class="px-6 py-4">Spesialisasi &amp; Tarif</th>
                                <th class="px-6 py-4 text-center">Status Onboarding</th>
                                <th class="px-6 py-4 text-right">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($tutors as $tutor)
                            <tr class="hover:bg-slate-50/50 transition-colors duration-150 group">

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-blue-950 flex items-center justify-center text-white font-black text-sm flex-shrink-0 shadow-sm">
                                            {{ strtoupper(substr($tutor->user->name ?? 'T', 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-sm leading-tight">{{ $tutor->user->name ?? 'Tanpa Nama' }}</p>
                                            <p class="text-[10px] text-slate-400 font-mono mt-0.5">{{ $tutor->user->email ?? '-' }}</p>
                                            <a href="https://wa.me/{{ $tutor->user->phone_number ?? '' }}" target="_blank"
                                                class="inline-flex items-center gap-1 text-emerald-600 font-bold text-[9px] mt-1 hover:underline uppercase tracking-wider">
                                                WhatsApp
                                            </a>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 bg-slate-100 text-slate-600 border border-slate-200 rounded-lg text-[9px] font-black uppercase tracking-wider">
                                        {{ $tutor->bidang ?? 'Umum' }}
                                    </span>
                                    <p class="text-sm font-black text-slate-800 mt-2">
                                        Rp {{ number_format($tutor->tarif_per_sesi ?? 0, 0, ',', '.') }}
                                        <span class="text-[9px] text-slate-400 font-semibold">/sesi</span>
                                    </p>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @php
                                        $statusConfig = [
                                            'pending' => ['class' => 'bg-orange-50 text-orange-600 border-orange-200', 'dot' => 'bg-orange-400'],
                                            'menunggu_mou' => ['class' => 'bg-blue-50 text-blue-700 border-blue-200', 'dot' => 'bg-blue-500'],
                                            'aktif' => ['class' => 'bg-emerald-50 text-emerald-700 border-emerald-200', 'dot' => 'bg-emerald-500'],
                                        ];
                                        $cfg = $statusConfig[strtolower($tutor->status_akun)] ?? ['class' => 'bg-gray-50 text-gray-600 border-gray-200', 'dot' => 'bg-gray-400'];
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border {{ $cfg['class'] }} text-[9px] font-black uppercase tracking-wider shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $cfg['dot'] }}"></span>
                                        {{ $tutor->status_akun }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.tutor.detail', $tutor->id) }}"
                                        class="inline-flex items-center gap-2 border border-slate-200 hover:bg-blue-950 hover:border-blue-950 hover:text-white text-slate-600 font-black py-2 px-4 rounded-xl transition-all duration-200 text-[9px] uppercase tracking-widest group-hover:shadow-md">
                                        Periksa Data
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-20 bg-slate-50/30">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-16 h-16 rounded-3xl bg-white shadow-sm border border-slate-100 flex items-center justify-center">
                                            <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <p class="text-sm font-bold text-slate-500 mt-2">Belum ada data pendaftar tutor</p>
                                        <p class="text-xs text-slate-400">Data akan muncul otomatis saat ada tutor yang mendaftar</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Footer tabel --}}
                @if($tutors->count() > 0)
                <div class="px-4 py-3 md:px-6 md:py-4 bg-slate-50/80 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-3">
                    <p class="text-[9px] md:text-[10px] text-slate-400 font-semibold">
                        Menampilkan <span class="font-black text-slate-700">{{ $tutors->count() }}</span> data tutor
                    </p>
                    <div class="flex items-center gap-1.5 bg-white px-2.5 py-1.5 rounded-lg border border-slate-200 shadow-sm">
                        <div class="w-1.5 h-1.5 rounded-full bg-orange-400"></div>
                        <div class="w-1.5 h-1.5 rounded-full bg-blue-500 ml-1"></div>
                        <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 ml-1"></div>
                        <span class="text-[8px] md:text-[9px] text-slate-500 ml-1 font-bold uppercase tracking-wider">Pending · MoU · Aktif</span>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>