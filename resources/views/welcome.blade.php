@extends('layouts.main')

@section('title', 'Cari Tutor Les Privat Terbaik - tempatles.id')

@section('content')
    {{-- HERO SECTION --}}
    <main class="relative pt-20 pb-32 overflow-hidden flex-grow">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[60%] bg-blue-100/50 blur-[120px] rounded-full"></div>
            <div class="absolute bottom-[10%] right-[-5%] w-[30%] h-[50%] bg-orange-100/50 blur-[100px] rounded-full"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 border border-blue-100 rounded-full mb-8 animate-bounce">
                <span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span></span>
                <span class="text-[10px] font-black text-blue-600 uppercase tracking-[0.2em]">Platform Les Privat Terpercaya</span>
            </div>

            <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 leading-[1.1] tracking-tight mb-8">
                Cari Tutor Terbaik <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Tanpa Ribet Pasang Iklan</span>
            </h1>

            <p class="max-w-2xl mx-auto text-slate-500 text-lg md:text-xl leading-relaxed mb-12">
                Hubungkan bakat pengajar dengan antusiasme pelajar. Daftar gratis, fleksibel, dan tanpa potongan biaya admin atau iklan yang mahal.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-5 mb-20">
                <a href="{{ route('katalog.publik') }}" class="w-full sm:w-auto px-10 py-4 bg-orange-500 text-white rounded-2xl font-black uppercase tracking-widest text-sm hover:bg-orange-600 transition-all shadow-xl shadow-orange-500/30 transform hover:-translate-y-1">
                    Cari Tutor Sekarang
                </a>
                <a href="{{ route('register') }}?role=tutor" class="w-full sm:w-auto px-10 py-4 bg-transparent border-2 border-blue-950 text-blue-950 rounded-2xl font-black uppercase tracking-widest text-sm hover:bg-blue-950 hover:text-white transition-all transform hover:-translate-y-1">
                    Mulai Mengajar (Tutor)
                </a>
            </div>

            <div class="max-w-4xl mx-auto bg-white p-8 md:p-12 rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-slate-200/60 relative">
                <div class="absolute -top-6 left-1/2 -translate-x-1/2 w-12 h-12 bg-orange-500 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-orange-500/40">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" /></svg>
                </div>
                <p class="text-slate-600 text-lg md:text-xl italic leading-relaxed font-medium">
                    "tempatles.id adalah revolusi bimbingan belajar. Cocok untuk guru, mahasiswa, dan praktisi skill di seluruh Indonesia untuk menemukan peluang tanpa batas."
                </p>
                <div class="mt-6 flex flex-col items-center justify-center">
                    <p class="text-sm font-black text-slate-800 uppercase tracking-widest">- Dani, Founder tempatles.id</p>
                </div>
            </div>
        </div>
    </main>

    {{-- SECTION BIDANG LES --}}
    <section class="py-24 bg-[#f8f9fa] relative border-t border-slate-200">
        <div class="max-w-6xl mx-auto px-6 md:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-2xl md:text-3xl font-black text-blue-600 uppercase tracking-wide mb-4">Bidang Les Yang Dibutuhkan</h2>
                <p class="text-sm md:text-base text-slate-500 font-medium leading-relaxed">
                    Pilih kategori di bawah untuk menemukan tutor atau mulai mengajar.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 border-t border-l border-slate-200/80 bg-[#f8f9fa]">
                {{-- Akademik --}}
                <div class="group p-8 text-center border-r border-b border-slate-200/80 hover:bg-white transition-colors duration-300 flex flex-col h-full">
                    <div class="w-12 h-12 mx-auto text-blue-600 mb-6 group-hover:-translate-y-1 transition-transform">
                        <svg fill="currentColor" viewBox="0 0 24 24"><path d="M4 4a2 2 0 012-2h12a2 2 0 012 2v16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v16h12V4H6zm2 4h8v2H8V8zm0 4h8v2H8v-2z"/></svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-3">Akademik Sekolah</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium mb-6 flex-grow">Bimbingan belajar untuk SD, SMP, SMA. Pasar terbesar yang selalu dibutuhkan oleh orang tua murid.</p>
                    <a href="{{ route('katalog.publik', ['mapel' => 'Akademik']) }}" class="inline-flex items-center justify-center gap-1 text-sm font-bold text-blue-600 hover:text-blue-800">Eksplor Bidang &rarr;</a>
                </div>

                {{-- Mengaji --}}
                <div class="group p-8 text-center border-r border-b border-slate-200/80 hover:bg-white transition-colors duration-300 flex flex-col h-full">
                    <div class="w-12 h-12 mx-auto text-blue-600 mb-6 group-hover:-translate-y-1 transition-transform">
                        <svg fill="currentColor" viewBox="0 0 24 24"><path d="M21 4H3v16h18V4zm-2 14H5V6h14v12zm-8-2h6v-2h-6v2zm0-4h6V8h-6v4z"/></svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-3">Mengaji & Agama</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium mb-6 flex-grow">Kebutuhan pokok di Indonesia. Bimbingan baca tulis Al-Qur'an, tahsin, tajwid, dan ilmu agama.</p>
                    <a href="{{ route('katalog.publik', ['mapel' => 'Mengaji']) }}" class="inline-flex items-center justify-center gap-1 text-sm font-bold text-blue-600 hover:text-blue-800">Eksplor Bidang &rarr;</a>
                </div>

                {{-- Bahasa Inggris --}}
                <div class="group p-8 text-center border-r border-b border-slate-200/80 hover:bg-white transition-colors duration-300 flex flex-col h-full">
                    <div class="w-12 h-12 mx-auto text-blue-600 mb-6 group-hover:-translate-y-1 transition-transform">
                        <svg fill="currentColor" viewBox="0 0 24 24"><path d="M4 4a2 2 0 012-2h12a2 2 0 012 2v16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v16h12V4H6zm3.5 3h1L13 13h-1.5l-.6-1.8H8.1L7.5 13H6l3.5-6zm2.3 3.3l-1.3 3.7h2.6l-1.3-3.7zM14 15h4v-1.5h-2.5v-1h2v-1.5h-2v-1H18V8h-4v7z"/></svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-3">Bahasa Inggris</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium mb-6 flex-grow">Skill wajib untuk semua kalangan. Cocok untuk tutor TOEFL, IELTS, maupun Conversation praktis.</p>
                    <a href="{{ route('katalog.publik', ['mapel' => 'Inggris']) }}" class="inline-flex items-center justify-center gap-1 text-sm font-bold text-blue-600 hover:text-blue-800">Eksplor Bidang &rarr;</a>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION KEUNGGULAN --}}
    <section class="py-24 bg-white relative border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-6 md:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <p class="text-[10px] font-black text-blue-600 uppercase tracking-[0.25em] mb-2">Nilai Lebih</p>
                <h2 class="text-3xl md:text-4xl font-black text-blue-950 leading-tight">Belajar Lebih Nyaman, <br>Mengajar Lebih Cuan</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="bg-white rounded-3xl p-8 border-b-4 border-blue-600 shadow-xl shadow-slate-200/50 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-20 h-20 mx-auto bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mb-6"><svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
                    <h3 class="text-xl font-black text-slate-900 mb-4">0% Biaya Admin</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium">Kami tidak memotong komisi sepeserpun dari biaya les Anda. Tutor dibayar utuh.</p>
                </div>
                <div class="bg-white rounded-3xl p-8 border-b-4 border-emerald-500 shadow-xl shadow-slate-200/50 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-20 h-20 mx-auto bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center mb-6"><svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg></div>
                    <h3 class="text-xl font-black text-slate-900 mb-4">Tutor Terverifikasi</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium">Kualitas adalah prioritas. Setiap tutor melalui seleksi untuk menjamin standar pengajaran.</p>
                </div>
                <div class="bg-white rounded-3xl p-8 border-b-4 border-orange-500 shadow-xl shadow-slate-200/50 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-20 h-20 mx-auto bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mb-6"><svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
                    <h3 class="text-xl font-black text-slate-900 mb-4">Jadwal Fleksibel</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium">Belajar kapan saja. Sesuaikan jadwal dengan kesibukan harianmu langsung dengan tutor.</p>
                </div>
            </div>
        </div>
    </section>
@endsection