<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="p-6">
        @csrf

        <div class="flex justify-center mb-6">
            <a href="/">
                <img src="{{ asset('img/logo.png') }}" class="h-20 w-auto object-contain" alt="Logo tempatles.id">
            </a>
        </div>

        @php
        $role = request()->get('role', 'murid');
        @endphp
        <input type="hidden" name="role" value="{{ $role }}">

        <div class="mb-6 text-center border-b pb-4">
            <h2 class="text-xl font-bold text-gray-800 uppercase tracking-wider">
                Daftar Sebagai {{ ucfirst($role) }}
            </h2>
            <p class="text-sm text-gray-500 mt-1">Lengkapi data di bawah untuk membuat akun baru.</p>
        </div>

        <div class="mt-4">
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" placeholder="Contoh: Budi Santoso" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email Aktif')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autocomplete="username" placeholder="budisantoso@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-10" type="password" name="password" required
                    autocomplete="new-password" placeholder="Minimal 8 karakter" />
                <button type="button" onclick="togglePassword('password', 'eye-icon-1')"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <svg id="eye-icon-1" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
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

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
            <div class="relative">
                <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10" type="password"
                    name="password_confirmation" required autocomplete="new-password"
                    placeholder="Ulangi password Anda" />
                <button type="button" onclick="togglePassword('password_confirmation', 'eye-icon-2')"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <svg id="eye-icon-2" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-8 border-t pt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Sudah punya akun?') }}
            </a>

            <x-primary-button
                class="ms-4 bg-[#1d4ed8] hover:bg-blue-800 transition shadow-md text-lg px-6 py-3 border-none normal-case">
                {{ __('Daftar Sekarang') }}
            </x-primary-button>
        </div>
    </form>

    <script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (input.type === "password") {
            input.type = "text";
            icon.classList.add("text-blue-600");
            // Ubah SVG menjadi ikon mata tertutup jika diinginkan, atau cukup ganti warna
        } else {
            input.type = "password";
            icon.classList.remove("text-blue-600");
        }
    }
    </script>
</x-guest-layout>