<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <p class="text-[10px] font-black text-blue-500 uppercase tracking-[0.25em] mb-1">Manajemen Keuangan</p>
                <h2 class="font-black text-2xl text-slate-900 leading-tight tracking-tight">
                    Monitoring Dana Escrow
                </h2>
                <p class="text-sm text-slate-400 font-medium mt-0.5">Awasi aliran dana yang ditahan sistem sebelum dicairkan ke mitra tutor.</p>
            </div>
            
            <form method="GET" action="{{ route('admin.escrow') }}" class="flex flex-wrap md:flex-nowrap gap-2 w-full md:w-auto">
                <div class="relative">
                    <select name="status" onchange="this.form.submit()"
                        class="appearance-none pl-9 pr-8 py-2.5 bg-slate-100 border-transparent rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-200 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm cursor-pointer">
                        <option value="">Status Escrow Aktif</option>
                        <option value="siap_cair" {{ request('status') == 'siap_cair' ? 'selected' : '' }}>Siap Dicairkan</option>
                        <option value="dicairkan" {{ request('status') == 'dicairkan' ? 'selected' : '' }}>Sudah Dicairkan (History)</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 left-2.5 flex items-center">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z" /></svg>
                    </div>
                </div>

                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari tutor atau mapel..." 
                        class="pl-9 pr-4 py-2.5 bg-slate-100 border-transparent rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-200 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all w-full md:w-52 placeholder:font-medium placeholder:text-slate-400 shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-2.5 flex items-center">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </div>
                </div>

                <button type="submit" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-black text-white px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-md shadow-slate-900/20">
                    Cari
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-[1400px] mx-auto px-6 md:px-12 space-y-8">
            
            {{-- Gradient Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                
                {{-- Dana Hak Tutor (Blue Gradient) --}}
                <div class="bg-gradient-to-br from-blue-600 to-blue-900 rounded-2xl shadow-lg shadow-blue-500/20 p-6 relative overflow-hidden group border border-blue-400/50">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-bl-[4rem] -translate-y-4 translate-x-4 transition group-hover:scale-110 duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-tr-full"></div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-start">
                            <div class="inline-flex items-center justify-center w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl mb-4 shadow-sm border border-white/20">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-white/20 backdrop-blur-md rounded-lg text-[9px] font-black text-white uppercase tracking-wider border border-white/20 shadow-sm">
                                Liabilitas
                            </span>
                        </div>
                        <p class="text-[10px] font-black text-blue-200 uppercase tracking-[0.2em]">Dana Hak Tutor (Tertahan)</p>
                        <p class="text-3xl font-black text-white mt-1 leading-none">Rp {{ number_format($danaTutor, 0, ',', '.') }}</p>
                    </div>
                </div>

                {{-- Pendapatan Platform (Emerald Gradient) --}}
                <div class="bg-gradient-to-br from-emerald-500 to-emerald-700 rounded-2xl shadow-lg shadow-emerald-500/20 p-6 relative overflow-hidden group border border-emerald-400/50">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-bl-[4rem] -translate-y-4 translate-x-4 transition group-hover:scale-110 duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-tr-full"></div>
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl mb-4 shadow-sm border border-white/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <p class="text-[10px] font-black text-emerald-100 uppercase tracking-[0.2em]">Pendapatan Platform (Fee)</p>
                        <p class="text-3xl font-black text-white mt-1 leading-none">Rp {{ number_format($danaPlatform, 0, ',', '.') }}</p>
                    </div>
                </div>

                {{-- Siap Cair (Orange Gradient) --}}
                <div class="bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl shadow-lg shadow-orange-500/20 p-6 relative overflow-hidden group border border-orange-400/50">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-bl-[4rem] -translate-y-4 translate-x-4 transition group-hover:scale-110 duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-tr-full"></div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-start">
                            <div class="inline-flex items-center justify-center w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl mb-4 shadow-sm border border-white/20">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-white/20 backdrop-blur-md rounded-lg text-[9px] font-black text-white uppercase tracking-wider border border-white/20 shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                                Action
                            </span>
                        </div>
                        <p class="text-[10px] font-black text-orange-100 uppercase tracking-[0.2em]">Kelas Selesai (Siap Cair)</p>
                        <p class="text-4xl font-black text-white mt-1 leading-none">{{ $siapCair }}</p>
                    </div>
                </div>
            </div>

            {{-- Tabel Escrow --}}
            <div class="bg-white shadow-sm rounded-2xl overflow-hidden border border-gray-100">
                <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-white">
                    <div class="flex items-center gap-3">
                        <div class="w-1.5 h-6 bg-slate-900 rounded-full"></div>
                        <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest">Rincian Tiket Escrow</h3>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="bg-slate-50/50 text-slate-400 uppercase text-[9px] tracking-[0.18em] font-black border-b border-gray-100">
                                <th class="px-6 py-4">Tutor & Order ID</th>
                                <th class="px-6 py-4">Rincian Nilai Transaksi</th>
                                <th class="px-6 py-4 text-center">Status Kelas</th>
                                <th class="px-6 py-4 text-center">Status Escrow</th>
                                <th class="px-6 py-4 text-right">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($escrows as $escrow)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                
                                {{-- Kolom 1: Tutor --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-blue-950 text-white flex items-center justify-center font-black text-sm uppercase shadow-sm">
                                            {{ substr($escrow->tutor->name ?? 'T', 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-xs">{{ $escrow->tutor->name ?? 'Tutor Terhapus' }}</p>
                                            <p class="text-[9px] text-slate-400 font-black uppercase tracking-wider mt-0.5">#ORD-{{ str_pad($escrow->id, 4, '0', STR_PAD_LEFT) }}</p>
                                        </div>
                                    </div>
                                </td>
                                
                                {{-- Kolom 2: Uang --}}
                                <td class="px-6 py-4">
                                    <div class="flex flex-col gap-1 w-48">
                                        <div class="flex justify-between items-center text-[10px]">
                                            <span class="text-slate-500 font-semibold">Dibayar Murid:</span>
                                            <span class="font-bold text-slate-700">Rp {{ number_format($escrow->grand_total, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex justify-between items-center text-[10px]">
                                            <span class="text-rose-500 font-semibold">Fee Platform:</span>
                                            <span class="font-bold text-rose-600">- Rp {{ number_format($escrow->biaya_layanan, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex justify-between items-center pt-1 mt-1 border-t border-dashed border-slate-200">
                                            <span class="text-blue-950 font-black text-[9px] uppercase tracking-widest">Nett Tutor:</span>
                                            <span class="font-black text-emerald-600 text-xs">Rp {{ number_format($escrow->total_harga_sesi, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </td>

                                {{-- Kolom 3: Status Kelas --}}
                                <td class="px-6 py-4 text-center">
                                    @if($escrow->status_pesanan == 'selesai')
                                        <span class="inline-flex items-center justify-center px-2 py-1 rounded bg-emerald-50 text-emerald-600 font-black text-[8px] uppercase tracking-widest border border-emerald-200">Kelas Selesai</span>
                                    @elseif($escrow->status_pesanan == 'komplain')
                                        <span class="inline-flex items-center justify-center px-2 py-1 rounded bg-rose-50 text-rose-600 font-black text-[8px] uppercase tracking-widest border border-rose-200">Sengketa</span>
                                    @else
                                        <span class="inline-flex items-center justify-center px-2 py-1 rounded bg-blue-50 text-blue-600 font-black text-[8px] uppercase tracking-widest border border-blue-200">Berjalan</span>
                                    @endif
                                </td>

                                {{-- Kolom 4: Status Escrow --}}
                                <td class="px-6 py-4 text-center">
                                    @if($escrow->status_pembayaran == 'dicairkan')
                                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest border border-slate-200 px-2 py-1 rounded bg-slate-50">Telah Dicairkan</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 text-[9px] font-black text-blue-600 uppercase tracking-widest">
                                            <svg class="w-3 h-3 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                                            Ditahan
                                        </span>
                                    @endif
                                </td>

                                {{-- Kolom 5: Aksi --}}
                                <td class="px-6 py-4 text-right">
                                    @if($escrow->status_pembayaran == 'lunas_escrow' && $escrow->status_pesanan == 'selesai')
                                        <a href="#" class="inline-flex items-center gap-1.5 bg-orange-50 hover:bg-orange-500 text-orange-600 hover:text-white font-black py-1.5 px-3 rounded-lg transition-all duration-200 text-[9px] uppercase tracking-widest border border-orange-200 shadow-sm group-hover:border-orange-500">
                                            Release Dana
                                        </a>
                                    @else
                                        <span class="text-[9px] font-bold text-slate-300 italic">Belum bisa ditarik</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-20 bg-slate-50/30">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-16 h-16 rounded-3xl bg-white shadow-sm border border-slate-100 flex items-center justify-center">
                                            <svg class="w-7 h-7 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                                        </div>
                                        <p class="text-sm font-bold text-slate-500 mt-2">Belum ada dana masuk</p>
                                        <p class="text-xs text-slate-400">Escrow akan terisi saat murid melakukan pembayaran.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($escrows->hasPages())
                <div class="px-6 py-4 bg-slate-50/80 border-t border-gray-100">
                    {{ $escrows->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>