@php
$role = request()->query('role', 'murid');
@endphp

@if($role === 'tutor')
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Tutor - tempatles.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .bg-pattern {
        background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
        background-size: 20px 20px;
    }

    .step-hidden {
        display: none;
    }

    .step-active {
        animation: fadeIn 0.4s ease-out forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 antialiased flex flex-col min-h-screen relative">
    <div class="fixed inset-0 bg-pattern opacity-30 z-[-1] pointer-events-none"></div>

    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-lg border-b border-slate-200/60 shadow-sm">
        <div class="max-w-5xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-8 h-8">
                <span class="font-black text-blue-950 text-xl tracking-tight hidden sm:block">tempatles<span
                        class="text-orange-500">.id</span></span>
            </a>
            <a href="/" class="text-xs font-bold text-slate-500 hover:text-rose-500 transition-colors">Batal &
                Kembali</a>
        </div>
    </nav>

    <main class="w-full max-w-4xl mx-auto px-6 py-12 relative z-10">
        <div class="text-center mb-10">
            <h2 class="text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">Bergabung Sebagai Pengajar</h2>
            <p class="text-slate-500 mt-2 font-medium">Isi biodata lengkap Anda dalam 2 langkah mudah.</p>
        </div>

        {{-- ALERT ERROR VALIDASI DARI LARAVEL --}}
        @if ($errors->any())
        <div class="mb-8 bg-rose-50 border border-rose-200 p-5 rounded-2xl shadow-sm animate-pulse">
            <div class="flex items-center gap-3 mb-2">
                <svg class="w-6 h-6 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <h3 class="font-black text-rose-800 text-sm uppercase tracking-widest">Pendaftaran Gagal</h3>
            </div>
            <p class="text-xs font-bold text-rose-600 mb-2">Ada isian yang terlewat atau tidak sesuai. Mohon cek
                peringatan di bawah ini (Cek Step 1 dan Step 2):</p>
            <ul class="list-disc pl-9 text-xs font-semibold text-rose-600 space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Progress Bar Indicator --}}
        <div class="flex items-center justify-between mb-8 relative max-w-xl mx-auto">
            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-1 bg-slate-200 rounded-full z-0"></div>
            <div id="progress-line"
                class="absolute left-0 top-1/2 -translate-y-1/2 w-1/2 h-1 bg-blue-600 rounded-full z-0 transition-all duration-300">
            </div>

            <div class="relative z-10 flex flex-col items-center gap-2">
                <div id="ind-1"
                    class="w-8 h-8 rounded-full bg-blue-600 text-white font-black flex items-center justify-center text-xs shadow-md ring-4 ring-slate-50 transition-all duration-300">
                    1</div>
                <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest">Akun & Biodata</span>
            </div>
            <div class="relative z-10 flex flex-col items-center gap-2">
                <div id="ind-2"
                    class="w-8 h-8 rounded-full bg-slate-200 text-slate-500 font-black flex items-center justify-center text-xs ring-4 ring-slate-50 transition-all duration-300">
                    2</div>
                <span id="text-ind-2"
                    class="text-[10px] font-bold text-slate-400 uppercase tracking-widest transition-colors duration-300">Legalitas</span>
            </div>
        </div>

        {{-- FORM UTAMA --}}
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="hidden" name="role" value="tutor">

            {{-- ================= STEP 1: AKUN & BIODATA ================= --}}
            <div id="step-1"
                class="bg-white p-8 lg:p-10 rounded-[2.5rem] border border-slate-200 shadow-sm step-active">
                <h3 class="text-lg font-black text-slate-800 border-b border-slate-100 pb-4 mb-6">Informasi Akun &
                    Pribadi</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Nama
                            Lengkap (Sesuai KTP)</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold"
                            required />
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Email
                            Aktif</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold"
                            required />
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Nomor
                            WhatsApp Aktif</label>
                        <input type="number" id="phone_number" name="phone_number" value="{{ old('phone_number') }}"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold"
                            required />
                    </div>

                    <div>
                        <label
                            class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Password
                            Akun</label>
                        <div class="relative">
                            <input type="password" id="password" name="password"
                                class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold pr-10"
                                required />
                            <button type="button" onclick="togglePassword('password', 'eye-icon-1')"
                                class="absolute inset-y-0 right-0 px-3 flex items-center text-slate-400 hover:text-blue-600 transition-colors">
                                <svg id="eye-icon-1" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label
                            class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Konfirmasi
                            Password</label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold pr-10"
                                required />
                            <button type="button" onclick="togglePassword('password_confirmation', 'eye-icon-2')"
                                class="absolute inset-y-0 right-0 px-3 flex items-center text-slate-400 hover:text-blue-600 transition-colors">
                                <svg id="eye-icon-2" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Jenis
                            Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold"
                            required>
                            <option value="" disabled {{ old('jenis_kelamin') ? '' : 'selected' }}>Pilih...</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Tempat
                            Lahir</label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold"
                            required />
                    </div>
                    <div>
                        <label
                            class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Tanggal
                            Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold"
                            required />
                    </div>
                    <div class="md:col-span-3">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Alamat
                            Domisili Lengkap</label>
                        <textarea id="alamat_domisili" name="alamat_domisili" rows="2"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-medium"
                            placeholder="Nama Jalan, RT/RW, Kec, Kota..."
                            required>{{ old('alamat_domisili') }}</textarea>
                    </div>
                </div>

                <div class="mt-8 flex justify-end border-t border-slate-100 pt-6">
                    <button type="button" onclick="nextStep()"
                        class="bg-blue-950 hover:bg-blue-800 text-white px-8 py-4 rounded-2xl transition-all text-xs font-black uppercase tracking-widest shadow-lg flex items-center gap-2">
                        Lanjut ke Step 2
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- ================= STEP 2: LEGALITAS & JADWAL ================= --}}
            <div id="step-2"
                class="bg-white p-8 lg:p-10 rounded-[2.5rem] border border-slate-200 shadow-sm step-hidden">

                {{-- Latar Belakang --}}
                <h3 class="text-lg font-black text-slate-800 border-b border-slate-100 pb-4 mb-6">Latar Belakang
                    Pendidikan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label
                            class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Pendidikan
                            Terakhir</label>
                        <input type="text" name="pendidikan_terakhir" value="{{ old('pendidikan_terakhir') }}"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold"
                            placeholder="Cth: S1 Teknik Kimia" required />
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Asal
                            Kampus / Sekolah</label>
                        <input type="text" name="instansi" value="{{ old('instansi') }}"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold"
                            placeholder="Cth: ITB" required />
                    </div>
                    <div class="md:col-span-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Spesialisasi
                            Bidang</label>
                        <input type="text" name="bidang" value="{{ old('bidang') }}"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold"
                            placeholder="Cth: Matematika & Fisika" required />
                    </div>
                    <div class="md:col-span-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Pengalaman
                            Mengajar</label>
                        <textarea name="pengalaman" rows="3"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-medium resize-none"
                            placeholder="Ceritakan riwayat mengajarmu..." required>{{ old('pengalaman') }}</textarea>
                    </div>
                </div>

                {{-- Preferensi Mengajar --}}
                <h3 class="text-lg font-black text-slate-800 border-b border-slate-100 pb-4 mb-6 mt-8">Preferensi
                    Mengajar</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label
                            class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Tingkat
                            Siswa</label>
                        <input type="text" name="tingkat_siswa" value="{{ old('tingkat_siswa') }}"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold"
                            placeholder="Cth: SD, SMP, Umum" required />
                        <p class="text-[9px] text-slate-400 mt-1">*Pisahkan dengan koma</p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Metode
                            Mengajar</label>
                        <input type="text" name="metode" value="{{ old('metode') }}"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold"
                            placeholder="Cth: Online, Offline" required />
                        <p class="text-[9px] text-slate-400 mt-1">*Pisahkan dengan koma</p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Hari
                            Tersedia</label>
                        <input type="text" name="hari" value="{{ old('hari') }}"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold"
                            placeholder="Cth: Senin, Rabu, Jumat" required />
                        <p class="text-[9px] text-slate-400 mt-1">*Pisahkan dengan koma</p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Jam
                            Tersedia</label>
                        <input type="text" name="jam" value="{{ old('jam') }}"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold"
                            placeholder="Cth: 13.00-14.30" required />
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Area
                            Mengajar (Kecamatan Offline)</label>
                        <input type="text" name="area" value="{{ old('area') }}"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold"
                            placeholder="Cth: Kecamatan Gubeng, Surabaya" required />
                    </div>
                </div>

                {{-- Area Khusus Legalitas (GDrive Link) --}}
                <h3 class="text-lg font-black text-slate-800 border-b border-slate-100 pb-4 mb-6 mt-8">Verifikasi
                    Legalitas</h3>
                <div class="p-6 bg-blue-50/50 rounded-2xl border border-blue-100">
                    <div
                        class="mb-6 p-4 bg-white rounded-xl border border-blue-100 shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div>
                            <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest mb-1">1. Download
                                Berkas</h4>
                            <p class="text-xs text-slate-500 font-medium">Download format Silabus & MoU tempatles.id,
                                isi, lalu siapkan untuk diunggah bersama KTP dan Pas Foto Anda.</p>
                        </div>
                        <a href="https://drive.google.com/drive/folders/1q5_IXgzY8uf0O4gsYUSw41bEpcgxADgf?usp=sharing"
                            target="_blank"
                            class="shrink-0 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-[10px] font-black uppercase tracking-widest transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Download Format
                        </a>
                    </div>

                    <label class="block text-sm font-black text-blue-800 mb-1 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                        2. Link Google Drive Dokumen Legalitas
                    </label>
                    <p class="text-xs text-blue-600/80 mb-4 font-medium leading-relaxed">
                        Penting! Gabungkan <span class="font-bold text-rose-500">Scan KTP/NIK, Pas Foto Terbaru, Silabus
                            yang sudah diisi, dan MoU yang sudah ditandatangani</span> ke dalam 1 folder Google Drive
                        milik Anda, lalu tempel link foldernya di bawah ini.
                    </p>
                    <input type="url" name="link_silabus" value="{{ old('link_silabus') }}"
                        class="block w-full border-blue-200 focus:border-blue-500 rounded-xl bg-white shadow-sm text-sm"
                        placeholder="https://drive.google.com/drive/folders/..." required />
                    <p class="text-[10px] text-slate-400 mt-2 font-bold uppercase tracking-widest">* Wajib: Akses link
                        diatur ke 'Siapa saja yang memiliki link'.</p>
                    <p class="text-[10px] text-slate-400 mt-1 font-bold uppercase tracking-widest">* Format Penamaan
                        File: BIDANG_NAMA LENGKAP</p>
                </div>

                <div class="flex items-start gap-3 mt-6 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                    <input type="checkbox" name="setuju_pernyataan" required
                        {{ old('setuju_pernyataan') ? 'checked' : '' }}
                        class="mt-0.5 w-5 h-5 rounded border-slate-300 text-emerald-500 focus:ring-emerald-500 cursor-pointer">
                    <label class="text-xs text-slate-600 font-medium leading-relaxed">
                        Data yang saya berikan adalah <span class="font-black text-slate-900">ASLI</span>. Saya bersedia
                        menunggu untuk proses verifikasi oleh Admin tempatles.id.
                    </label>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100 flex flex-col md:flex-row justify-between gap-4">
                    <button type="button" onclick="prevStep()"
                        class="bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 px-8 py-4 rounded-2xl transition-all text-xs font-black uppercase tracking-widest">
                        Kembali
                    </button>
                    <button type="submit"
                        class="flex-1 bg-orange-500 hover:bg-orange-600 text-white py-4 rounded-2xl transition-all text-xs font-black uppercase tracking-widest shadow-xl shadow-orange-500/30 flex justify-center items-center gap-2">
                        Kirim Pendaftaran
                    </button>
                </div>
            </div>
        </form>
    </main>

    <script>
    // Fungsi Mata Password
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (input.type === "password") {
            input.type = "text";
            icon.innerHTML =
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
        } else {
            input.type = "password";
            icon.innerHTML =
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
        }
    }

    // Fungsi Next & Prev Step
    function nextStep() {
        const step1Inputs = ['name', 'email', 'password', 'password_confirmation', 'phone_number', 'jenis_kelamin',
            'tempat_lahir', 'tanggal_lahir', 'alamat_domisili'
        ];
        let isValid = true;
        step1Inputs.forEach(id => {
            if (!document.getElementById(id).value) isValid = false;
        });

        if (!isValid) {
            alert('Mohon lengkapi semua data Akun & Biodata terlebih dahulu!');
            return;
        }

        document.getElementById('step-1').classList.replace('step-active', 'step-hidden');
        document.getElementById('step-2').classList.replace('step-hidden', 'step-active');

        document.getElementById('progress-line').classList.replace('w-1/2', 'w-full');
        document.getElementById('ind-2').classList.replace('bg-slate-200', 'bg-blue-600');
        document.getElementById('ind-2').classList.replace('text-slate-500', 'text-white');
        document.getElementById('text-ind-2').classList.replace('text-slate-400', 'text-blue-600');
    }

    function prevStep() {
        document.getElementById('step-2').classList.replace('step-active', 'step-hidden');
        document.getElementById('step-1').classList.replace('step-hidden', 'step-active');

        document.getElementById('progress-line').classList.replace('w-full', 'w-1/2');
        document.getElementById('ind-2').classList.replace('bg-blue-600', 'bg-slate-200');
        document.getElementById('ind-2').classList.replace('text-white', 'text-slate-500');
        document.getElementById('text-ind-2').classList.replace('text-blue-600', 'text-slate-400');
    }
    </script>
</body>

</html>

@else
{{-- ======================================================== --}}
{{-- TAMPILAN REGISTER UNTUK MURID --}}
{{-- ======================================================== --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Murid - tempatles.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 antialiased flex items-center justify-center min-h-screen p-6">

    <div
        class="w-full max-w-md bg-white rounded-[2rem] p-8 md:p-10 shadow-xl shadow-slate-200/50 border border-slate-100">

        <div class="text-center mb-10">
            <a href="/" class="inline-block mb-6">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-14 h-14 mx-auto">
            </a>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight uppercase">DAFTAR SEBAGAI MURID</h2>
            <p class="text-slate-500 mt-2 text-sm font-medium">Buat akun untuk mulai mencari tutor impianmu.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf
            <input type="hidden" name="role" value="murid">

            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Nama
                    Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                    class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold"
                    placeholder="Contoh: Budi Santoso" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Email
                    Aktif</label>
                <input type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                    class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold"
                    placeholder="budisantoso@email.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <label
                    class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Password</label>
                <div class="relative">
                    <input type="password" id="password_murid" name="password" required autocomplete="new-password"
                        class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold pr-10"
                        placeholder="Minimal 8 karakter" />
                    <button type="button" onclick="togglePasswordMurid('password_murid', 'eye-murid-1')"
                        class="absolute inset-y-0 right-0 px-3 flex items-center text-slate-400 hover:text-blue-600 transition-colors">
                        <svg id="eye-murid-1" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Konfirmasi
                    Password</label>
                <div class="relative">
                    <input type="password" id="password_confirmation_murid" name="password_confirmation" required
                        autocomplete="new-password"
                        class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold pr-10"
                        placeholder="Ulangi password Anda" />
                    <button type="button" onclick="togglePasswordMurid('password_confirmation_murid', 'eye-murid-2')"
                        class="absolute inset-y-0 right-0 px-3 flex items-center text-slate-400 hover:text-blue-600 transition-colors">
                        <svg id="eye-murid-2" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between pt-4 mt-6 border-t border-slate-100">
                <a class="text-xs font-bold text-slate-500 hover:text-blue-600 underline decoration-slate-300 underline-offset-4 transition-colors"
                    href="{{ route('login') }}">
                    Sudah punya akun?
                </a>
                <button type="submit"
                    class="bg-blue-950 hover:bg-blue-800 text-white px-6 py-3.5 rounded-xl text-xs font-black tracking-widest uppercase transition-all shadow-md">
                    Daftar Sekarang
                </button>
            </div>
        </form>
    </div>

    <script>
    function togglePasswordMurid(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (input.type === "password") {
            input.type = "text";
            icon.innerHTML =
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
        } else {
            input.type = "password";
            icon.innerHTML =
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
        }
    }
    </script>
</body>

</html>
@endif