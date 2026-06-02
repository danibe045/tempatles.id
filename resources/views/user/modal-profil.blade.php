<dialog id="modal-profil" class="rounded-[2.5rem] p-0 border border-slate-100 shadow-2xl backdrop:bg-slate-950/80 backdrop:backdrop-blur-sm m-auto w-full max-w-lg overflow-hidden transition-all duration-300">
    {{-- Header Background Accent --}}
    <div class="h-3 bg-gradient-to-r from-blue-600 to-blue-800 w-full"></div>
    
    <div class="bg-white relative p-6 md:p-8 max-h-[88vh] overflow-y-auto custom-scrollbar">
        
        {{-- Tombol Close --}}
        <button type="button" onclick="this.closest('dialog').close()" class="absolute top-6 right-6 w-10 h-10 flex items-center justify-center bg-slate-50 border border-slate-200 hover:bg-rose-50 text-slate-400 hover:text-rose-500 rounded-full transition-all duration-200 active:scale-95 shadow-sm z-10 focus:outline-none focus:ring-2 focus:ring-rose-500/20">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>
        
        {{-- Header Modal --}}
        <div class="mb-8 flex flex-col items-center text-center mt-2">
            <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-blue-100/80 shadow-inner">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
            </div>
            <h3 class="text-2xl font-black text-slate-900 tracking-tight mb-1">Pengaturan Profil</h3>
            <p class="text-xs font-medium text-slate-500">Perbarui data diri dan keamanan akunmu.</p>
        </div>

        {{-- FORM UTAMA UPDATE PROFIL & PASSWORD --}}
        <form action="{{ route('murid.profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- AREA UBAH & HAPUS FOTO PROFIL --}}
            <div class="flex flex-col sm:flex-row items-center gap-5 p-5 bg-slate-50/70 border border-slate-200/80 rounded-[1.5rem] shadow-sm group hover:border-blue-200 transition-colors">
                <div class="w-20 h-20 rounded-full bg-blue-600 text-white flex items-center justify-center text-2xl font-black shrink-0 overflow-hidden border-4 border-white shadow-md">
                    @if(auth()->user()->profile_photo_path ?? false)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Foto Wajah" class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr(auth()->user()->name ?? 'S', 0, 1)) }}
                    @endif
                </div>
                
                <div class="flex-grow text-center sm:text-left w-full sm:w-auto">
                    <label class="block text-[10px] font-black text-slate-700 uppercase tracking-widest mb-2">Foto Wajah</label>
                    
                    <input type="file" name="foto_profil" accept="image/*" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 cursor-pointer bg-white border border-slate-200/80 rounded-2xl p-1.5 transition-all outline-none focus:border-blue-500 shadow-sm mb-2">
                    
                    @if(auth()->user()->profile_photo_path ?? false)
                        <button type="button" onclick="deleteProfilePhoto()" class="inline-flex items-center gap-1.5 text-[10px] font-bold text-rose-500 hover:text-rose-700 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            Hapus Foto Saat Ini
                        </button>
                    @else
                        <p class="text-[9px] text-slate-400 font-medium sm:hidden">Format: JPG, PNG maksimal 2MB</p>
                    @endif
                </div>
            </div>

            {{-- DATA BIODATA --}}
            <div class="space-y-4">
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Nama Lengkap <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                        <input type="text" name="name" value="{{ auth()->user()->name ?? '' }}" required class="pl-12 w-full bg-slate-50/50 border border-slate-200 rounded-2xl p-4 text-sm font-bold text-slate-800 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none shadow-inner placeholder:text-slate-400 placeholder:font-normal" placeholder="Masukkan nama lengkap...">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Nomor WhatsApp <span class="text-rose-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            </div>
                            <input type="text" name="phone_number" value="{{ auth()->user()->phone_number ?? '' }}" required class="pl-12 w-full bg-slate-50/50 border border-slate-200 rounded-2xl p-4 text-sm font-bold text-slate-800 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none shadow-inner placeholder:text-slate-400 placeholder:font-normal" placeholder="08123456789">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Asal Sekolah / Kelas</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z" /><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                            </div>
                            <input type="text" name="sekolah" value="{{ auth()->user()->sekolah ?? '' }}" class="pl-12 w-full bg-slate-50/50 border border-slate-200 rounded-2xl p-4 text-sm font-bold text-slate-800 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none shadow-inner placeholder:text-slate-400 placeholder:font-normal" placeholder="Siswa SMAN 1...">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Alamat Email Terdaftar</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        </div>
                        <input type="email" value="{{ auth()->user()->email ?? '' }}" readonly class="pl-12 pr-12 w-full bg-slate-100/80 border border-slate-200 rounded-2xl p-4 text-sm font-bold text-slate-500 outline-none cursor-not-allowed select-none" title="Email akun tidak dapat diubah">
                    </div>
                    <p class="text-[9px] text-slate-400 font-medium mt-1.5 ml-1">Email digunakan sebagai identitas login dan tidak dapat diubah.</p>
                </div>
            </div>

            {{-- ========================================== --}}
            {{-- BAGIAN BARU: KEAMANAN (GANTI PASSWORD)     --}}
            {{-- ========================================== --}}
            <div class="pt-4 border-t border-slate-100 space-y-3">
                <div class="flex items-center justify-between">
                    <label class="block text-xs font-black text-slate-800">🔒 Keamanan Akun</label>
                    <span class="text-[9px] font-black text-slate-400 bg-slate-100 px-2 py-0.5 rounded uppercase tracking-wider">Opsional</span>
                </div>
                <p class="text-[10px] text-slate-400 font-medium leading-relaxed">Kosongkan ketiga isian di bawah ini jika kamu tidak ingin mengubah password saat ini.</p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-1">
                    <div>
                        <label class="block text-[9px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Password Lama</label>
                        <input type="password" name="password_lama" class="w-full bg-slate-50/50 border border-slate-200 rounded-xl p-3 text-xs outline-none focus:bg-white focus:border-rose-400 transition-all" placeholder="••••••••">
                    </div>
                    <div>
                        <label class="block text-[9px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Password Baru</label>
                        <input type="password" name="password_baru" class="w-full bg-slate-50/50 border border-slate-200 rounded-xl p-3 text-xs outline-none focus:bg-white focus:border-rose-400 transition-all" placeholder="••••••••">
                    </div>
                    <div>
                        <label class="block text-[9px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Ulangi Baru</label>
                        <input type="password" name="password_baru_confirmation" class="w-full bg-slate-50/50 border border-slate-200 rounded-xl p-3 text-xs outline-none focus:bg-white focus:border-rose-400 transition-all" placeholder="••••••••">
                    </div>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="pt-4">
                {{-- Ganti tombol submit lama Anda dengan ini --}}
                <button type="button" 
                        onclick="confirmSimpanProfil()" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-blue-600/20 transition-all duration-200 active:scale-95 border border-blue-600 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>

        {{-- FORM TERPISAH UNTUK REQUEST HAPUS FOTO --}}
        <form id="form-hapus-foto" action="{{ route('murid.profil.hapus-foto') }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</dialog>

<script>
    function deleteProfilePhoto() {
        const modal = document.getElementById('modal-profil');
        modal.close();

        Swal.fire({
            title: 'Hapus Foto Wajah?',
            text: "Avatar Anda akan kembali menggunakan inisial nama.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f43f5e',
            cancelButtonColor: '#cbd5e1',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                confirmButton: 'bg-rose-500 hover:bg-rose-600 text-white px-5 py-2.5 rounded-xl text-xs font-bold shadow-md transition-all',
                cancelButton: 'bg-slate-100 hover:bg-slate-200 text-slate-600 px-5 py-2.5 rounded-xl text-xs font-bold transition-all'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menghapus...',
                    allowOutsideClick: false,
                    didOpen: () => { Swal.showLoading(); }
                });
                document.getElementById('form-hapus-foto').submit();
            } else {
                modal.showModal();
            }
        });
    }

    function confirmSimpanProfil() {
        const form = document.querySelector('form[action="{{ route("murid.profil.update") }}"]');
        const modal = document.getElementById('modal-profil');

        // Cek validasi HTML5 (required)
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        modal.close();

        Swal.fire({
            title: 'Simpan Perubahan?',
            text: "Data profil Anda akan diperbarui.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2563eb',
            confirmButtonText: 'Ya, Simpan',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                confirmButton: 'bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest shadow-md',
                cancelButton: 'bg-slate-100 hover:bg-slate-200 text-slate-600 px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({ title: 'Menyimpan...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
                form.submit();
            } else {
                modal.showModal(); // Buka kembali jika batal
            }
        });
    }
</script>
{{-- Skrip Alert Session --}}
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        confirmButtonText: 'Tutup',
        buttonsStyling: false,
        customClass: { confirmButton: 'bg-emerald-500 text-white px-8 py-3 rounded-xl text-xs font-black uppercase tracking-widest' }
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: "{{ session('error') }}",
        confirmButtonText: 'Coba Lagi',
        buttonsStyling: false,
        customClass: { confirmButton: 'bg-rose-500 text-white px-8 py-3 rounded-xl text-xs font-black uppercase tracking-widest' }
    });
</script>
@endif