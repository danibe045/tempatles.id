<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <p class="text-[10px] font-black text-orange-500 uppercase tracking-[0.25em] mb-1">Kendali Mutu Akademik</p>
                <h2 class="font-black text-2xl text-slate-900 leading-tight tracking-tight">
                    Monitoring Silabus & Rencana Ajar
                </h2>
                <p class="text-sm text-slate-400 font-medium mt-0.5">Tinjau, setujui, atau minta revisi modul pembelajaran dari tutor.</p>
            </div>
            
            {{-- Form Pencarian & Filter bergaya Borderless menyatu dengan Header --}}
            <form method="GET" action="{{ route('admin.silabus') }}" class="flex flex-wrap md:flex-nowrap gap-2 w-full md:w-auto">
                <div class="relative">
                    <select name="status" onchange="this.form.submit()"
                        class="appearance-none pl-9 pr-8 py-2.5 bg-slate-100 border-transparent rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-200 focus:bg-white focus:ring-2 focus:ring-blue-900 focus:border-blue-900 transition-all shadow-sm cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Review</option>
                        <option value="revisi" {{ request('status') == 'revisi' ? 'selected' : '' }}>Perlu Revisi</option>
                        <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 left-2.5 flex items-center">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z" />
                        </svg>
                    </div>
                </div>

                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari tutor atau mapel..." 
                        class="pl-9 pr-4 py-2.5 bg-slate-100 border-transparent rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-200 focus:bg-white focus:ring-2 focus:ring-blue-900 focus:border-blue-900 transition-all w-full md:w-56 placeholder:font-medium placeholder:text-slate-400 shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-2.5 flex items-center">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <button type="submit" class="inline-flex items-center gap-2 bg-blue-950 hover:bg-black text-white px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-md shadow-blue-950/20">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Cari
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-[1400px] mx-auto px-6 md:px-12 space-y-8">
            
            {{-- Stats Cards (Gradient Style) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                
                {{-- Menunggu Review (Orange Gradient) --}}
                <div class="bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl shadow-lg shadow-orange-500/20 p-6 relative overflow-hidden group border border-orange-400/50">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-bl-[4rem] -translate-y-4 translate-x-4 transition group-hover:scale-110 duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-tr-full"></div>
                    
                    <div class="relative z-10">
                        <div class="flex justify-between items-start">
                            <div class="inline-flex items-center justify-center w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl mb-4 shadow-sm border border-white/20">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-white/20 backdrop-blur-md rounded-lg text-[9px] font-black text-white uppercase tracking-wider border border-white/20 shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                                Butuh Tinjauan
                            </span>
                        </div>
                        <p class="text-[10px] font-black text-orange-100 uppercase tracking-[0.2em]">Menunggu Review</p>
                        <p class="text-4xl font-black text-white mt-1 leading-none">{{ $countPending }}</p>
                    </div>
                </div>

                {{-- Perlu Revisi (Rose/Merah Gradient) --}}
                <div class="bg-gradient-to-br from-rose-400 to-rose-600 rounded-2xl shadow-lg shadow-rose-500/20 p-6 relative overflow-hidden group border border-rose-400/50">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-bl-[4rem] -translate-y-4 translate-x-4 transition group-hover:scale-110 duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-tr-full"></div>
                    
                    <div class="relative z-10">
                        <div class="flex justify-between items-start">
                            <div class="inline-flex items-center justify-center w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl mb-4 shadow-sm border border-white/20">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-[10px] font-black text-rose-100 uppercase tracking-[0.2em]">Perlu Revisi</p>
                        <p class="text-4xl font-black text-white mt-1 leading-none">{{ $countRevisi }}</p>
                    </div>
                </div>

                {{-- Disetujui (Emerald/Hijau Gradient) --}}
                <div class="bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-2xl shadow-lg shadow-emerald-500/20 p-6 relative overflow-hidden group border border-emerald-400/50">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-bl-[4rem] -translate-y-4 translate-x-4 transition group-hover:scale-110 duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-tr-full"></div>
                    
                    <div class="relative z-10">
                        <div class="flex justify-between items-start">
                            <div class="inline-flex items-center justify-center w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl mb-4 shadow-sm border border-white/20">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-[10px] font-black text-emerald-100 uppercase tracking-[0.2em]">Disetujui</p>
                        <p class="text-4xl font-black text-white mt-1 leading-none">{{ $countDisetujui }}</p>
                    </div>
                </div>
            </div>

            {{-- Tabel Silabus --}}
            <div class="bg-white shadow-sm rounded-2xl overflow-hidden border border-gray-100">
                <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-white">
                    <div class="flex items-center gap-3">
                        <div class="w-1.5 h-6 bg-blue-950 rounded-full"></div>
                        <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest">Daftar Modul & Silabus</h3>
                    </div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-wider bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-100">
                        {{ $silabusList->total() ?? 0 }} Data
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="bg-slate-50/50 text-slate-400 uppercase text-[9px] tracking-[0.18em] font-black border-b border-gray-100">
                                <th class="px-6 py-4">Tutor & Info</th>
                                <th class="px-6 py-4">Mata Pelajaran</th>
                                <th class="px-6 py-4">Modul / Rencana Ajar</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($silabusList as $silabus)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-blue-950 flex items-center justify-center text-white font-black text-sm uppercase shadow-sm">
                                            {{ substr($silabus->tutor->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-sm leading-tight">{{ $silabus->tutor->name }}</p>
                                            <p class="text-[10px] text-slate-400 font-mono mt-0.5">ID Tutor: {{ str_pad($silabus->tutor_id, 4, '0', STR_PAD_LEFT) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-bold text-slate-800 text-xs">{{ $silabus->mata_pelajaran }}</p>
                                    <span class="inline-block mt-1 bg-slate-100 text-slate-600 border border-slate-200 text-[9px] font-black px-2 py-0.5 rounded-md tracking-wider uppercase">
                                        {{ $silabus->tingkat_siswa }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-xs font-bold text-slate-700">{{ $silabus->judul_kurikulum }}</p>
                                    <p class="text-[9px] font-bold text-blue-600 uppercase tracking-widest mt-1 bg-blue-50 inline-block px-2 py-0.5 rounded border border-blue-100">
                                        {{ $silabus->jumlah_pertemuan }} Pertemuan
                                    </p>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if ($silabus->status_persetujuan == 'pending')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border bg-orange-50 text-orange-600 border-orange-200 text-[9px] font-black uppercase tracking-wider shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-orange-400 animate-pulse"></span>
                                            Menunggu Review
                                        </span>
                                    @elseif ($silabus->status_persetujuan == 'revisi')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border bg-rose-50 text-rose-600 border-rose-200 text-[9px] font-black uppercase tracking-wider shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                            Perlu Revisi
                                        </span>
                                    @elseif ($silabus->status_persetujuan == 'disetujui')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border bg-emerald-50 text-emerald-700 border-emerald-200 text-[9px] font-black uppercase tracking-wider shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Disetujui
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border bg-gray-50 text-gray-600 border-gray-200 text-[9px] font-black uppercase tracking-wider shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span>
                                            Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    {{-- Sesuaikan route ini jika halaman Show sudah dibuat (misal route('admin.silabus.show', $silabus->id)) --}}
                                    <a href="#" class="inline-flex items-center gap-2 border border-slate-200 hover:bg-blue-950 hover:border-blue-950 hover:text-white text-slate-600 font-black py-2 px-4 rounded-xl transition-all duration-200 text-[9px] uppercase tracking-widest group-hover:shadow-md">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        Tinjau
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-20 bg-slate-50/30">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-16 h-16 rounded-3xl bg-white shadow-sm border border-slate-100 flex items-center justify-center">
                                            <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <p class="text-sm font-bold text-slate-500 mt-2">Belum ada data kurikulum</p>
                                        <p class="text-xs text-slate-400">Sistem belum menerima pengajuan paket belajar dari tutor.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                {{-- Footer Tabel & Pagination --}}
                @if($silabusList->hasPages())
                <div class="px-6 py-4 bg-slate-50/80 border-t border-gray-100">
                    {{ $silabusList->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>