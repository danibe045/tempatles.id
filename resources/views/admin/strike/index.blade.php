<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <p class="text-[10px] font-black text-rose-500 uppercase tracking-[0.25em] mb-1">Kendali Mutu</p>
                <h2 class="font-black text-2xl text-slate-900 leading-tight tracking-tight">
                    Manajemen Strike & Sanksi
                </h2>
                <p class="text-sm text-slate-400 font-medium mt-0.5">Kelola poin pelanggaran tutor untuk menjaga kualitas layanan Tempatles.id.</p>
            </div>
            
            <form method="GET" action="{{ route('admin.strike') }}" class="flex flex-wrap md:flex-nowrap gap-2 w-full md:w-auto">
                <div class="relative">
                    <select name="status" onchange="this.form.submit()"
                        class="appearance-none pl-9 pr-8 py-2.5 bg-slate-100 border-transparent rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-200 focus:bg-white focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition-all shadow-sm cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Strike Aktif</option>
                        <option value="dicabut" {{ request('status') == 'dicabut' ? 'selected' : '' }}>Strike Dicabut / Dimaafkan</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 left-2.5 flex items-center">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z" /></svg>
                    </div>
                </div>

                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari tutor atau alasan..." 
                        class="pl-9 pr-4 py-2.5 bg-slate-100 border-transparent rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-200 focus:bg-white focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition-all w-full md:w-56 placeholder:font-medium placeholder:text-slate-400 shadow-sm">
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
                
                {{-- Strike Aktif (Rose/Merah Gradient) --}}
                <div class="bg-gradient-to-br from-rose-500 to-rose-700 rounded-2xl shadow-lg shadow-rose-500/20 p-6 relative overflow-hidden group border border-rose-400/50">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-bl-[4rem] -translate-y-4 translate-x-4 transition group-hover:scale-110 duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-tr-full"></div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-start">
                            <div class="inline-flex items-center justify-center w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl mb-4 shadow-sm border border-white/20">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-white/20 backdrop-blur-md rounded-lg text-[9px] font-black text-white uppercase tracking-wider border border-white/20 shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                                Total SP
                            </span>
                        </div>
                        <p class="text-[10px] font-black text-rose-100 uppercase tracking-[0.2em]">Poin Strike Aktif</p>
                        <p class="text-4xl font-black text-white mt-1 leading-none">{{ $countAktif }}</p>
                    </div>
                </div>

                {{-- Tutor Bermasalah (Orange Gradient) --}}
                <div class="bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl shadow-lg shadow-orange-500/20 p-6 relative overflow-hidden group border border-orange-400/50">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-bl-[4rem] -translate-y-4 translate-x-4 transition group-hover:scale-110 duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-tr-full"></div>
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl mb-4 shadow-sm border border-white/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        </div>
                        <p class="text-[10px] font-black text-orange-100 uppercase tracking-[0.2em]">Tutor Dlm Pengawasan</p>
                        <p class="text-4xl font-black text-white mt-1 leading-none">{{ $countTutorBermasalah }}</p>
                    </div>
                </div>

                {{-- Strike Dicabut (Emerald/Blue Gradient) --}}
                <div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl shadow-lg shadow-blue-500/20 p-6 relative overflow-hidden group border border-blue-400/50">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-bl-[4rem] -translate-y-4 translate-x-4 transition group-hover:scale-110 duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-tr-full"></div>
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl mb-4 shadow-sm border border-white/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <p class="text-[10px] font-black text-blue-100 uppercase tracking-[0.2em]">Strike Dimaafkan / Dicabut</p>
                        <p class="text-4xl font-black text-white mt-1 leading-none">{{ $countDicabut }}</p>
                    </div>
                </div>
            </div>

            {{-- Tabel Strike --}}
            <div class="bg-white shadow-sm rounded-2xl overflow-hidden border border-gray-100">
                <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-white">
                    <div class="flex items-center gap-3">
                        <div class="w-1.5 h-6 bg-slate-900 rounded-full"></div>
                        <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest">Catatan Pelanggaran Tutor</h3>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="bg-slate-50/50 text-slate-400 uppercase text-[9px] tracking-[0.18em] font-black border-b border-gray-100">
                                <th class="px-6 py-4">Tutor Info</th>
                                <th class="px-6 py-4">Detail Pelanggaran</th>
                                <th class="px-6 py-4">Tanggal Kejadian</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4 text-right">Tindakan Admin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($strikes as $strike)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                
                                {{-- Kolom 1: Tutor --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-blue-950 text-white flex items-center justify-center font-black text-sm uppercase shadow-sm">
                                            {{ substr($strike->tutor->name ?? 'T', 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-xs">{{ $strike->tutor->name ?? 'Tutor Terhapus' }}</p>
                                            <p class="text-[9px] text-slate-400 font-mono mt-0.5">ID: {{ str_pad($strike->tutor_id, 4, '0', STR_PAD_LEFT) }}</p>
                                        </div>
                                    </div>
                                </td>
                                
                                {{-- Kolom 2: Alasan --}}
                                <td class="px-6 py-4">
                                    <p class="font-bold text-rose-600 text-xs truncate max-w-[250px]">{{ $strike->alasan_pelanggaran }}</p>
                                    <p class="text-[10px] text-slate-500 font-medium mt-1 truncate max-w-[250px]">{{ $strike->keterangan_detail ?? '-' }}</p>
                                </td>

                                {{-- Kolom 3: Waktu --}}
                                <td class="px-6 py-4">
                                    <p class="font-black text-slate-700 text-xs">{{ $strike->created_at->format('d M Y') }}</p>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">{{ $strike->created_at->format('H:i') }} WIB</p>
                                </td>

                                {{-- Kolom 4: Status --}}
                                <td class="px-6 py-4 text-center">
                                    @if($strike->status == 'aktif')
                                        <span class="inline-flex items-center justify-center px-2.5 py-1.5 rounded border bg-rose-50 text-rose-600 border-rose-200 text-[8px] font-black uppercase tracking-wider shadow-sm">
                                            Berlaku
                                        </span>
                                    @else
                                        <span class="inline-flex items-center justify-center px-2.5 py-1.5 rounded border bg-slate-100 text-slate-500 border-slate-300 text-[8px] font-black uppercase tracking-wider">
                                            Dicabut
                                        </span>
                                    @endif
                                </td>

                                {{-- Kolom 5: Aksi --}}
                                <td class="px-6 py-4 text-right">
                                    @if($strike->status == 'aktif')
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="#" class="inline-flex items-center gap-1.5 bg-white hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 font-black py-1.5 px-3 rounded-lg transition-all duration-200 text-[9px] uppercase tracking-widest border border-slate-200 shadow-sm group-hover:border-emerald-200">
                                                Maafkan
                                            </a>
                                            <a href="#" class="inline-flex items-center gap-1.5 bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white font-black py-1.5 px-3 rounded-lg transition-all duration-200 text-[9px] uppercase tracking-widest border border-rose-200 shadow-sm">
                                                Banned
                                            </a>
                                        </div>
                                    @else
                                        <span class="text-[9px] font-bold text-slate-400 italic">Telah dimaafkan</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-20 bg-slate-50/30">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-16 h-16 rounded-3xl bg-white shadow-sm border border-slate-100 flex items-center justify-center">
                                            <svg class="w-7 h-7 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        </div>
                                        <p class="text-sm font-bold text-slate-500 mt-2">Zero Strike! Bersih!</p>
                                        <p class="text-xs text-slate-400">Belum ada pelanggaran yang dilakukan oleh tutor sejauh ini.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($strikes->hasPages())
                <div class="px-6 py-4 bg-slate-50/80 border-t border-gray-100">
                    {{ $strikes->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>