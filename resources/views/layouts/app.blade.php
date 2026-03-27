<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'tempatles.id') }}</title>

    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
{{-- Otak pembuka menu dipindah ke body --}}
<body class="font-sans antialiased text-slate-800" x-data="{ sidebarOpen: false }">
    
    <div class="min-h-screen bg-gradient-to-br from-[#0f172a] to-blue-950">
        
        @include('layouts.navigation')

        <div class="md:pl-64 flex flex-col min-h-screen transition-all duration-300">
            
            @isset($header)
                <header class="bg-white border-b border-gray-200 sticky top-0 z-40 shadow-sm flex items-center"> 
                    
                    {{-- TOMBOL HAMBURGER (Hanya muncul di HP) --}}
                    <button @click="sidebarOpen = true" class="md:hidden p-5 pl-6 text-slate-400 hover:text-blue-950 focus:outline-none transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <div class="pr-6 py-6 md:px-8 max-w-full mx-auto w-full">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="flex-1 p-0">
                {{ $slot }}
            </main>

            <footer class="py-4 text-center text-[10px] font-semibold tracking-wider text-blue-200/30 border-t border-white/5 bg-[#0f172a]/50 mt-auto uppercase">
                &copy; {{ date('Y') }} Tempatles.id - Admin Panel
            </footer>
        </div>
    </div>
</body>
</html>