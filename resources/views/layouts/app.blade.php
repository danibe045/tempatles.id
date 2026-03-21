<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'tempatles.id') }}</title>

    <!-- Logo -->
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-800">
    <div class="min-h-screen bg-gray-300">
        
        @include('layouts.navigation')

        <div class="md:pl-64 flex flex-col min-h-screen transition-all duration-300">
            
            @isset($header)
                <header class="bg-white border-b border-gray-200 sticky top-0 z-40 shadow-sm"> 
                    <div class="px-6 py-6 md:px-8 max-w-full mx-auto w-full">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="flex-1 p-0">
                {{ $slot }}
            </main>

            <footer class="py-4 text-center text-xs text-gray-400 border-t border-gray-100 bg-white mt-auto">
                &copy; {{ date('Y') }} Tempatles.id - Admin Panel
            </footer>
        </div>
    </div>
</body>
</html>