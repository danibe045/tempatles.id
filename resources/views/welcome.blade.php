<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tempatles.id - Dapatkan Layanan Les Tanpa Pasang Iklan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Tambahkan Google Fonts agar lebih profesional --}}
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
            <a href="#" class="hover:text-blue-600 transition-colors">Layanan Tutor</a>
            <a href="#" class="hover:text-blue-600 transition-colors">Layanan Murid</a>
            <a href="#" class="hover:text-blue-600 transition-colors">Tentang</a>
        </div>

        <div>
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="bg-blue-950 text-white px-7 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-orange-500 transition-all shadow-lg shadow-blue-950/20">
                    Dashboard
                </a>
            @else
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="text-xs font-black uppercase tracking-widest text-slate-600 hover:text-blue-600 transition-colors">Masuk</a>
                    <a href="{{ route('register') }}"
                        class="bg-blue-950 text-white px-7 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-orange-500 transition-all shadow-lg shadow-blue-950/20">
                        Daftar Gratis
                    </a>
                </div>
            @endauth
        </div>
    </nav>

    <main class="relative pt-20 pb-32 overflow-hidden">
        {{-- Elemen Dekorasi Background --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[60%] bg-blue-100/50 blur-[120px] rounded-full"></div>
            <div class="absolute bottom-[10%] right-[-5%] w-[30%] h-[50%] bg-orange-100/50 blur-[100px] rounded-full"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 text-center">
            {{-- Badge Kecil --}}
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 border border-blue-100 rounded-full mb-8 animate-bounce">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                </span>
                <span class="text-[10px] font-black text-blue-600 uppercase tracking-[0.2em]">Platform Les Private</span>
            </div>

            {{-- Judul Utama --}}
            <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 leading-[1.1] tracking-tight mb-8">
                Cari Tutor Terbaik <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Tanpa Ribet Pasang Iklan</span>
            </h1>

            <p class="max-w-2xl mx-auto text-slate-500 text-lg md:text-xl leading-relaxed mb-12">
                Hubungkan bakat pengajar dengan antusiasme pelajar. Daftar gratis, fleksibel, dan tanpa potongan biaya iklan yang mahal.
            </p>

            {{-- Kelompok Tombol Utama --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-5 mb-20">
                <a href="{{ route('register') }}?role=murid"
                    class="group relative w-full sm:w-auto px-10 py-5 bg-white border-2 border-blue-600 text-blue-600 rounded-2xl font-black uppercase tracking-widest text-sm hover:bg-blue-600 hover:text-white transition-all shadow-xl shadow-blue-100 overflow-hidden">
                    <span class="relative z-10">Daftar Jadi Murid</span>
                </a>
                
                <a href="{{ route('register') }}?role=tutor"
                    class="w-full sm:w-auto px-10 py-5 bg-blue-950 text-white rounded-2xl font-black uppercase tracking-widest text-sm hover:bg-orange-500 transition-all shadow-xl shadow-blue-900/20 transform hover:-translate-y-1">
                    Mulai Mengajar (Tutor)
                </a>
            </div>

            {{-- Testimonial / Quote Card --}}
            <div class="max-w-4xl mx-auto bg-white p-8 md:p-12 rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-slate-200/60 relative">
                <div class="absolute -top-6 left-1/2 -translate-x-1/2 w-12 h-12 bg-orange-500 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-orange-500/40">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" /></svg>
                </div>
                <p class="text-slate-600 text-lg md:text-xl italic leading-relaxed font-medium">
                    "tempatles.id adalah revolusi bimbingan belajar. Cocok untuk guru, mahasiswa, dan praktisi skill di seluruh Indonesia untuk menemukan peluang tanpa batas."
                </p>
                <div class="mt-8 flex items-center justify-center gap-4">
                    <div class="h-px w-8 bg-slate-200"></div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Misi Kami</span>
                    <div class="h-px w-8 bg-slate-200"></div>
                </div>
            </div>

            {{-- Tombol Bantuan Floating atau Bottom --}}
            <div class="mt-16">
                <a href="https://wa.me/6285859222500" target="_blank"
                    class="inline-flex items-center gap-3 px-8 py-4 bg-emerald-500 text-white rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-emerald-600 transition-all shadow-lg shadow-emerald-500/30 group">
                    <svg class="w-5 h-5 transition-transform group-hover:rotate-12" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.414 0 0 5.414 0 12.05c0 2.123.553 4.197 1.603 6.013L0 24l6.135-1.611a11.79 11.79 0 005.911 1.586h.005c6.632 0 12.045-5.413 12.045-12.051 0-3.21-1.248-6.227-3.511-8.491z" />
                    </svg>
                    Tanya via WhatsApp
                </a>
            </div>
        </div>
    </main>

</body>
</html>