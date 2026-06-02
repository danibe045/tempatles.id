<x-app-layout>
    <style>
        [x-cloak] { display: none !important; }
    </style>

    {{-- ========================================================================= --}}
    {{-- WRAPPER UTAMA STICKY (Mengunci Header + Filter)                           --}}
    {{-- ========================================================================= --}}
    <div class="sticky top-0 z-[40] w-full pb-4">
        <div class="bg-white/95 backdrop-blur-md border-b border-slate-200 pt-6 pb-6 px-6 md:px-8 shadow-sm">
            <div class="max-w-[1400px] mx-auto flex flex-col xl:flex-row justify-between items-start xl:items-center gap-6">
                
                {{-- Kiri: Judul --}}
                <div>
                    <div class="inline-flex items-center gap-2 bg-orange-50 border border-orange-100 px-3 py-1 rounded-full mb-3 shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span>
                        <p class="text-[10px] font-black text-orange-600 uppercase tracking-[0.2em]">Operasional Utama</p>
                    </div>
                    <h2 class="font-black text-2xl text-slate-900 leading-tight tracking-tight">
                        Manajemen Pesanan & Transaksi
                    </h2>
                    <p class="text-sm text-slate-400 font-medium mt-0.5">Pantau alur pemesanan, pembayaran Escrow, dan status kelas.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ========================================================================= --}}
    {{-- KONTEN UTAMA DENGAN ALPINE STATE UNTUK MODAL ACC & BATAL                  --}}
    {{-- ========================================================================= --}}
    <div x-data="{ accOpen: false, accId: null, cancelOpen: false, cancelId: null }" class="py-6 relative z-10">
        <div class="max-w-[1400px] mx-auto px-6 md:px-8 space-y-8">

            {{-- Flash Messages --}}
            @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 shadow-sm rounded-2xl flex items-center gap-4">
                <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                </div>
                <span class="font-black text-sm text-emerald-800 tracking-wide">{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="p-4 bg-rose-50 border border-rose-200 shadow-sm rounded-2xl flex items-center gap-4">
                <div class="w-10 h-10 bg-rose-100 rounded-full flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                </div>
                <span class="font-black text-sm text-rose-800 tracking-wide">{{ session('error') }}</span>
            </div>
            @endif

            {{-- Gradient Stats Cards --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
                {{-- Pending --}}
                <div class="bg-gradient-to-br from-orange-400 to-orange-600 rounded-[2rem] shadow-xl shadow-orange-500/20 p-8 relative overflow-hidden group border border-orange-400/50">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl group-hover:scale-125 transition-transform duration-700"></div>
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-14 h-14 bg-white/20 backdrop-blur-md rounded-2xl mb-4 border border-white/30">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <p class="text-[10px] font-black text-orange-100 uppercase tracking-[0.2em]">Pending Order</p>
                        <p class="text-5xl font-black text-white mt-1 leading-none tracking-tight">{{ $countPending }}</p>
                    </div>
                </div>

                {{-- Berjalan --}}
                <div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-[2rem] shadow-xl shadow-blue-600/20 p-8 relative overflow-hidden group border border-blue-400/50">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl group-hover:scale-125 transition-transform duration-700"></div>
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-14 h-14 bg-white/20 backdrop-blur-md rounded-2xl mb-4 border border-white/30">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <p class="text-[10px] font-black text-blue-100 uppercase tracking-[0.2em]">Kelas Berjalan</p>
                        <p class="text-5xl font-black text-white mt-1 leading-none tracking-tight">{{ $countBerjalan }}</p>
                    </div>
                </div>

                {{-- Escrow --}}
                <div class="bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-[2rem] shadow-xl shadow-emerald-500/20 p-8 relative overflow-hidden group border border-emerald-400/50">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl group-hover:scale-125 transition-transform duration-700"></div>
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-14 h-14 bg-white/20 backdrop-blur-md rounded-2xl mb-4 border border-white/30">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <p class="text-[10px] font-black text-emerald-100 uppercase tracking-[0.2em]">Dana di Escrow</p>
                        <p class="text-4xl font-black text-white mt-1 leading-none tracking-tight">Rp {{ number_format($totalEscrow, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            {{-- Tabel Pesanan --}}
            <div class="bg-white shadow-xl rounded-[2rem] border border-slate-200 overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-100 flex items-center gap-4 bg-slate-50/50">
                    <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center text-blue-600 border border-blue-200 shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                    </div>
                    <div>
                        <h3 class="font-black text-slate-800 text-lg tracking-tight">Riwayat Transaksi</h3>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Pantau status & konfirmasi pembayaran</p>
                    </div>

                    {{-- Kanan: Form Filter & Search --}}
                    <form method="GET" action="{{ route('admin.orders') }}" class="flex flex-col sm:flex-row items-center gap-3 w-full xl:w-auto">
                        
                        {{-- Filter Status --}}
                        <div class="relative w-full sm:w-auto shrink-0">
                            <select name="status" onchange="this.form.submit()" class="appearance-none w-full pl-10 pr-8 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-600 hover:bg-white focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all shadow-sm cursor-pointer outline-none">
                                <option value="">Semua Status</option>
                                <option value="menunggu_konfirmasi" {{ request('status') == 'menunggu_konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                                <option value="berjalan" {{ request('status') == 'berjalan' ? 'selected' : '' }}>Kelas Berjalan</option>
                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="komplain" {{ request('status') == 'komplain' ? 'selected' : '' }}>Komplain / Sengketa</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 left-3.5 flex items-center">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z" /></svg>
                            </div>
                        </div>

                        {{-- Kolom Cari --}}
                        <div class="relative w-full sm:w-64 lg:w-72">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari mapel / nama..." class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all outline-none placeholder:font-medium placeholder:text-slate-400 shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-3.5 flex items-center">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            </div>
                        </div>

                        <div class="flex gap-2 w-full sm:w-auto">
                            <button type="submit" class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 bg-blue-950 hover:bg-blue-800 text-white px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg active:scale-95 border border-blue-900">
                                Cari
                            </button>
                            @if(request('search') || request('status'))
                                <a href="{{ route('admin.orders') }}" class="flex-1 sm:flex-none px-6 py-3 bg-slate-100 hover:bg-rose-50 text-slate-500 hover:text-rose-600 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all border border-slate-200 hover:border-rose-200 text-center flex items-center justify-center">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest whitespace-nowrap">ID Pesanan</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest">Partisipan</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest">Paket Belajar</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest text-center">Status</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($orders as $order)
                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <td class="px-8 py-5">
                                    <p class="font-black text-blue-950 text-sm">#ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</p>
                                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-wider mt-1">{{ $order->created_at->translatedFormat('d M Y') }}</p>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-5 h-5 rounded-full bg-orange-100 flex items-center justify-center border border-orange-200 shrink-0">
                                            <span class="text-[9px] font-black text-orange-600">M</span>
                                        </div>
                                        <p class="font-bold text-slate-800 text-xs truncate max-w-[180px]">{{ $order->murid->name ?? 'User Terhapus' }}</p>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-5 h-5 rounded-full bg-blue-100 flex items-center justify-center border border-blue-200 shrink-0">
                                            <span class="text-[9px] font-black text-blue-600">T</span>
                                        </div>
                                        <p class="font-bold text-slate-500 text-xs truncate max-w-[180px]">{{ $order->tutor->name ?? 'User Terhapus' }}</p>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <p class="font-bold text-slate-800 text-sm">{{ $order->mata_pelajaran }}</p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="bg-slate-200 text-slate-600 text-[9px] font-black px-2 py-0.5 rounded uppercase tracking-wider">{{ $order->jumlah_sesi }} Sesi</span>
                                        <span class="font-black text-blue-700 text-xs">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    @php
                                    $statusClasses = [
                                        'menunggu_konfirmasi' => 'bg-gray-50 text-gray-600 border-gray-200',
                                        'menunggu_pembayaran' => 'bg-orange-50 text-orange-600 border-orange-200',
                                        'berjalan' => 'bg-blue-50 text-blue-700 border-blue-200',
                                        'selesai' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                        'komplain' => 'bg-rose-50 text-rose-600 border-rose-200',
                                        'dibatalkan' => 'bg-red-50 text-red-600 border-red-200',
                                    ];
                                    $badgeClass = $statusClasses[$order->status_pesanan] ?? 'bg-gray-50 text-gray-600 border-gray-200';
                                    @endphp
                                    <div class="flex flex-col items-center gap-2">
                                        <span class="inline-flex items-center justify-center w-full px-3 py-1.5 rounded border {{ $badgeClass }} text-[9px] font-black uppercase tracking-widest shadow-sm">
                                            {{ str_replace('_', ' ', $order->status_pesanan) }}
                                        </span>
                                        @if($order->status_pembayaran == 'lunas_escrow')
                                        <span class="text-[9px] font-black text-emerald-500 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                            Escrow Aman
                                        </span>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-8 py-5 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        
                                        {{-- AKSI: JIKA MENUNGGU VERIFIKASI PEMBAYARAN --}}
                                        @if($order->status_pembayaran == 'belum_bayar' && $order->bukti_bayar != null)
                                            <a href="{{ asset('storage/' . $order->bukti_bayar) }}" target="_blank" class="bg-blue-50 text-blue-600 hover:bg-blue-100 px-3 py-2 rounded-xl text-[10px] font-bold uppercase tracking-widest border border-blue-200 transition-colors">
                                                Cek Struk
                                            </a>
                                            <button @click.prevent="accOpen = true; accId = {{ $order->id }}" type="button" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-md transition-transform active:scale-95">
                                                ACC
                                            </button>
                                        
                                        {{-- AKSI: JIKA MASIH MENUNGGU (BISA DIBATALKAN) --}}
                                        @elseif($order->status_pesanan == 'menunggu_konfirmasi' || $order->status_pesanan == 'menunggu_pembayaran')
                                            <button @click.prevent="cancelOpen = true; cancelId = {{ $order->id }}" type="button" class="text-rose-500 hover:text-white bg-rose-50 hover:bg-rose-500 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-colors border border-rose-200 hover:border-transparent">
                                                Batal
                                            </button>
                                        
                                        {{-- AKSI: JIKA SUDAH JALAN/SELESAI (DETAIL) --}}
                                        @else
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-slate-50 text-slate-500 hover:bg-blue-950 hover:text-white transition-all shadow-sm border border-slate-200 text-[10px] font-black uppercase tracking-widest">
                                                Detail
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-20 bg-slate-50/50">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-20 h-20 rounded-full bg-white shadow-sm border border-slate-100 flex items-center justify-center">
                                            <span class="text-3xl grayscale opacity-40">📂</span>
                                        </div>
                                        <p class="text-base font-black text-slate-800 mt-2">Belum Ada Transaksi</p>
                                        <p class="text-xs font-medium text-slate-500 max-w-sm">Sistem belum menerima pesanan baru yang sesuai dengan kriteria.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($orders->hasPages())
                <div class="px-8 py-6 bg-slate-50 border-t border-slate-200">
                    {{ $orders->links() }}
                </div>
                @endif
            </div>
        </div>

        {{-- ======================================================== --}}
        {{-- MODAL KONFIRMASI (ACC & BATAL) Diteleport ke body        --}}
        {{-- ======================================================== --}}
        <template x-teleport="body">
            <div>
                @foreach($orders as $modalOrder)
                
                {{-- MODAL ACC PESANAN --}}
                <div x-show="accOpen && accId === {{ $modalOrder->id }}" x-cloak class="fixed inset-0 z-[110] flex items-center justify-center p-4" aria-modal="true">
                    <div x-show="accOpen && accId === {{ $modalOrder->id }}" x-transition.opacity class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm" @click="accOpen = false; accId = null"></div>
                    <div x-show="accOpen && accId === {{ $modalOrder->id }}" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" class="relative bg-white rounded-3xl shadow-2xl p-8 w-full max-w-sm text-center border border-slate-100">
                        <div class="w-20 h-20 rounded-full mx-auto flex items-center justify-center mb-5 bg-emerald-100 text-emerald-500 shadow-inner">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h3 class="text-xl font-black text-slate-800 mb-2">Verifikasi Pembayaran?</h3>
                        <p class="text-sm font-medium text-slate-500 mb-8 leading-relaxed">
                            Pastikan Anda sudah mengecek struk transfer. Jika di-ACC, kelas akan otomatis berjalan.
                        </p>
                        <div class="flex gap-3">
                            <button @click="accOpen = false; accId = null" type="button" class="w-full px-5 py-3 bg-slate-50 hover:bg-slate-100 text-slate-600 text-[10px] font-black uppercase tracking-widest rounded-xl border border-slate-200">Batal</button>
                            <form action="{{ route('admin.orders.verify', $modalOrder->id) }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="w-full px-5 py-3 bg-emerald-500 hover:bg-emerald-600 text-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-md active:scale-95">Ya, ACC Pesanan</button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- MODAL BATALKAN PESANAN --}}
                <div x-show="cancelOpen && cancelId === {{ $modalOrder->id }}" x-cloak class="fixed inset-0 z-[110] flex items-center justify-center p-4" aria-modal="true">
                    <div x-show="cancelOpen && cancelId === {{ $modalOrder->id }}" x-transition.opacity class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm" @click="cancelOpen = false; cancelId = null"></div>
                    <div x-show="cancelOpen && cancelId === {{ $modalOrder->id }}" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" class="relative bg-white rounded-3xl shadow-2xl p-8 w-full max-w-sm text-center border border-slate-100">
                        <div class="w-20 h-20 rounded-full mx-auto flex items-center justify-center mb-5 bg-rose-100 text-rose-500 shadow-inner">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                        </div>
                        <h3 class="text-xl font-black text-slate-800 mb-2">Batalkan Pesanan?</h3>
                        <p class="text-sm font-medium text-slate-500 mb-8 leading-relaxed">
                            Pesanan ini akan dibatalkan secara paksa dan tidak dapat dikembalikan lagi. Lanjutkan?
                        </p>
                        <div class="flex gap-3">
                            <button @click="cancelOpen = false; cancelId = null" type="button" class="w-full px-5 py-3 bg-slate-50 hover:bg-slate-100 text-slate-600 text-[10px] font-black uppercase tracking-widest rounded-xl border border-slate-200">Tutup</button>
                            <form action="{{ route('admin.orders.cancel', $modalOrder->id) }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="w-full px-5 py-3 bg-rose-600 hover:bg-rose-700 text-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-md active:scale-95">Ya, Batalkan</button>
                            </form>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </template>
    </div>
</x-app-layout>