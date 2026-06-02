@php
$role = request()->query('role', 'murid');
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran {{ ucfirst($role) }} - tempatles.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .step-hidden { display: none; }
        .step-active { animation: slideLeft 0.4s ease-out forwards; }
        @keyframes slideLeft { from { opacity: 0; transform: translateX(15px); } to { opacity: 1; transform: translateX(0); } }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 antialiased overflow-x-hidden">

    <div class="min-h-screen flex flex-col lg:flex-row">

        {{-- ======================================================== --}}
        {{-- PANEL KIRI: BRANDING & INFORMASI --}}
        {{-- ======================================================== --}}
        <div class="w-full lg:w-5/12 bg-blue-950 relative overflow-hidden flex flex-col justify-between px-8 py-8 lg:px-12 lg:py-10 text-white min-h-[25vh] lg:min-h-screen shrink-0 shadow-2xl z-20">
            <div class="absolute top-[-10%] left-[-20%] w-[70%] h-[50%] bg-blue-600/30 blur-[100px] rounded-full pointer-events-none"></div>
            <div class="absolute bottom-[-10%] right-[-20%] w-[70%] h-[50%] bg-orange-500/20 blur-[100px] rounded-full pointer-events-none"></div>
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-40 pointer-events-none"></div>

            <div class="relative z-10">
                <a href="/" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-white rounded-xl shadow-lg flex items-center justify-center group-hover:-translate-y-1 transition-transform">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-auto h-10">
                    </div>
                    <span class="font-black text-white text-2xl tracking-tight">tempatles<span class="text-orange-500">.id</span></span>
                </a>
            </div>

            <div class="relative z-10 mt-10 lg:mt-0 flex-grow flex flex-col justify-center">
                @if($role === 'tutor')
                    <span class="inline-block py-1.5 px-3 rounded-lg bg-blue-500/20 text-blue-300 text-[10px] font-black uppercase tracking-[0.2em] mb-4 border border-blue-400/20 w-fit">Untuk Pengajar</span>
                    <h1 class="text-3xl lg:text-5xl font-black leading-[1.1] tracking-tight mb-5">Mulai Karir <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-orange-400">Mengajarmu</span> Di Sini.</h1>
                    <p class="text-slate-300 text-sm leading-relaxed mb-8 font-medium max-w-sm">Bergabung dengan tempatles.id dan dapatkan kemudahan mengajar tanpa ribet cari murid.</p>
                    <div class="space-y-3.5 mb-10">
                        <div class="flex items-center gap-3"><div class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div><p class="text-sm font-bold text-slate-200">Sistem Bagi Hasil Adil (90%)</p></div>
                        <div class="flex items-center gap-3"><div class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div><p class="text-sm font-bold text-slate-200">Jadwal Sangat Fleksibel</p></div>
                        <div class="flex items-center gap-3"><div class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div><p class="text-sm font-bold text-slate-200">Tutor Terverifikasi Aman</p></div>
                    </div>
                @else
                    <span class="inline-block py-1.5 px-3 rounded-lg bg-orange-500/20 text-orange-300 text-[10px] font-black uppercase tracking-[0.2em] mb-4 border border-orange-400/20 w-fit">Untuk Murid</span>
                    <h1 class="text-3xl lg:text-5xl font-black leading-[1.1] tracking-tight mb-5">Temukan <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-blue-400">Tutor Impianmu.</span></h1>
                    <p class="text-slate-300 text-sm leading-relaxed mb-8 font-medium max-w-sm">Platform pencarian guru les privat terpercaya untuk semua jenjang.</p>
                    <div class="space-y-3.5 mb-10">
                        <div class="flex items-center gap-3"><div class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div><p class="text-sm font-bold text-slate-200">100% Bebas Biaya Admin</p></div>
                        <div class="flex items-center gap-3"><div class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div><p class="text-sm font-bold text-slate-200">Ratusan Pilihan Tutor</p></div>
                    </div>
                @endif

                <div class="flex items-center gap-4 mt-4">
                    <a href="/" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/10 backdrop-blur-md text-white px-5 py-2.5 rounded-full text-[11px] font-black uppercase tracking-widest transition-all shadow-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg> Kembali ke Beranda
                    </a>
                </div>
            </div>

            <div class="relative z-10 hidden lg:block text-[10px] font-bold text-slate-500 mt-8">© {{ date('Y') }} tempatles.id</div>
        </div>

        {{-- ======================================================== --}}
        {{-- PANEL KANAN: FORM PENDAFTARAN --}}
        {{-- ======================================================== --}}
        <div class="w-full lg:w-7/12 flex {{ $role === 'murid' ? 'items-center' : 'items-start' }} justify-center p-6 py-10 lg:px-14 lg:py-10 bg-slate-50 relative min-h-[70vh] lg:min-h-screen overflow-y-auto">
            <div class="w-full max-w-2xl pt-2 lg:pt-4">
                
                @if ($errors->any())
                <div class="mb-6 bg-rose-50 border border-rose-100 p-4 rounded-2xl flex gap-3 items-start shadow-sm">
                    <div class="bg-rose-500 p-1.5 rounded-lg text-white shadow-md shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    </div>
                    <div>
                        <h4 class="font-black text-rose-900 text-xs uppercase tracking-widest mb-1">Cek Kembali Isian Anda</h4>
                        <ul class="text-[11px] font-bold text-rose-600 space-y-0.5">
                            @foreach ($errors->all() as $error) <li>• {{ $error }}</li> @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                @if($role === 'tutor')
                    {{-- PROGRESS --}}
                    <div class="flex items-center justify-between mb-8 relative px-2">
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-1 bg-slate-200 rounded-full z-0 overflow-hidden">
                            <div id="progress-line" class="absolute left-0 top-0 h-full bg-blue-600 w-1/2 transition-all duration-500"></div>
                        </div>
                        <div class="relative z-10 flex flex-row items-center gap-2 bg-slate-50 px-1 py-1 rounded-full">
                            <div id="ind-1" class="w-6 h-6 rounded-full bg-blue-600 text-white font-black flex items-center justify-center text-[10px] shadow-sm">1</div>
                            <span class="text-[9px] font-black text-blue-600 uppercase tracking-widest mr-2">Biodata</span>
                        </div>
                        <div class="relative z-10 flex flex-row items-center gap-2 bg-slate-50 px-1 py-1 rounded-full">
                            <span id="text-ind-2" class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-2 transition-colors duration-300">Legalitas</span>
                            <div id="ind-2" class="w-6 h-6 rounded-full bg-white text-slate-400 font-black flex items-center justify-center text-[10px] border border-slate-300 transition-all duration-300">2</div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="relative mt-2">
                        @csrf
                        <input type="hidden" name="role" value="tutor">

                        {{-- STEP 1 --}}
                        <div id="step-1" class="step-active">
                            <h3 class="text-lg font-black text-slate-800 mb-4">Informasi Akun Pribadi</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-5 gap-y-4">
                                <div class="md:col-span-2 group">
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5 ml-1 group-focus-within:text-blue-600 transition-colors">Nama Lengkap (Sesuai KTP)</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="block w-full bg-white border border-slate-200 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl shadow-sm text-sm font-bold transition-all py-2.5 px-4 outline-none" placeholder="Budi Santoso" required />
                                </div>
                                <div class="group">
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5 ml-1 group-focus-within:text-blue-600 transition-colors">Email Aktif</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="block w-full bg-white border border-slate-200 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl shadow-sm text-sm font-bold transition-all py-2.5 px-4 outline-none" placeholder="nama@email.com" required />
                                </div>
                                <div class="group">
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5 ml-1 group-focus-within:text-blue-600 transition-colors">Nomor WhatsApp</label>
                                    <input type="number" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" class="block w-full bg-white border border-slate-200 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl shadow-sm text-sm font-bold transition-all py-2.5 px-4 outline-none" placeholder="081234567890" required />
                                </div>
                                <div class="group">
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5 ml-1 group-focus-within:text-blue-600 transition-colors">Password</label>
                                    <div class="relative">
                                        <input type="password" id="password" name="password" class="block w-full bg-white border border-slate-200 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl shadow-sm text-sm font-bold transition-all py-2.5 pl-4 pr-10 outline-none" placeholder="Min. 8 Karakter" required />
                                        <button type="button" onclick="togglePass('password', 'eye-1')" class="absolute inset-y-0 right-2 px-2 text-slate-400 hover:text-blue-600 transition-colors"><svg id="eye-1" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg></button>
                                    </div>
                                </div>
                                <div class="group">
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5 ml-1 group-focus-within:text-blue-600 transition-colors">Ulangi Password</label>
                                    <div class="relative">
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="block w-full bg-white border border-slate-200 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl shadow-sm text-sm font-bold transition-all py-2.5 pl-4 pr-10 outline-none" placeholder="Ketik Ulang" required />
                                        <button type="button" onclick="togglePass('password_confirmation', 'eye-2')" class="absolute inset-y-0 right-2 px-2 text-slate-400 hover:text-blue-600 transition-colors"><svg id="eye-2" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg></button>
                                    </div>
                                </div>
                                <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-3 gap-5">
                                    <div class="group">
                                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5 ml-1 group-focus-within:text-blue-600 transition-colors">Kelamin</label>
                                        <select id="jenis_kelamin" name="jenis_kelamin" class="block w-full bg-white border border-slate-200 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl shadow-sm text-sm font-bold transition-all py-2.5 px-4 outline-none" required>
                                            <option value="" disabled {{ old('jenis_kelamin') ? '' : 'selected' }}>Pilih</option>
                                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="group">
                                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5 ml-1 group-focus-within:text-blue-600 transition-colors">Kota Lahir</label>
                                        <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="block w-full bg-white border border-slate-200 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl shadow-sm text-sm font-bold transition-all py-2.5 px-4 outline-none" placeholder="Surabaya" required />
                                    </div>
                                    <div class="group">
                                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5 ml-1 group-focus-within:text-blue-600 transition-colors">Tgl Lahir</label>
                                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="block w-full bg-white border border-slate-200 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl shadow-sm text-sm font-bold transition-all py-2.5 px-4 outline-none" required />
                                    </div>
                                </div>
                                <div class="md:col-span-2 group">
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5 ml-1 group-focus-within:text-blue-600 transition-colors">Alamat Lengkap</label>
                                    <textarea id="alamat_domisili" name="alamat_domisili" rows="2" class="block w-full bg-white border border-slate-200 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl shadow-sm text-sm font-medium transition-all py-2.5 px-4 resize-none outline-none" placeholder="Nama Jalan, Kec, Kota..." required>{{ old('alamat_domisili') }}</textarea>
                                </div>
                            </div>
                            
                            <div class="mt-6 flex justify-end">
                                <button type="button" onclick="nextStep()" class="w-full sm:w-auto bg-blue-950 hover:bg-blue-800 text-white px-8 py-3.5 rounded-xl font-black text-[10px] uppercase tracking-widest shadow-lg transition-all flex items-center justify-center gap-2 group">Lanjut Tahap 2 <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg></button>
                            </div>
                        </div>

                        {{-- STEP 2 --}}
                        <div id="step-2" class="step-hidden">
                            <h3 class="text-lg font-black text-slate-800 mb-4">Kualifikasi & Legalitas</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-5 gap-y-4 mb-6">
                                <div class="group">
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5 ml-1 group-focus-within:text-blue-600 transition-colors">Pendidikan Terakhir</label>
                                    <input type="text" name="pendidikan_terakhir" value="{{ old('pendidikan_terakhir') }}" class="block w-full bg-white border border-slate-200 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl shadow-sm text-sm font-bold transition-all py-2.5 px-4 outline-none" placeholder="Cth: S1 Biologi" required>
                                </div>
                                <div class="group">
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5 ml-1 group-focus-within:text-blue-600 transition-colors">Asal Instansi</label>
                                    <input type="text" name="instansi" value="{{ old('instansi') }}" class="block w-full bg-white border border-slate-200 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl shadow-sm text-sm font-bold transition-all py-2.5 px-4 outline-none" placeholder="Cth: Univ. Brawijaya" required>
                                </div>
                                <div class="md:col-span-2 group">
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5 ml-1 group-focus-within:text-blue-600 transition-colors">Bidang / Mapel</label>
                                    <input type="text" name="bidang" value="{{ old('bidang') }}" class="block w-full bg-white border border-slate-200 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl shadow-sm text-sm font-bold transition-all py-2.5 px-4 outline-none" placeholder="Cth: Matematika SD, Mengaji Iqro" required>
                                </div>
                                <div class="md:col-span-2 group">
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5 ml-1 group-focus-within:text-blue-600 transition-colors">Pengalaman Mengajar</label>
                                    <textarea name="pengalaman" rows="2" class="block w-full bg-white border border-slate-200 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl shadow-sm text-sm font-medium transition-all py-2.5 px-4 resize-none outline-none" placeholder="Ceritakan riwayat mengajarmu..." required>{{ old('pengalaman') }}</textarea>
                                </div>
                            </div>

                            <div class="p-4 bg-blue-50/70 rounded-2xl border border-blue-200/60 shadow-inner">
                                <h4 class="font-black text-blue-950 text-xs mb-1.5 flex items-center gap-2"><svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 00-5.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg> Tautan Folder Google Drive</h4>
                                <p class="text-[10px] font-medium text-slate-500 mb-3 leading-relaxed">Jadikan 1 folder: <span class="font-bold text-blue-600">Silabus, & MoU</span>.</p>
                                <input type="url" name="link" value="{{ old('link') }}" class="block w-full bg-white border border-slate-200 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl shadow-sm text-sm font-bold transition-all py-2.5 px-4 outline-none" placeholder="Paste Tautan Folder GDrive" required />
                            </div>

                            <div class="mt-4 flex items-start gap-3 p-4 bg-white rounded-xl border border-slate-200 hover:border-blue-300 transition-colors cursor-pointer" onclick="document.getElementById('setuju').click()">
                                <input type="checkbox" id="setuju" name="setuju_pernyataan" class="mt-0.5 w-4 h-4 rounded border-slate-300 text-blue-600 pointer-events-none" required {{ old('setuju_pernyataan') ? 'checked' : '' }}>
                                <p class="text-[10px] font-bold text-slate-600 leading-relaxed select-none">Data yang saya berikan <span class="text-slate-900 font-black">ASLI</span>. Saya bersedia menunggu proses verifikasi.</p>
                            </div>

                            <div class="mt-5 flex flex-col-reverse sm:flex-row gap-3">
                                <button type="button" onclick="prevStep()" class="w-full sm:w-auto bg-white border border-slate-300 text-slate-600 hover:bg-slate-50 px-6 py-3.5 rounded-xl font-black text-[10px] uppercase tracking-widest transition-all">Kembali</button>
                                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3.5 px-6 rounded-xl font-black text-[10px] uppercase tracking-widest shadow-lg transition-all flex justify-center items-center gap-2">Kirim Pendaftaran <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></button>
                            </div>
                        </div>
                    </form>

                    {{-- LINK SUDAH PUNYA AKUN UNTUK TUTOR (SEJAJAR DI BAWAH FORM) --}}
                    <p class="text-xs font-bold text-slate-400 text-center mt-8 pt-4 border-t border-slate-100">
                        Sudah memiliki akun pengajar? <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 hover:underline font-black transition-colors">Masuk di sini</a>
                    </p>
                @else
                    {{-- ---------------- FORM MURID ---------------- --}}
                    <div class="text-center sm:text-left mb-6">
                        <h3 class="text-xl font-black text-slate-800 mb-1.5">Buat Akun Murid</h3>
                        <p class="text-xs font-medium text-slate-500">Lengkapi data di bawah untuk mencari tutor.</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf
                        <input type="hidden" name="role" value="murid">

                        <div class="group">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5 ml-1 group-focus-within:text-blue-600 transition-colors">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" required autofocus class="block w-full bg-white border border-slate-200 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl shadow-sm text-sm font-bold transition-all py-3 px-4 outline-none" placeholder="Budi Santoso" />
                            <x-input-error :messages="$errors->get('name')" class="mt-1 text-[9px] font-bold text-rose-500" />
                        </div>

                        <div class="group">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5 ml-1 group-focus-within:text-blue-600 transition-colors">Email Aktif</label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="block w-full bg-white border border-slate-200 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl shadow-sm text-sm font-bold transition-all py-3 px-4 outline-none" placeholder="budi@email.com" />
                            <x-input-error :messages="$errors->get('email')" class="mt-1 text-[9px] font-bold text-rose-500" />
                        </div>

                        <div class="group">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5 ml-1 group-focus-within:text-blue-600 transition-colors">Password</label>
                            <div class="relative">
                                <input type="password" id="password_murid" name="password" required class="block w-full bg-white border border-slate-200 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl shadow-sm text-sm font-bold transition-all py-3 pl-4 pr-10 outline-none" placeholder="Minimal 8 karakter" />
                                <button type="button" onclick="togglePass('password_murid', 'eye-m1')" class="absolute inset-y-0 right-2 px-2 text-slate-400 hover:text-blue-600 transition-colors"><svg id="eye-m1" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg></button>
                            </div>
                        </div>

                        <div class="group">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1.5 ml-1 group-focus-within:text-blue-600 transition-colors">Konfirmasi Password</label>
                            <div class="relative">
                                <input type="password" id="password_confirmation_murid" name="password_confirmation" required class="block w-full bg-white border border-slate-200 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl shadow-sm text-sm font-bold transition-all py-3 pl-4 pr-10 outline-none" placeholder="Ulangi password" />
                                <button type="button" onclick="togglePass('password_confirmation_murid', 'eye-m2')" class="absolute inset-y-0 right-2 px-2 text-slate-400 hover:text-blue-600 transition-colors"><svg id="eye-m2" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg></button>
                            </div>
                        </div>

                        <div class="pt-4 mt-6 border-t border-slate-100">
                            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white w-full py-3.5 rounded-xl text-[10px] font-black tracking-widest uppercase transition-all shadow-lg shadow-orange-500/30 transform hover:-translate-y-1">Daftar Sekarang</button>
                        </div>
                    </form>

                    {{-- LINK SUDAH PUNYA AKUN UNTUK MURID (DI BAWAH FORM MURID) --}}
                    <p class="text-xs font-bold text-slate-400 text-center mt-6">
                        Sudah mendaftar sebagai murid? <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 hover:underline font-black transition-colors">Masuk di sini</a>
                    </p>
                @endif
            </div>
        </div>
    </div>

    <script>
        function togglePass(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === "password") {
                input.type = "text";
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
            } else {
                input.type = "password";
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
            }
        }

        @if($role === 'tutor')
        function nextStep() {
            const step1Inputs = ['name', 'email', 'phone_number', 'password', 'password_confirmation', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat_domisili'];
            let isValid = true;
            step1Inputs.forEach(id => {
                const el = document.getElementById(id);
                if (!el.value) { isValid = false; el.classList.add('ring-4', 'ring-rose-500/20', 'border-rose-400'); } 
                else { el.classList.remove('ring-4', 'ring-rose-500/20', 'border-rose-400'); }
            });
            if (!isValid) return; 
            document.getElementById('step-1').classList.replace('step-active', 'step-hidden');
            document.getElementById('step-2').classList.replace('step-hidden', 'step-active');
            document.getElementById('progress-line').classList.replace('w-1/2', 'w-full');
            const ind1 = document.getElementById('ind-1');
            ind1.classList.replace('bg-blue-600', 'bg-emerald-500');
            ind1.innerHTML = '<svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>';
            const ind2 = document.getElementById('ind-2');
            ind2.classList.replace('bg-white', 'bg-blue-600');
            ind2.classList.replace('text-slate-400', 'text-white');
            ind2.classList.replace('border-slate-300', 'border-transparent');
            document.getElementById('text-ind-2').classList.replace('text-slate-400', 'text-blue-600');
            document.querySelector('.lg\\:w-7\\/12').scrollTo({top: 0, behavior: 'smooth'});
        }

        function prevStep() {
            document.getElementById('step-2').classList.replace('step-active', 'step-hidden');
            document.getElementById('step-1').classList.replace('step-hidden', 'step-active');
            document.getElementById('progress-line').classList.replace('w-full', 'w-1/2');
            const ind1 = document.getElementById('ind-1');
            ind1.classList.replace('bg-emerald-500', 'bg-blue-600');
            ind1.innerHTML = '1';
            const ind2 = document.getElementById('ind-2');
            ind2.classList.replace('bg-blue-600', 'bg-white');
            ind2.classList.replace('text-white', 'text-slate-400');
            ind2.classList.replace('border-transparent', 'border-slate-300');
            document.getElementById('text-ind-2').classList.replace('text-blue-600', 'text-slate-400');
            document.querySelector('.lg\\:w-7\\/12').scrollTo({top: 0, behavior: 'smooth'});
        }
        @endif
    </script>
</body>
</html>