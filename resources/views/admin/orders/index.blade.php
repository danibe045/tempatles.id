<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <p class="text-[10px] font-black text-orange-500 uppercase tracking-[0.25em] mb-1">Operasional Utama</p>
                <h2 class="font-black text-2xl text-slate-900 leading-tight tracking-tight">
                    Manajemen Pesanan & Transaksi
                </h2>
                <p class="text-sm text-slate-400 font-medium mt-0.5">Pantau alur pemesanan, pembayaran Escrow, dan status kelas.</p>
            </div>
            
            {{-- Form Pencarian & Filter (Borderless) --}}
            <form method="GET" action="{{ route('admin.orders') }}" class="flex flex-wrap md:flex-nowrap gap-2 w-full md:w-auto">
                <div class="relative">
                    <select name="status" onchange="this.form.submit()"
                        class="appearance-none pl-9 pr-8 py-2.5 bg-slate-100 border-transparent rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-200 focus:bg-white focus:ring-2 focus:ring-blue-900 focus:border-blue-900 transition-all shadow-sm cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="menunggu_konfirmasi" {{ request('status') == 'menunggu_konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                        <option value="berjalan" {{ request('status') == 'berjalan' ? 'selected' : '' }}>Kelas Berjalan</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="komplain" {{ request('status') == 'komplain' ? 'selected' : '' }}>Komplain / Sengketa</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 left-2.5 flex items-center">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z" /></svg>
                    </div>
                </div>

                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau mapel..." 
                        class="pl-9 pr-4 py-2.5 bg-slate-100 border-transparent rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-200 focus:bg-white focus:ring-2 focus:ring-blue-900 focus:border-blue-900 transition-all w-full md:w-56 placeholder:font-medium placeholder:text-slate-400 shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-2.5 flex items-center">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </div>
                </div>

                <button type="submit" class="inline-flex items-center gap-2 bg-blue-950 hover:bg-black text-white px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-md shadow-blue-950/20">
                    Cari
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-[1400px] mx-auto px-6 md:px-12 space-y-8">
            
            {{-- Gradient Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                
                {{-- Pesanan Pending (Orange) --}}
                <div class="bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl shadow-lg shadow-orange-500/20 p-6 relative overflow-hidden group border border-orange-400/50">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-bl-[4rem] -translate-y-4 translate-x-4 transition group-hover:scale-110 duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-tr-full"></div>
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl mb-4 shadow-sm border border-white/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <p class="text-[10px] font-black text-orange-100 uppercase tracking-[0.2em]">Pending Order</p>
                        <p class="text-4xl font-black text-white mt-1 leading-none">{{ $countPending }}</p>
                        <p class="text-[10px] text-orange-50 mt-4 border-t border-white/10 pt-4 font-semibold tracking-wider">Menunggu konfirmasi tutor / bayar</p>
                    </div>
                </div>

                {{-- Kelas Berjalan (Blue) --}}
                <div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl shadow-lg shadow-blue-600/20 p-6 relative overflow-hidden group border border-blue-400/50">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-bl-[4rem] -translate-y-4 translate-x-4 transition group-hover:scale-110 duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-tr-full"></div>
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl mb-4 shadow-sm border border-white/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <p class="text-[10px] font-black text-blue-100 uppercase tracking-[0.2em]">Kelas Berjalan</p>
                        <p class="text-4xl font-black text-white mt-1 leading-none">{{ $countBerjalan }}</p>
                        <p class="text-[10px] text-blue-50 mt-4 border-t border-white/10 pt-4 font-semibold tracking-wider">Sesi pembelajaran sedang aktif</p>
                    </div>
                </div>

                {{-- Total Dana Escrow (Emerald) --}}
                <div class="bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-2xl shadow-lg shadow-emerald-500/20 p-6 relative overflow-hidden group border border-emerald-400/50">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-bl-[4rem] -translate-y-4 translate-x-4 transition group-hover:scale-110 duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-tr-full"></div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-start">
                            <div class="inline-flex items-center justify-center w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl mb-4 shadow-sm border border-white/20">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-white/20 backdrop-blur-md rounded-lg text-[9px] font-black text-white uppercase tracking-wider border border-white/20 shadow-sm">Safe</span>
                        </div>
                        <p class="text-[10px] font-black text-emerald-100 uppercase tracking-[0.2em]">Dana di Escrow</p>
                        <p class="text-3xl font-black text-white mt-1 leading-none tracking-tight">Rp {{ number_format($totalEscrow, 0, ',', '.') }}</p>
                        <p class="text-[10px] text-emerald-50 mt-4 border-t border-white/10 pt-4 font-semibold tracking-wider">Uang murid yang aman di sistem</p>
                    </div>
                </div>
            </div>

            {{-- Tabel Pesanan --}}
            <div class="bg-white shadow-sm rounded-2xl overflow-hidden border border-gray-100">
                <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-white">
                    <div class="flex items-center gap-3">
                        <div class="w-1.5 h-6 bg-blue-950 rounded-full"></div>
                        <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest">Riwayat Transaksi</h3>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="bg-slate-50/50 text-slate-400 uppercase text-[9px] tracking-[0.18em] font-black border-b border-gray-100">
                                <th class="px-6 py-4">ID Pesanan</th>
                                <th class="px-6 py-4">Partisipan (Murid & Tutor)</th>
                                <th class="px-6 py-4">Paket Belajar & Harga</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($orders as $order)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-4">
                                    <p class="font-black text-blue-950 text-xs">#ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</p>
                                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-wider mt-1">{{ $order->created_at->format('d M Y') }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2 mb-1.5">
                                        <div class="w-4 h-4 rounded-full bg-orange-100 flex items-center justify-center"><span class="text-[8px] font-black text-orange-600">M</span></div>
                                        <p class="font-bold text-slate-800 text-xs truncate max-w-[150px]">{{ $order->murid->name ?? 'User Terhapus' }}</p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div class="w-4 h-4 rounded-full bg-blue-100 flex items-center justify-center"><span class="text-[8px] font-black text-blue-600">T</span></div>
                                        <p class="font-bold text-slate-500 text-[10px] truncate max-w-[150px]">{{ $order->tutor->name ?? 'User Terhapus' }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-bold text-slate-800 text-xs">{{ $order->mata_pelajaran }}</p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="bg-slate-100 text-slate-500 text-[9px] font-black px-2 py-0.5 rounded uppercase tracking-wider">{{ $order->jumlah_sesi }} Sesi</span>
                                        <span class="font-black text-blue-700 text-[11px]">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{-- Badge Status Pesanan --}}
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
                                    <div class="flex flex-col items-center gap-1.5">
                                        <span class="inline-flex items-center justify-center w-full px-2.5 py-1 rounded border {{ $badgeClass }} text-[8px] font-black uppercase tracking-wider shadow-sm">
                                            {{ str_replace('_', ' ', $order->status_pesanan) }}
                                        </span>
                                        {{-- Indikator Uang / Pembayaran --}}
                                        @if($order->status_pembayaran == 'lunas_escrow')
                                            <span class="text-[9px] font-black text-emerald-500 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Escrow Aman</span>
                                        @elseif($order->status_pembayaran == 'dicairkan')
                                            <span class="text-[9px] font-black text-blue-500">Dana Dicairkan</span>
                                        @else
                                            <span class="text-[9px] font-black text-slate-400">Belum Bayar</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="#" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-50 text-slate-400 hover:bg-blue-950 hover:text-white transition-all shadow-sm border border-slate-200 group-hover:border-transparent">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-20 bg-slate-50/30">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-16 h-16 rounded-3xl bg-white shadow-sm border border-slate-100 flex items-center justify-center">
                                            <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                                        </div>
                                        <p class="text-sm font-bold text-slate-500 mt-2">Belum ada transaksi</p>
                                        <p class="text-xs text-slate-400">Sistem belum menerima pesanan baru dari murid.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($orders->hasPages())
                <div class="px-6 py-4 bg-slate-50/80 border-t border-gray-100">
                    {{ $orders->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>