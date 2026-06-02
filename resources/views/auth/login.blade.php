<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - tempatles.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 antialiased overflow-x-hidden">

    <div class="min-h-screen flex flex-col lg:flex-row">

        {{-- ======================================================== --}}
        {{-- PANEL KIRI: BRANDING & INFORMASI --}}
        {{-- ======================================================== --}}
        <div class="w-full lg:w-5/12 bg-blue-950 relative overflow-hidden flex flex-col px-8 py-10 lg:px-12 lg:py-16 text-white min-h-[30vh] lg:min-h-screen shrink-0 shadow-2xl z-20">
            {{-- Background Ornamen Premium --}}
            <div class="absolute top-[-10%] left-[-20%] w-[70%] h-[50%] bg-blue-600/30 blur-[100px] rounded-full pointer-events-none"></div>
            <div class="absolute bottom-[-10%] right-[-20%] w-[70%] h-[50%] bg-orange-500/20 blur-[100px] rounded-full pointer-events-none"></div>
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-40 pointer-events-none"></div>

            {{-- Logo --}}
            <div class="relative z-10 flex items-center justify-between">
                <a href="/" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-white rounded-xl shadow-lg flex items-center justify-center group-hover:-translate-y-1 transition-transform">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-auto h-10">
                    </div>
                    <span class="font-black text-white text-2xl tracking-tight">tempatles<span class="text-orange-500">.id</span></span>
                </a>
            </div>

            {{-- Text Promosi (Khusus Login) --}}
            <div class="relative z-10 flex-grow flex flex-col justify-center mt-12 lg:mt-16">
                <div>
                    <span class="inline-block py-1.5 px-3 rounded-lg bg-emerald-500/20 text-emerald-300 text-[10px] font-black uppercase tracking-[0.2em] mb-4 border border-emerald-400/20 w-fit">Selamat Datang Kembali</span>
                    <h1 class="text-3xl lg:text-5xl font-black leading-[1.1] tracking-tight mb-5">
                        Siap Untuk <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-emerald-400">Belajar & Mengajar?</span>
                    </h1>
                    <p class="text-slate-300 text-sm leading-relaxed mb-8 font-medium max-w-sm">
                        Masuk ke akun Anda untuk mengakses dashboard, memantau jadwal, dan mulai aktivitas hari ini.
                    </p>
                </div>
                
                {{-- Tombol Navigasi --}}
                <div class="flex items-center gap-4 mt-2">
                    <a href="/" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/10 backdrop-blur-md text-white px-5 py-2.5 rounded-full text-[11px] font-black uppercase tracking-widest transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                        Beranda
                    </a>
                </div>
            </div>

            {{-- Footer Area Kiri --}}
            <div class="relative z-10 hidden lg:block text-[10px] font-bold text-slate-500 mt-12">
                <span>© {{ date('Y') }} tempatles.id</span>
            </div>
        </div>

        {{-- ======================================================== --}}
        {{-- PANEL KANAN: FORM LOGIN --}}
        {{-- ======================================================== --}}
        <div class="w-full lg:w-7/12 flex items-center justify-center p-6 py-10 lg:px-14 lg:py-10 bg-slate-50 relative min-h-[70vh] lg:min-h-screen">
            
            {{-- PERUBAHAN: max-w-md diubah jadi max-w-lg --}}
            <div class="w-full max-w-lg">
                
                <div class="text-center sm:text-left mb-8">
                    <h3 class="text-2xl font-black text-slate-800 mb-1.5">Masuk ke Akun</h3>
                    <p class="text-sm font-medium text-slate-500">Masukkan email dan password Anda.</p>
                </div>

                {{-- Alert Error --}}
                <x-auth-session-status class="mb-4" :status="session('status')" />
                @if ($errors->any())
                <div class="mb-6 bg-rose-50 border border-rose-100 p-4 rounded-2xl flex gap-3 items-start shadow-sm">
                    <div class="bg-rose-500 p-1.5 rounded-lg text-white shadow-md shadow-rose-500/20 shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    </div>
                    <div>
                        <h4 class="font-black text-rose-900 text-xs uppercase tracking-widest mb-1">Gagal Masuk</h4>
                        <ul class="text-[11px] font-bold text-rose-600 space-y-0.5">
                            @foreach ($errors->all() as $error) <li>• {{ $error }}</li> @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div class="group">
                        <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1 group-focus-within:text-blue-600 transition-colors" for="email">Email Aktif</label>
                        {{-- PERUBAHAN: py-3 diubah jadi py-3.5 untuk input yang lebih lega --}}
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="block w-full bg-white border border-slate-200 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl shadow-sm text-sm font-bold transition-all py-3.5 px-4 outline-none" placeholder="nama@email.com" />
                    </div>

                    <div class="group">
                        <div class="flex items-center justify-between mb-2">
                            <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest ml-1 group-focus-within:text-blue-600 transition-colors !mb-0" for="password">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-[11px] font-bold text-blue-600 hover:text-blue-800 transition-colors">Lupa Password?</a>
                            @endif
                        </div>
                        <div class="relative">
                            {{-- PERUBAHAN: py-3 diubah jadi py-3.5 --}}
                            <input id="password" type="password" name="password" required autocomplete="current-password" class="block w-full bg-white border border-slate-200 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl shadow-sm text-sm font-bold transition-all py-3.5 pl-4 pr-10 outline-none" placeholder="••••••••" />
                            <button type="button" onclick="togglePass('password', 'eye-icon')" class="absolute inset-y-0 right-2 px-2 flex items-center text-slate-400 hover:text-blue-600 transition-colors">
                                <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center mt-3">
                        <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 cursor-pointer">
                        <label for="remember_me" class="ml-2 block text-xs font-bold text-slate-600 cursor-pointer select-none">
                            Ingat sesi saya
                        </label>
                    </div>

                    <div class="pt-4 mt-8 border-t border-slate-100">
                        {{-- PERUBAHAN: py-3.5 diubah jadi py-4 --}}
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white w-full py-4 rounded-xl text-xs font-black tracking-widest uppercase transition-all shadow-lg shadow-blue-600/30 transform hover:-translate-y-1 flex items-center justify-center gap-2">
                            Masuk Sekarang
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>
                </form>

                <div class="mt-8 pt-6 border-t border-slate-200/60 text-center">
                    <p class="text-xs font-bold text-slate-500 leading-loose">
                        Belum punya akun? <br class="sm:hidden">
                        <a href="{{ route('register', ['role' => 'murid']) }}" class="text-orange-500 hover:text-orange-600 underline decoration-orange-300 underline-offset-4 mx-1">Daftar Murid</a>
                        atau
                        <a href="{{ route('register', ['role' => 'tutor']) }}" class="text-blue-600 hover:text-blue-800 underline decoration-blue-300 underline-offset-4 mx-1">Daftar Pengajar</a>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Fitur lihat password
        function togglePass(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === "password") {
                input.type = "text";
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
            } else {
                input.type = "password";
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
            }
        }
    </script>
</body>
</html>