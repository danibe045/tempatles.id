<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-slate-50/50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white rounded-[2rem] border border-slate-200 shadow-xl p-8 md:p-10 text-center">
            
            {{-- Icon Shield Security --}}
            <div class="w-14 h-14 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center mb-5 border border-rose-100 shadow-sm mx-auto">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>

            <h3 class="text-2xl font-black text-slate-900 tracking-tight mb-2">Pemulihan Akun</h3>
            <p class="text-xs font-medium text-slate-400 leading-relaxed mb-6">Masukkan nomor WhatsApp aktif Anda yang telah terdaftar di platform Tempatles.id untuk menerima kode OTP otentikasi.</p>

            {{-- Error Feedback --}}
            @if ($errors->any())
                <div class="mb-4 p-3.5 bg-rose-50 border border-rose-100 rounded-xl text-left">
                    <p class="text-xs font-bold text-rose-600 leading-tight">{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('password.request') }}" class="space-y-5 text-left">
                @csrf
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 pl-1">Nomor WhatsApp Aktif</label>
                    <div class="relative shadow-sm rounded-xl overflow-hidden">
                        <input type="text" name="phone_number" required placeholder="Contoh: 081234567890" value="{{ old('phone_number') }}"
                            class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 focus:bg-white rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-slate-900 focus:border-slate-900 transition-all outline-none placeholder:font-medium placeholder:text-slate-400">
                        <div class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none text-slate-400 font-bold text-xs">
                            📞
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-slate-900 hover:bg-black text-white px-6 py-4 rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-lg shadow-slate-900/10 active:scale-95 flex items-center justify-center gap-2">
                    Kirim Kode OTP Pengaman
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </form>

            <div class="mt-8 text-center border-t border-slate-100 pt-4">
                <a href="{{ route('login') }}" class="text-[10px] font-black uppercase tracking-wider text-slate-400 hover:text-slate-700 transition-colors">← Kembali Ke Log Masuk</a>
            </div>
        </div>
    </div>
</x-guest-layout>