<x-guest-layout>
    @php
        // Fungsi menyamarkan nomor telepon demi privasi keamanan berkas
        $phone = session('reset_phone', '');
        $maskedPhone = strlen($phone) > 6 ? substr($phone, 0, 4) . 'XXXXXX' . substr($phone, -3) : $phone;
    @endphp

    <div class="min-h-screen flex flex-col justify-center items-center bg-slate-50/50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white rounded-[2rem] border border-slate-200 shadow-xl p-8 md:p-10 text-center">
            
            {{-- Icon Chat Whatsapp Verification --}}
            <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-4 border border-emerald-100 shadow-sm mx-auto animate-bounce-short">
                💬
            </div>

            <h3 class="text-2xl font-black text-slate-900 tracking-tight mb-2">Verifikasi Otentikasi</h3>
            <p class="text-xs font-bold text-slate-400 leading-relaxed mb-6">Masukkan 6 digit kode keamanan OTP resmi yang telah kami kirimkan ke nomor WhatsApp <span class="text-slate-800 font-black">({{ $maskedPhone }})</span></p>

            {{-- Error Feedback --}}
            @if ($errors->any())
                <div class="mb-4 p-3.5 bg-rose-50 border border-rose-100 rounded-xl text-left">
                    <p class="text-xs font-bold text-rose-600 leading-tight">{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('password.otp.submit') }}" class="space-y-6">
                @csrf
                
                {{-- Komponen 6 Kotak Angka Berjejer --}}
                <div class="flex justify-center gap-2" id="otp-container">
                    @for($i = 0; $i < 6; $i++)
                        <input type="text" name="otp[]" maxlength="1" pattern="\d*" required
                            class="otp-field w-12 h-14 text-center bg-slate-50 border border-slate-200 rounded-xl text-lg font-black text-slate-800 focus:bg-white focus:ring-2 focus:ring-slate-900 focus:border-slate-900 transition-all outline-none shadow-sm shadow-inner"
                            autocomplete="off">
                    @endfor
                </div>

                <button type="submit" class="w-full bg-slate-900 hover:bg-black text-white px-6 py-4 rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-lg active:scale-95 flex items-center justify-center gap-2">
                    Validasi Kode Pengaman
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>
            </form>

            <div class="mt-8 text-center border-t border-slate-100 pt-4">
                <a href="{{ route('password.request') }}" class="text-[10px] font-black uppercase tracking-wider text-slate-400 hover:text-slate-700 transition-colors">← Salah Nomor? Ajukan Ulang</a>
            </div>
        </div>
    </div>

    {{-- Script UX Auto Tab Focus Input --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fields = document.querySelectorAll('.otp-field');
            
            fields.forEach((field, index) => {
                // Berpindah kotak ke kanan secara otomatis saat angka terisi
                field.addEventListener('input', function() {
                    if (this.value.length >= 1 && index < fields.length - 1) {
                        fields[index + 1].focus();
                    }
                });

                // Kembali ke kotak kiri saat menekan tombol hapus/Backspace
                field.addEventListener('keydown', function(e) {
                    if (e.key === 'Backspace' && this.value.length === 0 && index > 0) {
                        fields[index - 1].focus();
                    }
                });
            });
        });
    </script>
</x-guest-layout>