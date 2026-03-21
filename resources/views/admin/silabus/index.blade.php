{{-- resources/views/admin/silabus/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="pb-8">
            <p class="text-[10px] font-black text-orange-500 uppercase tracking-[0.25em] mb-1">Kendali Mutu Akademik</p>
            <h2 class="font-black text-2xl text-slate-900 leading-tight tracking-tight">
                Monitoring Silabus & Rencana Ajar
            </h2>
            <p class="text-sm text-slate-400 font-medium mt-0.5">Tinjau, setujui, atau minta revisi modul pembelajaran dari tutor.</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-6 md:px-12 space-y-8">
            {{-- Stats Cards (Angka sekarang dinamis) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                {{-- Menunggu Review --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center gap-5">
                    <div class="w-14 h-14 rounded-full bg-orange-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Menunggu Review</p>
                        <p class="text-3xl font-black text-slate-800 mt-1">{{ $countPending }}</p>
                    </div>
                </div>

                {{-- Perlu Revisi --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center gap-5">
                    <div class="w-14 h-14 rounded-full bg-rose-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Perlu Revisi</p>
                        <p class="text-3xl font-black text-slate-800 mt-1">{{ $countRevisi }}</p>
                    </div>
                </div>

                {{-- Disetujui --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center gap-5">
                    <div class="w-14 h-14 rounded-full bg-emerald-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Disetujui</p>
                        <p class="text-3xl font-black text-slate-800 mt-1">{{ $countDisetujui }}</p>
                    </div>
                </div>
            </div>

            {{-- Filter & Search Form --}}
            <form method="GET" action="{{ route('admin.silabus') }}" class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-2 w-full md:w-auto">
                    <select name="status" onchange="this.form.submit()" class="bg-slate-50 border-none rounded-xl text-xs font-bold text-slate-700 focus:ring-2 focus:ring-blue-900 px-4 py-2.5 w-full md:w-48">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Review</option>
                        <option value="revisi" {{ request('status') == 'revisi' ? 'selected' : '' }}>Perlu Revisi</option>
                        <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    </select>
                </div>
                <div class="relative w-full md:w-72">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama tutor atau mapel..." 
                        class="w-full bg-slate-50 border-none rounded-xl text-xs font-bold text-slate-700 focus:ring-2 focus:ring-blue-900 pl-10 pr-4 py-2.5 placeholder:font-normal">
                    <button type="submit" class="absolute left-3.5 top-3">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </button>
                </div>
            </form>

            {{-- Tabel Silabus --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="bg-slate-50 text-slate-400 uppercase text-[9px] tracking-[0.18em] font-black border-b border-gray-100">
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
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-blue-950 flex items-center justify-center text-white font-black text-sm uppercase">
                                            {{ substr($silabus->tutor->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-sm">{{ $silabus->tutor->name }}</p>
                                            <p class="text-[10px] text-slate-400 font-mono mt-0.5">Tutor ID: {{ $silabus->tutor_id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-bold text-slate-800 text-xs">{{ $silabus->mata_pelajaran }}</p>
                                    <span class="inline-block mt-1 bg-blue-50 text-blue-700 text-[9px] font-black px-2 py-0.5 rounded-md">{{ $silabus->tingkat_siswa }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-xs font-semibold text-slate-700">{{ $silabus->judul_kurikulum }}</p>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">{{ $silabus->jumlah_pertemuan }} Pertemuan</p>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if ($silabus->status_persetujuan == 'pending')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border bg-orange-50 text-orange-600 border-orange-200 text-[9px] font-black uppercase tracking-wider">
                                            <span class="w-1.5 h-1.5 rounded-full bg-orange-400 animate-pulse"></span>
                                            Menunggu Review
                                        </span>
                                    @elseif ($silabus->status_persetujuan == 'revisi')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border bg-rose-50 text-rose-600 border-rose-200 text-[9px] font-black uppercase tracking-wider">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                            Perlu Revisi
                                        </span>
                                    @elseif ($silabus->status_persetujuan == 'disetujui')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border bg-emerald-50 text-emerald-700 border-emerald-200 text-[9px] font-black uppercase tracking-wider">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Disetujui
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border bg-gray-50 text-gray-600 border-gray-200 text-[9px] font-black uppercase tracking-wider">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span>
                                            Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="#" class="inline-flex items-center gap-2 border border-blue-950/20 hover:bg-blue-950 hover:text-white text-blue-950 font-black py-2 px-4 rounded-xl transition-all duration-200 text-[9px] uppercase tracking-widest">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        Tinjau
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-slate-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                        <p class="text-sm font-bold text-slate-500">Belum ada data kurikulum</p>
                                        <p class="text-xs text-slate-400 mt-1">Sistem belum menerima pengajuan paket belajar dari tutor.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                {{-- Footer Tabel & Pagination --}}
                <div class="px-6 py-4 border-t border-gray-100 bg-slate-50 flex justify-between items-center">
                    <div class="w-full">
                        {{ $silabusList->links() }}
                    </div>
                </div>
            </div>

        </div>
        
        

    </div>
</x-app-layout>