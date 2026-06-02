<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col xl:flex-row justify-between items-start xl:items-center gap-4">
            <div>
                <div class="inline-flex items-center gap-2 bg-emerald-100 border border-emerald-200 px-3 py-1 rounded-full mb-3 shadow-sm">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <p class="text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em]">Manajemen Keuangan</p>
                </div>
                <h2 class="font-black text-2xl text-slate-900 leading-tight tracking-tight">
                    Pencairan Dana (Payout)
                </h2>
                <p class="text-sm text-slate-400 font-medium mt-0.5">
                    Kelola permintaan penarikan saldo dan mutasi ke rekening bank Tutor.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-[1400px] mx-auto px-6 md:px-12 space-y-8">

            {{-- ========================================== --}}
            {{-- ALERTS NOTIFIKASI                          --}}
            {{-- ========================================== --}}
            @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 shadow-sm rounded-2xl flex items-center gap-4 animate-bounce-short">
                <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center shrink-0 shadow-md shadow-emerald-500/20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                </div>
                <span class="font-black text-sm text-emerald-800 uppercase tracking-wide">{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="p-4 bg-rose-50 border border-rose-200 shadow-sm rounded-2xl flex items-center gap-4">
                <div class="w-10 h-10 bg-rose-500 rounded-full flex items-center justify-center shrink-0 shadow-md shadow-rose-500/20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                </div>
                <span class="font-black text-sm text-rose-800 uppercase tracking-wide">{{ session('error') }}</span>
            </div>
            @endif

            @if ($errors->any())
            <div class="p-5 bg-rose-50 border border-rose-200 shadow-sm rounded-2xl flex items-start gap-4">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shrink-0 border border-rose-200">
                    <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <div>
                    <h4 class="font-black text-sm text-rose-900 uppercase tracking-widest mb-1">Gagal Diproses!</h4>
                    <ul class="list-disc pl-4 text-xs font-bold text-rose-600 space-y-1">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            {{-- ========================================== --}}
            {{-- GRADIENT STATS CARDS                       --}}
            {{-- ========================================== --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                {{-- Card 1: Antrean --}}
                <div class="bg-gradient-to-br from-orange-400 to-orange-600 rounded-[2rem] shadow-lg shadow-orange-500/20 p-8 relative overflow-hidden text-white border border-orange-300 hover:-translate-y-1 transition-transform group">
                    <svg class="absolute -right-6 -bottom-6 w-32 h-32 text-white opacity-20 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"/><path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"/></svg>
                    <p class="text-[10px] font-black uppercase tracking-widest opacity-80 mb-2">Antrean Pencairan</p>
                    <p class="text-4xl font-black leading-none">{{ $countPending }} <span class="text-lg font-bold opacity-70">Tiket</span></p>
                </div>
                
                {{-- Card 2: Kewajiban --}}
                <div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-[2rem] shadow-lg shadow-blue-500/20 p-8 relative overflow-hidden text-white border border-blue-400 hover:-translate-y-1 transition-transform group">
                    <svg class="absolute -right-6 -bottom-6 w-32 h-32 text-white opacity-20 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    <p class="text-[10px] font-black uppercase tracking-widest opacity-80 mb-2">Kewajiban Transfer</p>
                    <p class="text-3xl font-black leading-none"><span class="opacity-70 text-2xl mr-1">Rp</span>{{ number_format($totalNominalPending, 0, ',', '.') }}</p>
                </div>

                {{-- Card 3: Berhasil --}}
                <div class="bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-[2rem] shadow-lg shadow-emerald-500/20 p-8 relative overflow-hidden text-white border border-emerald-300 hover:-translate-y-1 transition-transform group">
                    <svg class="absolute -right-6 -bottom-6 w-32 h-32 text-white opacity-20 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <p class="text-[10px] font-black uppercase tracking-widest opacity-80 mb-2">Total Payout Berhasil</p>
                    <p class="text-3xl font-black leading-none"><span class="opacity-70 text-2xl mr-1">Rp</span>{{ number_format($totalNominalBerhasil, 0, ',', '.') }}</p>
                </div>
            </div>

            {{-- ========================================== --}}
            {{-- TABEL & FILTER                             --}}
            {{-- ========================================== --}}
            <div class="bg-white shadow-xl rounded-[2rem] overflow-hidden border border-slate-200">
                
                {{-- Panel Filter Terpisah --}}
                <div class="bg-slate-50/60 p-6 border-b border-slate-200/60">
                    <form method="GET" action="{{ route('admin.payout') }}" class="grid grid-cols-1 lg:grid-cols-12 gap-4 w-full items-end">
                        
                        {{-- Grup Dropdown Kiri --}}
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 lg:col-span-8 w-full">
                            {{-- Pilih Bulan --}}
                            <div class="relative w-full">
                                <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1.5 pl-1">Periode Bulan</label>
                                <select name="month" onchange="this.form.submit()" class="appearance-none w-full pl-10 pr-8 py-3 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-700 hover:border-emerald-400 focus:ring-2 focus:ring-emerald-500 transition-all shadow-sm cursor-pointer outline-none">
                                    <option value="">Semua Bulan</option>
                                    @foreach(['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'] as $num => $name)
                                        <option value="{{ $num }}" {{ request('month') == $num ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute bottom-3.5 left-3.5 text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                </div>
                            </div>

                            {{-- Pilih Tahun --}}
                            <div class="relative w-full">
                                <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1.5 pl-1">Periode Tahun</label>
                                <select name="year" onchange="this.form.submit()" class="appearance-none w-full pl-10 pr-8 py-3 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-700 hover:border-emerald-400 focus:ring-2 focus:ring-emerald-500 transition-all shadow-sm cursor-pointer outline-none">
                                    <option value="">Semua Tahun</option>
                                    @for($y = 2024; $y <= date('Y') + 2; $y++) 
                                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                    @endfor
                                </select>
                                <div class="pointer-events-none absolute bottom-3.5 left-3.5 text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                </div>
                            </div>

                            {{-- Pilih Status --}}
                            <div class="relative w-full">
                                <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1.5 pl-1">Status Verifikasi</label>
                                <select name="status" onchange="this.form.submit()" class="appearance-none w-full pl-10 pr-8 py-3 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-700 hover:border-emerald-400 focus:ring-2 focus:ring-emerald-500 transition-all shadow-sm cursor-pointer outline-none">
                                    <option value="">Semua Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏳ Pending Request</option>
                                    <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>🔵 Sedang Diproses</option>
                                    <option value="berhasil" {{ request('status') == 'berhasil' ? 'selected' : '' }}>🟢 Transfer Berhasil</option>
                                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>🔴 Dana Ditolak</option>
                                </select>
                                <div class="pointer-events-none absolute bottom-3.5 left-3.5 text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                            </div>
                        </div>

                        {{-- Kolom Cari Kanan --}}
                        <div class="flex items-center gap-2 lg:col-span-4 w-full">
                            <div class="relative flex-grow">
                                <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1.5 pl-1">Kata Kunci</label>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama tutor atau kode tiket..." 
                                    class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-700 focus:ring-2 focus:ring-blue-900 transition-all outline-none placeholder:text-slate-400 shadow-sm">
                                <div class="pointer-events-none absolute bottom-3.5 left-3.5 text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-1.5 pt-5">
                                <button type="submit" class="bg-slate-900 hover:bg-black text-white px-5 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-md active:scale-95 shrink-0">
                                    Cari
                                </button>

                                @if(request()->anyFilled(['month', 'year', 'status', 'search']))
                                    <a href="{{ route('admin.payout') }}" class="px-4 py-3 bg-white hover:bg-rose-50 text-slate-500 hover:text-rose-600 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all border border-slate-200 hover:border-rose-200 shrink-0 shadow-sm">
                                        Reset
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Header Judul Tabel --}}
                <div class="px-6 py-5 flex items-center gap-3 bg-white border-b border-slate-100">
                    <div class="w-1.5 h-6 bg-emerald-500 rounded-full"></div>
                    <h3 class="font-black text-slate-900 text-sm uppercase tracking-widest">Daftar Transaksi Pencairan Dana</h3>
                </div>

                {{-- Isi Tabel Premium --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left whitespace-nowrap border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-slate-400 uppercase text-[9px] tracking-[0.2em] font-black border-b border-slate-200">
                                <th class="px-6 py-4">Tiket & Waktu</th>
                                <th class="px-6 py-4">Tutor Pengajar</th>
                                <th class="px-6 py-4">Nominal Payout</th>
                                <th class="px-6 py-4">Rekening Tujuan</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4 text-right">Aksi Manajemen</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse ($payouts as $payout)
                            <tr class="hover:bg-slate-50/50 even:bg-slate-50/20 transition-colors group">
                                {{-- Kolom 1: Tiket --}}
                                <td class="px-6 py-4">
                                    <p class="font-black text-slate-900 text-xs tracking-tight uppercase bg-slate-100 border border-slate-200 px-2 py-1 rounded-md w-max shadow-inner">{{ $payout->kode_pencairan }}</p>
                                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mt-1.5 flex items-center gap-1">
                                        <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ $payout->created_at->format('d M Y • H:i') }} WIB
                                    </p>
                                </td>

                                {{-- Kolom 2: Tutor --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-xl bg-blue-950 text-white flex items-center justify-center font-black text-[11px] uppercase shadow-md flex-shrink-0">
                                            {{ substr($payout->tutor->name ?? 'T', 0, 1) }}
                                        </div>
                                        <div class="text-left">
                                            <p class="font-black text-slate-800 text-xs leading-none mb-1">
                                                {{ $payout->tutor->name ?? 'User Terhapus' }}
                                            </p>
                                            <p class="text-[9px] font-bold text-slate-400 font-mono">ID: #TTR-{{ str_pad($payout->tutor_id, 4, '0', STR_PAD_LEFT) }}</p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Kolom 3: Nominal --}}
                                <td class="px-6 py-4 font-black text-slate-900 text-sm">
                                    <span class="text-xs font-bold text-slate-400 mr-0.5">Rp</span>{{ number_format($payout->nominal, 0, ',', '.') }}
                                </td>

                                {{-- Kolom 4: Rekening Tujuan --}}
                                <td class="px-6 py-4 text-left">
                                    <div class="inline-flex items-center gap-1.5 bg-blue-50/50 border border-blue-100/60 px-2 py-0.5 rounded-md text-[9px] font-black text-blue-700 uppercase tracking-wider mb-1 shadow-inner">
                                        🏦 {{ $payout->nama_bank }}
                                    </div>
                                    <p class="text-xs text-slate-800 font-mono font-black tracking-wide">{{ $payout->nomor_rekening }}</p>
                                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mt-0.5">A.N {{ $payout->nama_pemilik_rekening }}</p>
                                </td>

                                {{-- Kolom 5: Status --}}
                                <td class="px-6 py-4 text-center">
                                    @php
                                        $statusConfig = [
                                            'pending' => ['bg' => 'bg-orange-50 text-orange-600 border-orange-200', 'dot' => 'bg-orange-500', 'pulse' => true],
                                            'diproses' => ['bg' => 'bg-blue-50 text-blue-600 border-blue-200', 'dot' => 'bg-blue-500', 'pulse' => true],
                                            'berhasil' => ['bg' => 'bg-emerald-50 text-emerald-700 border-emerald-200', 'dot' => 'bg-emerald-500', 'pulse' => false],
                                            'ditolak' => ['bg' => 'bg-rose-50 text-rose-600 border-rose-200', 'dot' => 'bg-rose-500', 'pulse' => false],
                                        ];
                                        $cfg = $statusConfig[$payout->status] ?? ['bg' => 'bg-slate-50 text-slate-600 border-slate-200', 'dot' => 'bg-slate-400', 'pulse' => false];
                                    @endphp
                                    <span class="inline-flex items-center justify-center gap-1.5 px-3 py-1.5 rounded-xl border {{ $cfg['bg'] }} text-[9px] font-black uppercase tracking-widest shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $cfg['dot'] }} {{ $cfg['pulse'] ? 'animate-pulse' : '' }}"></span>
                                        {{ str_replace('_', ' ', $payout->status) }}
                                    </span>
                                </td>

                                {{-- Kolom 6: Aksi (Fixed Sesuai Parameter Modal Copy VA Baru) --}}
                                <td class="px-6 py-4 text-right">
                                    @if($payout->status == 'pending' || $payout->status == 'diproses')
                                        {{-- SINKRONISASI: Menambahkan parameter $payout->nama_pemilik_rekening di akhir fungsi onclick --}}
                                        <button onclick="openTransferModal('{{ $payout->id }}', '{{ $payout->kode_pencairan }}', '{{ number_format($payout->nominal, 0, ',', '.') }}', '{{ $payout->nama_bank }}', '{{ $payout->nomor_rekening }}', '{{ $payout->nama_pemilik_rekening }}')"
                                            class="inline-flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 text-white font-black py-2.5 px-4 rounded-xl transition-all text-[9px] uppercase tracking-widest shadow-md shadow-emerald-500/20 active:scale-95 border border-emerald-700">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                            Transfer Dana
                                        </button>
                                    @elseif($payout->status == 'berhasil' && $payout->bukti_transfer_path)
                                        <a href="{{ asset('storage/' . $payout->bukti_transfer_path) }}" target="_blank"
                                            class="inline-flex items-center gap-1.5 bg-white hover:bg-slate-50 text-slate-700 font-black py-2.5 px-4 rounded-xl transition-all text-[9px] uppercase tracking-widest border border-slate-200 shadow-sm active:scale-95 group-hover:border-slate-300">
                                            <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            Bukti Transfer
                                        </a>
                                    @else
                                        <span class="text-[10px] font-bold text-slate-400 bg-slate-100 border border-slate-200/60 px-2.5 py-1 rounded-md italic">Selesai / Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-20 bg-slate-50/40">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-white rounded-3xl flex items-center justify-center text-slate-300 border border-slate-200 mb-4 shadow-sm relative">
                                            <span class="text-2xl relative z-10">💰</span>
                                        </div>
                                        <p class="font-black text-slate-700 uppercase tracking-widest text-xs">Belum Ada Request Payout</p>
                                        <p class="text-xs font-medium text-slate-400 mt-1">Seluruh pengajuan penarikan dana tutor akan tercatat secara rapi di sini.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($payouts->hasPages())
                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                    {{ $payouts->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- MODAL UPLOAD BUKTI TRANSFER PREMIUM        --}}
    {{-- ========================================== --}}
    <dialog id="modal-transfer" class="rounded-[2.5rem] p-0 border border-slate-200 shadow-2xl backdrop:bg-slate-900/60 backdrop:backdrop-blur-sm m-auto w-full max-w-lg overflow-hidden">
        {{-- Mengintegrasikan Alpine.js lokal untuk fitur Copy To Clipboard instan --}}
        <div class="bg-white relative" x-data="{ copied: false }">
            
            {{-- Tombol Tutup Pojok Atas --}}
            <button type="button" onclick="this.closest('dialog').close()"
                class="absolute top-6 right-6 w-10 h-10 flex items-center justify-center bg-slate-50 hover:bg-rose-50 text-slate-400 hover:text-rose-500 rounded-xl border border-slate-200/60 hover:border-rose-200 transition-all z-20 shadow-sm active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>

            <div class="p-8 md:p-10 relative z-10 text-left">
                {{-- Header Judul --}}
                <div class="mb-6 border-b border-slate-100 pb-5">
                    <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-4 shadow-inner border border-emerald-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 tracking-tight mb-1">Konfirmasi Transfer</h3>
                    <p class="text-xs font-bold text-slate-400 leading-relaxed">Unggah bukti transaksi agar sistem dapat memverifikasi pemotongan saldo dompet Tutor.</p>
                </div>

                {{-- Detail Informasi Tiket Payout --}}
                <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-5 mb-6 shadow-inner space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Nomor Tiket Payout</p>
                            <p id="modal-tiket" class="text-xs font-black text-slate-900 tracking-tight bg-slate-200/60 px-2 py-0.5 rounded border border-slate-300/40 w-max shadow-sm"></p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Nominal Transfer</p>
                            <p id="modal-nominal" class="text-sm font-black text-emerald-600"></p>
                        </div>
                    </div>

                    {{-- Komponen Rekening/VA dengan Tombol Salin --}}
                    <div class="pt-4 border-t border-slate-200/80">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Rekening / VA Tujuan Transfer</p>
                        
                        <div class="flex items-center justify-between gap-3 bg-white border border-slate-200 p-3 rounded-xl shadow-sm group">
                            <div class="min-w-0">
                                <div class="inline-flex items-center gap-1.5 bg-blue-50 border border-blue-100 px-2 py-0.5 rounded text-[8px] font-black text-blue-700 uppercase tracking-wider mb-1" id="modal-bank-badge">
                                    🏦 <span id="modal-bank"></span>
                                </div>
                                {{-- Elemen penampung nomor rekening riil --}}
                                <p id="modal-rekening" class="text-sm font-mono font-black text-slate-900 tracking-wider leading-none"></p>
                                <p id="modal-pemilik" class="text-[10px] font-bold text-slate-400 mt-1 uppercase truncate max-w-[240px]"></p>
                            </div>

                            {{-- Tombol Salin Interaktif --}}
                            <button type="button" 
                                @click="
                                    navigator.clipboard.writeText(document.getElementById('modal-rekening').innerText);
                                    copied = true;
                                    setTimeout(() => copied = false, 2000);
                                "
                                class="shrink-0 inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all shadow-sm border active:scale-95 select-none"
                                :class="copied ? 'bg-emerald-50 text-emerald-600 border-emerald-200' : 'bg-slate-50 border-slate-200 text-slate-500 hover:bg-slate-100 hover:text-slate-800'">
                                
                                {{-- Ikon Sebelum Disalin --}}
                                <svg x-show="!copied" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                                {{-- Ikon Setelah Berhasil Disalin --}}
                                <svg x-show="copied" x-cloak class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                
                                <span x-text="copied ? 'Disalin!' : 'Salin'"></span>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Form Aksi Unggah Bukti --}}
                <form id="form-transfer" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2.5">Upload Bukti Struk Resmi (JPG/PNG)</label>
                        <input type="file" name="bukti_transfer" accept="image/*" required
                            class="block w-full text-xs font-bold text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-[9px] file:font-black file:uppercase file:tracking-widest file:bg-slate-900 file:text-white hover:file:bg-black cursor-pointer bg-slate-50 border-2 border-dashed border-slate-300 hover:border-blue-500 rounded-2xl p-2 transition-all outline-none">
                    </div>
                    
                    <button type="submit" class="w-full bg-slate-900 hover:bg-orange-500 text-white px-6 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-lg shadow-slate-900/10 active:scale-95 flex items-center justify-center gap-2">
                        Kirim &Selesaikan
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </dialog>

    <script>
        function openTransferModal(id, tiket, nominal, bank, rekening, pemilik) {
            // 1. Ubah Atribut Form Action secara dinamis menuju route verifikasi Anda
            document.getElementById('form-transfer').action = "/admin/payout/" + id + "/verify";
            
            // 2. Suntik Data Riil ke dalam Label Modal Box
            document.getElementById('modal-tiket').innerText = tiket;
            document.getElementById('modal-nominal').innerText = "Rp " + nominal;
            document.getElementById('modal-bank').innerText = bank;
            document.getElementById('modal-rekening').innerText = rekening; // Mengisi nomor rekening/VA
            document.getElementById('modal-pemilik').innerText = "A.N " + pemilik; // Mengisi nama pemilik
            
            // 3. Tampilkan Jendela Dialog HTML5
            document.getElementById('modal-transfer').showModal();
        }
    </script>
</x-app-layout>