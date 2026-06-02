<x-app-layout>
    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 99px; }
    </style>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div class="w-full">
                <div class="inline-flex items-center gap-2 bg-orange-100 border border-orange-200 px-3 py-1 rounded-full mb-3 shadow-sm">
                    <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span>
                    <p class="text-[10px] font-black text-orange-600 uppercase tracking-[0.2em]">Pusat Kendali Admin</p>
                </div>
                <h2 class="font-black text-3xl text-slate-900 leading-tight tracking-tight">
                    Manajemen Mitra Tutor
                </h2>
                <p class="text-sm text-slate-500 font-medium mt-1.5 max-w-xl">
                    Pantau antrean pendaftaran, verifikasi legalitas, dan kelola status kemitraan tutor Tempatles.id secara real-time.
                </p>
            </div>
        </div>
    </x-slot>

    <div x-data="{ modalOpen: false, activeModal: null, confirmOpen: false, confirmTutorId: null, confirmType: '' }" class="py-8 md:py-12 bg-[#0f172a]/50 min-h-screen relative z-10">

        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- ── STATS CARDS ── --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 md:gap-8">
                <div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-[2rem] shadow-xl shadow-blue-500/20 p-6 md:p-8 relative overflow-hidden group border border-blue-400">
                    <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-white/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div class="flex justify-between items-start mb-6">
                            <div class="w-14 h-14 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center border border-white/30 shadow-inner">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            </div>
                            <span class="bg-white/20 text-white px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border border-white/20 backdrop-blur-sm">Verifikasi</span>
                        </div>
                        <div>
                            <p class="text-[11px] font-black text-blue-100 uppercase tracking-[0.2em] mb-1">Tahap MoU</p>
                            <p class="text-5xl font-black text-white leading-none tracking-tighter">{{ $countMou }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-emerald-500 to-emerald-700 rounded-[2rem] shadow-xl shadow-emerald-500/20 p-6 md:p-8 relative overflow-hidden group border border-emerald-400">
                    <div class="absolute -top-10 -left-10 w-32 h-32 bg-white/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div class="flex justify-between items-start mb-6">
                            <div class="w-14 h-14 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center border border-white/30 shadow-inner">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            </div>
                            <span class="bg-white/20 text-white px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border border-white/20 backdrop-blur-sm">Siap Mengajar</span>
                        </div>
                        <div>
                            <p class="text-[11px] font-black text-emerald-100 uppercase tracking-[0.2em] mb-1">Total Mitra Aktif</p>
                            <p class="text-5xl font-black text-white leading-none tracking-tighter">{{ $countAktif }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── TABLE CARD ── --}}
            <div class="bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-[2.5rem] overflow-hidden border border-slate-200 relative">

                {{-- Header Filter --}}
                <div class="px-6 py-6 border-b border-slate-100 flex flex-col xl:flex-row xl:items-center justify-between gap-5 bg-white">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 border border-blue-100 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        </div>
                        <div>
                            <h3 class="font-black text-slate-800 text-lg tracking-tight">Database Pendaftar</h3>
                            <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest mt-0.5">
                                Total {{ $tutors->count() }} Entri Ditemukan
                            </p>
                        </div>
                    </div>

                    <form action="{{ route('admin.dashboard') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-3 w-full xl:w-auto">
                        <div class="relative w-full sm:w-64 lg:w-72">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..."
                                class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none placeholder:font-medium placeholder:text-slate-400">
                            <div class="pointer-events-none absolute inset-y-0 left-3.5 flex items-center">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            </div>
                        </div>
                        <div class="flex gap-2 w-full sm:w-auto">
                            <button type="submit" class="flex-1 sm:flex-none px-6 py-3 bg-slate-900 hover:bg-blue-600 text-white text-xs font-black uppercase tracking-widest rounded-xl transition-all shadow-lg shadow-slate-900/20 active:scale-95 border border-slate-800 hover:border-blue-500">
                                Cari
                            </button>
                            @if(request('search'))
                                <a href="{{ route('admin.dashboard') }}" class="flex-1 sm:flex-none px-6 py-3 bg-slate-100 hover:bg-rose-50 text-slate-500 hover:text-rose-600 text-xs font-black uppercase tracking-widest rounded-xl transition-all border border-slate-200 hover:border-rose-200 text-center flex items-center justify-center">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                @php
                $statusConfig = [
                    'menunggu_mou' => ['class' => 'bg-blue-50 text-blue-700 border-blue-200',    'dot' => 'bg-blue-500',    'text' => 'Tahap MoU'],
                    'aktif'        => ['class' => 'bg-emerald-50 text-emerald-700 border-emerald-200', 'dot' => 'bg-emerald-500', 'text' => 'Aktif'],
                ];
                @endphp

                {{-- Mobile View --}}
                <div class="block md:hidden divide-y divide-slate-100">
                    @forelse($tutors as $tutor)
                        @php
                        $cfg = $statusConfig[strtolower($tutor->status_akun)] ?? ['class' => 'bg-slate-50 text-slate-600 border-slate-200', 'dot' => 'bg-slate-400', 'text' => $tutor->status_akun];
                        @endphp
                        <div class="p-5 space-y-4 hover:bg-slate-50 transition-colors">
                            <div class="flex justify-between items-start gap-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-2xl bg-blue-950 flex items-center justify-center text-white font-black text-lg shrink-0 shadow-sm border border-blue-900">
                                        {{ strtoupper(substr($tutor->user->name ?? 'T', 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-black text-slate-800 text-sm leading-tight line-clamp-1">{{ $tutor->user->name ?? 'Tanpa Nama' }}</p>
                                        <p class="text-[10px] text-slate-400 font-bold mt-0.5 truncate max-w-[140px]">{{ $tutor->user->email ?? '-' }}</p>
                                    </div>
                                </div>
                                <span class="shrink-0 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md border {{ $cfg['class'] }} text-[8px] font-black uppercase tracking-widest shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $cfg['dot'] }}"></span>
                                    {{ $cfg['text'] }}
                                </span>
                            </div>
                            <div class="bg-slate-50 border border-slate-100 rounded-xl p-3 flex justify-between items-center">
                                <div>
                                    <p class="text-[9px] text-slate-400 font-black uppercase tracking-widest mb-0.5">Spesialisasi Mengajar</p>
                                    <p class="text-xs font-black text-blue-950">{{ $tutor->bidang ?? 'Pengajar Umum' }}</p>
                                </div>
                            </div>
                            <div class="flex gap-2 w-full pt-1">
                                <a href="https://wa.me/{{ $tutor->user->phone_number ?? '' }}" target="_blank"
                                   class="flex-1 inline-flex justify-center items-center gap-1.5 bg-white text-emerald-600 font-black py-2.5 rounded-xl text-[10px] uppercase tracking-widest border border-slate-200 hover:bg-emerald-50 hover:border-emerald-200 transition-colors shadow-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                                    Chat
                                </a>
                                <button type="button" @click="modalOpen = true; activeModal = {{ $tutor->id }}"
                                    class="flex-1 inline-flex justify-center items-center gap-1.5 bg-slate-900 hover:bg-blue-600 text-white font-black py-2.5 rounded-xl text-[10px] uppercase tracking-widest shadow-md transition-colors border border-slate-800 hover:border-blue-500">
                                    Tinjau Data
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-16">
                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3 border border-slate-200 shadow-sm">
                                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            </div>
                            <p class="text-sm font-bold text-slate-600">Belum ada data pendaftar.</p>
                        </div>
                    @endempty
                </div>

                {{-- Desktop View --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest whitespace-nowrap">Tutor &amp; Kontak</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest">Spesialisasi</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest text-center">Status Onboarding</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest text-right">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($tutors as $tutor)
                                @php
                                $cfg = $statusConfig[strtolower($tutor->status_akun)] ?? ['class' => 'bg-slate-50 text-slate-600 border-slate-200', 'dot' => 'bg-slate-400', 'text' => $tutor->status_akun];
                                @endphp
                                <tr class="hover:bg-slate-50/50 transition-colors duration-200 group">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-2xl bg-blue-950 flex items-center justify-center text-white font-black text-lg shrink-0 shadow-sm border border-blue-900 group-hover:scale-105 transition-transform">
                                                {{ strtoupper(substr($tutor->user->name ?? 'T', 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="font-black text-slate-900 text-sm leading-tight">{{ $tutor->user->name ?? 'Tanpa Nama' }}</p>
                                                <p class="text-[10px] text-slate-500 font-bold mt-0.5">{{ $tutor->user->email ?? '-' }}</p>
                                                <a href="https://wa.me/{{ $tutor->user->phone_number ?? '' }}" target="_blank"
                                                   class="inline-flex items-center gap-1 text-emerald-600 font-black text-[9px] mt-1.5 hover:underline uppercase tracking-widest bg-emerald-50 px-2 py-0.5 rounded border border-emerald-100">
                                                    Chat WhatsApp
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <span class="px-3 py-1.5 bg-slate-50 text-slate-700 border border-slate-200 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm">
                                            {{ $tutor->bidang ?? 'Umum' }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 text-center">
                                        <span class="inline-flex items-center justify-center gap-1.5 px-3 py-1.5 rounded-full border {{ $cfg['class'] }} text-[9px] font-black uppercase tracking-widest shadow-sm min-w-[120px]">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $cfg['dot'] }}"></span>
                                            {{ $cfg['text'] }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 text-right">
                                        <button type="button" @click="modalOpen = true; activeModal = {{ $tutor->id }}"
                                            class="inline-flex items-center gap-2 bg-white border border-slate-200 hover:bg-blue-600 hover:border-blue-600 hover:text-white text-slate-600 font-black py-2.5 px-5 rounded-xl transition-all duration-300 text-[10px] uppercase tracking-widest shadow-sm active:scale-95 group/btn">
                                            Tinjau Data
                                            <svg class="w-3.5 h-3.5 transition-transform group-hover/btn:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-24 bg-white">
                                        <div class="flex flex-col items-center gap-3">
                                            <div class="w-20 h-20 rounded-full bg-slate-50 border-8 border-slate-100 flex items-center justify-center">
                                                <span class="text-3xl grayscale opacity-50">📂</span>
                                            </div>
                                            <p class="text-base font-black text-slate-800 mt-2">Belum Ada Pendaftar</p>
                                            <p class="text-xs font-medium text-slate-500 max-w-sm">Data tutor baru akan otomatis muncul di sini setelah mereka mengisi formulir registrasi.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endempty
                        </tbody>
                    </table>
                </div>

                @if($tutors->count() > 0)
                <div class="px-6 py-5 bg-white border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">
                        Menampilkan <span class="font-black text-slate-800">{{ $tutors->count() }}</span> data tutor
                    </p>
                    <div class="flex items-center gap-2 bg-slate-50 px-3 py-2 rounded-xl border border-slate-200 shadow-sm">
                        <div class="flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                            <span class="text-[8px] font-black text-slate-500 uppercase tracking-widest">Menunggu Tinjauan MoU</span>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- ══════════════════════════════════════════════════════════ --}}
        {{-- KUMPULAN MODAL (teleport ke body agar z-index bebas)       --}}
        {{-- ══════════════════════════════════════════════════════════ --}}
        <template x-teleport="body">
            <div>
                @foreach($tutors as $modalTutor)

                {{-- ─────────────────────────────────────────────── --}}
                {{-- MODAL 1 : DETAIL PROFIL (z-index 100)           --}}
                {{-- ─────────────────────────────────────────────── --}}
                <div x-show="modalOpen && activeModal === {{ $modalTutor->id }}"
                    x-cloak
                    class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6"
                    role="dialog" aria-modal="true">

                    {{-- Overlay --}}
                    <div x-show="modalOpen && activeModal === {{ $modalTutor->id }}"
                        x-transition.opacity.duration.300ms
                        class="fixed inset-0 bg-slate-900/70 backdrop-blur-sm"
                        @click="modalOpen = false; activeModal = null"></div>

                    {{-- Panel --}}
                    <div x-show="modalOpen && activeModal === {{ $modalTutor->id }}"
                        x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="relative w-full max-w-2xl max-h-[92vh] flex flex-col bg-white rounded-[1.5rem] shadow-2xl border border-slate-200/60 overflow-hidden">

                        {{-- ── HEADER COVER ── --}}
                        <div class="relative bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900 px-6 pt-5 pb-14 shrink-0 overflow-hidden">
                            <div class="absolute -top-8 -right-8 w-40 h-40 bg-white/5 rounded-full pointer-events-none"></div>
                            <div class="absolute bottom-0 left-10 w-24 h-24 bg-white/5 rounded-full pointer-events-none"></div>
                            <div class="relative z-10 flex items-start justify-between">
                                <div>
                                    <p class="text-[10px] font-bold text-white/40 uppercase tracking-widest">
                                        ID #{{ str_pad($modalTutor->id, 4, '0', STR_PAD_LEFT) }}
                                    </p>
                                    <p class="text-[10px] text-white/30 mt-1 font-medium">
                                        Bergabung {{ \Carbon\Carbon::parse($modalTutor->created_at)->translatedFormat('d M Y') }}
                                    </p>
                                </div>
                                <button type="button"
                                    @click="modalOpen = false; activeModal = null"
                                    class="w-9 h-9 flex items-center justify-center rounded-full bg-white/10 hover:bg-rose-500 border border-white/20 hover:border-rose-400 text-white transition-all active:scale-95">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </div>

                        {{-- ── AVATAR + NAMA (overlap yang lebih clean) ── --}}
                        <div class="px-6 -mt-9 relative z-10 flex items-center justify-between gap-4 shrink-0">
                            <div class="flex items-center gap-4">
                                {{-- Avatar dengan shadow yang lebih dalam --}}
                                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-3xl bg-blue-600 border-[5px] border-white shadow-xl shadow-slate-200/50 flex items-center justify-center text-white font-black text-3xl sm:text-4xl shrink-0 overflow-hidden">
                                    @if($modalTutor->user->profile_photo_path ?? false)
                                        <img src="{{ asset('storage/'.$modalTutor->user->profile_photo_path) }}" class="w-full h-full object-cover">
                                    @else
                                        {{ strtoupper(substr($modalTutor->user->name ?? 'T', 0, 1)) }}
                                    @endif
                                </div>

                                {{-- Nama & Bidang --}}
                                <div class="pt-7">
                                    <h3 class="text-xl sm:text-2xl font-black text-slate-900 leading-none mb-2">
                                        {{ $modalTutor->user->name ?? 'Tanpa Nama' }}
                                    </h3>
                                    <span class="inline-flex items-center bg-slate-100 text-slate-600 rounded-lg text-[10px] font-black uppercase tracking-widest border border-slate-200">
                                        {{ $modalTutor->bidang ?? 'Pengajar Umum' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Status Badge (Dipindahkan ke pojok kanan atas agar rapi) --}}
                            @php
                                $statusMap = [
                                    'menunggu_mou' => ['bg-blue-50 text-blue-700 border-blue-200', 'bg-blue-500', 'Tahap MoU'],
                                    'aktif'        => ['bg-emerald-50 text-emerald-700 border-emerald-200', 'bg-emerald-500', 'Aktif'],
                                ];
                                $sm = $statusMap[strtolower($modalTutor->status_akun)] ?? ['bg-slate-100 text-slate-600 border-slate-200', 'bg-slate-400', $modalTutor->status_akun];
                            @endphp
                            <span class="mb-6 shrink-0 inline-flex items-center gap-1.5 text-[9px] font-black border px-3 py-1.5 rounded-full {{ $sm[0] }} uppercase tracking-widest shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full {{ $sm[1] }} animate-pulse"></span>{{ $sm[2] }}
                            </span>
                        </div>

                        <div class="mx-6 mt-5 border-t border-slate-100 shrink-0"></div>

                        {{-- ── SCROLLABLE BODY ── --}}
                        <div class="px-6 pt-5 pb-3 overflow-y-auto custom-scrollbar flex-1 space-y-5">

                            {{-- Kontak & Personal --}}
                            <section>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    Kontak &amp; Personal
                                </p>
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="bg-slate-50 rounded-xl px-4 py-3 border border-slate-100">
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Email</p>
                                        <p class="text-xs font-bold text-slate-800 truncate">{{ $modalTutor->user->email ?? '-' }}</p>
                                    </div>
                                    <div class="bg-slate-50 rounded-xl px-4 py-3 border border-slate-100">
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">WhatsApp</p>
                                        <a href="https://wa.me/{{ $modalTutor->user->phone_number ?? '' }}" target="_blank"
                                           class="text-xs font-bold text-emerald-600 hover:underline flex items-center gap-1">
                                            <svg class="w-3 h-3 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.121 1.532 5.847L.057 23.077a.75.75 0 00.92.92l5.23-1.475A11.95 11.95 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.75a9.74 9.74 0 01-4.964-1.358l-.356-.212-3.693 1.041 1.04-3.595-.231-.37A9.748 9.748 0 012.25 12C2.25 6.615 6.615 2.25 12 2.25S21.75 6.615 21.75 12 17.385 21.75 12 21.75z"/></svg>
                                            {{ $modalTutor->user->phone_number ?? '-' }}
                                        </a>
                                    </div>
                                    <div class="bg-slate-50 rounded-xl px-4 py-3 border border-slate-100">
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Jenis Kelamin</p>
                                        <p class="text-xs font-bold text-slate-800">{{ $modalTutor->jenis_kelamin ?? '-' }}</p>
                                    </div>
                                    <div class="bg-slate-50 rounded-xl px-4 py-3 border border-slate-100">
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Tanggal Lahir</p>
                                        <p class="text-xs font-bold text-slate-800">
                                            {{ $modalTutor->tempat_lahir ?? '-' }},
                                            {{ $modalTutor->tanggal_lahir ? \Carbon\Carbon::parse($modalTutor->tanggal_lahir)->translatedFormat('d M Y') : '-' }}
                                        </p>
                                    </div>
                                    <div class="bg-slate-50 rounded-xl px-4 py-3 border border-slate-100 col-span-2">
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Alamat Domisili</p>
                                        <p class="text-xs font-bold text-slate-800 leading-relaxed">{{ $modalTutor->alamat_domisili ?? '-' }}</p>
                                    </div>
                                </div>
                            </section>

                            {{-- Akademik & Pengalaman --}}
                            <section>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6"/></svg>
                                    Akademik &amp; Pengalaman
                                </p>
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="bg-slate-50 rounded-xl px-4 py-3 border border-slate-100">
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Pendidikan Terakhir</p>
                                        <p class="text-xs font-bold text-slate-800">{{ $modalTutor->pendidikan_terakhir ?? '-' }}</p>
                                    </div>
                                    <div class="bg-slate-50 rounded-xl px-4 py-3 border border-slate-100">
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Instansi / Universitas</p>
                                        <p class="text-xs font-bold text-slate-800">{{ $modalTutor->instansi ?? '-' }}</p>
                                    </div>
                                    <div class="bg-slate-50 rounded-xl px-4 py-3 border border-slate-100 col-span-2 border-l-[3px] border-l-blue-400">
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Riwayat Pengalaman</p>
                                        <p class="text-xs text-slate-700 font-medium leading-relaxed whitespace-pre-line">{{ $modalTutor->pengalaman ?? 'Belum mengisi riwayat pengalaman.' }}</p>
                                    </div>
                                </div>
                            </section>

                            {{-- Dokumen Kualifikasi --}}
                            <section class="pb-1">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                                    Dokumen Kualifikasi
                                </p>
                                <div class="bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 flex items-center justify-between gap-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 bg-blue-100 rounded-xl flex items-center justify-center shrink-0 border border-blue-200">
                                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-bold text-slate-800">Silabus, CV &amp; KTP</p>
                                            <p class="text-[10px] text-slate-400 font-medium mt-0.5">Google Drive</p>
                                        </div>
                                    </div>
                                    @if($modalTutor->link)
                                        <a href="{{ $modalTutor->link }}" target="_blank"
                                           class="shrink-0 inline-flex items-center gap-1.5 text-[10px] font-black text-blue-600 bg-blue-50 hover:bg-blue-100 border border-blue-200 px-3 py-1.5 rounded-full transition-colors uppercase tracking-wider">
                                            Buka
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        </a>
                                    @else
                                        <span class="shrink-0 text-[10px] font-black text-rose-500 bg-rose-50 border border-rose-100 px-3 py-1.5 rounded-full uppercase tracking-wider">
                                            Belum Ada Tautan
                                        </span>
                                    @endif
                                </div>
                            </section>

                        </div>

                        {{-- ── FOOTER ACTIONS ── --}}
                        <div class="px-6 py-4 border-t border-slate-100 bg-white flex items-center justify-between gap-3 shrink-0">
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Status Akun</p>
                                <p class="text-xs font-bold text-slate-700 mt-0.5">{{ str_replace('_', ' ', ucfirst($modalTutor->status_akun)) }}</p>
                            </div>
                            <div class="flex gap-2">
                                <button type="button"
                                    @click="confirmOpen = true; confirmTutorId = {{ $modalTutor->id }}; confirmType = 'hapus';"
                                    class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-wider bg-white border border-rose-200 text-rose-600 hover:bg-rose-50 transition-colors active:scale-95">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Hapus
                                </button>
                                <button type="button"
                                    @click="confirmOpen = true; confirmTutorId = {{ $modalTutor->id }}; confirmType = 'aktif';"
                                    class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-wider bg-emerald-500 hover:bg-emerald-600 text-white border border-emerald-600 transition-all shadow-sm shadow-emerald-200 active:scale-95">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    Setujui
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
                {{-- ── END MODAL 1 ── --}}


                {{-- ─────────────────────────────────────────────── --}}
                {{-- MODAL 2 : KONFIRMASI AKSI (z-index 110)         --}}
                {{-- ─────────────────────────────────────────────── --}}
                <div x-show="confirmOpen && confirmTutorId === {{ $modalTutor->id }}"
                    x-cloak
                    class="fixed inset-0 z-[110] flex items-center justify-center p-4 sm:p-6"
                    aria-modal="true">

                    {{-- Overlay --}}
                    <div x-show="confirmOpen && confirmTutorId === {{ $modalTutor->id }}"
                        x-transition.opacity.duration.300ms
                        class="fixed inset-0 bg-slate-900/80 backdrop-blur-md"
                        @click="confirmOpen = false; confirmTutorId = null"></div>

                    {{-- Box --}}
                    <div x-show="confirmOpen && confirmTutorId === {{ $modalTutor->id }}"
                        x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-90"
                        class="relative bg-white rounded-3xl shadow-2xl p-6 sm:p-8 w-full max-w-sm text-center border border-slate-100">

                        {{-- Icon dinamis --}}
                        <div class="w-20 h-20 rounded-full mx-auto flex items-center justify-center mb-5"
                            x-bind:class="confirmType === 'aktif' ? 'bg-emerald-100 text-emerald-500' : 'bg-rose-100 text-rose-500'">
                            <svg x-show="confirmType === 'aktif'" class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                            <svg x-show="confirmType === 'hapus'" class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </div>

                        <h3 class="text-xl font-black text-slate-800 mb-2"
                            x-text="confirmType === 'aktif' ? 'Setujui & Aktifkan?' : 'Hapus Pendaftar?'"></h3>
                        <p class="text-sm font-medium text-slate-500 mb-8"
                            x-text="confirmType === 'aktif' ? 'Pastikan Anda telah memeriksa MoU dan dokumen tutor ini sebelum menyetujuinya.' : 'Aksi ini akan menghapus permanen seluruh data dan akun tutor ini dari sistem.'"></p>

                        <div class="flex flex-col sm:flex-row justify-center gap-3">
                            <button @click="confirmOpen = false; confirmTutorId = null" type="button"
                                class="w-full px-5 py-3 bg-white hover:bg-slate-100 text-slate-700 text-xs font-black uppercase tracking-widest rounded-xl border border-slate-200 transition-colors">
                                Batal
                            </button>

                            <form x-show="confirmType === 'aktif'" action="{{ route('admin.tutors.updateStatus', $modalTutor->id) }}" method="POST" class="w-full">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status_akun" value="aktif">
                                <button type="submit" class="w-full px-5 py-3 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-black uppercase tracking-widest rounded-xl transition-all shadow-md active:scale-95 border border-emerald-700">
                                    Ya, Aktifkan
                                </button>
                            </form>

                            <form x-show="confirmType === 'hapus'" action="{{ route('admin.tutors.destroy', $modalTutor->id) }}" method="POST" class="w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-5 py-3 bg-rose-600 hover:bg-rose-700 text-white text-xs font-black uppercase tracking-widest rounded-xl transition-all shadow-md active:scale-95 border border-rose-700">
                                    Ya, Hapus Data
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- ── END MODAL 2 ── --}}

                @endforeach
            </div>
        </template>

    </div>
</x-app-layout>