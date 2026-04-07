<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pt-6 pb-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.katalog-tutor') }}" class="flex items-center justify-center w-10 h-10 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm group">
                    <svg class="w-5 h-5 text-slate-500 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <div>
                    <p class="text-[10px] font-black text-orange-500 uppercase tracking-[0.25em] mb-1">Manajemen Tutor</p>
                    <h2 class="font-black text-2xl text-slate-900 leading-tight tracking-tight">
                        Detail Profil Pengajar
                    </h2>
                </div>
            </div>
            
            {{-- Tombol Aksi Tambahan --}}
            <div class="flex gap-3">
                <a href="{{ route('admin.tutor.edit', $tutor->id) }}" class="bg-blue-950 border border-blue-900 text-slate-100 px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-orange-500 transition-all shadow-sm">
                    Edit Data Tutor
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 md:px-8 pt-4 pb-32 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            {{-- ========================================= --}}
            {{-- KOLOM KIRI: Profil & Kontak (Sticky) --}}
            {{-- ========================================= --}}
            <div class="lg:col-span-1 space-y-6 lg:sticky lg:top-24">
                
                {{-- KARTU 1: IDENTITAS UTAMA (Dengan Cover Banner) --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    {{-- Cover Background --}}
                    <div class="h-24 bg-gradient-to-r from-blue-950 to-blue-800 relative">
                        <div class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm px-3 py-1 rounded-md border border-white/30">
                            <p class="text-[9px] font-black text-white uppercase tracking-widest">ID: {{ str_pad($tutor->id, 4, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>
                    
                    <div class="px-6 pb-6 text-center relative">
                        {{-- Avatar Melayang --}}
                        <div class="w-24 h-24 mx-auto -mt-12 mb-4 flex items-center justify-center text-3xl font-black text-blue-700 bg-slate-50 rounded-full border-4 border-white shadow-md">
                            {{ strtoupper(substr($tutor->user->name ?? 'T', 0, 1)) }}
                        </div>
                        
                        <h3 class="font-black text-lg text-slate-800 leading-tight mb-1">{{ $tutor->user->name ?? 'Nama Tidak Diketahui' }}</h3>
                        <p class="text-xs font-bold text-orange-500 uppercase tracking-widest mb-4">{{ $tutor->bidang ?? 'Umum' }}</p>
                        
                        <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg {{ $tutor->status_akun == 'aktif' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-amber-50 text-amber-700 border-amber-200' }} border">
                            <span class="w-2 h-2 rounded-full {{ $tutor->status_akun == 'aktif' ? 'bg-emerald-500' : 'bg-amber-500' }} animate-pulse"></span>
                            <span class="text-[10px] font-black uppercase tracking-wider">{{ $tutor->status_akun }}</span>
                        </div>

                        {{-- Info Kontak List --}}
                        <div class="mt-6 pt-6 border-t border-slate-100 flex flex-col gap-3 text-left">
                            <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl border border-slate-100">
                                <div class="p-2 bg-white rounded-lg shadow-sm text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <div class="overflow-hidden">
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Email Aktif</p>
                                    <p class="text-xs font-bold text-slate-700 truncate">{{ $tutor->user->email ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl border border-slate-100">
                                <div class="p-2 bg-white rounded-lg shadow-sm text-emerald-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">WhatsApp</p>
                                    <p class="text-xs font-bold text-slate-700">{{ $tutor->user->phone_number ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KARTU 2: BIODATA PERSONAL --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <div class="p-1.5 bg-orange-50 text-orange-500 rounded-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest">Biodata Personal</h4>
                    </div>
                    <div class="p-6 space-y-5">
                        <div class="flex items-start gap-3">
                            <svg class="w-4 h-4 text-slate-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Jenis Kelamin</p>
                                <p class="text-sm font-bold text-slate-800">{{ $tutor->jenis_kelamin ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-4 h-4 text-slate-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Tempat, Tgl Lahir</p>
                                <p class="text-sm font-bold text-slate-800">
                                    {{ $tutor->tempat_lahir ?? '-' }}, 
                                    {{ $tutor->tanggal_lahir ? \Carbon\Carbon::parse($tutor->tanggal_lahir)->translatedFormat('d M Y') : '-' }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-4 h-4 text-slate-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Alamat Domisili</p>
                                <p class="text-sm font-bold text-slate-800 leading-relaxed">{{ $tutor->alamat_domisili ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ========================================= --}}
            {{-- KOLOM KANAN: Data Profesional & Dokumen --}}
            {{-- ========================================= --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- KARTU 3: INFORMASI MENGAJAR --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
                    <div class="px-8 py-5 border-b border-slate-100 flex items-center gap-3">
                        <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <h4 class="text-sm font-black text-slate-800 uppercase tracking-widest">Informasi Mengajar</h4>
                    </div>
                    
                    {{-- Menggunakan gap-y-8 untuk jarak atas-bawah yang lega, dan gap-x-6 untuk jarak kiri-kanan --}}
                    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-6">
                        
                        {{-- Tingkat Siswa --}}
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Tingkat Siswa</p>
                            <div class="flex flex-wrap gap-2">
                                @php $tingkat = is_array($tutor->tingkat_siswa) ? $tutor->tingkat_siswa : json_decode($tutor->tingkat_siswa, true) ?? []; @endphp
                                @forelse($tingkat as $t)
                                    <span class="bg-blue-50 text-blue-700 border border-blue-100 text-[11px] font-bold px-3 py-1.5 rounded-lg shadow-sm">{{ $t }}</span>
                                @empty
                                    <span class="text-sm text-slate-500">-</span>
                                @endforelse
                            </div>
                        </div>

                        {{-- Metode Tersedia --}}
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Metode Tersedia</p>
                            <div class="flex flex-wrap gap-2">
                                @php $metodes = is_array($tutor->metode) ? $tutor->metode : json_decode($tutor->metode, true) ?? []; @endphp
                                @forelse($metodes as $m)
                                    <span class="bg-emerald-50 text-emerald-700 border border-emerald-100 text-[11px] font-bold px-3 py-1.5 rounded-lg shadow-sm">{{ $m }}</span>
                                @empty
                                    <span class="text-sm text-slate-500">-</span>
                                @endforelse
                            </div>
                        </div>
                        
                        {{-- Jadwal Hari --}}
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Jadwal Hari</p>
                            <div class="flex flex-wrap gap-2">
                                @php $haris = is_array($tutor->hari) ? $tutor->hari : json_decode($tutor->hari, true) ?? []; @endphp
                                @forelse($haris as $h)
                                    <span class="bg-slate-100 text-slate-600 border border-slate-200 text-[11px] font-bold px-3 py-1.5 rounded-lg shadow-sm">{{ $h }}</span>
                                @empty
                                    <span class="text-sm text-slate-500">-</span>
                                @endforelse
                            </div>
                        </div>

                        {{-- Waktu / Jam --}}
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Waktu / Jam</p>
                            <p class="text-sm font-black bg-slate-100 text-slate-800 mt-1.5 px-3 py-1.5 rounded-lg shadow-sm">{{ $tutor->jam ?? '-' }}</p>
                        </div>

                        {{-- Area Mengajar --}}
                        <div class="md:col-span-2 pt-6 border-t border-slate-100">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Area Mengajar (Cakupan Offline)</p>
                            <p class="text-sm font-bold text-slate-800">{{ $tutor->area ?? 'Hanya Menerima Kelas Online' }}</p>
                        </div>
                        
                        {{-- TARIF BANNER  --}}
                        <div class="md:col-span-2 p-5 bg-gradient-to-r from-blue-950 to-blue-900 rounded-xl shadow-md flex justify-between items-center mt-2">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-white/10 rounded-lg text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-blue-200 uppercase tracking-widest">Tarif Per Sesi</p>
                                    <p class="text-white text-xs opacity-80">Harga yang ditawarkan tutor</p>
                                </div>
                            </div>
                            <span class="text-2xl font-black text-white">Rp {{ number_format($tutor->tarif_per_sesi ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                {{-- KARTU 4: LATAR BELAKANG --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
                    <div class="px-8 py-5 border-b border-slate-100 flex items-center gap-3">
                        <div class="p-2 bg-emerald-50 text-emerald-600 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m0-6l-9-5m9 5l9-5"/></svg>
                        </div>
                        <h4 class="text-sm font-black text-slate-800 uppercase tracking-widest">Latar Belakang & Pendidikan</h4>
                    </div>
                    
                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Pendidikan Terakhir</p>
                                <p class="text-sm font-bold text-slate-800">{{ $tutor->pendidikan_terakhir ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Asal Kampus / Instansi</p>
                                <p class="text-sm font-bold text-slate-800">{{ $tutor->instansi ?? '-' }}</p>
                            </div>
                        </div>
                        
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Riwayat Pengalaman Mengajar</p>
                            <div class="p-5 bg-slate-50 rounded-xl border border-slate-100 text-sm text-slate-700 leading-relaxed font-medium">
                                {{ $tutor->pengalaman ?? 'Belum ada catatan pengalaman yang ditambahkan.' }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KARTU 5: SILABUS --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
                    <div class="px-8 py-5 border-b border-slate-100 flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-orange-50 text-orange-500 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <h4 class="text-sm font-black text-slate-800 uppercase tracking-widest">Dokumen Silabus</h4>
                        </div>
                        <a href="{{ route('admin.silabus') }}" class="text-[10px] font-bold text-blue-600 hover:text-orange-500 uppercase tracking-widest transition-colors flex items-center gap-1">
                            Kelola
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>

                    @php
                        $silabuses = \App\Models\Silabus::where('tutor_id', $tutor->user_id)->latest()->get();
                    @endphp

                    <div class="p-8 space-y-4">
                        @forelse($silabuses as $silabus)
                            <div class="p-4 border border-slate-200 rounded-xl hover:shadow-md transition-shadow flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 shrink-0 bg-red-50 text-red-500 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                    </div>
                                    <div>
                                        <h5 class="text-sm font-black text-slate-800">{{ $silabus->judul_kurikulum }}</h5>
                                        <p class="text-[10px] font-bold text-slate-500 mt-0.5 uppercase tracking-widest">{{ $silabus->mata_pelajaran }} • {{ $silabus->tingkat_siswa }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center gap-3 w-full sm:w-auto">
                                    <span class="px-2.5 py-1 text-[9px] font-black uppercase tracking-widest rounded-md border 
                                        {{ $silabus->status_persetujuan == 'disetujui' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 
                                           ($silabus->status_persetujuan == 'revisi' ? 'bg-rose-50 text-rose-700 border-rose-200' : 'bg-amber-50 text-amber-700 border-amber-200') }}">
                                        {{ $silabus->status_persetujuan }}
                                    </span>
                                    
                                    @if($silabus->file_panduan_path)
                                        <a href="{{ $silabus->file_panduan_path }}" target="_blank" class="px-4 py-2 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all">
                                            Buka Drive
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10 bg-slate-50 rounded-xl border border-dashed border-slate-300">
                                <svg class="w-8 h-8 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Belum ada silabus tersimpan</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>