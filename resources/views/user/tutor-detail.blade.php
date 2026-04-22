@extends('layouts.main')

@section('title', 'Detail Tutor & Pemesanan - tempatles.id')

@section('content')
    <div class="bg-slate-50 flex-grow pt-8 pb-24">
        <div class="max-w-7xl mx-auto px-6 md:px-8">
            
            {{-- Tombol Kembali --}}
            <a href="{{ route('katalog.publik') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 text-xs font-bold text-slate-500 rounded-xl hover:bg-slate-100 hover:text-blue-600 transition-colors shadow-sm mb-8">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Katalog
            </a>

            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 p-4 rounded-2xl mb-8 font-bold text-sm flex items-center gap-3 shadow-sm">
                    <svg class="w-6 h-6 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            @php
                // Logika deteksi Array atau String untuk data profil
                $tingkatArray = is_array($tutor->tingkat_siswa) ? $tutor->tingkat_siswa : (is_string($tutor->tingkat_siswa) ? array_map('trim', explode(',', $tutor->tingkat_siswa)) : []);
                $metodeArray = is_array($tutor->metode) ? $tutor->metode : (is_string($tutor->metode) ? array_map('trim', explode(',', $tutor->metode)) : []);
                $hariArray = is_array($tutor->hari) ? $tutor->hari : (is_string($tutor->hari) ? array_map('trim', explode(',', $tutor->hari)) : []);
                $jamArray = is_array($tutor->jam) ? $tutor->jam : (is_string($tutor->jam) ? array_map('trim', explode(',', $tutor->jam)) : []);
            @endphp

            <div class="flex flex-col lg:flex-row gap-8 items-start">
                
                {{-- KOLOM KIRI: PROFIL TUTOR --}}
                <div class="w-full lg:w-3/5 space-y-6">
                    
                    {{-- Card Profil Utama --}}
                    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden relative">
                        {{-- Cover Background --}}
                        <div class="h-32 w-full bg-gradient-to-r from-blue-900 via-blue-800 to-blue-600 relative">
                            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                        </div>
                        
                        <div class="px-8 pb-8 relative">
                            {{-- Foto & Nama --}}
                            <div class="flex flex-col sm:flex-row gap-5 items-start sm:items-end -mt-12 sm:-mt-16 mb-6">
                                <div class="w-28 h-28 sm:w-36 sm:h-36 shrink-0 bg-white border-4 border-white shadow-lg text-blue-600 rounded-[1.5rem] flex items-center justify-center font-black text-4xl sm:text-5xl overflow-hidden relative z-10">
                                    @if($tutor->foto)
                                        <img src="{{ asset('storage/'.$tutor->foto) }}" alt="{{ $tutor->user->name }}" class="w-full h-full object-cover">
                                    @else
                                        {{ strtoupper(substr($tutor->user->name, 0, 1)) }}
                                    @endif
                                </div>
                                <div class="pb-1">
                                    <div class="flex flex-wrap items-center gap-2 mb-2">
                                        <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 border border-emerald-100 rounded-lg text-[10px] font-black text-emerald-600 uppercase tracking-widest">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            Terverifikasi
                                        </div>
                                        @if($tutor->pengalaman)
                                            <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-50 border border-amber-100 rounded-lg text-[10px] font-black text-amber-600 uppercase tracking-widest">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                Pengalaman {{ $tutor->pengalaman }}
                                            </div>
                                        @endif
                                    </div>
                                    <h1 class="text-3xl font-black text-slate-900 leading-tight flex items-center gap-3">
                                        {{ $tutor->user->name }}
                                        @if($tutor->jenis_kelamin == 'Laki-laki')
                                            <span class="bg-blue-100 text-blue-600 p-1 rounded-md" title="Laki-laki">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            </span>
                                        @elseif($tutor->jenis_kelamin == 'Perempuan')
                                            <span class="bg-rose-100 text-rose-500 p-1 rounded-md" title="Perempuan">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            </span>
                                        @endif
                                    </h1>
                                    <p class="text-sm font-bold text-slate-500 mt-1">{{ $tutor->bidang ?? 'Pengajar' }} • {{ $tutor->area ?? 'Online' }}</p>
                                </div>
                            </div>

                            {{-- Pendidikan --}}
                            <div class="bg-slate-50 border border-slate-100 rounded-2xl p-5 mb-8">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                                    Pendidikan Terakhir
                                </p>
                                <p class="text-sm font-bold text-slate-800">{{ $tutor->pendidikan_terakhir ?? '-' }} @if($tutor->instansi) at {{ $tutor->instansi }} @endif</p>
                            </div>

                            {{-- Info Grid --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-6 border-t border-slate-100">
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Tingkat Siswa</p>
                                    <div class="flex flex-wrap gap-2">
                                        @forelse($tingkatArray as $tingkat)
                                            <span class="bg-blue-50 text-blue-700 border border-blue-100 px-3 py-1.5 rounded-lg text-xs font-bold">{{ $tingkat }}</span>
                                        @empty
                                            <span class="text-xs font-bold text-slate-400">-</span>
                                        @endforelse
                                    </div>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Metode Belajar</p>
                                    <div class="flex flex-wrap gap-2">
                                        @forelse($metodeArray as $metode)
                                            <span class="bg-purple-50 text-purple-700 border border-purple-100 px-3 py-1.5 rounded-lg text-xs font-bold uppercase">{{ $metode }}</span>
                                        @empty
                                            <span class="text-xs font-bold text-slate-400">-</span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                            {{-- Jadwal --}}
                            <div class="mt-8 pt-8 border-t border-slate-100">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Ketersediaan Jadwal</p>
                                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5 flex flex-col md:flex-row gap-6">
                                    <div class="flex-1">
                                        <p class="text-xs font-bold text-slate-500 mb-2">Hari:</p>
                                        <div class="flex flex-wrap gap-2">
                                            @forelse($hariArray as $hari)
                                                <span class="bg-white border border-slate-200 text-slate-700 px-3 py-1.5 rounded-lg text-xs font-bold">{{ $hari }}</span>
                                            @empty
                                                <span class="text-xs text-slate-400">Belum diatur</span>
                                            @endforelse
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-xs font-bold text-slate-500 mb-2">Waktu:</p>
                                        <div class="flex flex-wrap gap-2">
                                            @forelse($jamArray as $jam)
                                                <span class="bg-white border border-slate-200 text-slate-700 px-3 py-1.5 rounded-lg text-xs font-bold">{{ $jam }}</span>
                                            @empty
                                                <span class="text-xs text-slate-400">Belum diatur</span>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="bg-white rounded-[2rem] border border-slate-200 p-8 shadow-sm">
                        <h2 class="text-lg font-black text-blue-950 mb-4">Tentang Pengajar</h2>
                        <div class="prose prose-sm prose-slate text-slate-600 font-medium leading-relaxed bg-slate-50 p-6 rounded-2xl border border-slate-100">
                            {!! nl2br(e($tutor->deskripsi ?? 'Belum ada deskripsi profil.')) !!}
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: ETALASE PAKET (SESUAI DATABASE MAS DANI) --}}
                <div class="w-full lg:w-2/5 lg:sticky lg:top-24">
                    <form action="{{ route('katalog.pesan', $tutor->id) }}" method="POST" class="bg-white rounded-[2rem] border border-slate-200 p-8 shadow-xl shadow-slate-200/50">
                        @csrf
                        <div class="mb-6 border-b border-slate-100 pb-6">
                            <h2 class="text-2xl font-black text-blue-950">Paket & Layanan</h2>
                            <p class="text-xs font-medium text-slate-500 mt-1">Pilih paket les yang sesuai dengan kebutuhanmu.</p>
                        </div>

                        <div class="mb-8">
                            @if(isset($tutor->packages) && $tutor->packages->count() > 0)
                                <div class="space-y-4">
                                    @foreach($tutor->packages as $index => $paket)
                                    <label class="relative flex flex-col p-6 cursor-pointer rounded-[1.5rem] border-2 border-slate-100 hover:border-blue-300 transition-all has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50/40 bg-white shadow-sm group">
                                        <input type="radio" name="package_id" value="{{ $paket->id }}" class="sr-only peer" {{ $index == 0 ? 'checked' : '' }} required>
                                        
                                        <div class="flex justify-between items-start mb-4">
                                            <div>
                                                {{-- MENGGUNAKAN NAMA_MAPEL & JENJANG SESUAI SCREENSHOT DB --}}
                                                <h3 class="text-lg font-black text-slate-900 peer-checked:text-blue-900 leading-tight mb-1 uppercase">
                                                    {{ $paket->nama_mapel ?: 'PAKET LES' }} - {{ $paket->jenjang ?: 'UMUM' }}
                                                </h3>
                                            </div>
                                            <div class="text-right shrink-0 pl-4">
                                                {{-- MENGGUNAKAN HARGA_NETT SESUAI SCREENSHOT DB --}}
                                                <p class="text-xl font-black text-blue-600">Rp {{ number_format($paket->harga_nett ?? 0, 0, ',', '.') }}</p>
                                            </div>
                                        </div>

                                        <div class="h-px w-full bg-slate-100 mb-4"></div>

                                        <div class="grid grid-cols-2 gap-y-3">
                                            <div class="flex items-center gap-2">
                                                <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                </div>
                                                <span class="text-xs font-bold text-slate-700">{{ $paket->jumlah_sesi ?? 1 }}x Sesi</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                                </div>
                                                <span class="text-[10px] font-black text-slate-700 uppercase">{{ $paket->metode ?: 'Online/Offline' }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="absolute -right-3 -top-3 hidden group-has-[:checked]:flex bg-blue-600 text-white rounded-full w-8 h-8 border-4 border-white shadow-md items-center justify-center">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="4" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            @else
                                <div class="bg-rose-50 border border-rose-200 text-rose-700 p-6 rounded-xl text-sm font-bold text-center">
                                    Tutor belum mengatur paket harga.
                                </div>
                            @endif
                        </div>

                        {{-- Form Input --}}
                        <div class="bg-slate-50 border border-slate-100 p-5 rounded-2xl mb-6">
                            <div class="mb-4">
                                <label class="block text-xs font-bold text-slate-700 mb-2">Request Jadwal <span class="text-rose-500">*</span></label>
                                <input type="text" name="jadwal_request" placeholder="Contoh: Senin Jam 15:00" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 transition-all shadow-sm" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-2">Alamat / Catatan</label>
                                <textarea name="catatan" rows="2" placeholder="Tuliskan alamat (jika tatap muka)..." class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 transition-all shadow-sm"></textarea>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white px-6 py-4 rounded-2xl text-sm font-black uppercase tracking-widest transition-all shadow-lg shadow-orange-500/30 transform hover:-translate-y-1">
                            Pesan Sekarang
                        </button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
@endsection