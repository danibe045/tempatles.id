<x-guest-layout>
    {{-- Kita tidak menggunakan slot logo bawaan agar logo menyatu di dalam kotak putih --}}

    <form method="POST" action="{{ route('login') }}" class="p-6">
        @csrf

        {{-- 1. Logo di bagian atas form --}}
        <div class="flex justify-center mb-6">
            <a href="/">
                <img src="{{ asset('img/logo.png') }}" class="h-20 w-auto object-contain" alt="Logo tempatles.id">
            </a>
        </div>

        <div class="mb-6 text-center border-b pb-4">
            <h2 class="text-xl font-bold text-gray-800 uppercase tracking-wider">
                Masuk ke Akun
            </h2>
            <p class="text-sm text-gray-500 mt-1">Selamat datang kembali di tempatles.id</p>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-10" type="password" name="password" required
                    autocomplete="current-password" />

                {{-- Fitur simbol mata untuk lihat password --}}
                <button type="button" onclick="togglePassword('password', 'eye-icon')"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <svg id="eye-icon" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-8 border-t pt-4">
            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('password.request') }}">
                {{ __('Lupa password?') }}
            </a>
            @endif

            <x-primary-button
                class="ms-4 bg-blue-600 hover:bg-blue-700 transition shadow-md text-lg px-6 py-3 border-none normal-case">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        {{-- Link ke Register jika belum punya akun --}}
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">Daftar Sekarang</a>
            </p>
        </div>
    </form>

    <script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (input.type === "password") {
            input.type = "text";
            icon.classList.add("text-blue-600");
        } else {
            input.type = "password";
            icon.classList.remove("text-blue-600");
        }
    }
    </script>
</x-guest-layout>