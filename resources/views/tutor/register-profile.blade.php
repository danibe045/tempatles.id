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

    {{-- NAVBAR SEDERHANA --}}
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-lg border-b border-slate-200/60 shadow-sm">
        <div class="max-w-4xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-8 h-8">
                <span class="font-black text-blue-950 text-xl tracking-tight hidden sm:block">tempatles<span
                        class="text-orange-500">.id</span></span>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="text-xs font-bold text-rose-500 hover:text-rose-700 transition-colors">Batalkan &
                    Keluar</button>
            </form>
        </div>
    </nav>

    <main class="w-full max-w-3xl mx-auto px-6 py-12 relative z-10">

        <div class="text-center mb-10">
            <div
                class="inline-flex items-center justify-center w-16 h-16 bg-blue-50 text-blue-600 rounded-full mb-4 shadow-sm border border-blue-100">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
            <h2 class="text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">Lengkapi Profil Pengajar</h2>
            <p class="text-slate-500 mt-2 font-medium">Selesaikan 2 tahapan ini untuk mulai mengajar.</p>
        </div>

        {{-- Progress Bar Indicator --}}
        <div class="flex items-center justify-between mb-8 relative">
            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-1 bg-slate-200 rounded-full z-0"></div>
            <div id="progress-line"
                class="absolute left-0 top-1/2 -translate-y-1/2 w-1/2 h-1 bg-blue-600 rounded-full z-0 transition-all duration-300">
            </div>

            <div class="relative z-10 flex flex-col items-center gap-2">
                <div id="ind-1"
                    class="w-8 h-8 rounded-full bg-blue-600 text-white font-black flex items-center justify-center text-xs shadow-md ring-4 ring-slate-50 transition-all duration-300">
                    1</div>
                <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest">Biodata</span>
            </div>
            <div class="relative z-10 flex flex-col items-center gap-2">
                <div id="ind-2"
                    class="w-8 h-8 rounded-full bg-slate-200 text-slate-500 font-black flex items-center justify-center text-xs ring-4 ring-slate-50 transition-all duration-300">
                    2</div>
                <span id="text-ind-2"
                    class="text-[10px] font-bold text-slate-400 uppercase tracking-widest transition-colors duration-300">Legalitas</span>
            </div>
        </div>

        {{-- FORM TANPA ENCTYPE KARENA TIDAK ADA UPLOAD FILE --}}
        <form method="POST" action="{{ route('tutor.store') }}">
            @csrf

            {{-- ================= STEP 1 ================= --}}
            <div id="step-1"
                class="bg-white p-8 lg:p-10 rounded-[2.5rem] border border-slate-200 shadow-sm step-active">
                <h3 class="text-lg font-black text-slate-800 border-b border-slate-100 pb-4 mb-6">Biodata Pribadi &
                    Kontak</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Nomor
                            WhatsApp Aktif</label>
                        <input type="number" id="phone_number" name="phone_number" value="{{ $user->phone_number }}"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold"
                            placeholder="08123456789" required />
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Jenis
                            Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold"
                            required>
                            <option value="" disabled selected>Pilih...</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Tempat
                            Lahir</label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold"
                            placeholder="Cth: Surabaya" required />
                    </div>
                    <div>
                        <label
                            class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Tanggal
                            Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold"
                            required />
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Alamat
                            Domisili Lengkap</label>
                        <textarea id="alamat_domisili" name="alamat_domisili" rows="2"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-medium"
                            placeholder="Nama Jalan, RT/RW, Kecamatan, Kota..." required></textarea>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="button" onclick="nextStep()"
                        class="bg-blue-950 hover:bg-blue-800 text-white px-8 py-4 rounded-2xl transition-all text-xs font-black uppercase tracking-widest shadow-lg flex items-center gap-2">
                        Lanjut ke Step 2
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- ================= STEP 2 ================= --}}
            <div id="step-2"
                class="bg-white p-8 lg:p-10 rounded-[2.5rem] border border-slate-200 shadow-sm step-hidden">
                <h3 class="text-lg font-black text-slate-800 border-b border-slate-100 pb-4 mb-6">Latar Belakang &
                    Legalitas</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label
                            class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Pendidikan
                            Terakhir</label>
                        <input type="text" name="pendidikan_terakhir"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold"
                            placeholder="Cth: S1 Kimia" required />
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Asal
                            Kampus / Sekolah</label>
                        <input type="text" name="instansi"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold"
                            placeholder="Cth: UI" required />
                    </div>
                    <div class="md:col-span-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Spesialisasi
                            Bidang</label>
                        <input type="text" name="bidang"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-bold"
                            placeholder="Cth: Matematika & Fisika" required />
                    </div>
                    <div class="md:col-span-2">
                        <label
                            class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Pengalaman
                            Mengajar</label>
                        <textarea name="pengalaman" rows="3"
                            class="block w-full bg-slate-50 border-slate-200 focus:border-blue-500 rounded-xl shadow-sm text-sm font-medium resize-none"
                            placeholder="Ceritakan riwayat mengajarmu..." required></textarea>
                    </div>
                </div>

                {{-- Area Khusus Legalitas Sesuai Database (Tanpa Upload File) --}}
                <div class="p-6 bg-blue-50/50 rounded-2xl border border-blue-100">
                    <label class="block text-sm font-black text-blue-800 mb-1 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                        Link Google Drive Dokumen Legalitas
                    </label>
                    <p class="text-xs text-blue-600/80 mb-4 font-medium leading-relaxed">
                        Penting! Gabungkan <span class="font-bold text-rose-500">Scan NIK/KTP, Pas Foto Terbaru,
                            Silabus, dan MoU</span> ke dalam 1 folder Google Drive milik Anda.
                    </p>
                    <input type="url" name="link_silabus"
                        class="block w-full border-blue-200 focus:border-blue-500 rounded-xl bg-white shadow-sm text-sm"
                        placeholder="https://drive.google.com/drive/folders/..." required />
                    <p class="text-[10px] text-slate-400 mt-2 font-bold uppercase tracking-widest">*Wajib: Akses link
                        diatur ke 'Siapa saja yang memiliki link'.</p>
                </div>

                <div class="flex items-start gap-3 mt-6 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                    <input type="checkbox" name="setuju_pernyataan" required
                        class="mt-0.5 w-5 h-5 rounded border-slate-300 text-emerald-500 focus:ring-emerald-500 cursor-pointer">
                    <label class="text-xs text-slate-600 font-medium leading-relaxed">
                        Data yang saya berikan adalah <span class="font-black text-slate-900">ASLI</span>. Saya setuju
                        mematuhi aturan tempatles.id.
                    </label>
                </div>

                <div class="mt-8 flex justify-between gap-4">
                    <button type="button" onclick="prevStep()"
                        class="bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 px-8 py-4 rounded-2xl transition-all text-xs font-black uppercase tracking-widest">
                        Kembali
                    </button>
                    <button type="submit"
                        class="flex-1 bg-orange-500 hover:bg-orange-600 text-white py-4 rounded-2xl transition-all text-xs font-black uppercase tracking-widest shadow-xl shadow-orange-500/30 flex justify-center items-center gap-2">
                        Simpan & Masuk Karantina
                    </button>
                </div>
            </div>
        </form>
    </main>

    {{-- JavaScript untuk Efek Wizard --}}
    <script>
    function nextStep() {
        // Validasi sederhana Step 1 sebelum lanjut
        const step1Inputs = ['phone_number', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat_domisili'];
        let isValid = true;
        step1Inputs.forEach(id => {
            if (!document.getElementById(id).value) isValid = false;
        });

        if (!isValid) {
            alert('Mohon lengkapi semua data di Step 1 terlebih dahulu.');
            return;
        }

        document.getElementById('step-1').classList.replace('step-active', 'step-hidden');
        document.getElementById('step-2').classList.replace('step-hidden', 'step-active');

        // Update UI Progress Bar
        document.getElementById('progress-line').classList.replace('w-1/2', 'w-full');
        document.getElementById('ind-2').classList.replace('bg-slate-200', 'bg-blue-600');
        document.getElementById('ind-2').classList.replace('text-slate-500', 'text-white');
        document.getElementById('text-ind-2').classList.replace('text-slate-400', 'text-blue-600');
    }

    function prevStep() {
        document.getElementById('step-2').classList.replace('step-active', 'step-hidden');
        document.getElementById('step-1').classList.replace('step-hidden', 'step-active');

        // Revert UI Progress Bar
        document.getElementById('progress-line').classList.replace('w-full', 'w-1/2');
        document.getElementById('ind-2').classList.replace('bg-blue-600', 'bg-slate-200');
        document.getElementById('ind-2').classList.replace('text-white', 'text-slate-500');
        document.getElementById('text-ind-2').classList.replace('text-blue-600', 'text-slate-400');
    }
    </script>
</body>

</html>