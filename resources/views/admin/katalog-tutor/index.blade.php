<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pb-8"> {{-- Tambah pb-8 agar header lebih tinggi --}}
            <div>
                <p class="text-[10px] font-black text-orange-500 uppercase tracking-[0.25em] mb-1">Manajemen Tutor</p>
                <h2 class="font-black text-2xl text-slate-900 leading-tight tracking-tight">
                    Katalog Pengajar Aktif
                </h2>
                <p class="text-sm text-slate-400 font-medium mt-0.5">Cari dan rekomendasikan tutor terbaik untuk murid.</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 md:px-8">
        <div class="sticky top-[73px] z-50 -mt-10 mb-10">
            {{-- Search & Multi-Criteria Filter (DIKASIH BORDER ORANYE & NAIK KE ATAS) --}}
            <div class="bg-white p-6 rounded-2xl border-2 border-orange-400 shadow-2xl -mt-12 relative z-50">
                <form action="{{ route('admin.katalog-tutor') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    
                    {{-- Filter Mapel --}}
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Mata Pelajaran</label>
                        <input type="text" name="mapel" value="{{ request('mapel') }}" placeholder="Contoh: Matematika" 
                            class="w-full bg-slate-50 border-none rounded-xl text-xs font-bold text-slate-700 focus:ring-2 focus:ring-blue-900 placeholder:font-normal">
                    </div>

                    {{-- Filter Kota --}}
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Domisili (Kota)</label>
                        <input type="text" name="kota" value="{{ request('kota') }}" placeholder="Contoh: Surabaya" 
                            class="w-full bg-slate-50 border-none rounded-xl text-xs font-bold text-slate-700 focus:ring-2 focus:ring-blue-900 placeholder:font-normal">
                    </div>

                    {{-- Filter Tingkat --}}
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Tingkat Siswa</label>
                        <select name="tingkat" class="w-full bg-slate-50 border-none rounded-xl text-xs font-bold text-slate-700 focus:ring-2 focus:ring-blue-900">
                            <option value="">Semua Tingkat</option>
                            <option value="SD" {{ request('tingkat') == 'SD' ? 'selected' : '' }}>SD</option>
                            <option value="SMP" {{ request('tingkat') == 'SMP' ? 'selected' : '' }}>SMP</option>
                            <option value="SMA" {{ request('tingkat') == 'SMA' ? 'selected' : '' }}>SMA</option>
                        </select>
                    </div>

                    {{-- Filter Metode --}}
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Metode Belajar</label>
                        <select name="metode" class="w-full bg-slate-50 border-none rounded-xl text-xs font-bold text-slate-700 focus:ring-2 focus:ring-blue-900">
                            <option value="">Semua Metode</option>
                            <option value="Offline (Datang ke Rumah)" {{ request('metode') == 'Offline (Datang ke Rumah)' ? 'selected' : '' }}>Offline</option>
                            <option value="Online (Zoom/Meet)" {{ request('metode') == 'Online (Zoom/Meet)' ? 'selected' : '' }}>Online</option>
                        </select>
                    </div>

                    {{-- Button --}}
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-blue-950 text-white py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-orange-500 transition-all shadow-lg">
                            Terapkan Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>
        

        {{-- Grid Katalog --}}
        <div class="mt-12 pb-12"> {{-- Kasih margin top agar tidak nempel ke card filter --}}
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($tutors as $tutor)
                    {{-- ... isi card tutor sama seperti sebelumnya ... --}}
                    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden group hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="p-5 pb-0 flex justify-between items-start">
                            <span class="bg-slate-100 text-slate-500 text-[9px] font-black px-2.5 py-1 rounded-lg uppercase">
                                ID: {{ str_pad($tutor->id, 4, '0', STR_PAD_LEFT) }}
                            </span>
                            <div class="flex gap-1">
                                @foreach($tutor->metode as $m)
                                    <span class="w-2 h-2 rounded-full {{ str_contains($m, 'Online') ? 'bg-blue-500' : 'bg-emerald-500' }}" title="{{ $m }}"></span>
                                @endforeach
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <div class="w-20 h-20 bg-slate-100 rounded-2xl mx-auto mb-4 flex items-center justify-center text-2xl font-black text-slate-300 overflow-hidden border-2 border-white shadow-sm">
                                {{ strtoupper(substr($tutor->user->name, 0, 1)) }}
                            </div>
                            <h3 class="font-black text-slate-800 text-sm leading-tight mb-1">{{ $tutor->user->name }}</h3>
                            <p class="text-[10px] font-bold text-orange-500 uppercase tracking-widest mb-3">{{ $tutor->bidang }}</p>
                            <div class="flex flex-wrap justify-center gap-1.5 mb-4">
                                @foreach($tutor->tingkat_siswa as $t)
                                    <span class="bg-blue-50 text-blue-700 text-[9px] font-black px-2 py-0.5 rounded-md">{{ $t }}</span>
                                @endforeach
                            </div>
                            <div class="pt-4 border-t border-slate-50 flex justify-between items-center">
                                <div class="text-left">
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">Tarif Sesi</p>
                                    <p class="text-xs font-black text-slate-800">Rp {{ number_format($tutor->tarif_per_sesi, 0, ',', '.') }}</p>
                                </div>
                                <a href="{{ route('admin.tutor.detail', $tutor->id) }}" class="p-2 bg-slate-950 text-white rounded-xl hover:bg-orange-500 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center text-slate-400 font-bold">
                        Belum ada tutor aktif saat ini.
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $tutors->links() }}
            </div>
        </div>
    </div>
</x-app-layout>