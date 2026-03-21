{{-- resources/views/admin/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <p class="text-[10px] font-black text-orange-500 uppercase tracking-[0.25em] mb-1">Admin Panel</p>
                <h2 class="font-black text-2xl text-slate-900 leading-tight tracking-tight">
                    Management Center
                </h2>
                <p class="text-sm text-slate-400 font-medium mt-0.5">Pantau pendaftaran dan legalitas mitra tutor Tempatles.id</p>
            </div>

            <form action="{{ route('admin.dashboard') }}" method="GET"
                class="flex flex-wrap md:flex-nowrap gap-2 w-full md:w-auto">

                <div class="relative">
                    <select name="mapel"
                        class="appearance-none pl-9 pr-8 py-2.5 bg-white border border-gray-200 rounded-xl text-xs font-semibold text-slate-700 shadow-sm focus:ring-2 focus:ring-blue-900 focus:border-blue-900 transition">
                        <option value="">Semua Mapel</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 left-2.5 flex items-center">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>

                <div class="relative">
                    <input type="text" name="search" value="{{ $search ?? '' }}"
                        placeholder="Cari nama tutor..."
                        class="pl-9 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl text-xs font-semibold text-slate-700 shadow-sm focus:ring-2 focus:ring-blue-900 focus:border-blue-900 transition w-full md:w-52 placeholder:font-normal placeholder:text-slate-400">
                    <div class="pointer-events-none absolute inset-y-0 left-2.5 flex items-center">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <button type="submit"
                    class="inline-flex items-center gap-2 bg-blue-950 hover:bg-blue-900 text-white px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition shadow-md shadow-blue-950/30">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z" />
                    </svg>
                    Filter
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-[1400px] mx-auto px-6 md:px-12 space-y-8">

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                {{-- Pending --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-28 h-28 bg-orange-50 rounded-bl-[4rem] -translate-y-6 translate-x-6 transition group-hover:scale-110 duration-300"></div>
                    <div class="relative">
                        <div class="inline-flex items-center justify-center w-10 h-10 bg-orange-100 rounded-xl mb-4">
                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Pending Review</p>
                        <p class="text-4xl font-black text-slate-900 mt-1 leading-none">{{ $tutors->where('status', 'Pending')->count() }}</p>
                        <div class="flex items-center gap-1.5 mt-3">
                            <span class="w-1.5 h-1.5 rounded-full bg-orange-400 animate-pulse"></span>
                            <p class="text-[10px] text-orange-500 font-black uppercase tracking-wider">Butuh Verifikasi Segera</p>
                        </div>
                    </div>
                </div>

                {{-- MoU --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-28 h-28 bg-blue-50 rounded-bl-[4rem] -translate-y-6 translate-x-6 transition group-hover:scale-110 duration-300"></div>
                    <div class="relative">
                        <div class="inline-flex items-center justify-center w-10 h-10 bg-blue-100 rounded-xl mb-4">
                            <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Tahap MoU</p>
                        <p class="text-4xl font-black text-slate-900 mt-1 leading-none">{{ $tutors->where('status', 'Menunggu MoU')->count() }}</p>
                        <div class="mt-3 space-y-1">
                            <div class="flex justify-between items-center">
                                <span class="text-[10px] text-slate-400 font-semibold">Progres onboarding</span>
                                <span class="text-[10px] font-black text-blue-700">45%</span>
                            </div>
                            <div class="w-full bg-gray-100 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-blue-700 h-1.5 rounded-full" style="width: 45%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Aktif --}}
                <div class="bg-blue-950 rounded-2xl shadow-lg shadow-blue-950/30 p-6 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-28 h-28 bg-orange-500/10 rounded-bl-[4rem] -translate-y-6 translate-x-6 transition group-hover:scale-110 duration-300"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-tr-3xl"></div>
                    <div class="relative">
                        <div class="inline-flex items-center justify-center w-10 h-10 bg-orange-500/20 rounded-xl mb-4">
                            <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <p class="text-[10px] font-black text-blue-300 uppercase tracking-[0.2em]">Total Mitra Aktif</p>
                        <p class="text-4xl font-black text-white mt-1 leading-none">{{ $tutors->where('status', 'Aktif')->count() }}</p>
                        <div class="flex items-center gap-1.5 mt-3">
                            <svg class="w-3 h-3 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <p class="text-[10px] text-blue-300 font-semibold">Tutor siap dipasarkan</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Table Section --}}
            <div class="bg-white shadow-sm rounded-2xl overflow-hidden border border-gray-100">

                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="w-1 h-6 bg-orange-500 rounded-full"></div>
                        <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest">Data Pendaftar Terbaru</h3>
                    </div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-wider">
                        {{ $tutors->count() }} entri
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="bg-slate-50 text-slate-400 uppercase text-[9px] tracking-[0.18em] font-black border-b border-gray-100">
                                <th class="px-6 py-3.5">Tutor &amp; Kontak</th>
                                <th class="px-6 py-3.5">Spesialisasi &amp; Tarif</th>
                                <th class="px-6 py-3.5 text-center">Status Onboarding</th>
                                <th class="px-6 py-3.5 text-right">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($tutors as $tutor)
                            <tr class="hover:bg-orange-50/30 transition-colors duration-150 group">

                                {{-- Tutor & Kontak --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-blue-950 flex items-center justify-center text-white font-black text-sm flex-shrink-0 shadow-sm">
                                            {{ strtoupper(substr($tutor->nama_lengkap, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-sm leading-tight">{{ $tutor->nama_lengkap }}</p>
                                            <p class="text-[10px] text-slate-400 font-mono mt-0.5">{{ $tutor->email_aktif }}</p>
                                            <a href="https://wa.me/{{ $tutor->no_wa }}" target="_blank"
                                                class="inline-flex items-center gap-1 text-emerald-600 font-bold text-[9px] mt-1 hover:underline uppercase tracking-wider">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                                </svg>
                                                WhatsApp
                                            </a>
                                        </div>
                                    </div>
                                </td>

                                {{-- Spesialisasi & Tarif --}}
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 bg-blue-950/5 text-blue-950 border border-blue-950/10 rounded-lg text-[9px] font-black uppercase tracking-wider">
                                        {{ $tutor->bidang }}
                                    </span>
                                    <p class="text-sm font-black text-slate-800 mt-2">
                                        Rp {{ number_format($tutor->tarif_per_sesi ?? 0, 0, ',', '.') }}
                                        <span class="text-[9px] text-slate-400 font-semibold">/sesi</span>
                                    </p>
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-4 text-center">
                                    @php
                                        $statusConfig = [
                                            'Pending' => [
                                                'class' => 'bg-orange-50 text-orange-600 border-orange-200',
                                                'dot'   => 'bg-orange-400',
                                            ],
                                            'Menunggu MoU' => [
                                                'class' => 'bg-blue-50 text-blue-700 border-blue-200',
                                                'dot'   => 'bg-blue-500',
                                            ],
                                            'Aktif' => [
                                                'class' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                                'dot'   => 'bg-emerald-500',
                                            ],
                                        ];
                                        $cfg = $statusConfig[$tutor->status] ?? ['class' => 'bg-gray-50 text-gray-600 border-gray-200', 'dot' => 'bg-gray-400'];
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border {{ $cfg['class'] }} text-[9px] font-black uppercase tracking-wider">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $cfg['dot'] }}"></span>
                                        {{ $tutor->status }}
                                    </span>
                                </td>

                                {{-- Tindakan --}}
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.tutor.detail', $tutor->id) }}"
                                        class="inline-flex items-center gap-2 border border-blue-950/20 hover:bg-blue-950 hover:border-blue-950 hover:text-white text-blue-950 font-black py-2 px-4 rounded-xl transition-all duration-200 text-[9px] uppercase tracking-widest group-hover:shadow-md">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Periksa Data
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-20">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <p class="text-sm font-bold text-slate-400">Belum ada data pendaftar tutor</p>
                                        <p class="text-xs text-slate-300">Data akan muncul saat ada tutor yang mendaftar</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Footer tabel --}}
                @if($tutors->count() > 0)
                <div class="px-6 py-3 bg-slate-50 border-t border-gray-100 flex items-center justify-between">
                    <p class="text-[10px] text-slate-400 font-semibold">
                        Menampilkan <span class="font-black text-slate-600">{{ $tutors->count() }}</span> data tutor
                    </p>
                    <div class="flex items-center gap-1">
                        <div class="w-2 h-2 rounded-full bg-orange-400"></div>
                        <div class="w-2 h-2 rounded-full bg-blue-700"></div>
                        <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                        <span class="text-[9px] text-slate-400 ml-1 font-semibold uppercase tracking-wider">Pending · MoU · Aktif</span>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>