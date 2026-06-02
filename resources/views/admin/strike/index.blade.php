<x-app-layout>
    <style>
        [x-cloak] { display: none !important; }
        .tab-content { display: none; }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

        #tab-1:checked ~ .tab-nav label[for="tab-1"],
        #tab-2:checked ~ .tab-nav label[for="tab-2"] {
            background-color: #0f172a;
            color: #ffffff;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }
        #tab-1:checked ~ #content-1,
        #tab-2:checked ~ #content-2 { display: block; }
    </style>

    {{-- ===== HEADER STICKY ===== --}}
    <div class="sticky top-0 z-[40] w-full">
        <div class="bg-white/95 backdrop-blur-md border-b border-slate-200 py-5 px-6 md:px-8 shadow-sm">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <div class="inline-flex items-center gap-2 bg-rose-50 border border-rose-100 px-3 py-1 rounded-lg mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                        <p class="text-[10px] font-black text-rose-600 uppercase tracking-[0.2em]">Pusat Kendali Mutu</p>
                    </div>
                    <h2 class="font-black text-2xl text-slate-900 leading-tight tracking-tight">Manajemen Komplain & Strike</h2>
                    <p class="text-sm text-slate-400 font-medium mt-0.5">Tinjau keluhan, mediasi sengketa, dan kelola poin sanksi tutor.</p>
                </div>

                <form method="GET" action="{{ url()->current() }}" class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-2.5 flex items-center">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/></svg>
                        </div>
                        <select name="status" onchange="this.form.submit()"
                            class="appearance-none pl-8 pr-7 py-2.5 bg-slate-100 border border-transparent rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-200 focus:bg-white focus:ring-2 focus:ring-rose-400 transition-all outline-none cursor-pointer">
                            <option value="">Semua Status</option>
                            <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div class="relative flex-grow min-w-[200px]">
                        <div class="pointer-events-none absolute inset-y-0 left-2.5 flex items-center">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama tutor, pelapor..."
                            class="w-full pl-8 pr-4 py-2.5 bg-slate-100 border border-transparent rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-200 focus:bg-white focus:ring-2 focus:ring-rose-400 transition-all outline-none placeholder:text-slate-400 placeholder:font-normal">
                    </div>

                    <button type="submit"
                        class="inline-flex items-center gap-1.5 bg-slate-900 hover:bg-black text-white px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-md">
                        Cari
                    </button>

                    @if(request('search') || request('status'))
                        <a href="{{ url()->current() }}"
                            class="px-4 py-2.5 bg-white hover:bg-rose-50 text-slate-500 hover:text-rose-600 rounded-xl text-xs font-black uppercase tracking-widest transition-all border border-slate-200 hover:border-rose-200">
                            Reset
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-6 md:px-8 space-y-6">

            {{-- ===== STATS CARDS ===== --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                <div class="bg-white rounded-2xl border border-slate-200 border-l-[3px] border-l-amber-500 shadow-sm p-5">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        </div>
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Kasus</span>
                    </div>
                    <p class="text-3xl font-black text-slate-900 leading-none mb-1">{{ $complaints->whereIn('status', ['menunggu_review', 'sedang_dimediasi'])->count() }}</p>
                    <p class="text-xs font-bold text-slate-400">Komplain masuk aktif</p>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 border-l-[3px] border-l-rose-500 shadow-sm p-5">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-10 h-10 rounded-xl bg-rose-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Poin</span>
                    </div>
                    <p class="text-3xl font-black text-rose-600 leading-none mb-1">{{ $strikes->where('status', 'aktif')->count() }}</p>
                    <p class="text-xs font-bold text-slate-400">Poin strike berlaku</p>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 border-l-[3px] border-l-slate-700 shadow-sm p-5">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Akun</span>
                    </div>
                    <p class="text-3xl font-black text-slate-900 leading-none mb-1">{{ $countTutorBermasalah }}</p>
                    <p class="text-xs font-bold text-slate-400">Tutor dinonaktifkan</p>
                </div>

            </div>

            {{-- ===== TAB NAVIGATION ===== --}}
            <input type="radio" name="kendali_tabs" id="tab-1" class="hidden" checked>
            <input type="radio" name="kendali_tabs" id="tab-2" class="hidden">

            <div class="tab-nav flex gap-1.5 bg-slate-100 p-1.5 rounded-2xl w-max border border-slate-200">
                <label for="tab-1"
                    class="cursor-pointer px-5 py-2.5 rounded-xl text-[11px] font-black uppercase tracking-widest text-slate-500 hover:text-slate-800 transition-all select-none whitespace-nowrap">
                    Keluhan Murid
                    <span class="ml-1.5 bg-amber-100 text-amber-700 px-1.5 py-0.5 rounded-md text-[9px]">{{ $complaints->whereIn('status', ['menunggu_review', 'sedang_dimediasi'])->count() }}</span>
                </label>
                <label for="tab-2"
                    class="cursor-pointer px-5 py-2.5 rounded-xl text-[11px] font-black uppercase tracking-widest text-slate-500 hover:text-slate-800 transition-all select-none whitespace-nowrap">
                    Log Strike Tutor
                    <span class="ml-1.5 bg-rose-100 text-rose-700 px-1.5 py-0.5 rounded-md text-[9px]">{{ $strikes->where('status', 'aktif')->count() }}</span>
                </label>
            </div>

            {{-- ===== TAB 1: KOMPLAIN UTAMA ===== --}}
            <div id="content-1" class="tab-content w-full pb-8">
                <div class="grid grid-cols-1 gap-5">
                    @forelse($complaints as $complaint)

                    @php
                        $isActive = in_array($complaint->status, ['menunggu_review', 'sedang_dimediasi']);
                    @endphp

                    <div class="bg-white rounded-[1.5rem] border {{ $isActive ? 'border-amber-300' : 'border-slate-200' }} shadow-sm overflow-hidden flex flex-col lg:flex-row hover:shadow-md transition-shadow duration-200">

                        {{-- KIRI: Berkas Laporan & Info Kasus --}}
                        <div class="p-6 lg:p-7 flex-1 border-b lg:border-b-0 lg:border-r border-slate-100">

                            {{-- Header: Profil Pelapor & Badge Status Hukum --}}
                            <div class="flex items-start justify-between gap-4 mb-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-slate-100 border border-slate-200 text-slate-700 flex items-center justify-center font-black text-sm shrink-0 shadow-inner">
                                        {{ strtoupper(substr($complaint->pelapor->name ?? 'M', 0, 1)) }}
                                    </div>
                                    <div class="text-left">
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Pihak Pelapor (Murid)</p>
                                        <p class="text-sm font-bold text-slate-900 leading-none">{{ $complaint->pelapor->name ?? 'Pengguna' }}</p>
                                    </div>
                                </div>

                                {{-- Badge Status Bahasa Baku --}}
                                @if($isActive)
                                    <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-700 border border-amber-200 px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest shrink-0">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>Menunggu Mediasi
                                    </span>
                                @elseif($complaint->status == 'selesai_refund')
                                    <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-700 border border-rose-200 px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest shrink-0">Sengketa Selesai (Refund)</span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200 px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest shrink-0">
                                        <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Keluhan Ditolak
                                    </span>
                                @endif
                            </div>

                            {{-- Deskripsi Keluhan Kelompok --}}
                            <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 {{ $isActive ? 'border-l-[4px] border-l-amber-500' : '' }} mb-4 text-left">
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Klasifikasi Pelanggaran: <span class="text-slate-700 border-b border-slate-200 pb-0.5">{{ $complaint->jenis_komplain }}</span></p>
                                <p class="text-sm text-slate-700 font-medium leading-relaxed italic">"{{ $complaint->deskripsi }}"</p>
                            </div>

                            {{-- Meta Objek Transaksi --}}
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <div class="flex flex-wrap gap-2">
                                    <span class="inline-flex items-center px-2.5 py-1 bg-white border border-slate-200 rounded-lg text-[10px] font-bold text-slate-500">
                                        Pihak Terlapor: <span class="text-slate-900 font-black ml-1">{{ $complaint->order->tutor->name ?? '-' }}</span>
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-1 bg-white border border-slate-200 rounded-lg text-[10px] font-bold text-slate-500">
                                        Mata Pelajaran: <span class="text-slate-900 font-black ml-1">{{ $complaint->order->mata_pelajaran }}</span>
                                    </span>
                                </div>
                                @if($complaint->bukti_path)
                                    <a href="{{ asset('storage/'.$complaint->bukti_path) }}" target="_blank"
                                        class="inline-flex items-center gap-1.5 text-[10px] font-black text-blue-600 uppercase tracking-widest bg-blue-50 border border-blue-200 px-3 py-1.5 rounded-lg hover:bg-blue-100 transition-colors shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        Buka Dokumen Bukti
                                    </a>
                                @endif
                            </div>
                        </div>

                        {{-- KANAN: Panel Eksekusi & Berita Acara Putusan --}}
                        <div class="p-6 lg:p-7 lg:w-[36%] bg-slate-50/60 flex flex-col justify-center border-t lg:border-t-0 border-slate-100">
                            @if($isActive)
                                <form action="{{ route('admin.complaints.update', $complaint->id) }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div class="text-left">
                                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Berita Acara / Catatan Putusan</label>
                                        <textarea name="keputusan" rows="3"
                                            class="w-full bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-800 px-3 py-2.5 outline-none focus:ring-2 focus:ring-rose-500 focus:border-rose-500 resize-none transition-all shadow-inner"
                                            placeholder="Tuliskan pertimbangan hukum atau alasan pembatalan..." required></textarea>
                                    </div>

                                    {{-- Checkbox Sanksi SP Otomatis --}}
                                    <label class="flex items-center gap-3 cursor-pointer bg-rose-50 border border-rose-100 px-3 py-2.5 rounded-xl hover:bg-rose-100/70 transition-colors text-left shadow-sm">
                                        <input type="checkbox" name="berikan_sp" value="1"
                                            class="w-4 h-4 rounded text-rose-600 border-slate-300 focus:ring-rose-500 bg-white shrink-0">
                                        <div class="flex flex-col">
                                            <span class="text-[10px] font-black text-rose-700 uppercase tracking-widest block leading-tight">Terbitkan Surat Peringatan</span>
                                            <span class="text-[8px] font-bold text-rose-400 mt-0.5 block leading-none">Menambahkan 1 poin sanksi (Strike) ke akun pengajar</span>
                                        </div>
                                    </label>

                                    {{-- Kelompok Tombol Keputusan Sidang Mediasi --}}
                                    <div class="flex gap-2 pt-1">
                                        {{-- Button Setujui Refund Keluhan Murid --}}
                                        <button type="submit" name="status" value="selesai_refund"
                                            class="flex-1 bg-rose-600 hover:bg-rose-700 text-white px-3 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-md shadow-rose-600/20 active:scale-95 transition-all flex items-center justify-center gap-1.5 border border-rose-700">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                            Eksekusi Refund
                                        </button>
                                        {{-- Button Tolak Keluhan Murid --}}
                                        <button type="submit" name="status" value="selesai_tolak"
                                            class="flex-1 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 px-3 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest active:scale-95 transition-all flex items-center justify-center gap-1.5 shadow-sm">
                                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                            Tolak Keluhan
                                        </button>
                                    </div>
                                </form>
                            @else
                                {{-- Kondisi Sengketa Keluhan Sudah Selesai Diarsip --}}
                                <div class="flex flex-col gap-2.5 text-left">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-lg bg-slate-200 text-slate-500 flex items-center justify-center shrink-0 border border-slate-300/40 shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        </div>
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Arsip Berita Acara Putusan</p>
                                    </div>
                                    <div class="bg-white border border-slate-200 rounded-xl px-4 py-3 shadow-inner">
                                        <p class="text-xs font-medium text-slate-600 italic leading-relaxed">"{{ $complaint->keputusan_admin ?? 'Kasus selesai tanpa catatan tambahan.' }}"</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @empty
                    {{-- Tampilan Kosong (Zero Case) Bahasa Profesional --}}
                    <div class="bg-white rounded-[1.5rem] border border-dashed border-slate-300 p-16 text-center shadow-inner">
                        <div class="w-14 h-14 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-emerald-100 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="text-base font-black text-slate-800 uppercase tracking-tight mb-1">Seluruh Keluhan Berhasil Dimediasi</h3>
                        <p class="text-xs text-slate-400 font-medium max-w-sm mx-auto">Sistem mendeteksi nol sengketa aktif. Tidak ada laporan pelanggaran atau klaim sengketa masuk dari murid yang memerlukan tindakan peninjauan.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- ===== TAB 2: LOG STRIKE ===== --}}
            <div id="content-2" class="tab-content w-full pb-8">
                <div class="bg-white rounded-[1.5rem] shadow-sm border border-slate-200 overflow-hidden">

                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between gap-4 bg-white">
                        <div class="flex items-center gap-3">
                            <div class="w-1 h-6 bg-rose-500 rounded-full"></div>
                            <h3 class="font-black text-slate-800 text-xs uppercase tracking-widest">Catatan Pelanggaran Tutor</h3>
                        </div>
                        <button onclick="document.getElementById('modal-tambah-strike').showModal()"
                            class="inline-flex items-center gap-2 bg-rose-500 hover:bg-rose-600 text-white px-4 py-2.5 rounded-xl text-[11px] font-black uppercase tracking-widest transition-all shadow-md shadow-rose-500/20 active:scale-95">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                            Beri SP
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-100">
                                    <th class="px-5 py-3.5 text-[9px] font-black text-slate-400 uppercase tracking-[0.15em]">Tutor</th>
                                    <th class="px-5 py-3.5 text-[9px] font-black text-slate-400 uppercase tracking-[0.15em]">Detail Pelanggaran</th>
                                    <th class="px-5 py-3.5 text-[9px] font-black text-slate-400 uppercase tracking-[0.15em]">Tanggal</th>
                                    <th class="px-5 py-3.5 text-[9px] font-black text-slate-400 uppercase tracking-[0.15em] text-center">Status</th>
                                    <th class="px-5 py-3.5 text-[9px] font-black text-slate-400 uppercase tracking-[0.15em] text-right">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($strikes as $strike)
                                <tr class="hover:bg-slate-50/60 transition-colors">
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-xl bg-blue-950 text-white flex items-center justify-center font-black text-sm shrink-0">
                                                {{ substr($strike->tutor->name ?? 'T', 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-slate-800 text-xs">{{ $strike->tutor->name ?? 'Tutor Terhapus' }}</p>
                                                <p class="text-[9px] text-slate-400 font-mono mt-0.5">ID: {{ str_pad($strike->tutor_id, 4, '0', STR_PAD_LEFT) }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4">
                                        <p class="font-bold text-xs {{ $strike->status == 'aktif' ? 'text-rose-600' : 'text-slate-500' }} truncate max-w-[220px]">{{ $strike->alasan_pelanggaran }}</p>
                                        @if($strike->keterangan_detail)
                                        <p class="text-[10px] text-slate-400 font-medium mt-0.5 truncate max-w-[220px]">{{ $strike->keterangan_detail }}</p>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4">
                                        <p class="font-bold text-slate-700 text-xs">{{ $strike->created_at->format('d M Y') }}</p>
                                        <p class="text-[9px] font-bold text-slate-400 mt-0.5">{{ $strike->created_at->format('H:i') }} WIB</p>
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        @if($strike->status == 'aktif')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg border bg-rose-50 text-rose-600 border-rose-200 text-[9px] font-black uppercase tracking-wider">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>Berlaku
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg border bg-slate-100 text-slate-500 border-slate-200 text-[9px] font-black uppercase tracking-wider">Dicabut</span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-right">
                                        @if($strike->status == 'aktif')
                                        <div class="flex items-center justify-end gap-2">
                                            <form action="{{ route('admin.strike.cabut', $strike->id) }}" method="POST"
                                                onsubmit="return confirm('Cabut pelanggaran ini?');">
                                                @csrf
                                                <button type="submit"
                                                    class="px-3 py-1.5 bg-white border border-slate-200 hover:bg-emerald-50 hover:border-emerald-200 hover:text-emerald-600 text-slate-500 font-black rounded-lg text-[9px] uppercase tracking-widest transition-all">
                                                    Maafkan
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.strike.banned', $strike->tutor_id) }}" method="POST"
                                                onsubmit="return confirm('Ini akan memblokir akun tutor secara permanen. Lanjutkan?');">
                                                @csrf
                                                <button type="submit"
                                                    class="px-3 py-1.5 bg-rose-50 hover:bg-rose-500 border border-rose-200 hover:border-rose-500 text-rose-600 hover:text-white font-black rounded-lg text-[9px] uppercase tracking-widest transition-all">
                                                    Banned
                                                </button>
                                            </form>
                                        </div>
                                        @else
                                            <span class="text-[9px] font-bold text-slate-400 italic">Telah dimaafkan</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-14 bg-slate-50/40">
                                        <div class="flex flex-col items-center gap-2">
                                            <div class="w-12 h-12 bg-white rounded-2xl border border-slate-200 flex items-center justify-center mb-1">
                                                <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                            </div>
                                            <p class="text-sm font-bold text-slate-500">Zero Strike!</p>
                                            <p class="text-xs text-slate-400">Belum ada catatan pelanggaran tutor.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($strikes->hasPages())
                    <div class="px-6 py-4 bg-slate-50/80 border-t border-slate-100">
                        {{ $strikes->links() }}
                    </div>
                    @endif

                </div>
            </div>

        </div>
    </div>

    {{-- ===== MODAL TAMBAH STRIKE ===== --}}
    <dialog id="modal-tambah-strike"
        class="rounded-[1.5rem] p-0 border border-slate-200 shadow-2xl backdrop:bg-slate-900/60 backdrop:backdrop-blur-sm m-auto w-full max-w-md overflow-hidden">
        <div class="bg-white">

            <div class="flex items-center justify-between px-7 py-5 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-rose-50 border border-rose-100 rounded-xl flex items-center justify-center">
                        <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-black text-slate-900">Beri SP / Pelanggaran</h3>
                        <p class="text-[10px] text-slate-400 font-medium">Strike manual di luar sistem otomatis</p>
                    </div>
                </div>
                <button type="button" onclick="this.closest('dialog').close()"
                    class="w-8 h-8 flex items-center justify-center bg-slate-100 hover:bg-rose-50 text-slate-400 hover:text-rose-500 rounded-full transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form method="POST" action="{{ route('admin.strike.beri') }}" class="px-7 py-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Pilih Tutor</label>
                    <select name="tutor_id" required
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-800 px-4 py-2.5 outline-none focus:ring-2 focus:ring-rose-400 focus:border-rose-400 transition-all">
                        <option value="" disabled selected>Pilih tutor dari daftar...</option>
                        @foreach($tutors as $t)
                            <option value="{{ $t->id }}">{{ $t->name }} (ID: {{ $t->id }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Alasan Utama</label>
                    <input type="text" name="alasan_pelanggaran" required
                        placeholder="Contoh: Mengunggah bukti foto palsu"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-800 px-4 py-2.5 outline-none focus:ring-2 focus:ring-rose-400 focus:border-rose-400 transition-all placeholder:font-normal placeholder:text-slate-400">
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Keterangan Detail <span class="normal-case font-normal text-slate-400">(opsional)</span></label>
                    <textarea name="keterangan_detail" rows="3"
                        placeholder="Tulis rincian lengkap pelanggaran..."
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 px-4 py-2.5 resize-none outline-none focus:ring-2 focus:ring-rose-400 focus:border-rose-400 transition-all placeholder:font-normal placeholder:text-slate-400"></textarea>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="this.closest('dialog').close()"
                        class="flex-1 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 px-4 py-3 rounded-xl text-[11px] font-black uppercase tracking-widest transition-all">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 bg-rose-500 hover:bg-rose-600 text-white px-4 py-3 rounded-xl text-[11px] font-black uppercase tracking-widest shadow-lg shadow-rose-500/20 active:scale-95 transition-all">
                        Kirim SP
                    </button>
                </div>
            </form>
        </div>
    </dialog>

    {{-- ===== MODAL NOTIFIKASI ===== --}}
    @if(session('success') || session('error'))
    <div x-data="{ open: true }" x-show="open" style="display:none;" class="relative z-[150]" role="dialog" aria-modal="true">
        <div x-show="open" x-transition.opacity class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
        <div class="fixed inset-0 z-10 flex items-center justify-center p-4">
            <div x-show="open" @click.away="open = false"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                class="bg-white rounded-3xl shadow-2xl border border-slate-100 w-full max-w-sm">
                <div class="px-6 pb-6 pt-8 text-center">
                    @if(session('success'))
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-emerald-50 border-4 border-emerald-100 mb-5">
                        <svg class="h-8 w-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-2">Berhasil!</h3>
                    <p class="text-sm text-slate-500 font-medium">{{ session('success') }}</p>
                    @endif
                    @if(session('error'))
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-rose-50 border-4 border-rose-100 mb-5">
                        <svg class="h-8 w-8 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-2">Terjadi Kesalahan</h3>
                    <p class="text-sm text-slate-500 font-medium">{{ session('error') }}</p>
                    @endif
                    <button type="button" @click="open = false"
                        class="mt-6 w-full bg-blue-950 hover:bg-blue-800 text-white px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg transition-all">
                        Mengerti
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

</x-app-layout>