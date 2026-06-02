<x-guest-layout>
    <div class="w-full max-w-lg mx-auto p-6 lg:p-10">
        {{-- Header --}}
        <div class="mb-8">
            <h3 class="text-2xl font-black text-slate-800 mb-2">Buat Password Baru</h3>
            <p class="text-sm font-medium text-slate-500">
                Masukkan password baru Anda untuk mengamankan akun tempatles.id Anda kembali.
            </p>
        </div>

        {{-- Notifikasi Error Umum jika ada --}}
        @if ($errors->any())
            <div class="mb-4 p-3.5 bg-rose-50 border border-rose-100 rounded-xl">
                <p class="text-xs font-bold text-rose-600 leading-tight">{{ $errors->first() }}</p>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
            @csrf

            {{-- Token kustom yang dikirimkan lewat link session --}}
            <input type="hidden" name="token" value="{{ $token }}">

            {{-- Input Penanda Akun (Diubah menjadi Nomor WhatsApp otomatis readonly dari session) --}}
            <div class="group">
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1" for="phone_number">Nomor WhatsApp Anda</label>
                <input id="phone_number" type="text" name="phone_number" value="{{ session('reset_phone') }}" required readonly
                    class="block w-full bg-slate-100 border border-slate-200 rounded-xl text-sm font-bold text-slate-500 transition-all py-3.5 px-4 outline-none cursor-not-allowed" />
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
            </div>

            <div class="group">
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1" for="password">Password Baru</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" 
                    class="block w-full bg-white border border-slate-200 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl shadow-sm text-sm font-bold transition-all py-3.5 px-4 outline-none" 
                    placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="group">
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1" for="password_confirmation">Konfirmasi Password Baru</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                    class="block w-full bg-white border border-slate-200 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl shadow-sm text-sm font-bold transition-all py-3.5 px-4 outline-none" 
                    placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="pt-2">
                <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-lg shadow-blue-600/30 transform hover:-translate-y-1 flex items-center justify-center gap-2">
                    Simpan Password Baru
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>