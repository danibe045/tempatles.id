@extends('layouts.main')

{{-- OPTIMASI SEO: Title & Meta Description yang kaya kata kunci --}}
@section('title', 'Cari Tutor Les Privat & Guru Ngaji Terbaik - tempatles.id')

@section('meta')
    <meta name="description" content="Platform cari guru les privat SD, SMP, SMA, Bahasa Inggris, dan Guru Mengaji terdekat. Jadwal fleksibel, tutor terverifikasi, dan bagi hasil transparan.">
    <meta name="keywords" content="les privat, guru ngaji, tutor sd smp sma, les bahasa inggris, cari guru privat">
@endsection

@section('content')
    {{-- ========================================== --}}
    {{-- HERO SECTION --}}
    {{-- ========================================== --}}
    <main class="relative pt-20 pb-32 overflow-hidden flex-grow">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10 pointer-events-none">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[60%] bg-blue-100/50 blur-[120px] rounded-full"></div>
            <div class="absolute bottom-[10%] right-[-5%] w-[30%] h-[50%] bg-orange-100/50 blur-[100px] rounded-full"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 text-center relative z-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 border border-blue-100 rounded-full mb-8 hover:scale-105 transition-transform cursor-default shadow-sm">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-600"></span>
                </span>
                <span class="text-[10px] font-black text-blue-700 uppercase tracking-[0.2em]">Platform Les Privat Terpercaya</span>
            </div>

            <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 leading-[1.1] tracking-tight mb-8">
                Temukan Guru Les Privat <br class="hidden md:block">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Sesuai Kebutuhanmu</span>
            </h1>

            <p class="max-w-2xl mx-auto text-slate-500 text-lg md:text-xl leading-relaxed mb-10 font-medium">
                Mulai dari bimbingan akademik SD-SMA, bahasa Inggris, hingga mengaji. Jadwal fleksibel, tutor terverifikasi, dan sistem bagi hasil yang adil.
            </p>

            <div class="flex flex-col items-center justify-center gap-4 mb-20">
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 w-full sm:w-auto">
                    {{-- CTA Murid --}}
                    <a href="{{ route('katalog.publik') }}" class="w-full sm:w-auto px-10 py-4 bg-orange-500 text-white rounded-2xl font-black uppercase tracking-widest text-sm hover:bg-orange-600 transition-all shadow-xl shadow-orange-500/30 transform hover:-translate-y-1">
                        Cari Tutor Sekarang
                    </a>
                    
                    {{-- CTA Tutor --}}
                    <a href="{{ route('register') }}?role=tutor" class="w-full sm:w-auto px-10 py-4 bg-white border-2 border-blue-950 text-blue-950 rounded-2xl font-black uppercase tracking-widest text-sm hover:bg-blue-950 hover:text-white transition-all transform hover:-translate-y-1 shadow-sm">
                        Mulai Mengajar (Tutor)
                    </a>
                </div>
                <p class="text-xs font-medium text-slate-500 mt-2">
                    Ingin mendaftar sebagai murid? <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-800 underline decoration-blue-300 underline-offset-4">Daftar Gratis di sini</a>.
                </p>
            </div>

            {{-- Kutipan Founder --}}
            <div class="max-w-4xl mx-auto bg-white p-8 md:p-12 rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-slate-200/60 relative">
                <div class="absolute -top-6 left-1/2 -translate-x-1/2 w-12 h-12 bg-orange-500 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-orange-500/40">
                    <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" /></svg>
                </div>
                <p class="text-slate-600 text-lg md:text-xl italic leading-relaxed font-medium">
                    "tempatles.id adalah revolusi bimbingan belajar. Menghubungkan orang tua dengan pengajar berkualitas secara transparan dan aman."
                </p>
                <div class="mt-6 flex flex-col items-center justify-center">
                    <p class="text-xs font-black text-slate-800 uppercase tracking-widest">- Miftahul Rozikin, Founder tempatles.id</p>
                </div>
            </div>
        </div>
    </main>

    {{-- ========================================== --}}
    {{-- SECTION BIDANG LES --}}
    {{-- ========================================== --}}
    <section class="py-24 bg-[#f8f9fa] relative border-t border-slate-200">
        <div class="max-w-6xl mx-auto px-6 md:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-2xl md:text-3xl font-black text-blue-600 uppercase tracking-wide mb-4">Bidang Les Yang Dibutuhkan</h2>
                <p class="text-sm md:text-base text-slate-500 font-medium leading-relaxed">
                    Pilih kategori di bawah untuk menemukan tutor atau mulai mengajar.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 border-t border-l border-slate-200/80 bg-[#f8f9fa]">
                <div class="group p-8 text-center border-r border-b border-slate-200/80 hover:bg-white transition-colors duration-300 flex flex-col h-full cursor-pointer" onclick="window.location.href='{{ route('katalog.publik', ['mapel' => 'Akademik']) }}'">
                    <div class="w-12 h-12 mx-auto text-blue-600 mb-6 group-hover:-translate-y-1 transition-transform">
                        <svg aria-hidden="true" fill="currentColor" viewBox="0 0 24 24"><path d="M4 4a2 2 0 012-2h12a2 2 0 012 2v16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v16h12V4H6zm2 4h8v2H8V8zm0 4h8v2H8v-2z"/></svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-3">Akademik Sekolah</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium mb-6 flex-grow">Bimbingan belajar untuk SD, SMP, SMA. Pasar terbesar yang selalu dibutuhkan oleh orang tua murid.</p>
                    <span class="inline-flex items-center justify-center gap-1 text-sm font-bold text-blue-600 group-hover:text-blue-800">Eksplor Bidang &rarr;</span>
                </div>

                <div class="group p-8 text-center border-r border-b border-slate-200/80 hover:bg-white transition-colors duration-300 flex flex-col h-full cursor-pointer" onclick="window.location.href='{{ route('katalog.publik', ['mapel' => 'Mengaji']) }}'">
                    <div class="w-12 h-12 mx-auto text-blue-600 mb-6 group-hover:-translate-y-1 transition-transform">
                        <svg aria-hidden="true" fill="currentColor" viewBox="0 0 24 24"><path d="M21 4H3v16h18V4zm-2 14H5V6h14v12zm-8-2h6v-2h-6v2zm0-4h6V8h-6v4z"/></svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-3">Mengaji & Agama</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium mb-6 flex-grow">Kebutuhan pokok di Indonesia. Bimbingan baca tulis Al-Qur'an, tahsin, tajwid, dan ilmu agama.</p>
                    <span class="inline-flex items-center justify-center gap-1 text-sm font-bold text-blue-600 group-hover:text-blue-800">Eksplor Bidang &rarr;</span>
                </div>

                <div class="group p-8 text-center border-r border-b border-slate-200/80 hover:bg-white transition-colors duration-300 flex flex-col h-full cursor-pointer" onclick="window.location.href='{{ route('katalog.publik', ['mapel' => 'Inggris']) }}'">
                    <div class="w-12 h-12 mx-auto text-blue-600 mb-6 group-hover:-translate-y-1 transition-transform">
                        <svg aria-hidden="true" fill="currentColor" viewBox="0 0 24 24"><path d="M4 4a2 2 0 012-2h12a2 2 0 012 2v16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v16h12V4H6zm3.5 3h1L13 13h-1.5l-.6-1.8H8.1L7.5 13H6l3.5-6zm2.3 3.3l-1.3 3.7h2.6l-1.3-3.7zM14 15h4v-1.5h-2.5v-1h2v-1.5h-2v-1H18V8h-4v7z"/></svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-3">Bahasa Inggris</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium mb-6 flex-grow">Skill wajib untuk semua kalangan. Cocok untuk tutor TOEFL, IELTS, maupun Conversation praktis.</p>
                    <span class="inline-flex items-center justify-center gap-1 text-sm font-bold text-blue-600 group-hover:text-blue-800">Eksplor Bidang &rarr;</span>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================================== --}}
    {{-- SECTION KEUNGGULAN --}}
    {{-- ========================================== --}}
    <section class="py-24 bg-white relative border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-6 md:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <p class="text-[10px] font-black text-blue-600 uppercase tracking-[0.25em] mb-2">Nilai Lebih</p>
                <h2 class="text-3xl md:text-4xl font-black text-blue-950 leading-tight">Belajar Lebih Nyaman, <br>Mengajar Lebih Cuan</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                
                <div class="bg-white rounded-3xl p-8 border-b-4 border-blue-600 shadow-xl shadow-slate-200/50 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-20 h-20 mx-auto bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mb-6">
                        <svg aria-hidden="true" class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-4">Bagi Hasil Transparan</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium">Tutor menerima <span class="font-bold text-blue-600">90%</span> dari setiap transaksi. Hanya 10% untuk biaya pemeliharaan platform agar aman & nyaman.</p>
                </div>

                <div class="bg-white rounded-3xl p-8 border-b-4 border-emerald-500 shadow-xl shadow-slate-200/50 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-20 h-20 mx-auto bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center mb-6"><svg aria-hidden="true" class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg></div>
                    <h3 class="text-xl font-black text-slate-900 mb-4">Tutor Terverifikasi</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium">Kualitas adalah prioritas. Setiap tutor melalui seleksi untuk menjamin standar pengajaran dan keamanan.</p>
                </div>
                
                <div class="bg-white rounded-3xl p-8 border-b-4 border-orange-500 shadow-xl shadow-slate-200/50 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-20 h-20 mx-auto bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mb-6"><svg aria-hidden="true" class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
                    <h3 class="text-xl font-black text-slate-900 mb-4">Jadwal Fleksibel</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium">Belajar kapan saja. Sesuaikan jadwal dengan kesibukan harianmu dan buat kesepakatan langsung dengan tutor.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================================== --}}
    {{-- SECTION FAQ (PERTANYAAN POPULER) --}}
    {{-- ========================================== --}}
    <section id="faq" class="py-24 bg-slate-50 border-t border-slate-200 relative overflow-hidden">
        {{-- Dekorasi BG --}}
        <div class="absolute bottom-0 right-[-10%] w-[40%] h-[60%] bg-blue-100/50 blur-[120px] rounded-full pointer-events-none -z-10"></div>

        <div class="max-w-4xl mx-auto px-6 md:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <p class="text-[10px] font-black text-blue-600 uppercase tracking-[0.25em] mb-2">Pusat Bantuan</p>
                <h2 class="text-3xl md:text-4xl font-black text-blue-950 leading-tight">Pertanyaan Populer (FAQ)</h2>
                <p class="text-slate-500 text-sm font-medium mt-3">Punya pertanyaan seputar cara kerja tempatles.id? Temukan jawabannya di bawah ini.</p>
            </div>

            {{-- Wrapper Accordion dengan Alpine.js --}}
            <div x-data="{ activeFaq: null }" class="space-y-4">
                
                {{-- FAQ 1 --}}
                <div class="bg-white border border-slate-200 rounded-2xl transition-all duration-300" :class="activeFaq === 1 ? 'border-blue-500 ring-4 ring-blue-500/10 shadow-lg' : 'hover:border-blue-300 shadow-sm'">
                    <button @click="activeFaq = activeFaq === 1 ? null : 1" class="w-full px-6 py-5 flex items-center justify-between gap-4 text-left font-black text-slate-800 text-sm md:text-base outline-none">
                        <span>Apakah tutor di tempatles.id sudah terverifikasi dengan aman?</span>
                        <span class="text-blue-600 shrink-0 transition-transform duration-300" :class="activeFaq === 1 ? 'rotate-180' : ''">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                        </span>
                    </button>
                    <div x-show="activeFaq === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                        <div class="px-6 pb-6 text-sm font-medium text-slate-600 leading-relaxed border-t border-slate-100 pt-4 mt-1">
                            Tentu saja. Setiap tutor yang mendaftar wajib mengunggah KTP, identitas/ijazah terakhir, serta menyetujui MoU resmi. Tim Admin kami menyeleksi dan memverifikasi data tersebut secara manual sebelum akun mereka dinyatakan 'Aktif' dan bisa menerima pesanan mengajar.
                        </div>
                    </div>
                </div>

                {{-- FAQ 2 --}}
                <div class="bg-white border border-slate-200 rounded-2xl transition-all duration-300" :class="activeFaq === 2 ? 'border-blue-500 ring-4 ring-blue-500/10 shadow-lg' : 'hover:border-blue-300 shadow-sm'">
                    <button @click="activeFaq = activeFaq === 2 ? null : 2" class="w-full px-6 py-5 flex items-center justify-between gap-4 text-left font-black text-slate-800 text-sm md:text-base outline-none">
                        <span>Bagaimana sistem pembayaran les privat disini?</span>
                        <span class="text-blue-600 shrink-0 transition-transform duration-300" :class="activeFaq === 2 ? 'rotate-180' : ''">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                        </span>
                    </button>
                    <div x-show="activeFaq === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                        <div class="px-6 pb-6 text-sm font-medium text-slate-600 leading-relaxed border-t border-slate-100 pt-4 mt-1">
                            Kami menggunakan <span class="font-bold text-blue-600">Sistem Rekening Bersama (Escrow)</span>. Murid mentransfer biaya paket langsung ke rekening tempatles.id. Dana tersebut akan diamankan oleh sistem dan baru akan bisa dicairkan ke dompet tutor secara bertahap SETELAH tutor selesai mengajar dan kelas dinyatakan usai.
                        </div>
                    </div>
                </div>

                {{-- FAQ 3 --}}
                <div class="bg-white border border-slate-200 rounded-2xl transition-all duration-300" :class="activeFaq === 3 ? 'border-blue-500 ring-4 ring-blue-500/10 shadow-lg' : 'hover:border-blue-300 shadow-sm'">
                    <button @click="activeFaq = activeFaq === 3 ? null : 3" class="w-full px-6 py-5 flex items-center justify-between gap-4 text-left font-black text-slate-800 text-sm md:text-base outline-none">
                        <span>Berapa potongan komisi platform untuk para Tutor?</span>
                        <span class="text-blue-600 shrink-0 transition-transform duration-300" :class="activeFaq === 3 ? 'rotate-180' : ''">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                        </span>
                    </button>
                    <div x-show="activeFaq === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                        <div class="px-6 pb-6 text-sm font-medium text-slate-600 leading-relaxed border-t border-slate-100 pt-4 mt-1">
                            Sistem bagi hasil kami sangat adil dan transparan. Tutor akan menerima pendapatan bersih sebesar <span class="font-bold text-emerald-600">90%</span> dari harga paket yang mereka tentukan sendiri. Potongan platform hanya 10% untuk biaya pemeliharaan sistem, promosi, dan garansi keamanan transaksi.
                        </div>
                    </div>
                </div>

                {{-- FAQ 4 --}}
                <div class="bg-white border border-slate-200 rounded-2xl transition-all duration-300" :class="activeFaq === 4 ? 'border-blue-500 ring-4 ring-blue-500/10 shadow-lg' : 'hover:border-blue-300 shadow-sm'">
                    <button @click="activeFaq = activeFaq === 4 ? null : 4" class="w-full px-6 py-5 flex items-center justify-between gap-4 text-left font-black text-slate-800 text-sm md:text-base outline-none">
                        <span>Bagaimana jika tutor tidak hadir mengajar tanpa kabar?</span>
                        <span class="text-blue-600 shrink-0 transition-transform duration-300" :class="activeFaq === 4 ? 'rotate-180' : ''">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                        </span>
                    </button>
                    <div x-show="activeFaq === 4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                        <div class="px-6 pb-6 text-sm font-medium text-slate-600 leading-relaxed border-t border-slate-100 pt-4 mt-1">
                            Murid dijamin 100% aman. Jika tutor terbukti mangkir dari jadwal kesepakatan, murid dapat mengajukan komplain via Dasbor. Admin kami akan menginvestigasi, dan jika benar, dana akan dikembalikan penuh (Refund) kepada murid, sementara tutor akan mendapatkan sanksi (Strike).
                        </div>
                    </div>
                </div>

            </div>

            {{-- Bantuan Tambahan CTA --}}
            <div class="mt-10 text-center bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                <p class="text-sm font-bold text-slate-600">Pertanyaanmu belum terjawab di atas?</p>
                <a href="https://wa.me/6285859222500" target="_blank" class="inline-flex items-center gap-2 mt-4 text-xs font-black bg-blue-950 text-white px-6 py-3 rounded-xl uppercase tracking-widest hover:bg-orange-500 transition-colors shadow-md">
                    <span>Hubungi Admin Via WhatsApp</span> 💬
                </a>
            </div>
        </div>
    </section>
@endsection