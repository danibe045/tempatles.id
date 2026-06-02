<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - tempatles.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 CSS & JS -->
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-pattern { background-image: radial-gradient(#cbd5e1 1.5px, transparent 1.5px); background-size: 28px 28px; }
        
        /* Custom Input Number */
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
        input[type=number] { -moz-appearance: textfield; }

        /* Meredupkan background di luar popup */
        .swal2-backdrop-show {
            backdrop-filter: blur(4px);
            background: rgba(15, 23, 42, 0.6) !important;
        }
    </style>
</head>

<body class="bg-[#F8FAFC] text-slate-900 antialiased flex flex-col min-h-screen relative overflow-x-hidden">
    <div class="fixed inset-0 bg-pattern opacity-40 z-[-1] pointer-events-none"></div>

    {{-- NAVBAR SUB-PAGE --}}
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-200/60 shadow-sm shrink-0">
        <div class="max-w-7xl mx-auto px-6 md:px-12 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <a href="/" class="flex items-center gap-2 group">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-8 md:h-9 transition-transform group-hover:scale-110">
                    <span class="font-black text-blue-950 text-xl tracking-tighter hidden sm:block">tempatles<span class="text-orange-500">.id</span></span>
                </a>
            </div>

            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="group flex items-center gap-2 bg-white hover:bg-slate-100 text-slate-700 px-5 py-2.5 rounded-full font-bold text-xs transition-all duration-300 border border-slate-200 shadow-sm">
                    <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span class="hidden sm:inline">Kembali ke Dashboard</span>
                    <span class="sm:hidden">Kembali</span>
                </a>
            </div>
        </div>
    </nav>

    {{-- FORM PASSWORD INVISIBLE (Untuk Ganti Password Saja) --}}
    <form id="form-password" action="{{ route('tutor.profile.password') }}" method="POST" class="hidden">
        @csrf @method('PATCH')
    </form>

    {{-- MAIN CONTENT --}}
    <main class="py-8 md:py-12 relative z-10 flex-grow">
        <div class="max-w-6xl mx-auto px-6 lg:px-8 w-full">

            {{-- HEADER HALAMAN --}}
            <div class="bg-blue-950 border border-blue-900 shadow-2xl shadow-blue-900/20 rounded-[2.5rem] p-8 md:p-10 mb-10 relative overflow-hidden">
                <div class="absolute -top-20 -right-20 w-80 h-80 bg-blue-500 rounded-full blur-[80px] opacity-40 pointer-events-none"></div>
                <div class="absolute -bottom-20 -left-10 w-64 h-64 bg-emerald-500 rounded-full blur-[80px] opacity-20 pointer-events-none"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-emerald-400 px-4 py-2 rounded-full mb-4 backdrop-blur-md">
                            <span class="text-[10px] font-black uppercase tracking-[0.25em] text-white">Pusat Akun</span>
                        </div>
                        <h2 class="font-black text-3xl md:text-4xl text-white leading-tight tracking-tight mb-2">Pengaturan Profil</h2>
                        <p class="text-sm text-blue-200 font-medium max-w-xl leading-relaxed">Perbarui informasi diri, latar belakang, dan kelola keamanan akun Anda di sini.</p>
                    </div>
                </div>
            </div>

            {{-- FORM PROFIL UTAMA MEMBUNGKUS SELURUH GRID KIRI & KANAN --}}
            <form id="form-profile" action="{{ route('tutor.profile.update') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                @csrf @method('PATCH')
                
                {{-- KOLOM KIRI (FOTO & PASSWORD) --}}
                <div class="lg:col-span-1 space-y-8">
                    
                    {{-- KARTU 1: FOTO PROFIL --}}
                    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm p-8 text-center relative overflow-hidden group hover:shadow-xl hover:border-blue-200 transition-all duration-300">
                        <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-b from-blue-50 to-white"></div>
                        
                        <div class="relative z-10">
                            <h3 class="font-black text-slate-800 mb-6 text-lg">Foto Profil</h3>
                            
                            {{-- Area Upload Foto --}}
                            <div class="relative w-40 h-40 mx-auto mb-6">
                                <div class="w-full h-full rounded-[2rem] border-4 border-white shadow-xl overflow-hidden bg-slate-100 relative group cursor-pointer ring-4 ring-slate-50 hover:ring-blue-100 transition-all" onclick="document.getElementById('foto_upload').click()">
                                    
                                    {{-- Preview Image --}}
                                    {{-- Preview Image --}}
                                    <img id="foto_preview" src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&color=1e293b&background=f1F5f9&size=200' }}" alt="Preview" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    
                                    {{-- Overlay Hover --}}
                                    <div class="absolute inset-0 bg-slate-900/50 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 backdrop-blur-[2px]">
                                        <svg class="w-8 h-8 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                        <span class="text-[10px] font-black text-white uppercase tracking-widest">Ubah Foto</span>
                                    </div>
                                </div>
                                <input type="file" id="foto_upload" name="foto" accept="image/*" class="hidden" onchange="previewImage(event)">
                            </div>

                            <p class="text-[11px] text-slate-500 font-medium leading-relaxed mb-5">Format: JPG, PNG, JPEG.<br>Maksimal ukuran file <span class="font-bold text-slate-700">2MB</span>.</p>
                            
                            <div class="bg-blue-50/50 text-blue-700 px-4 py-3 rounded-xl text-[10px] font-bold flex items-center justify-center gap-2 border border-blue-100 shadow-inner">
                                <svg class="w-4 h-4 shrink-0 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                                Status Akun: <span class="uppercase tracking-widest text-blue-800">{{ $user->tutorProfile->status_akun ?? 'Menunggu Verifikasi' }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- KARTU 2: GANTI PASSWORD --}}
                    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm p-8 hover:shadow-xl hover:border-rose-200 transition-all duration-300">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                            <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-500 flex items-center justify-center border border-rose-100 shadow-inner">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            </div>
                            <h3 class="text-lg font-black text-slate-800">Ubah Password</h3>
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Password Saat Ini</label>
                                <input type="password" name="current_password" form="form-password" required placeholder="••••••••" class="w-full bg-slate-50 hover:bg-slate-100/50 border border-slate-200 rounded-xl p-3.5 text-sm font-bold text-slate-900 focus:bg-white focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition-all outline-none shadow-inner placeholder:text-slate-300">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Password Baru</label>
                                <input type="password" name="password" form="form-password" required placeholder="Minimal 8 karakter" class="w-full bg-slate-50 hover:bg-slate-100/50 border border-slate-200 rounded-xl p-3.5 text-sm font-bold text-slate-900 focus:bg-white focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition-all outline-none shadow-inner placeholder:text-slate-300">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" form="form-password" required placeholder="Ketik ulang password baru" class="w-full bg-slate-50 hover:bg-slate-100/50 border border-slate-200 rounded-xl p-3.5 text-sm font-bold text-slate-900 focus:bg-white focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition-all outline-none shadow-inner placeholder:text-slate-300">
                            </div>

                            <div class="pt-4">
                                <button type="button" onclick="confirmPasswordUpdate()" class="w-full bg-rose-500 hover:bg-rose-600 text-white py-3.5 rounded-xl text-xs font-black uppercase tracking-widest shadow-lg shadow-rose-500/30 active:scale-95 transition-all flex items-center justify-center gap-2">
                                    Update Password
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- KOLOM KANAN (FORM BIODATA) --}}
                <div class="lg:col-span-2 space-y-8">
                    
                    {{-- Card 3: Informasi Dasar --}}
                    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm p-8 hover:shadow-xl hover:border-blue-200 transition-all duration-300">
                        <div class="flex items-center gap-3 mb-8 pb-4 border-b border-slate-100">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center border border-blue-100 shadow-inner">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </div>
                            <h3 class="text-lg font-black text-slate-800">Informasi Pribadi</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Nama Lengkap <span class="text-rose-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" required placeholder="Nama Lengkap Anda" class="w-full bg-slate-50 hover:bg-slate-100/50 border border-slate-200 rounded-xl p-4 text-sm font-bold text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none shadow-inner placeholder:font-medium placeholder:text-slate-300">
                            </div>
                            
                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Alamat Email <span class="text-slate-400 normal-case tracking-normal font-medium">(Login)</span></label>
                                <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required class="w-full bg-slate-100 border border-slate-200 rounded-xl p-4 text-sm font-bold text-slate-400 cursor-not-allowed outline-none focus:ring-0" readonly title="Email tidak dapat diubah">
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Nomor WhatsApp <span class="text-rose-500">*</span></label>
                                <div class="flex shadow-inner rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-blue-500 focus-within:border-blue-500 transition-all">
                                    <span class="inline-flex items-center px-4 bg-slate-100 border border-r-0 border-slate-200 text-xs font-black text-slate-500">+62</span>
                                    <input type="number" name="no_wa" value="{{ old('no_wa', $user->phone_number ?? '') }}" required placeholder="8123456789" class="w-full bg-slate-50 hover:bg-slate-100/50 border border-slate-200 border-l-0 p-4 text-sm font-bold text-slate-900 outline-none placeholder:font-medium placeholder:text-slate-300">
                                </div>
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Bidang Keahlian <span class="text-rose-500">*</span></label>
                                <input type="text" name="bidang" value="{{ old('bidang', $user->tutorProfile->bidang ?? '') }}" required placeholder="Cth: Matematika, Bahasa Inggris" class="w-full bg-slate-50 hover:bg-slate-100/50 border border-slate-200 rounded-xl p-4 text-sm font-bold text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none shadow-inner placeholder:font-medium placeholder:text-slate-300">
                            </div>
                        </div>
                    </div>

                    {{-- Card 4: Latar Belakang --}}
                    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm p-8 hover:shadow-xl hover:border-orange-200 transition-all duration-300">
                        <div class="flex items-center gap-3 mb-8 pb-4 border-b border-slate-100">
                            <div class="w-8 h-8 rounded-lg bg-orange-50 text-orange-500 flex items-center justify-center border border-orange-100 shadow-inner">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 14l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6" /></svg>
                            </div>
                            <h3 class="text-lg font-black text-slate-800">Latar Belakang</h3>
                        </div>

                        <div class="grid grid-cols-1 gap-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">
                                        Pendidikan Terakhir <span class="text-rose-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="text" 
                                            name="pendidikan" 
                                            value="{{ old('pendidikan', $user->tutorProfile->pendidikan_terakhir ?? '') }}" 
                                            placeholder="Contoh: S1 Teknik Informatika"
                                            class="w-full bg-slate-50 hover:bg-slate-100/50 border border-slate-200 rounded-xl p-4 text-sm font-bold text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none shadow-inner"
                                            required>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Asal Universitas / Sekolah <span class="text-rose-500">*</span></label>
                                    <input type="text" name="universitas" value="{{ old('universitas', $user->tutorProfile->instansi ?? '') }}" required placeholder="Cth: Universitas Indonesia" class="w-full bg-slate-50 hover:bg-slate-100/50 border border-slate-200 rounded-xl p-4 text-sm font-bold text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none shadow-inner placeholder:font-medium placeholder:text-slate-300">
                                </div>
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 flex items-center justify-between">
                                    <span>Bio Singkat / Tentang Anda <span class="text-rose-500">*</span></span>
                                </label>
                                <textarea name="bio" rows="5" required placeholder="Ceritakan pengalaman mengajar, metode, dan karakter Anda kepada calon murid..." class="w-full bg-slate-50 hover:bg-slate-100/50 border border-slate-200 rounded-xl p-4 text-sm font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none resize-none shadow-inner placeholder:text-slate-400 placeholder:font-normal leading-relaxed">{{ old('bio', $user->tutorProfile->pengalaman ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Submit Form Profil --}}
                    <div class="pt-4 pb-10 md:pb-0">
                        <button type="button" onclick="confirmProfileUpdate()" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl text-sm font-black uppercase tracking-widest shadow-xl shadow-blue-600/30 active:scale-95 transition-all flex items-center justify-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                            Simpan Perubahan Profil
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </main>

    <footer class="mt-auto py-10 border-t border-slate-200 bg-white relative z-10">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em]">Hak Cipta Pengajar &copy; {{ date('Y') }} tempatles.id</p>
        </div>
    </footer>

    {{-- Script & SweetAlert2 Kustom --}}
    <script>
        // Custom Tailwind Styling untuk SweetAlert biar nyambung sama UI
        const customSwalClasses = {
            popup: 'rounded-[2rem] p-6 border border-slate-100 shadow-2xl',
            title: 'text-2xl font-black text-slate-800 tracking-tight',
            htmlContainer: 'text-sm font-medium text-slate-500 mt-2',
            confirmButton: 'bg-blue-600 hover:bg-blue-700 text-white px-8 py-3.5 rounded-xl text-sm font-bold tracking-wide transition-all shadow-lg shadow-blue-500/30 w-full sm:w-auto',
            cancelButton: 'bg-slate-100 hover:bg-slate-200 text-slate-600 px-8 py-3.5 rounded-xl text-sm font-bold tracking-wide transition-all w-full sm:w-auto',
            actions: 'flex flex-col sm:flex-row gap-3 w-full sm:w-auto justify-center mt-6'
        };

        // Preview & Pengecekan Ukuran Foto (Maksimal 2MB)
        function previewImage(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const file = input.files[0];
                
                // Cek Ukuran File (2MB = 2 * 1024 * 1024 bytes)
                if (file.size > 2097152) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Maaf, Foto Anda Kebesaran! 😅',
                        text: 'Maksimal ukuran foto adalah 2MB ya Kak. Yuk di-compress sedikit atau pilih foto yang lain.',
                        customClass: customSwalClasses,
                        buttonsStyling: false,
                        confirmButtonText: 'Oke'
                    });
                    input.value = ''; // Reset inputan file
                    return;
                }

                // Lanjut Preview Jika Aman
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('foto_preview').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }

        // SweetAlert2 Konfirmasi Update Profil (Versi Human-Friendly)
        function confirmProfileUpdate() {
            Swal.fire({
                title: 'Sudah Yakin Dengan Perubahan ini?',
                text: "Pastikan nama, bio, dan foto profilmu sudah sesuai!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Tidak, Batal',
                reverseButtons: true,
                customClass: customSwalClasses,
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menyimpan...',
                        text: 'Sedang menyimpan data. Tunggu sebentar',
                        allowOutsideClick: false,
                        customClass: { popup: customSwalClasses.popup, title: customSwalClasses.title, htmlContainer: customSwalClasses.htmlContainer },
                        buttonsStyling: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    document.getElementById('form-profile').submit();
                }
            });
        }

        // SweetAlert2 Konfirmasi Update Password (Versi Human-Friendly)
        function confirmPasswordUpdate() {
            Swal.fire({
                title: 'Ganti Kata Sandi?',
                text: "Kamu akan mengubah kata sandi untuk login akun ini. Pastikan kamu ingat password barunya!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ganti Sekarang',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    ...customSwalClasses,
                    confirmButton: 'bg-rose-500 hover:bg-rose-600 text-white px-8 py-3.5 rounded-xl text-sm font-bold tracking-wide transition-all shadow-lg shadow-rose-500/30 w-full sm:w-auto',
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memperbarui...',
                        text: 'Tunggu sebentar, Sedang melakukan perubahan kata sandi',
                        allowOutsideClick: false,
                        customClass: { popup: customSwalClasses.popup, title: customSwalClasses.title, htmlContainer: customSwalClasses.htmlContainer },
                        buttonsStyling: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    document.getElementById('form-password').submit();
                }
            });
        }
    </script>

    {{-- ALERT BERHASIL / GAGAL DARI CONTROLLER (MENYATU DENGAN DESAIN) --}}
    @if(session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonText: 'Tutup',
                customClass: {
                    ...customSwalClasses,
                    confirmButton: 'bg-emerald-500 hover:bg-emerald-600 text-white px-8 py-3.5 rounded-xl text-sm font-bold tracking-wide transition-all shadow-lg shadow-emerald-500/30 w-full sm:w-auto'
                },
                buttonsStyling: false
            });
        });
    </script>
    @endif

    @if($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'error',
                title: 'Gagal Menyimpan',
                html: "<div class='text-left p-4 bg-rose-50 rounded-xl border border-rose-100 text-rose-600 mt-2 text-xs font-bold leading-relaxed'>{!! implode('<br>• ', $errors->all()) !!}</div>", 
                confirmButtonText: 'Tutup',
                customClass: {
                    ...customSwalClasses,
                    confirmButton: 'bg-rose-500 hover:bg-rose-600 text-white px-8 py-3.5 rounded-xl text-sm font-bold tracking-wide transition-all shadow-lg shadow-rose-500/30 w-full sm:w-auto'
                },
                buttonsStyling: false
            });
        });
    </script>
    @endif
</body>
</html>