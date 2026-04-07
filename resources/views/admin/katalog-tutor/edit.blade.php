<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pt-6 pb-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.tutor.detail', $tutor->id) }}" class="flex items-center justify-center w-10 h-10 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm group">
                    <svg class="w-5 h-5 text-slate-500 group-hover:text-rose-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </a>
                <div>
                    <p class="text-[10px] font-black text-orange-500 uppercase tracking-[0.25em] mb-1">Edit Data Profil</p>
                    <h2 class="font-black text-2xl text-slate-900 leading-tight tracking-tight">
                        {{ $tutor->user->name }}
                    </h2>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-6 md:px-8 pt-4 pb-32 relative z-10">
        <div class="bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden">
            <form action="{{ route('admin.tutor.update', $tutor->id) }}" method="POST" class="p-8 sm:p-10 space-y-10">
                @csrf
                @method('PUT')
                
                {{-- SECTION 1: DATA AKUN & PRIBADI --}}
                <div>
                    <h4 class="text-xs font-black text-blue-950 uppercase tracking-widest mb-6 flex items-center gap-3 border-b border-slate-100 pb-3">
                        <span class="w-6 h-6 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">1</span> 
                        Data Pribadi & Kontak
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $tutor->user->name) }}" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Email Aktif</label>
                            <input type="email" name="email" value="{{ old('email', $tutor->user->email) }}" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Nomor WhatsApp</label>
                            <input type="text" name="phone_number" value="{{ old('phone_number', $tutor->user->phone_number) }}" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600" required>
                        </div>
                        <div class="md:col-span-2 p-4 bg-amber-50 border border-amber-100 rounded-xl">
                            <label class="block text-[10px] font-black text-amber-700 uppercase tracking-widest mb-2">Reset Password (Opsional)</label>
                            <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password" class="w-full bg-white border-amber-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-amber-500 placeholder:font-normal placeholder:text-slate-400">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                                <option value="Laki-laki" {{ $tutor->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ $tutor->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $tutor->tempat_lahir) }}" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Tgl Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $tutor->tanggal_lahir) }}" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Alamat Domisili Lengkap</label>
                            <textarea name="alamat_domisili" rows="3" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">{{ old('alamat_domisili', $tutor->alamat_domisili) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- SECTION 2: LATAR BELAKANG --}}
                <div>
                    <h4 class="text-xs font-black text-blue-950 uppercase tracking-widest mb-6 flex items-center gap-3 border-b border-slate-100 pb-3">
                        <span class="w-6 h-6 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">2</span> 
                        Pendidikan & Pengalaman
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Pendidikan Terakhir</label>
                            <input type="text" name="pendidikan_terakhir" value="{{ old('pendidikan_terakhir', $tutor->pendidikan_terakhir) }}" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Asal Kampus / Sekolah</label>
                            <input type="text" name="instansi" value="{{ old('instansi', $tutor->instansi) }}" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Pengalaman Mengajar</label>
                            <textarea name="pengalaman" rows="4" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-medium text-slate-800 focus:ring-2 focus:ring-blue-600 leading-relaxed">{{ old('pengalaman', $tutor->pengalaman) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- SECTION 3: PREFERENSI MENGAJAR --}}
                <div>
                    <h4 class="text-xs font-black text-blue-950 uppercase tracking-widest mb-6 flex items-center gap-3 border-b border-slate-100 pb-3">
                        <span class="w-6 h-6 rounded-lg bg-orange-50 text-orange-500 flex items-center justify-center">3</span> 
                        Preferensi Mengajar
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Bidang Keahlian / Mata Pelajaran</label>
                            <input type="text" name="bidang" value="{{ old('bidang', $tutor->bidang) }}" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600" required>
                        </div>
                        
                        {{-- Konversi Array kembali jadi String dipisah koma untuk form --}}
                        @php
                            $tingkatStr = is_array($tutor->tingkat_siswa) ? implode(', ', $tutor->tingkat_siswa) : (is_array(json_decode($tutor->tingkat_siswa, true)) ? implode(', ', json_decode($tutor->tingkat_siswa, true)) : $tutor->tingkat_siswa);
                            $metodeStr = is_array($tutor->metode) ? implode(', ', $tutor->metode) : (is_array(json_decode($tutor->metode, true)) ? implode(', ', json_decode($tutor->metode, true)) : $tutor->metode);
                            $hariStr = is_array($tutor->hari) ? implode(', ', $tutor->hari) : (is_array(json_decode($tutor->hari, true)) ? implode(', ', json_decode($tutor->hari, true)) : $tutor->hari);
                        @endphp

                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Tingkat Siswa <span class="normal-case text-slate-400 font-normal">(Pisahkan dengan koma)</span></label>
                            <input type="text" name="tingkat_siswa" value="{{ old('tingkat_siswa', $tingkatStr) }}" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Metode Mengajar <span class="normal-case text-slate-400 font-normal">(Pisahkan dengan koma)</span></label>
                            <input type="text" name="metode" value="{{ old('metode', $metodeStr) }}" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Hari Tersedia <span class="normal-case text-slate-400 font-normal">(Pisahkan dengan koma)</span></label>
                            <input type="text" name="hari" value="{{ old('hari', $hariStr) }}" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Jam Tersedia</label>
                            <input type="text" name="jam" value="{{ old('jam', $tutor->jam) }}" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Area Mengajar (Kecamatan Offline)</label>
                            <input type="text" name="area" value="{{ old('area', $tutor->area) }}" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-600">
                        </div>
                        <div class="md:col-span-2 mt-4 p-5 bg-blue-50 border-2 border-blue-100 rounded-2xl">
                            <label class="block text-[10px] font-black text-blue-800 uppercase tracking-widest mb-2">Status Akun Tutor</label>
                            <select name="status_akun" class="w-full bg-white border-blue-200 rounded-xl text-sm font-black text-blue-900 focus:ring-2 focus:ring-blue-600 shadow-sm py-3">
                                <option value="aktif" {{ $tutor->status_akun == 'aktif' ? 'selected' : '' }}>🟢 AKTIF (Tampil di Katalog & Siap Mengajar)</option>
                                <option value="pending" {{ $tutor->status_akun == 'pending' ? 'selected' : '' }}>🟡 PENDING (Disembunyikan sementara)</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- TOMBOL SUBMIT --}}
                <div class="pt-8 mt-8 border-t border-slate-200 flex justify-end gap-4">
                    <a href="{{ route('admin.tutor.detail', $tutor->id) }}" class="bg-white border border-slate-300 text-slate-600 hover:bg-slate-50 hover:text-rose-500 px-8 py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                        Batalkan
                    </a>
                    <button type="submit" class="bg-blue-950 hover:bg-orange-500 text-white px-10 py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-blue-900/20 transition-all">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- ======================================================== --}}
    {{-- MODAL NOTIFIKASI (SUKSES / GAGAL) --}}
    {{-- ======================================================== --}}
    @if(session('success') || session('error'))
    <div x-data="{ open: true }" x-show="open" style="display: none;" class="relative z-[150]" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div x-show="open" x-transition.opacity class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div x-show="open" 
                    @click.away="open = false" 
                    x-transition:enter="ease-out duration-300" 
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                    x-transition:leave="ease-in duration-200" 
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                    class="relative transform overflow-hidden rounded-3xl bg-white text-center shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-sm border border-slate-100">
                    
                    <div class="bg-white px-6 pb-6 pt-8 sm:p-8">
                        {{-- Tampilan Jika Sukses --}}
                        @if(session('success'))
                            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-emerald-50 border-4 border-emerald-100 mb-5">
                                <svg class="h-10 w-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight mb-2">Berhasil!</h3>
                            <p class="text-sm text-slate-500 font-medium leading-relaxed">{{ session('success') }}</p>
                        @endif

                        {{-- Tampilan Jika Error/Gagal --}}
                        @if(session('error'))
                            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-rose-50 border-4 border-rose-100 mb-5">
                                <svg class="h-10 w-10 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                            </div>
                            <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight mb-2">Terjadi Kesalahan</h3>
                            <p class="text-sm text-slate-500 font-medium leading-relaxed">{{ session('error') }}</p>
                        @endif
                        
                        <div class="mt-8">
                            <button type="button" @click="open = false" class="w-full bg-blue-950 hover:bg-blue-800 text-white px-6 py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg transition-all">
                                Mengerti
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>