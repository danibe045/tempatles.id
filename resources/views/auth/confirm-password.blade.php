<x-guest-layout>
    <div class="w-full max-w-lg mx-auto p-6 lg:p-10">
        {{-- Header --}}
        <div class="mb-8">
            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-6">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <h3 class="text-2xl font-black text-slate-800 mb-2">Konfirmasi Keamanan</h3>
            <p class="text-sm font-medium text-slate-500">
                Ini adalah area sensitif aplikasi. Mohon konfirmasi password Anda untuk melanjutkan.
            </p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
            @csrf

            {{-- Password Input --}}
            <div class="group">
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1" for="password">Password Anda</label>
                <div class="relative">
                    <input id="password" type="password" name="password" required autocomplete="current-password" 
                        class="block w-full bg-white border border-slate-200 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl shadow-sm text-sm font-bold transition-all py-3.5 px-4 outline-none" 
                        placeholder="••••••••" />
                </div>
                
                @if ($errors->has('password'))
                    <p class="text-[10px] font-bold text-rose-500 mt-2 uppercase tracking-wider">
                        {{ $errors->first('password') }}
                    </p>
                @endif
            </div>

            {{-- Tombol Aksi --}}
            <div class="pt-2">
                <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-lg shadow-blue-600/30 transform hover:-translate-y-1 flex items-center justify-center gap-2">
                    Konfirmasi Password
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>