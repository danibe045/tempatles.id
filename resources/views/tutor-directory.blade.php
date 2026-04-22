@extends('layouts.main')

@section('title', 'Katalog Tutor - tempatles.id')

@section('content')
    {{-- HEADER & SEARCH BAR --}}
    <div class="bg-blue-950 pt-16 pb-32 relative overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10">
            <div class="absolute top-[-10%] left-[10%] w-[30%] h-[60%] bg-blue-600/30 blur-[100px] rounded-full"></div>
            <div class="absolute bottom-[10%] right-[10%] w-[20%] h-[50%] bg-orange-500/20 blur-[80px] rounded-full"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 text-center relative z-10">
            <h1 class="text-3xl md:text-5xl font-black text-white tracking-tight mb-4">Temukan Tutor Idealmu</h1>
            <p class="text-blue-200/80 font-medium text-lg max-w-2xl mx-auto mb-10">Pilih dari puluhan tutor terverifikasi yang siap membantumu meraih target belajar di kotamu.</p>

            {{-- Form Pencarian --}}
            <form action="{{ route('katalog.publik') }}" method="GET" class="max-w-4xl mx-auto bg-white p-3 rounded-3xl shadow-2xl flex flex-col md:flex-row gap-3">
                <div class="flex-1 relative flex items-center bg-slate-50 rounded-2xl border border-slate-100 hover:border-blue-300 focus-within:border-blue-500 focus-within:bg-white transition-all">
                    <svg class="w-5 h-5 text-slate-400 absolute left-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    <input type="text" name="mapel" value="{{ request('mapel') }}" placeholder="Mata Pelajaran (Contoh: Matematika)" class="w-full bg-transparent border-none text-sm font-bold text-slate-800 focus:ring-0 pl-12 pr-4 py-4 placeholder:font-medium placeholder:text-slate-400">
                </div>
                
                <div class="flex-1 relative flex items-center bg-slate-50 rounded-2xl border border-slate-100 hover:border-blue-300 focus-within:border-blue-500 focus-within:bg-white transition-all">
                    <svg class="w-5 h-5 text-slate-400 absolute left-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <input type="text" name="lokasi" value="{{ request('lokasi') }}" placeholder="Lokasi Kecamatan / Kota" class="w-full bg-transparent border-none text-sm font-bold text-slate-800 focus:ring-0 pl-12 pr-4 py-4 placeholder:font-medium placeholder:text-slate-400">
                </div>

                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all md:w-auto w-full shadow-lg shadow-orange-500/30">
                    Cari Tutor
                </button>
            </form>
        </div>
    </div>

    {{-- KATALOG TUTOR GRID --}}
    <main class="flex-grow max-w-7xl mx-auto px-6 md:px-8 w-full -mt-16 mb-24 relative z-20">
        
        {{-- Pesan Hasil Pencarian --}}
        @if(request('mapel') || request('lokasi'))
        <div class="bg-white px-6 py-4 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between mb-8">
            <p class="text-sm font-medium text-slate-600">
                Menampilkan hasil untuk: 
                @if(request('mapel')) <span class="font-black text-blue-950 bg-blue-50 px-3 py-1 rounded-lg ml-1">{{ request('mapel') }}</span> @endif
                @if(request('lokasi')) <span class="font-black text-blue-950 bg-blue-50 px-3 py-1 rounded-lg ml-1">📍 {{ request('lokasi') }}</span> @endif
            </p>
            <a href="{{ route('katalog.publik') }}" class="text-xs font-black text-rose-500 hover:text-rose-600 uppercase tracking-widest">Hapus Filter</a>
        </div>
        @endif

        @if(isset($tutors) && $tutors->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($tutors as $tutor)
                    @php
                        // FIX SUPER AMAN: Deteksi apakah datanya Array atau String Lama
                        $tingkatRaw = $tutor->tingkat_siswa;
                        $tingkatStr = is_array($tingkatRaw) ? implode(', ', $tingkatRaw) : ($tingkatRaw ?: '-');

                        $metodeRaw = $tutor->metode;
                        $metodeStr = is_array($metodeRaw) ? implode(', ', $metodeRaw) : ($metodeRaw ?: '-');
                    @endphp

                    {{-- Tutor Card --}}
                    <div class="bg-white rounded-[2rem] border border-slate-200 p-6 shadow-xl shadow-slate-200/40 hover:-translate-y-2 transition-transform duration-300 flex flex-col h-full">
                        
                        {{-- Header Card: Inisial & Nama --}}
                        <div class="flex items-start gap-4 mb-6">
                            <div class="w-16 h-16 shrink-0 bg-blue-50 border border-blue-100 text-blue-600 rounded-2xl flex items-center justify-center font-black text-2xl shadow-sm overflow-hidden">
                                @if($tutor->foto)
                                    <img src="{{ asset('storage/'.$tutor->foto) }}" alt="{{ $tutor->user->name }}" class="w-full h-full object-cover">
                                @else
                                    {{ substr($tutor->user->name, 0, 1) }}
                                @endif
                            </div>
                            <div>
                                <h3 class="text-lg font-black text-slate-900 leading-tight">{{ $tutor->user->name }}</h3>
                                <p class="text-xs font-bold text-blue-600 uppercase tracking-widest mt-1">{{ $tutor->bidang }}</p>
                            </div>
                        </div>

                        {{-- Info Details --}}
                        <div class="space-y-4 mb-8 flex-grow">
                            {{-- Area --}}
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Area Mengajar</p>
                                    <p class="text-sm font-bold text-slate-700">{{ $tutor->area ?: 'Seluruh Area (Online)' }}</p>
                                </div>
                            </div>
                            
                            {{-- Tingkat --}}
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tingkat Siswa</p>
                                    <p class="text-sm font-bold text-slate-700">{{ $tingkatStr }}</p>
                                </div>
                            </div>

                            {{-- Metode --}}
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Metode Belajar</p>
                                    <div class="flex flex-wrap gap-2 mt-1">
                                        {{-- Pecah manual kalau data lamanya string dipisah koma --}}
                                        @php
                                            $metodeArray = is_array($tutor->metode) ? $tutor->metode : (is_string($tutor->metode) ? explode(',', $tutor->metode) : []);
                                        @endphp
                                        @forelse($metodeArray as $metode)
                                            @if(trim($metode) && trim($metode) !== '-')
                                                <span class="bg-slate-100 text-slate-600 border border-slate-200 text-[10px] font-black px-2 py-1 rounded-md uppercase">{{ trim($metode) }}</span>
                                            @endif
                                        @empty
                                            <span class="text-xs font-bold text-slate-400">-</span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tombol CTA --}}
                        <div class="mt-auto pt-6 border-t border-slate-100">
                            @auth
                                <a href="{{ route('katalog.detail', $tutor->id) }}" class="flex items-center justify-center w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-3.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-md">
                                    Lihat & Pesan Tutor
                                </a>
                            @else
                                <a href="{{ route('register') }}?role=murid" class="flex items-center justify-center w-full bg-slate-50 hover:bg-blue-950 text-blue-600 hover:text-white px-6 py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all group">
                                    Daftar & Pesan Tutor 
                                    <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if(method_exists($tutors, 'links'))
                <div class="mt-12">
                    {{ $tutors->links() }}
                </div>
            @endif

        @else
            {{-- Empty State --}}
            <div class="bg-white rounded-[2.5rem] border border-slate-200 p-12 text-center max-w-2xl mx-auto shadow-sm">
                <div class="w-24 h-24 mx-auto bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-2xl font-black text-slate-900 mb-2">Tutor Tidak Ditemukan</h3>
                <p class="text-slate-500 font-medium mb-8 text-sm leading-relaxed">
                    Maaf, kami belum menemukan tutor yang cocok dengan kata kunci atau lokasi tersebut. Coba gunakan kata kunci yang lebih umum.
                </p>
                <a href="{{ route('katalog.publik') }}" class="inline-block bg-blue-950 hover:bg-blue-800 text-white px-8 py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg shadow-blue-900/20">
                    Tampilkan Semua Tutor
                </a>
            </div>
        @endif

    </main>
@endsection