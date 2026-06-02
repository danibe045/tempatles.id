<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col xl:flex-row justify-between items-start xl:items-center gap-4">
            <div>
                <div class="inline-flex items-center gap-2 bg-orange-100 border border-orange-200 px-3 py-1 rounded-full mb-3 shadow-sm">
                    <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span>
                    <p class="text-[10px] font-black text-orange-600 uppercase tracking-[0.2em]">Operasional Utama</p>
                </div>
                <h2 class="font-black text-2xl text-slate-900 leading-tight tracking-tight">
                    Absensi & Jurnal Mengajar
                </h2>
                <p class="text-sm text-slate-400 font-medium mt-0.5">Lacak kehadiran tutor dan murid pada setiap sesi
                    pertemuan.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-[1400px] mx-auto px-6 md:px-12 space-y-8">

            {{-- Pesan Berhasil/Gagal Override --}}
            @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 shadow-sm rounded-2xl flex items-center gap-4 mb-4">
                <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <span class="font-bold text-sm text-emerald-800">{{ session('success') }}</span>
            </div>
            @endif

            {{-- Gradient Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

                {{-- Sesi Hari Ini (Blue Gradient) --}}
                <div
                    class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl shadow-lg shadow-blue-500/20 p-6 relative overflow-hidden group border border-blue-400/50">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-bl-[4rem] -translate-y-4 translate-x-4 transition group-hover:scale-110 duration-500">
                    </div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-tr-full"></div>
                    <div class="relative z-10">
                        <div
                            class="inline-flex items-center justify-center w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl mb-4 shadow-sm border border-white/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <p class="text-[10px] font-black text-blue-100 uppercase tracking-[0.2em]">Sesi Hari Ini (All
                            Time)</p>
                        <p class="text-4xl font-black text-white mt-1 leading-none">{{ $countHariIni }}</p>
                        <p
                            class="text-[10px] text-blue-50 mt-4 border-t border-white/10 pt-4 font-semibold tracking-wider">
                            Sesi di hari ini saja</p>
                    </div>
                </div>

                {{-- Sesi Selesai (Emerald Gradient) --}}
                <div
                    class="bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-2xl shadow-lg shadow-emerald-500/20 p-6 relative overflow-hidden group border border-emerald-400/50">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-bl-[4rem] -translate-y-4 translate-x-4 transition group-hover:scale-110 duration-500">
                    </div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-tr-full"></div>
                    <div class="relative z-10">
                        <div
                            class="inline-flex items-center justify-center w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl mb-4 shadow-sm border border-white/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-[10px] font-black text-emerald-100 uppercase tracking-[0.2em]">Sesi Selesai
                            @if(request('month')) (Tersaring) @endif</p>
                        <p class="text-4xl font-black text-white mt-1 leading-none">{{ $countSelesai }}</p>
                        <p
                            class="text-[10px] text-emerald-50 mt-4 border-t border-white/10 pt-4 font-semibold tracking-wider">
                            Total sesi yang telah diajarkan</p>
                    </div>
                </div>

                {{-- Kendala / Absen (Rose Gradient) --}}
                <div
                    class="bg-gradient-to-br from-rose-400 to-rose-600 rounded-2xl shadow-lg shadow-rose-500/20 p-6 relative overflow-hidden group border border-rose-400/50">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-bl-[4rem] -translate-y-4 translate-x-4 transition group-hover:scale-110 duration-500">
                    </div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-tr-full"></div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-start">
                            <div
                                class="inline-flex items-center justify-center w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl mb-4 shadow-sm border border-white/20">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-[10px] font-black text-rose-100 uppercase tracking-[0.2em]">Kendala
                            @if(request('month')) (Tersaring) @endif
                        </p>
                        <p class="text-4xl font-black text-white mt-1 leading-none">{{ $countKendala }}</p>
                        <p
                            class="text-[10px] text-rose-50 mt-4 border-t border-white/10 pt-4 font-semibold tracking-wider">
                            Tutor atau murid absen (No-Show)</p>
                    </div>
                </div>
            </div>

            {{-- Tabel Absensi & Jadwal --}}
            <div class="bg-white shadow-sm rounded-2xl overflow-hidden border border-slate-100">
                
                {{-- HEADER TABEL & FILTER --}}
                <div class="p-6 border-b border-slate-100 flex flex-col xl:flex-row xl:items-center justify-between gap-6">
                    {{-- Judul --}}
                    <div class="flex items-center gap-3">
                        <div class="w-1.5 h-8 bg-blue-950 rounded-full"></div>
                        <div>
                            <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest">Jadwal & Absensi Pertemuan</h3>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Filter data untuk pencarian spesifik</p>
                        </div>
                    </div>

                    {{-- FORM FILTER --}}
                    <form method="GET" action="{{ route('admin.absensi') }}" class="flex flex-wrap items-center gap-2">
                        
                        {{-- Dropdowns --}}
                        <div class="flex flex-wrap gap-2">
                            {{-- Bulan --}}
                            <select name="month" onchange="this.form.submit()" class="pl-4 pr-8 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-600 focus:bg-white focus:ring-2 focus:ring-blue-900 transition-all cursor-pointer outline-none">
                                <option value="">Bulan</option>
                                @foreach(['01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'Mei','06'=>'Jun','07'=>'Jul','08'=>'Agu','09'=>'Sep','10'=>'Okt','11'=>'Nov','12'=>'Des'] as $num => $name)
                                    <option value="{{ $num }}" {{ request('month') == $num ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>

                            {{-- Tahun --}}
                            <select name="year" onchange="this.form.submit()" class="pl-4 pr-8 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-600 focus:ring-2 focus:ring-blue-900 transition-all cursor-pointer outline-none">
                                <option value="">Tahun</option>
                                @for($y = 2024; $y <= date('Y') + 1; $y++) 
                                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>

                            {{-- Status --}}
                            <select name="status" onchange="this.form.submit()" class="pl-4 pr-8 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-600 focus:ring-2 focus:ring-blue-900 transition-all cursor-pointer outline-none">
                                <option value="">Status</option>
                                <option value="dijadwalkan" {{ request('status') == 'dijadwalkan' ? 'selected' : '' }}>Dijadwalkan</option>
                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>

                        {{-- Pencarian --}}
                        <div class="relative flex-grow sm:flex-grow-0">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari..." class="w-full sm:w-48 pl-9 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-900 transition-all outline-none placeholder:text-slate-400">
                            <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex gap-2">
                            <button type="submit" class="bg-blue-950 hover:bg-black text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">Cari</button>
                            
                            {{-- Tombol Reset (Hanya muncul jika ada parameter di URL) --}}
                            @if(request()->anyFilled(['month', 'year', 'status', 'search']))
                                <a href="{{ route('admin.absensi') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-slate-100 hover:bg-rose-50 text-slate-500 hover:text-rose-600 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all border border-slate-200 hover:border-rose-200">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="bg-slate-50/50 text-slate-400 uppercase text-[9px] tracking-[0.18em] font-black border-b border-gray-100">
                                <th class="px-6 py-4">Jadwal Sesi</th>
                                <th class="px-6 py-4">Detail Mapel</th>
                                <th class="px-6 py-4">Partisipan</th>
                                <th class="px-6 py-4 text-center">Status Sesi</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($sessions as $session)
                            <tr class="hover:bg-slate-50/50 transition-colors group">

                                {{-- Kolom 1: Waktu --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($session->tanggal_jadwal)
                                            <div class="w-11 h-12 bg-slate-50 rounded-xl border border-slate-200 flex flex-col items-center justify-center flex-shrink-0 shadow-sm">
                                                <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest">
                                                    {{ \Carbon\Carbon::parse($session->tanggal_jadwal)->format('M') }}
                                                </span>
                                                <span class="text-sm font-black text-blue-950 leading-none">
                                                    {{ \Carbon\Carbon::parse($session->tanggal_jadwal)->format('d') }}
                                                </span>
                                            </div>
                                            <div>
                                                <p class="font-black text-slate-800 text-xs">
                                                    {{ \Carbon\Carbon::parse($session->waktu_mulai)->format('H:i') }} WIB
                                                </p>
                                                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-wider mt-0.5">
                                                    Pertemuan Ke-{{ $session->pertemuan_ke }}
                                                </p>
                                            </div>
                                        @else
                                            {{-- Tampilan saat tanggal masih null (Wadah Kosong) --}}
                                            <div class="w-11 h-12 bg-slate-50 rounded-xl border border-dashed border-slate-300 flex items-center justify-center flex-shrink-0">
                                                <span class="text-[10px] font-black text-slate-300">--</span>
                                            </div>
                                            <div>
                                                <p class="font-bold text-slate-400 text-xs italic">Belum Dijadwalkan</p>
                                                <p class="text-[9px] text-slate-300 font-bold uppercase tracking-wider mt-0.5">Pertemuan Ke-{{ $session->pertemuan_ke }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </td>

                                {{-- Kolom 2: Mapel --}}
                                <td class="px-6 py-4">
                                    <p class="font-bold text-slate-800 text-xs">
                                        {{ $session->order->mata_pelajaran ?? 'Mapel Terhapus' }}</p>
                                    <p class="text-[10px] text-slate-400 font-mono mt-0.5">
                                        ORD-{{ str_pad($session->order_id, 4, '0', STR_PAD_LEFT) }}</p>
                                </td>

                                {{-- Kolom 3: Partisipan (Murid & Tutor) --}}
                                <td class="px-6 py-4">
                                    <div class="flex flex-col gap-1.5">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-4 h-4 rounded-full bg-orange-100 flex items-center justify-center">
                                                <span class="text-[8px] font-black text-orange-600">M</span>
                                            </div>
                                            <p class="font-bold text-slate-800 text-[10px] truncate max-w-[120px]">
                                                {{ $session->order->murid->name ?? '-' }}</p>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-4 h-4 rounded-full bg-blue-100 flex items-center justify-center">
                                                <span class="text-[8px] font-black text-blue-600">T</span>
                                            </div>
                                            <p class="font-bold text-slate-500 text-[10px] truncate max-w-[120px]">
                                                {{ $session->order->tutor->name ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Kolom 4: Status --}}
                                <td class="px-6 py-4 text-center">
                                    @php
                                    $statusClasses = [
                                    'dijadwalkan' => 'bg-gray-50 text-gray-600 border-gray-200',
                                    'selesai' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                    'absen_tutor' => 'bg-rose-50 text-rose-600 border-rose-200',
                                    'absen_murid' => 'bg-orange-50 text-orange-600 border-orange-200',
                                    ];
                                    $badgeClass = $statusClasses[$session->status_sesi] ?? 'bg-gray-50 text-gray-600
                                    border-gray-200';
                                    @endphp
                                    <span
                                        class="inline-flex items-center justify-center px-2.5 py-1.5 rounded-lg border {{ $badgeClass }} text-[8px] font-black uppercase tracking-wider shadow-sm">
                                        {{ str_replace('_', ' ', $session->status_sesi) }}
                                    </span>
                                </td>

                                {{-- Kolom 5: Aksi --}}
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.absensi.show', $session->id) }}"
                                        class="inline-flex items-center gap-2 border border-slate-200 hover:bg-blue-950 hover:border-blue-950 hover:text-white text-slate-600 font-black py-2 px-3 rounded-xl transition-all duration-200 text-[9px] uppercase tracking-widest group-hover:shadow-md">
                                        Lihat Jurnal
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-20 bg-slate-50/30">
                                    <div class="flex flex-col items-center gap-3">
                                        <div
                                            class="w-16 h-16 rounded-3xl bg-white shadow-sm border border-slate-100 flex items-center justify-center">
                                            <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <p class="text-sm font-bold text-slate-500 mt-2">Belum ada jadwal sesi</p>
                                        <p class="text-xs text-slate-400">Jadwal pertemuan tidak ditemukan untuk filter
                                            ini.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($sessions->hasPages())
                <div class="px-6 py-4 bg-slate-50/80 border-t border-gray-100">
                    {{ $sessions->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>