<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tempatles.id - Dapatkan Layanan Les Tanpa Pasang Iklan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 antialiased overflow-x-hidden">

    {{-- NAVBAR --}}
    <nav class="sticky top-0 z-50 flex items-center justify-between px-6 md:px-12 py-4 bg-white/80 backdrop-blur-md border-b border-slate-100 shadow-sm">
        <div class="flex items-center gap-2">
            <a href="/" class="flex items-center gap-3 group">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-12 w-auto transition-transform group-hover:scale-105">
                <div class="hidden sm:block">
                    <span class="font-black text-blue-950 text-xl tracking-tight leading-none">tempatles</span>
                    <span class="font-black text-orange-500 text-xl tracking-tight leading-none">.id</span>
                </div>
            </a>
        </div>

        <div class="hidden lg:flex items-center space-x-10 text-[13px] font-bold uppercase tracking-widest text-slate-500">
            <a href="/" class="text-blue-600 border-b-2 border-blue-600 pb-1">Home</a>
            <a href="{{ route('layanan') }}" class="hover:text-blue-600 transition-colors">Layanan Kami</a>
            <a href="{{ route('tentang') }}" class="hover:text-blue-600 transition-colors">Tentang</a>
            <a href="{{ route('katalog.publik') }}" class="hover:text-blue-600 transition-colors">Cari Tutor</a>
        </div>

        <div>
            @auth
                <a href="{{ url('/dashboard') }}" class="bg-blue-950 text-white px-7 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-orange-500 transition-all shadow-lg shadow-blue-950/20">Dashboard</a>
            @else
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="text-xs font-black uppercase tracking-widest text-slate-600 hover:text-blue-600 transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-blue-950 text-white px-7 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-orange-500 transition-all shadow-lg shadow-blue-950/20">Daftar Gratis</a>
                </div>
            @endauth
        </div>
    </nav>

    {{-- HERO SECTION --}}
    <main class="relative pt-20 pb-32 overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[60%] bg-blue-100/50 blur-[120px] rounded-full"></div>
            <div class="absolute bottom-[10%] right-[-5%] w-[30%] h-[50%] bg-orange-100/50 blur-[100px] rounded-full"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 border border-blue-100 rounded-full mb-8 animate-bounce">
                <span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span></span>
                <span class="text-[10px] font-black text-blue-600 uppercase tracking-[0.2em]">Platform Les Private</span>
            </div>

            <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 leading-[1.1] tracking-tight mb-8">
                Cari Tutor Terbaik <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Tanpa Ribet Pasang Iklan</span>
            </h1>

            <p class="max-w-2xl mx-auto text-slate-500 text-lg md:text-xl leading-relaxed mb-12">
                Hubungkan bakat pengajar dengan antusiasme pelajar. Daftar gratis, fleksibel, dan tanpa potongan biaya iklan yang mahal.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-5 mb-20">
                <a href="{{ route('katalog.publik') }}" class="group relative w-full sm:w-auto px-10 py-5 bg-white border-2 border-blue-600 text-blue-600 rounded-2xl font-black uppercase tracking-widest text-sm hover:bg-blue-600 hover:text-white transition-all shadow-xl shadow-blue-100 overflow-hidden">
                    <span class="relative z-10">Lihat Katalog Tutor</span>
                </a>
                <a href="{{ route('register') }}?role=tutor" class="w-full sm:w-auto px-10 py-5 bg-blue-950 text-white rounded-2xl font-black uppercase tracking-widest text-sm hover:bg-orange-500 transition-all shadow-xl shadow-blue-900/20 transform hover:-translate-y-1">
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
                <div class="mt-8 flex items-center justify-center gap-4">
                    <div class="h-px w-8 bg-slate-200"></div><span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Misi Kami</span><div class="h-px w-8 bg-slate-200"></div>
                </div>
            </div>

            <div class="mt-16">
                <a href="https://wa.me/6285859222500" target="_blank" class="inline-flex items-center gap-3 px-8 py-4 bg-emerald-500 text-white rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-emerald-600 transition-all shadow-lg shadow-emerald-500/30 group">
                    <svg class="w-5 h-5 transition-transform group-hover:rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.414 0 0 5.414 0 12.05c0 2.123.553 4.197 1.603 6.013L0 24l6.135-1.611a11.79 11.79 0 005.911 1.586h.005c6.632 0 12.045-5.413 12.045-12.051 0-3.21-1.248-6.227-3.511-8.491z" /></svg>
                    Tanya via WhatsApp
                </a>
            </div>
        </div>
    </main>

    {{-- ========================================== --}}
    {{-- SECTION BIDANG LES (NEUTRAL UNTUK MURID & TUTOR) --}}
    {{-- ========================================== --}}
    <section class="py-24 bg-[#f8f9fa] relative border-t border-slate-200">
        <div class="max-w-6xl mx-auto px-6 md:px-8">
            
            {{-- Header Judul --}}
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-2xl md:text-3xl font-black text-blue-600 uppercase tracking-wide mb-4">Bidang Les Yang Dibutuhkan</h2>
                <p class="text-sm md:text-base text-slate-500 font-medium leading-relaxed">
                    Apapun yang ingin kamu pelajari atau ajarkan, kami punya tempatnya.<br class="hidden md:block">
                    Pilih kategori di bawah untuk menemukan tutor atau mulai mengajar.
                </p>
            </div>

            {{-- Seamless Grid Container (3x3 = 9 Kotak) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 border-t border-l border-slate-200/80 bg-[#f8f9fa]">
                
                {{-- 1. Akademik (SD, SMP, SMA) --}}
                <div class="group p-8 text-center border-r border-b border-slate-200/80 hover:bg-white transition-colors duration-300 flex flex-col h-full">
                    <div class="w-12 h-12 mx-auto text-blue-600 mb-6 group-hover:-translate-y-1 transition-transform">
                        {{-- Icon Buku --}}
                        <svg fill="currentColor" viewBox="0 0 24 24"><path d="M4 4a2 2 0 012-2h12a2 2 0 012 2v16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v16h12V4H6zm2 4h8v2H8V8zm0 4h8v2H8v-2z"/></svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-3">Akademik Sekolah</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium mb-6 flex-grow">
                        Bimbingan belajar untuk SD, SMP, SMA. Pasar terbesar yang selalu dibutuhkan oleh orang tua murid.
                    </p>
                    <a href="{{ route('katalog.publik', ['mapel' => 'Akademik']) }}" class="inline-flex items-center justify-center gap-1 text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors">
                        Eksplor Bidang <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                {{-- 2. Mengaji & Agama --}}
                <div class="group p-8 text-center border-r border-b border-slate-200/80 hover:bg-white transition-colors duration-300 flex flex-col h-full">
                    <div class="w-12 h-12 mx-auto text-blue-600 mb-6 group-hover:-translate-y-1 transition-transform">
                        {{-- Icon Quran/Agama --}}
                        <svg fill="currentColor" viewBox="0 0 24 24"><path d="M21 4H3v16h18V4zm-2 14H5V6h14v12zm-8-2h6v-2h-6v2zm0-4h6V8h-6v4z"/></svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-3">Mengaji & Agama</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium mb-6 flex-grow">
                        Kebutuhan pokok di Indonesia. Bimbingan baca tulis Al-Qur'an, tahsin, tajwid, dan ilmu agama.
                    </p>
                    <a href="{{ route('katalog.publik', ['mapel' => 'Mengaji']) }}" class="inline-flex items-center justify-center gap-1 text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors">
                        Eksplor Bidang <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                {{-- 3. Bahasa Inggris --}}
                <div class="group p-8 text-center border-r border-b border-slate-200/80 hover:bg-white transition-colors duration-300 flex flex-col h-full">
                    <div class="w-12 h-12 mx-auto text-blue-600 mb-6 group-hover:-translate-y-1 transition-transform">
                        {{-- Icon A-Z --}}
                        <svg fill="currentColor" viewBox="0 0 24 24"><path d="M4 4a2 2 0 012-2h12a2 2 0 012 2v16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v16h12V4H6zm3.5 3h1L13 13h-1.5l-.6-1.8H8.1L7.5 13H6l3.5-6zm2.3 3.3l-1.3 3.7h2.6l-1.3-3.7zM14 15h4v-1.5h-2.5v-1h2v-1.5h-2v-1H18V8h-4v7z"/></svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-3">Bahasa Inggris</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium mb-6 flex-grow">
                        Skill wajib untuk semua kalangan. Cocok untuk tutor TOEFL, IELTS, maupun Conversation praktis.
                    </p>
                    <a href="{{ route('katalog.publik', ['mapel' => 'Inggris']) }}" class="inline-flex items-center justify-center gap-1 text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors">
                        Eksplor Bidang <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                {{-- 4. Matematika / Calistung --}}
                <div class="group p-8 text-center border-r border-b border-slate-200/80 hover:bg-white transition-colors duration-300 flex flex-col h-full">
                    <div class="w-12 h-12 mx-auto text-blue-600 mb-6 group-hover:-translate-y-1 transition-transform">
                        {{-- Icon Calculator / Plus Minus --}}
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-3">Matematika & Calistung</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium mb-6 flex-grow">
                        Spesifik untuk anak usia PAUD, TK, hingga SD awal. Melatih dasar logika dan baca tulis berhitung.
                    </p>
                    <a href="{{ route('katalog.publik', ['mapel' => 'Matematika']) }}" class="inline-flex items-center justify-center gap-1 text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors">
                        Eksplor Bidang <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                {{-- 5. Coding & Robotik --}}
                <div class="group p-8 text-center border-r border-b border-slate-200/80 hover:bg-white transition-colors duration-300 flex flex-col h-full">
                    <div class="w-12 h-12 mx-auto text-blue-600 mb-6 group-hover:-translate-y-1 transition-transform">
                        {{-- Icon Coding --}}
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-3">Coding & Robotik</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium mb-6 flex-grow">
                        Skill modern yang sedang tren dengan tarif mengajar yang lebih menjanjikan. Web, game, & aplikasi.
                    </p>
                    <a href="{{ route('katalog.publik', ['mapel' => 'Coding']) }}" class="inline-flex items-center justify-center gap-1 text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors">
                        Eksplor Bidang <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                {{-- 6. Musik (Gitar/Piano) --}}
                <div class="group p-8 text-center border-r border-b border-slate-200/80 hover:bg-white transition-colors duration-300 flex flex-col h-full">
                    <div class="w-12 h-12 mx-auto text-blue-600 mb-6 group-hover:-translate-y-1 transition-transform">
                        {{-- Icon Nada Musik --}}
                        <svg fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-3">Musik & Kesenian</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium mb-6 flex-grow">
                        Hobi populer dengan permintaan tinggi. Tersedia untuk tutor alat musik, olah vokal, dan seni rupa.
                    </p>
                    <a href="{{ route('katalog.publik', ['mapel' => 'Musik']) }}" class="inline-flex items-center justify-center gap-1 text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors">
                        Eksplor Bidang <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                {{-- 7. Persiapan Ujian --}}
                <div class="group p-8 text-center border-r border-b border-slate-200/80 hover:bg-white transition-colors duration-300 flex flex-col h-full">
                    <div class="w-12 h-12 mx-auto text-blue-600 mb-6 group-hover:-translate-y-1 transition-transform">
                        {{-- Icon Target/Ujian --}}
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-3">Persiapan Ujian</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium mb-6 flex-grow">
                        Bimbingan intensif musiman dengan volume tinggi untuk UTBK, CPNS, Kedinasan, & Ujian Mandiri.
                    </p>
                    <a href="{{ route('katalog.publik', ['mapel' => 'Ujian']) }}" class="inline-flex items-center justify-center gap-1 text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors">
                        Eksplor Bidang <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                {{-- 8. Bahasa Asing Lain --}}
                <div class="group p-8 text-center border-r border-b border-slate-200/80 hover:bg-white transition-colors duration-300 flex flex-col h-full">
                    <div class="w-12 h-12 mx-auto text-blue-600 mb-6 group-hover:-translate-y-1 transition-transform">
                        {{-- Icon Globe/Translate --}}
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-3">Bahasa Asing Lainnya</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium mb-6 flex-grow">
                        Segmentasi khusus untuk hobi dan persiapan kerja/studi ke luar negeri seperti Jepang, Mandarin, Arab, dll.
                    </p>
                    <a href="{{ route('katalog.publik', ['mapel' => 'Bahasa Asing']) }}" class="inline-flex items-center justify-center gap-1 text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors">
                        Eksplor Bidang <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                {{-- 9. Privat SEO --}}
                <div class="group p-8 text-center border-r border-b border-slate-200/80 hover:bg-white transition-colors duration-300 flex flex-col h-full">
                    <div class="w-12 h-12 mx-auto text-blue-600 mb-6 group-hover:-translate-y-1 transition-transform">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-3">Privat SEO</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium mb-6 flex-grow">
                        Pahami dasar optimasi mesin pencari hingga praktik menaikkan trafik website bisnis atau UMKM.
                    </p>
                    <a href="{{ route('katalog.publik', ['mapel' => 'SEO']) }}" class="inline-flex items-center justify-center gap-1 text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors">
                        Cari Tutor <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                {{-- 9. Bidang Lainnya (Pelengkap Grid) --}}
                <div class="group p-8 text-center border-r border-b border-slate-200/80 hover:bg-white transition-colors duration-300 flex flex-col h-full bg-blue-50/50 hover:bg-blue-50">
                    <div class="w-12 h-12 mx-auto text-blue-600 mb-6 group-hover:-translate-y-1 transition-transform">
                        {{-- Icon Kaca Pembesar/Cari --}}
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-3">Bidang Lainnya</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium mb-6 flex-grow">
                        Tidak menemukan yang kamu cari? Telusuri seluruh katalog kami untuk melihat ratusan tutor lainnya.
                    </p>
                    <a href="{{ route('katalog.publik') }}" class="inline-flex items-center justify-center gap-1 text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors">
                        Lihat Semua <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

            </div>
        </div>
    </section>

    {{-- ========================================== --}}
    {{-- SECTION KEUNGGULAN (UNTUK MURID) --}}
    {{-- ========================================== --}}
    <section class="py-24 bg-white relative border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-6 md:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <p class="text-[10px] font-black text-blue-600 uppercase tracking-[0.25em] mb-2">Nilai Lebih Untuk Murid</p>
                <h2 class="text-3xl md:text-4xl font-black text-blue-950 leading-tight">Belajar Lebih Nyaman, <br>Tanpa Beban Ekstra</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                {{-- Card 1: 0% Biaya Admin --}}
                <div class="bg-white rounded-3xl p-8 border-b-4 border-blue-600 shadow-xl shadow-slate-200/50 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-20 h-20 mx-auto bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-4">0% Biaya Admin</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium">Transaksi langsung antara murid dan tutor. Kami tidak memotong komisi sepeserpun dari biaya les Anda.</p>
                </div>

                {{-- Card 2: Tutor Terverifikasi --}}
                <div class="bg-white rounded-3xl p-8 border-b-4 border-emerald-500 shadow-xl shadow-slate-200/50 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-20 h-20 mx-auto bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-4">Tutor Terverifikasi</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium">Kualitas adalah prioritas. Setiap tutor melalui seleksi ketat dan wawancara untuk menjamin standar pengajaran.</p>
                </div>

                {{-- Card 3: Jadwal Fleksibel --}}
                <div class="bg-white rounded-3xl p-8 border-b-4 border-orange-500 shadow-xl shadow-slate-200/50 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-20 h-20 mx-auto bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-4">Jadwal Fleksibel</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium">Belajar kapan saja dan di mana saja. Sesuaikan jadwal les dengan kesibukan sekolah atau aktivitas harianmu.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================================== --}}
    {{-- SECTION KEUNGGULAN (UNTUK TUTOR) --}}
    {{-- ========================================== --}}
    <section class="py-24 bg-slate-50 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <p class="text-[10px] font-black text-orange-500 uppercase tracking-[0.25em] mb-2">Untuk Para Pengajar</p>
                <h2 class="text-3xl md:text-4xl font-black text-blue-950">Dapatkan Peluang Mengajar Tanpa Batas</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                {{-- Card 1: Daftar Gratis & Mudah --}}
                <div class="p-8 bg-white rounded-3xl border-b-4 border-blue-600 shadow-xl shadow-slate-200/50 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-20 h-20 mx-auto bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mb-6">
                        {{-- Ikon Dokumen Centang --}}
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-4 text-center">Daftar Gratis & Mudah</h3>
                    <p class="text-sm text-slate-500 font-medium leading-relaxed text-center">Daftar sebagai tutor gratis. Isi data dan bidang ajar, lalu kami bantu prosesnya sampai profilmu tayang.</p>
                </div>

                {{-- Card 2: Tanpa Pasang Iklan --}}
                <div class="p-8 bg-white rounded-3xl border-b-4 border-orange-500 shadow-xl shadow-slate-200/50 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-20 h-20 mx-auto bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mb-6">
                        {{-- Ikon Megaphone Coret --}}
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                            <line x1="3" y1="3" x2="21" y2="21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-4 text-center">Tanpa Pasang Iklan</h3>
                    <p class="text-sm text-slate-500 font-medium leading-relaxed text-center">Tidak perlu promosi sendiri ke banyak tempat. tempatles.id membantu mencarikan murid yang tepat untukmu.</p>
                </div>

                {{-- Card 3: Fleksibel Pilih Murid --}}
                <div class="p-8 bg-white rounded-3xl border-b-4 border-emerald-500 shadow-xl shadow-slate-200/50 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-20 h-20 mx-auto bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center mb-6">
                        {{-- Ikon User Group dengan Centang --}}
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 11l3 3L22 4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-4 text-center">Fleksibel Pilih Murid</h3>
                    <p class="text-sm text-slate-500 font-medium leading-relaxed text-center">Bebas memilih murid sesuai jadwal dan lokasi. Kamu bisa diskusi kebutuhan murid sebelum kelas dimulai.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================================== --}}
    {{-- SECTION CARA KERJA (ALUR MURID) --}}
    {{-- ========================================== --}}
    <section class="py-24 bg-blue-950 relative overflow-hidden">
        {{-- Hiasan Background --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-900 rounded-full blur-3xl opacity-50 -translate-y-1/2 translate-x-1/2"></div>
        
        <div class="max-w-7xl mx-auto px-6 md:px-8 relative z-10">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <p class="text-[10px] font-black text-orange-400 uppercase tracking-[0.25em] mb-2">Cara Kerja</p>
                <h2 class="text-3xl md:text-4xl font-black text-white leading-tight">3 Langkah Mudah <br>Mulai Belajar</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
                {{-- Step 1 --}}
                <div class="relative">
                    <div class="w-20 h-20 mx-auto bg-blue-900 border-4 border-blue-950 text-white font-black text-2xl rounded-full flex items-center justify-center mb-6 relative z-10 shadow-xl">1</div>
                    <h3 class="text-lg font-black text-white mb-2">Cari Tutor</h3>
                    <p class="text-sm text-blue-200/80 font-medium">Telusuri katalog publik kami dan temukan pengajar yang pas dengan lokasi dan kebutuhanmu.</p>
                    {{-- Garis Penghubung (Hanya Desktop) --}}
                    <div class="hidden md:block absolute top-10 left-[60%] w-full h-0.5 bg-blue-900/50 border-t-2 border-dashed border-blue-800"></div>
                </div>

                {{-- Step 2 --}}
                <div class="relative">
                    <div class="w-20 h-20 mx-auto bg-blue-600 border-4 border-blue-950 text-white font-black text-2xl rounded-full flex items-center justify-center mb-6 relative z-10 shadow-xl shadow-blue-600/30">2</div>
                    <h3 class="text-lg font-black text-white mb-2">Daftar & Hubungi</h3>
                    <p class="text-sm text-blue-200/80 font-medium">Buat akun gratismu, lalu hubungi tutor pilihanmu untuk menentukan jadwal dan materi.</p>
                    {{-- Garis Penghubung (Hanya Desktop) --}}
                    <div class="hidden md:block absolute top-10 left-[60%] w-full h-0.5 bg-blue-900/50 border-t-2 border-dashed border-blue-800"></div>
                </div>

                {{-- Step 3 --}}
                <div class="relative">
                    <div class="w-20 h-20 mx-auto bg-orange-500 border-4 border-blue-950 text-white font-black text-2xl rounded-full flex items-center justify-center mb-6 relative z-10 shadow-xl shadow-orange-500/30">3</div>
                    <h3 class="text-lg font-black text-white mb-2">Mulai Kelas</h3>
                    <p class="text-sm text-blue-200/80 font-medium">Tingkatkan prestasimu dengan bimbingan personal yang fokus pada target belajarmu.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================================== --}}
    {{-- FOOTER MENDETAIL (SESUAI DESAIN) --}}
    {{-- ========================================== --}}
    <footer class="bg-slate-50 pt-20">
        <div class="max-w-4xl mx-auto px-6 text-center">
            
            {{-- Logo --}}
            <a href="/" class="inline-block mb-6">
                <img src="{{ asset('img/logo.png') }}" alt="tempatles.id Logo" class="h-20 mx-auto transition-transform hover:scale-105">
            </a>

            {{-- Deskripsi --}}
            <p class="text-slate-500 text-sm md:text-base leading-relaxed mb-8 max-w-2xl mx-auto font-medium">
                Tempatles.id membantu tutor mendapatkan murid les tanpa perlu pasang iklan. Daftar gratis, fleksibel memilih murid, dan sistem kerja transparan untuk tutor di seluruh Indonesia.
            </p>

            {{-- Social Media Icons --}}
            <div class="flex items-center justify-center gap-4 mb-10">
                <a href="#" class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors duration-300">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                </a>
                <a href="#" class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors duration-300">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.951-7.252 4.105 0 7.287 2.931 7.287 6.839 0 4.084-2.583 7.373-6.175 7.373-1.2 0-2.328-.624-2.715-1.362l-.741 2.825c-.268 1.024-1.001 2.302-1.493 3.082 1.306.398 2.686.611 4.109.611 6.621 0 11.988-5.367 11.988-11.987C24 5.367 18.638 0 12.017 0z"/></svg>
                </a>
                <a href="#" class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors duration-300">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
                <a href="#" class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors duration-300">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                </a>
                <a href="#" class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors duration-300">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z"/></svg>
                </a>
            </div>

            {{-- CTA Buttons (Untuk Murid & Tutor) --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12">
                {{-- Tombol Untuk Murid (Arahkan ke Katalog) --}}
                <a href="{{ route('katalog.publik') }}" class="w-full sm:w-auto bg-white border-2 border-blue-600 text-blue-600 hover:bg-blue-50 font-bold px-8 py-3 rounded-full transition-all hover:-translate-y-1">
                    Mulai Cari Tutor
                </a>
                
                {{-- Tombol Untuk Tutor (Arahkan ke Register) --}}
                <a href="{{ route('register') }}?role=tutor" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-3 rounded-full transition-all shadow-lg shadow-blue-600/30 hover:-translate-y-1">
                    Daftar Jadi Tutor
                </a>
            </div>

            {{-- Links --}}
            <div class="flex flex-wrap items-center justify-center gap-x-10 gap-y-4 text-sm font-semibold text-slate-700 mb-12">
                <a href="#" class="hover:text-blue-600 transition-colors">Kebijakan Privasi</a>
                <a href="#" class="hover:text-blue-600 transition-colors">Kebijakan Hak Cipta</a>
                <a href="#" class="hover:text-blue-600 transition-colors">Kebijakan Biaya dan Tarif</a>
                <a href="#" class="hover:text-blue-600 transition-colors">Syarat dan Ketentuan</a>
            </div>
        </div>

        {{-- Bottom Copyright Bar --}}
        <div class="bg-slate-200/50 py-6 text-center text-sm font-medium text-slate-500">
            Copyright &copy; <span class="text-blue-600">tempatles.id</span> | Belajar jadi lebih mudah
        </div>
    </footer>

</body>
</html>