<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4 pt-4 pb-2">
            <a href="{{ route('admin.tutor.detail', $tutor->id) }}"
                class="flex items-center justify-center w-10 h-10 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm group">
                <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </a>
            <div>
                <div class="inline-flex items-center gap-2 bg-orange-50 border border-orange-100 px-3 py-1 rounded-full mb-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span>
                    <p class="text-[10px] font-black text-orange-600 uppercase tracking-[0.2em]">Edit Data Tutor</p>
                </div>
                <h2 class="font-black text-2xl text-slate-900 leading-tight tracking-tight">{{ $tutor->user->name }}</h2>
            </div>
        </div>
    </x-slot>

    {{-- ============================================================ --}}
    {{-- x-data ADA DI SINI (wrapper terluar) agar semua modal bisa   --}}
    {{-- mengakses variabel Alpine dari dalam maupun luar <form>       --}}
    {{-- ============================================================ --}}
    <div x-data="{ showConfirm: false, showConfirmDeactivate: false, showConfirmDeletePhoto: false }">

        <div class="max-w-4xl mx-auto px-4 md:px-8 pt-6 pb-16">

            {{-- ============================================================ --}}
            {{-- FORM UTAMA — hanya berisi field data tutor                   --}}
            {{-- TIDAK ADA form lain di dalam sini                            --}}
            {{-- ============================================================ --}}
            <form id="form-edit-tutor" action="{{ route('admin.tutor.update', $tutor->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-5">

                    {{-- ===== SECTION FOTO PROFIL ===== --}}
                    <div class="sm:col-span-2 flex items-center gap-6 p-4 bg-slate-50 border border-slate-200 rounded-2xl">
                        <div class="relative group">
                            @if($tutor->user->profile_photo_path)
                                <img src="{{ asset('storage/' . $tutor->user->profile_photo_path) }}"
                                    class="w-20 h-20 rounded-2xl object-cover border-4 border-white shadow-md">
                            @else
                                <div class="w-20 h-20 rounded-2xl bg-slate-200 flex items-center justify-center border-4 border-white shadow-md">
                                    <svg class="w-8 h-8 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Foto Profil Tutor</label>
                            @if($tutor->user->profile_photo_path)
                                {{-- Tombol ini sekarang membuka modal Alpine, bukan confirm() browser --}}
                                <button type="button"
                                        @click="showConfirmDeletePhoto = true"
                                        class="px-4 py-2 bg-rose-50 hover:bg-rose-100 text-rose-600 text-[10px] font-black uppercase tracking-widest rounded-lg transition-all w-fit">
                                    Hapus Foto
                                </button>
                            @else
                                <p class="text-[10px] font-bold text-slate-400">Belum ada foto yang diunggah.</p>
                            @endif
                        </div>
                    </div>

                    {{-- ===== SECTION 1: DATA PRIBADI ===== --}}
                    <div class="bg-white rounded-[1.5rem] border border-slate-200 shadow-sm overflow-hidden">
                        <div class="flex items-center gap-3 px-6 py-4 border-b border-slate-100 bg-slate-50/60">
                            <div class="w-7 h-7 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center shrink-0">
                                <span class="text-[11px] font-black text-blue-600">1</span>
                            </div>
                            <h4 class="text-xs font-black text-slate-700 uppercase tracking-widest">Data Pribadi & Kontak</h4>
                        </div>
                        <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">

                            <div class="sm:col-span-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $tutor->user->name) }}"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-800 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('name') border-rose-400 ring-1 ring-rose-400 @enderror" required>
                                @error('name')<p class="text-[10px] font-bold text-rose-500 mt-1.5 uppercase tracking-wider">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Email Aktif</label>
                                <input type="email" name="email" value="{{ old('email', $tutor->user->email) }}"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-800 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('email') border-rose-400 ring-1 ring-rose-400 @enderror" required>
                                @error('email')<p class="text-[10px] font-bold text-rose-500 mt-1.5 uppercase tracking-wider">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Nomor WhatsApp</label>
                                <input type="text" name="phone_number" value="{{ old('phone_number', $tutor->user->phone_number) }}"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-800 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('phone_number') border-rose-400 ring-1 ring-rose-400 @enderror">
                                @error('phone_number')<p class="text-[10px] font-bold text-rose-500 mt-1.5 uppercase tracking-wider">{{ $message }}</p>@enderror
                            </div>

                            <div class="sm:col-span-2 bg-amber-50 border border-amber-100 rounded-xl p-4">
                                <label class="block text-[10px] font-black text-amber-700 uppercase tracking-widest mb-1.5">
                                    Reset Password
                                    <span class="font-medium normal-case tracking-normal text-amber-500 ml-1">(Opsional — kosongkan jika tidak ingin diubah)</span>
                                </label>
                                <input type="password" name="password" placeholder="••••••••"
                                    class="w-full bg-white border border-amber-200 rounded-xl text-sm font-bold text-slate-800 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-amber-400 placeholder:font-normal placeholder:text-slate-400 transition-all @error('password') border-rose-400 ring-1 ring-rose-400 @enderror">
                                @error('password')<p class="text-[10px] font-bold text-rose-500 mt-1.5 uppercase tracking-wider">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Jenis Kelamin</label>
                                <select name="jenis_kelamin"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-800 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                    <option value="Laki-laki" {{ $tutor->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ $tutor->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $tutor->tempat_lahir) }}"
                                        class="w-full bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-800 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Tgl Lahir</label>
                                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $tutor->tanggal_lahir) }}"
                                        class="w-full bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-800 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Alamat Domisili Lengkap</label>
                                <textarea name="alamat_domisili" rows="2"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-800 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none">{{ old('alamat_domisili', $tutor->alamat_domisili) }}</textarea>
                            </div>

                        </div>
                    </div>

                    {{-- ===== SECTION 2: PENDIDIKAN & PENGALAMAN ===== --}}
                    <div class="bg-white rounded-[1.5rem] border border-slate-200 shadow-sm overflow-hidden">
                        <div class="flex items-center gap-3 px-6 py-4 border-b border-slate-100 bg-slate-50/60">
                            <div class="w-7 h-7 rounded-lg bg-emerald-50 border border-emerald-100 flex items-center justify-center shrink-0">
                                <span class="text-[11px] font-black text-emerald-600">2</span>
                            </div>
                            <h4 class="text-xs font-black text-slate-700 uppercase tracking-widest">Pendidikan & Pengalaman</h4>
                        </div>
                        <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">

                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Pendidikan Terakhir</label>
                                <input type="text" name="pendidikan_terakhir" value="{{ old('pendidikan_terakhir', $tutor->pendidikan_terakhir) }}"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-800 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Asal Kampus / Sekolah</label>
                                <input type="text" name="instansi" value="{{ old('instansi', $tutor->instansi) }}"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-800 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Bidang Keahlian / Mata Pelajaran</label>
                                <input type="text" name="bidang" value="{{ old('bidang', $tutor->bidang) }}"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-800 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('bidang') border-rose-400 ring-1 ring-rose-400 @enderror" required>
                                @error('bidang')<p class="text-[10px] font-bold text-rose-500 mt-1.5 uppercase tracking-wider">{{ $message }}</p>@enderror
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Pengalaman Mengajar</label>
                                <textarea name="pengalaman" rows="4"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 leading-relaxed transition-all resize-none">{{ old('pengalaman', $tutor->pengalaman) }}</textarea>
                            </div>

                        </div>
                    </div>

                    {{-- ===== SECTION 3: STATUS AKUN & DOKUMEN ===== --}}
                    <div class="bg-white rounded-[1.5rem] border border-slate-200 shadow-sm overflow-hidden">
                        <div class="flex items-center gap-3 px-6 py-4 border-b border-slate-100 bg-slate-50/60">
                            <div class="w-7 h-7 rounded-lg bg-violet-50 border border-violet-100 flex items-center justify-center shrink-0">
                                <span class="text-[11px] font-black text-violet-600">3</span>
                            </div>
                            <h4 class="text-xs font-black text-slate-700 uppercase tracking-widest">Status Akun & Dokumen</h4>
                        </div>
                        <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">

                            <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                                <label class="block text-[10px] font-black text-blue-800 uppercase tracking-widest mb-1.5">Status Akun Tutor</label>
                                <select name="status_akun"
                                    class="w-full bg-white border border-blue-200 rounded-xl text-sm font-black text-blue-900 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                    <option value="aktif" {{ old('status_akun', $tutor->status_akun) == 'aktif' ? 'selected' : '' }}>🟢 AKTIF — Siap Mengajar</option>
                                    <option value="menunggu_mou" {{ old('status_akun', $tutor->status_akun) == 'menunggu_mou' ? 'selected' : '' }}>🟡 Menunggu Verifikasi</option>
                                </select>
                            </div>

                            <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Link Google Drive (Silabus & MoU)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                        </svg>
                                    </div>
                                    <input type="url" name="link_gdrive" value="{{ old('link_gdrive', $tutor->link) }}"
                                        placeholder="https://drive.google.com/..."
                                        class="w-full bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-800 pl-10 pr-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all placeholder:font-normal placeholder:text-slate-400 @error('link_gdrive') border-rose-400 ring-1 ring-rose-400 @enderror">
                                </div>
                                @error('link_gdrive')<p class="text-[10px] font-bold text-rose-500 mt-1.5 uppercase tracking-wider">{{ $message }}</p>@enderror
                            </div>

                        </div>

                        {{-- ===== TOMBOL AKSI ===== --}}
                        <div class="flex flex-col sm:flex-row items-center justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50/60">
                            <button type="button" @click="showConfirmDeactivate = true"
                                class="w-full sm:w-auto text-center bg-amber-50 border border-amber-200 text-amber-700 hover:bg-amber-100 px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                                Nonaktifkan Akun
                            </button>
                            <button type="button" @click="showConfirm = true"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-blue-600/20 active:scale-95 transition-all">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>

                </div>
            </form>
            {{-- ============================================================ --}}
            {{-- AKHIR FORM UTAMA                                             --}}
            {{-- ============================================================ --}}

            {{-- ============================================================ --}}
            {{-- FORM-FORM TERSEMBUNYI — di LUAR form utama, tidak nested      --}}
            {{-- ============================================================ --}}

            {{-- Form hapus foto --}}
            <form id="form-delete-photo" action="{{ route('admin.tutor.hapus-foto', $tutor->id) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>

            {{-- Form nonaktifkan --}}
            <form id="form-nonaktifkan" action="{{ route('admin.tutor.nonaktifkan', $tutor->id) }}" method="POST" class="hidden">
                @csrf
                @method('PATCH')
            </form>

        </div>{{-- end max-w-4xl --}}


        {{-- ============================================================ --}}
        {{-- MODAL KONFIRMASI HAPUS FOTO (BARU)                           --}}
        {{-- ============================================================ --}}
        <div x-show="showConfirmDeletePhoto" style="display: none;" class="relative z-[150]" role="dialog" aria-modal="true">
            <div x-show="showConfirmDeletePhoto" x-transition.opacity class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
            <div class="fixed inset-0 z-10 flex items-center justify-center p-4">
                <div x-show="showConfirmDeletePhoto"
                    @click.away="showConfirmDeletePhoto = false"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="bg-white rounded-3xl shadow-2xl border border-slate-100 w-full max-w-sm">
                    <div class="px-6 pb-6 pt-8 text-center">

                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-rose-50 border-4 border-rose-100 mb-5">
                            <svg class="h-10 w-10 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </div>

                        <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight mb-2">Hapus Foto Profil?</h3>
                        <p class="text-sm text-slate-500 font-medium leading-relaxed">Foto profil tutor ini akan dihapus permanen dan tidak bisa dikembalikan.</p>

                        <div class="mt-8 flex gap-3">
                            <button type="button" @click="showConfirmDeletePhoto = false"
                                class="w-full bg-slate-100 hover:bg-slate-200 text-slate-600 px-6 py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                                Batal
                            </button>
                            {{-- Submit form hapus foto via atribut form="..." --}}
                            <button type="submit" form="form-delete-photo"
                                class="w-full bg-rose-600 hover:bg-rose-700 text-white px-6 py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-rose-600/20 transition-all">
                                Ya, Hapus
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- ============================================================ --}}
        {{-- MODAL KONFIRMASI SIMPAN                                       --}}
        {{-- ============================================================ --}}
        <div x-show="showConfirm" style="display: none;" class="relative z-[150]" role="dialog" aria-modal="true">
            <div x-show="showConfirm" x-transition.opacity class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
            <div class="fixed inset-0 z-10 flex items-center justify-center p-4">
                <div x-show="showConfirm"
                    @click.away="showConfirm = false"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="bg-white rounded-3xl shadow-2xl border border-slate-100 w-full max-w-sm">
                    <div class="px-6 pb-6 pt-8 text-center">

                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-blue-50 border-4 border-blue-100 mb-5">
                            <svg class="h-10 w-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>

                        <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight mb-2">Simpan Perubahan?</h3>
                        <p class="text-sm text-slate-500 font-medium leading-relaxed">Pastikan semua data tutor yang Anda masukkan sudah benar.</p>

                        <div class="mt-8 flex gap-3">
                            <button type="button" @click="showConfirm = false"
                                class="w-full bg-slate-100 hover:bg-slate-200 text-slate-600 px-6 py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                                Batal
                            </button>
                            {{-- Submit form utama via atribut form="..." --}}
                            <button type="submit" form="form-edit-tutor"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-blue-600/20 transition-all">
                                Ya, Simpan
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- ============================================================ --}}
        {{-- MODAL KONFIRMASI NONAKTIFKAN                                  --}}
        {{-- ============================================================ --}}
        <div x-show="showConfirmDeactivate" style="display: none;" class="relative z-[150]" role="dialog" aria-modal="true">
            <div x-show="showConfirmDeactivate" x-transition.opacity class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
            <div class="fixed inset-0 z-10 flex items-center justify-center p-4">
                <div x-show="showConfirmDeactivate"
                    @click.away="showConfirmDeactivate = false"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="bg-white rounded-3xl shadow-2xl border border-slate-100 w-full max-w-sm">
                    <div class="px-6 pb-6 pt-8 text-center">

                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-amber-50 border-4 border-amber-100 mb-5">
                            <svg class="h-10 w-10 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>

                        <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight mb-2">Nonaktifkan Akun?</h3>
                        <p class="text-sm text-slate-500 font-medium leading-relaxed">Tutor tidak akan bisa lagi menerima pesanan baru setelah ini.</p>

                        <div class="mt-8 flex gap-3">
                            <button type="button" @click="showConfirmDeactivate = false"
                                class="w-full bg-slate-100 hover:bg-slate-200 text-slate-600 px-6 py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                                Batal
                            </button>
                            {{-- Submit form nonaktifkan via atribut form="..." --}}
                            <button type="submit" form="form-nonaktifkan"
                                class="w-full bg-amber-600 hover:bg-amber-700 text-white px-6 py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-amber-600/20 transition-all">
                                Ya, Nonaktifkan
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- ============================================================ --}}
        {{-- MODAL NOTIFIKASI (SUKSES / GAGAL DARI SESSION)                --}}
        {{-- ============================================================ --}}
        @if(session('success') || session('error'))
        <div x-data="{ open: true }" x-show="open" style="display: none;" class="relative z-[160]" role="dialog" aria-modal="true">
            <div x-show="open" x-transition.opacity class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
            <div class="fixed inset-0 z-10 flex items-center justify-center p-4">
                <div x-show="open"
                    @click.away="open = false"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="bg-white rounded-3xl shadow-2xl border border-slate-100 w-full max-w-sm">
                    <div class="px-6 pb-6 pt-8 text-center">

                        @if(session('success'))
                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-emerald-50 border-4 border-emerald-100 mb-5">
                            <svg class="h-10 w-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight mb-2">Berhasil!</h3>
                        <p class="text-sm text-slate-500 font-medium leading-relaxed">{{ session('success') }}</p>
                        @endif

                        @if(session('error'))
                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-rose-50 border-4 border-rose-100 mb-5">
                            <svg class="h-10 w-10 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight mb-2">Terjadi Kesalahan</h3>
                        <p class="text-sm text-slate-500 font-medium leading-relaxed">{{ session('error') }}</p>
                        @endif

                        <div class="mt-8">
                            <button type="button" @click="open = false"
                                class="w-full bg-blue-950 hover:bg-blue-800 text-white px-6 py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg transition-all">
                                Mengerti
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>{{-- end x-data --}}

</x-app-layout>