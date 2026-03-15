<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tempatles.id - Dapatkan Layanan Les Tanpa Pasang Iklan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white font-sans antialiased">

    <nav class="flex items-center justify-between px-10 py-4 bg-white border-b border-gray-100 shadow-sm">
        <div class="flex items-center">
            <a href="/">
                <img src="{{ asset('img/logo.png') }}" alt="tempatles.id Logo" class="h-16 w-auto object-contain">
            </a>
        </div>

        <div class="hidden md:flex items-center space-x-8 font-medium text-gray-700">
            <a href="/" class="hover:text-blue-600 transition">Home</a>

            <div class="relative group">
                <button class="flex items-center hover:text-blue-600 transition">
                    Layanan Tutor
                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>

            <div class="relative group">
                <button class="flex items-center hover:text-blue-600 transition">
                    Layanan Murid
                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>

            <a href="#" class="hover:text-blue-600 transition">Bidang</a>

            <div class="relative group">
                <button class="flex items-center hover:text-blue-600 transition">
                    Tentang
                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div>
            @if (Route::has('login'))
            @auth
            <a href="{{ url('/dashboard') }}"
                class="bg-blue-600 text-white px-6 py-2 rounded-full font-bold hover:bg-blue-700 transition shadow-md">
                Dashboard
            </a>
            @else
            <a href="{{ route('register') }}"
                class="bg-blue-600 text-white px-6 py-2 rounded-full font-bold hover:bg-blue-700 transition shadow-md">
                Daftar (Gratis)
            </a>
            @endauth
            @endif
        </div>
    </nav>

    <main class="flex flex-col items-center justify-center text-center px-4 py-24 min-h-[80vh]">
        <h1 class="text-5xl md:text-6xl font-extrabold text-gray-800 leading-tight tracking-tight">
            Dapatkan Layanan Les <br> <span class="text-blue-600">Tanpa Pasang Iklan</span>
        </h1>

        <div class="mt-12 flex flex-col md:flex-row gap-6">
            <a href="{{ route('register') }}?role=murid"
                class="bg-blue-400 text-white px-12 py-4 rounded-md font-bold shadow-lg hover:bg-blue-500 transition-all transform hover:scale-105 text-lg">
                Daftar jadi Murid
            </a>
            <a href="{{ route('register') }}?role=tutor"
                class="bg-blue-500 text-white px-12 py-4 rounded-md font-bold shadow-lg hover:bg-blue-600 transition-all transform hover:scale-105 text-lg">
                Daftar jadi Tutor
            </a>
        </div>

        <p class="mt-16 max-w-3xl text-gray-500 text-lg leading-relaxed italic">
            "tempatles.id menyediakan layanan daftar gratis, tanpa pasang iklan, dan fleksibel memilih murid ataupun
            menjadi tutor. Cocok untuk guru, pelajar, mahasiswa, dan praktisi skill di seluruh Indonesia."
        </p>

        <div class="mt-12 flex flex-col md:flex-row gap-4 items-center">
            <a href="{{ route('register') }}"
                class="bg-blue-700 text-white px-10 py-3 rounded-full font-bold hover:bg-blue-800 transition shadow-lg">
                Daftar (Gratis)
            </a>

            <a href="https://wa.me/6285859222500" target="_blank"
                class="bg-green-500 text-white px-8 py-3 rounded-full font-bold flex items-center gap-2 hover:bg-green-600 transition shadow-lg">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.414 0 0 5.414 0 12.05c0 2.123.553 4.197 1.603 6.013L0 24l6.135-1.611a11.79 11.79 0 005.911 1.586h.005c6.632 0 12.045-5.413 12.045-12.051 0-3.21-1.248-6.227-3.511-8.491z" />
                </svg>
                Tanya Via WhatsApp
            </a>
        </div>
    </main>

</body>

</html>