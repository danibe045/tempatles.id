<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Kami - tempatles.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 antialiased overflow-x-hidden flex flex-col min-h-screen">

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
            <a href="/" class="hover:text-blue-600 transition-colors">Home</a>
            <a href="{{ route('katalog.publik') }}" class="hover:text-blue-600 transition-colors">Cari Tutor</a>
            {{-- Menu Layanan Kami Aktif --}}
            <a href="{{ route('layanan') }}" class="text-blue-600 border-b-2 border-blue-600 pb-1">Layanan Kami</a>
            <a href="#" class="hover:text-blue-600 transition-colors">Tentang</a>
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

    {{-- HEADER / HERO SECTION --}}
    <div class="bg-blue-950 pt-20 pb-24 relative overflow-hidden text-center">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10">
            <div class="absolute top-[-10%] left-[10%] w-[30%] h-[60%] bg-blue-600/30 blur-[100px] rounded-full"></div>
            <div class="absolute bottom-[10%] right-[10%] w-[20%] h-[50%] bg-orange-500/20 blur-[80px] rounded-full"></div>
        </div>

        <div class="max-w-4xl mx-auto px-6 relative z-10">
            <p class="text-[10px] font-black text-orange-400 uppercase tracking-[0.25em] mb-4">Solusi Belajar Cerdas</p>
            <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight mb-6 leading-tight">Layanan Bimbingan Belajar <br>Menyesuaikan Kebutuhanmu</h1>
            <p class="text-blue-200/80 font-medium text-lg max-w-2xl mx-auto">
                Dari kelas tatap muka hingga sesi interaktif online. Temukan format belajar dan program yang paling pas untuk meraih targetmu.
            </p>
        </div>
    </div>

    <main class="flex-grow">
        
        {{-- 1. METODE BELAJAR --}}
        <section class="py-20 bg-white relative -mt-8 rounded-t-[3rem] z-20">
            <div class="max-w-6xl mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-black text-blue-950 mb-4">Pilih Metode Belajarmu</h2>
                    <div class="w-16 h-1 bg-orange-500 mx-auto rounded-full"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                    {{-- Metode Offline --}}
                    <div class="bg-slate-50 p-10 rounded-[2rem] border border-slate-200 hover:border-blue-300 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 text-center group">
                        <div class="w-20 h-20 mx-auto bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        </div>
                        <h3 class="text-2xl font-black text-slate-900 mb-4">Les Privat Tatap Muka</h3>
                        <p class="text-slate-500 font-medium leading-relaxed mb-6">
                            Tutor datang langsung ke rumahmu atau bertemu di lokasi yang disepakati (cafe/perpustakaan). Sangat cocok untuk anak usia dini atau yang butuh fokus tinggi.
                        </p>
                        <ul class="text-sm font-bold text-slate-700 space-y-2 text-left bg-white p-4 rounded-xl border border-slate-100">
                            <li class="flex items-center gap-2"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg> Fokus belajar 100% terjaga</li>
                            <li class="flex items-center gap-2"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg> Interaksi langsung lebih humanis</li>
                        </ul>
                    </div>

                    {{-- Metode Online --}}
                    <div class="bg-slate-50 p-10 rounded-[2rem] border border-slate-200 hover:border-orange-300 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 text-center group">
                        <div class="w-20 h-20 mx-auto bg-orange-100 text-orange-500 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="text-2xl font-black text-slate-900 mb-4">Les Privat Online (Jarak Jauh)</h3>
                        <p class="text-slate-500 font-medium leading-relaxed mb-6">
                            Belajar via Zoom/Google Meet. Solusi cerdas jika kamu mencari tutor spesialis (misal: Native Speaker) yang lokasinya berada di luar kotamu.
                        </p>
                        <ul class="text-sm font-bold text-slate-700 space-y-2 text-left bg-white p-4 rounded-xl border border-slate-100">
                            <li class="flex items-center gap-2"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg> Akses tutor dari seluruh Indonesia</li>
                            <li class="flex items-center gap-2"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg> Jadwal jauh lebih fleksibel & hemat waktu</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- 2. PROGRAM BIMBINGAN (Penjelasan Naratif) --}}
        <section class="py-20 bg-blue-50 border-y border-blue-100">
            <div class="max-w-6xl mx-auto px-6">
                <div class="flex flex-col md:flex-row items-center gap-12">
                    <div class="w-full md:w-1/2">
                        <h2 class="text-3xl font-black text-blue-950 mb-6">Program Bimbingan Unggulan</h2>
                        <p class="text-slate-600 font-medium leading-relaxed mb-8">
                            Kami memfasilitasi berbagai jenjang pendidikan dan minat bakat. Mulai dari anak usia dini hingga profesional yang ingin mengembangkan karir.
                        </p>
                        
                        <div class="space-y-6">
                            <div class="flex gap-4">
                                <div class="w-12 h-12 shrink-0 bg-white rounded-xl shadow-sm flex items-center justify-center text-blue-600 font-black text-xl border border-blue-100">A</div>
                                <div>
                                    <h4 class="text-lg font-black text-slate-900">Program Akademik & Ujian</h4>
                                    <p class="text-sm text-slate-500 font-medium mt-1">Pendampingan PR, pendalaman materi SD-SMA, persiapan UTBK, hingga persiapan tes CPNS/Kedinasan.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="w-12 h-12 shrink-0 bg-white rounded-xl shadow-sm flex items-center justify-center text-orange-500 font-black text-xl border border-orange-100">文</div>
                                <div>
                                    <h4 class="text-lg font-black text-slate-900">Bahasa & Ilmu Agama</h4>
                                    <p class="text-sm text-slate-500 font-medium mt-1">Persiapan TOEFL/IELTS, kursus bahasa asing (Jepang, Mandarin, Arab), serta bimbingan intensif mengaji dan tahsin.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="w-12 h-12 shrink-0 bg-white rounded-xl shadow-sm flex items-center justify-center text-emerald-500 font-black text-xl border border-emerald-100">⚡</div>
                                <div>
                                    <h4 class="text-lg font-black text-slate-900">Skill Digital & Terapan</h4>
                                    <p class="text-sm text-slate-500 font-medium mt-1">Tingkatkan value diri dengan kursus Web Programming (Coding), Desain Grafis, SEO, hingga praktik public speaking.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Visual/Ilustrasi Placeholder (Diganti Kotak Estetik) --}}
                    <div class="w-full md:w-1/2 relative">
                        <div class="aspect-square bg-gradient-to-tr from-blue-200 to-blue-50 rounded-[3rem] p-8 relative flex items-center justify-center shadow-inner border border-blue-100">
                            <div class="grid grid-cols-2 gap-4 w-full h-full">
                                <div class="bg-white rounded-2xl shadow-sm flex items-center justify-center hover:-translate-y-1 transition-transform"><span class="text-4xl">📚</span></div>
                                <div class="bg-blue-600 rounded-2xl shadow-sm flex items-center justify-center hover:-translate-y-1 transition-transform"><span class="text-4xl text-white font-black">A+</span></div>
                                <div class="bg-orange-500 rounded-2xl shadow-sm flex items-center justify-center hover:-translate-y-1 transition-transform"><span class="text-4xl">💻</span></div>
                                <div class="bg-white rounded-2xl shadow-sm flex items-center justify-center hover:-translate-y-1 transition-transform"><span class="text-4xl">🌍</span></div>
                            </div>
                            {{-- Badge Mengambang --}}
                            <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-2xl shadow-xl border border-slate-100 flex items-center gap-3">
                                <div class="w-10 h-10 bg-emerald-100 text-emerald-500 rounded-full flex items-center justify-center"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase">Mata Pelajaran</p>
                                    <p class="text-sm font-black text-slate-800">50+ Pilihan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- 3. JAMINAN MUTU (Quality Assurance) --}}
        <section class="py-20 bg-white">
            <div class="max-w-6xl mx-auto px-6 text-center">
                <h2 class="text-3xl font-black text-blue-950 mb-12">Komitmen Kualitas tempatles.id</h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="p-6">
                        <div class="w-14 h-14 mx-auto bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <h4 class="font-black text-slate-900 mb-2">Tutor Terverifikasi</h4>
                        <p class="text-xs text-slate-500 font-medium">Identitas dan kualifikasi tutor telah melalui proses pengecekan admin.</p>
                    </div>
                    <div class="p-6">
                        <div class="w-14 h-14 mx-auto bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h4 class="font-black text-slate-900 mb-2">Bebas Atur Jadwal</h4>
                        <p class="text-xs text-slate-500 font-medium">Sepakati waktu dan tempat langsung dengan tutor pilihanmu.</p>
                    </div>
                    <div class="p-6">
                        <div class="w-14 h-14 mx-auto bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                        </div>
                        <h4 class="font-black text-slate-900 mb-2">Garansi Kecocokan</h4>
                        <p class="text-xs text-slate-500 font-medium">Bebas mencari dan berganti tutor lain jika merasa metode ajarnya kurang pas.</p>
                    </div>
                    <div class="p-6">
                        <div class="w-14 h-14 mx-auto bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <h4 class="font-black text-slate-900 mb-2">Tanpa Biaya Admin</h4>
                        <p class="text-xs text-slate-500 font-medium">Biaya yang dibayarkan 100% murni untuk honor mengajar tutor.</p>
                    </div>
                </div>
            </div>
        </section>

    </main>

    {{-- FOOTER MENDETAIL --}}
    <footer class="bg-slate-50 pt-20 border-t border-slate-200 mt-auto">
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
                <a href="#" class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg></a>
                <a href="#" class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg></a>
            </div>

            {{-- CTA Buttons (Untuk Murid & Tutor) --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12">
                <a href="{{ route('katalog.publik') }}" class="w-full sm:w-auto bg-white border-2 border-blue-600 text-blue-600 hover:bg-blue-50 font-bold px-8 py-3 rounded-full transition-all hover:-translate-y-1">Mulai Cari Tutor</a>
                <a href="{{ route('register') }}?role=tutor" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-3 rounded-full transition-all shadow-lg shadow-blue-600/30 hover:-translate-y-1">Daftar Jadi Tutor</a>
            </div>

            {{-- Links --}}
            <div class="flex flex-wrap items-center justify-center gap-x-10 gap-y-4 text-sm font-semibold text-slate-700 mb-12">
                <a href="#" class="hover:text-blue-600 transition-colors">Kebijakan Privasi</a>
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