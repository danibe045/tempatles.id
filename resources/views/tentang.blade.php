@extends('layouts.main')

@section('title', 'Tentang Kami - tempatles.id')

@section('content')
    <main class="flex-grow">
        {{-- SECTION 1: VISI & MISI --}}
        <section class="py-24 bg-white overflow-hidden">
            <div class="max-w-6xl mx-auto px-6">
                <div class="flex flex-col md:flex-row items-center gap-16">
                    <div class="w-full md:w-1/2">
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-orange-50 border border-orange-100 rounded-full mb-6">
                            <span class="text-[10px] font-black text-orange-600 uppercase tracking-widest">Siapa Kami?</span>
                        </div>
                        <h2 class="text-4xl md:text-5xl font-black text-blue-950 leading-tight mb-8">Revolusi Akses Pendidikan di Indonesia</h2>
                        <p class="text-lg text-slate-600 font-medium leading-relaxed mb-6">
                            <span class="text-blue-600 font-black">tempatles.id</span> lahir dari keresahan akan sulitnya mencari pengajar berkualitas yang transparan dan fleksibel. Kami bukan sekadar platform, kami adalah jembatan yang menghubungkan semangat belajar dengan dedikasi pengajar.
                        </p>
                        <p class="text-slate-500 leading-relaxed font-medium">
                            Misi kami sederhana: Memastikan setiap pelajar mendapatkan bimbingan terbaik tanpa harus terbebani biaya iklan atau admin yang mahal, sekaligus memberdayakan tutor untuk mandiri dalam mengelola waktu dan penghasilannya.
                        </p>
                    </div>

                    <div class="w-full md:w-1/2 relative">
                        <div class="relative z-10 rounded-[3rem] overflow-hidden shadow-2xl transform md:rotate-3 hover:rotate-0 transition-transform duration-500 border-8 border-slate-50">
                            <div class="aspect-[4/3] bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center p-12 text-center">
                                <span class="text-white text-3xl font-black italic">"Belajar jadi lebih mudah, mengajar jadi lebih bermakna."</span>
                            </div>
                        </div>
                        {{-- Hiasan --}}
                        <div class="absolute -top-12 -right-12 w-48 h-48 bg-orange-100 rounded-full -z-10 blur-3xl opacity-50"></div>
                        <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-blue-100 rounded-full -z-10 blur-3xl opacity-50"></div>
                    </div>
                </div>
            </div>
        </section>

        {{-- SECTION 2: VALUES --}}
        <section class="py-24 bg-slate-50 border-y border-slate-100">
            <div class="max-w-6xl mx-auto px-6">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <h2 class="text-3xl font-black text-blue-950 mb-4">Nilai yang Kami Pegang</h2>
                    <p class="text-slate-500 font-medium leading-relaxed text-sm">Prinsip utama yang menjadikan kami platform bimbingan belajar terpercaya di Indonesia.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    {{-- Value 1 --}}
                    <div class="p-8">
                        <div class="w-16 h-16 mx-auto bg-white shadow-xl rounded-2xl flex items-center justify-center text-3xl mb-6">🤝</div>
                        <h3 class="text-xl font-black text-slate-900 mb-3">Transparansi</h3>
                        <p class="text-sm text-slate-500 font-medium leading-relaxed">Tanpa biaya tersembunyi. Semua kesepakatan antara tutor dan murid dilakukan secara terbuka dan adil.</p>
                    </div>
                    {{-- Value 2 --}}
                    <div class="p-8">
                        <div class="w-16 h-16 mx-auto bg-white shadow-xl rounded-2xl flex items-center justify-center text-3xl mb-6">🛡️</div>
                        <h3 class="text-xl font-black text-slate-900 mb-3">Integritas</h3>
                        <p class="text-sm text-slate-500 font-medium leading-relaxed">Kami memverifikasi setiap pengajar untuk menjamin keamanan dan kualitas pembelajaran.</p>
                    </div>
                    {{-- Value 3 --}}
                    <div class="p-8">
                        <div class="w-16 h-16 mx-auto bg-white shadow-xl rounded-2xl flex items-center justify-center text-3xl mb-6">🚀</div>
                        <h3 class="text-xl font-black text-slate-900 mb-3">Inovasi</h3>
                        <p class="text-sm text-slate-500 font-medium leading-relaxed">Terus mengembangkan fitur teknologi yang memudahkan proses pencarian dan manajemen jadwal les.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- SECTION 3: TIM / KONTAK --}}
        <section class="py-24 bg-white">
            <div class="max-w-6xl mx-auto px-6 text-center">
                <h2 class="text-3xl font-black text-blue-950 mb-12">Mari Berkembang Bersama</h2>
                <div class="bg-blue-950 p-12 rounded-[3rem] shadow-2xl shadow-blue-900/20 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-blue-900 rounded-full blur-3xl opacity-30 translate-x-1/2 -translate-y-1/2"></div>
                    
                    <div class="relative z-10 max-w-2xl mx-auto">
                        <p class="text-blue-200 text-lg font-medium mb-8 leading-relaxed">
                            Punya pertanyaan lebih lanjut atau ingin berkolaborasi? Kami siap mendengarkan aspirasi Anda untuk masa depan pendidikan yang lebih baik.
                        </p>
                        <a href="https://wa.me/6285859222500" target="_blank" class="inline-flex items-center gap-3 bg-white text-blue-950 px-8 py-4 rounded-full font-black uppercase tracking-widest text-xs hover:bg-orange-500 hover:text-white transition-all duration-300">
                            Hubungi Kami via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection