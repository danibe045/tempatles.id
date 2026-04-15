<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Murid - tempatles.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased flex flex-col min-h-screen overflow-x-hidden">

    {{-- NAVBAR KHUSUS MEMBER --}}
    <nav class="sticky top-0 z-50 flex items-center justify-between px-6 md:px-12 py-4 bg-white/90 backdrop-blur-md border-b border-slate-200 shadow-sm">
        <div class="flex items-center gap-2">
            <a href="/" class="flex items-center gap-3 group">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-10 w-auto transition-transform group-hover:scale-105">
                <div class="hidden sm:block">
                    <span class="font-black text-blue-950 text-lg tracking-tight leading-none">tempatles</span>
                    <span class="font-black text-orange-500 text-lg tracking-tight leading-none">.id</span>
                </div>
            </a>
        </div>

        <div class="hidden lg:flex items-center space-x-10 text-[13px] font-bold uppercase tracking-widest text-slate-500">
            <a href="/" class="hover:text-blue-600 transition-colors">Home</a>
            <a href="{{ route('katalog.publik') }}" class="hover:text-blue-600 transition-colors">Cari Tutor</a>
            <a href="#" class="text-blue-600 border-b-2 border-blue-600 pb-1">Dashboard Saya</a>
        </div>

        {{-- Profil Murid & Tombol Logout --}}
        <div class="flex items-center gap-4">
            <div class="hidden md:block text-right">
                <p class="text-xs font-black text-slate-900">{{ auth()->user()->name ?? 'Siswa' }}</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Siswa Aktif</p>
            </div>
            
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-700 text-white rounded-full flex items-center justify-center font-black text-lg shadow-inner">
                {{ strtoupper(substr(auth()->user()->name ?? 'M', 0, 1)) }}
            </div>
            
            <form method="POST" action="{{ route('logout') }}" class="ml-2">
                @csrf
                <button type="submit" class="w-10 h-10 bg-rose-50 text-rose-500 rounded-full flex items-center justify-center hover:bg-rose-500 hover:text-white transition-all shadow-sm" title="Keluar dari Akun">
                    <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                </button>
            </form>
        </div>
    </nav>

    {{-- KONTEN UTAMA DASHBOARD --}}
    <main class="flex-grow max-w-7xl mx-auto w-full px-6 md:px-8 pt-16 pb-10 md:pt-24">
        
        {{-- Banner Welcome (Versi Terang / Bersih) --}}
        <div class="bg-white rounded-[2rem] p-8 md:p-12 mb-10 relative overflow-hidden shadow-sm border border-slate-200 group hover:border-blue-300 transition-colors">
            <div class="absolute top-0 right-0 w-72 h-72 bg-blue-50 rounded-full blur-3xl opacity-70 translate-x-1/3 -translate-y-1/3 group-hover:bg-blue-100 transition-colors"></div>
            <div class="absolute bottom-0 left-10 w-40 h-40 bg-orange-50 rounded-full blur-3xl opacity-70 translate-y-1/2 group-hover:bg-orange-100 transition-colors"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <p class="text-blue-600 font-bold mb-2 tracking-wide flex items-center gap-2">
                        <span>Selamat datang kembali!</span> <span class="text-xl animate-bounce">👋</span>
                    </p>
                    <h1 class="text-3xl md:text-5xl font-black text-slate-900 mb-4 tracking-tight">{{ auth()->user()->name ?? 'Siswa Berprestasi' }}</h1>
                    <p class="text-sm md:text-base text-slate-500 font-medium max-w-xl leading-relaxed">
                        Siap untuk belajar hal baru hari ini? Pantau jadwal les, status pembayaran, dan hubungi tutormu dengan mudah di sini.
                    </p>
                </div>
                <a href="{{ route('katalog.publik') }}" class="shrink-0 bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-lg shadow-blue-600/20 transform hover:-translate-y-1">
                    + Pesan Tutor Baru
                </a>
            </div>
        </div>

        {{-- Statistik Belajar Singkat --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-10">
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm flex items-center gap-4 hover:border-blue-300 transition-colors">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tutor Aktif</p>
                    <p class="text-2xl font-black text-slate-800">{{ $statistik['tutor_aktif'] ?? 0 }}</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm flex items-center gap-4 hover:border-blue-300 transition-colors">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Sesi Minggu Ini</p>
                    <p class="text-2xl font-black text-slate-800">{{ $statistik['sesi_minggu_ini'] ?? 0 }}</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm flex items-center gap-4 hover:border-blue-300 transition-colors">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tagihan Aktif</p>
                    <p class="text-2xl font-black text-slate-800">{{ $statistik['tagihan_aktif'] ?? 0 }}</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm flex items-center gap-4 hover:border-blue-300 transition-colors">
                <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Sesi Selesai</p>
                    <p class="text-2xl font-black text-slate-800">{{ $statistik['sesi_selesai'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        {{-- Area Konten Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
            
            {{-- KOLOM KIRI (Lebar 2/3): FITUR JADWAL & TRANSAKSI --}}
            <div class="lg:col-span-2 space-y-8">
                
                {{-- Fitur 1: Jadwal Les Terdekat --}}
                <section>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-black text-slate-900">Jadwal Les Terdekat</h2>
                        <a href="#" class="text-xs font-bold text-blue-600 hover:text-blue-800 transition-colors">Lihat Semua Jadwal &rarr;</a>
                    </div>
                    
                    @forelse($jadwal_les ?? [] as $jadwal)
                        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm flex flex-col md:flex-row md:items-center gap-6 relative overflow-hidden group hover:border-blue-300 transition-all mb-4">
                            <div class="absolute left-0 top-0 bottom-0 w-2 bg-blue-500"></div>
                            
                            {{-- Tanggal & Jam --}}
                            <div class="bg-blue-50 text-blue-600 rounded-2xl p-4 text-center shrink-0 min-w-[110px]">
                                <p class="text-xs font-black uppercase tracking-widest mb-1">{{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d M') }}</p>
                                <p class="text-2xl font-black">{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}</p>
                                <p class="text-[10px] font-bold mt-1">WIB</p>
                            </div>
                            
                            {{-- Detail Pelajaran --}}
                            <div class="flex-grow">
                                <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-100 text-slate-600 rounded-md text-[10px] font-black uppercase tracking-widest mb-3">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $jadwal->metode == 'Online' ? 'bg-emerald-500' : 'bg-orange-500' }}"></span> 
                                    {{ $jadwal->metode }}
                                </div>
                                <h3 class="text-lg font-black text-slate-900 mb-1">{{ $jadwal->mapel }}</h3>
                                <p class="text-sm font-medium text-slate-500 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    Bersama: <span class="font-bold text-slate-700">{{ $jadwal->tutor->name ?? 'Tutor' }}</span>
                                </p>
                            </div>
                            
                            {{-- Tombol Aksi --}}
                            <div class="shrink-0 flex gap-3 mt-4 md:mt-0">
                                @if($jadwal->link_zoom)
                                <a href="{{ $jadwal->link_zoom }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-md shadow-blue-600/20 flex items-center justify-center">
                                    Masuk Kelas
                                </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        {{-- Tampilan Kosong Jadwal --}}
                        <div class="bg-white p-8 rounded-[2rem] border-2 border-dashed border-blue-200 shadow-sm text-center flex flex-col items-center justify-center py-12 hover:border-blue-400 hover:bg-blue-50/30 transition-all group">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4 shadow-inner group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <h3 class="text-lg font-black text-slate-800 mb-2">Belum Ada Jadwal Aktif</h3>
                            <p class="text-sm font-medium text-slate-600 max-w-sm mb-6 leading-relaxed">Kamu belum memiliki jadwal kelas minggu ini.</p>
                            <a href="{{ route('katalog.publik') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-full text-xs font-black uppercase tracking-widest transition-all shadow-lg shadow-blue-600/30">
                                Cari Tutor Sekarang
                            </a>
                        </div>
                    @endforelse
                </section>

                {{-- Fitur 2: Riwayat Transaksi / Pemesanan --}}
                <section>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-black text-slate-900">Riwayat Pembayaran</h2>
                    </div>
                    
                    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden">
                        <div class="divide-y divide-slate-100">
                            @forelse($riwayat_transaksi ?? [] as $transaksi)
                                {{-- Item Transaksi Dinamis --}}
                                <div class="p-5 flex items-center justify-between hover:bg-slate-50 transition-colors">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $transaksi->status == 'Lunas' ? 'bg-emerald-100 text-emerald-600' : 'bg-amber-100 text-amber-600' }}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-900 mb-0.5">Paket Les {{ $transaksi->mapel }}</p>
                                            <p class="text-[11px] font-medium text-slate-500">{{ \Carbon\Carbon::parse($transaksi->created_at)->translatedFormat('d M Y') }} • #INV-{{ $transaksi->id }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-black text-slate-900 mb-1">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                                        <span class="inline-block px-2.5 py-1 rounded-md text-[9px] font-black uppercase tracking-widest {{ $transaksi->status == 'Lunas' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                            {{ $transaksi->status }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                {{-- Tampilan Kosong Transaksi --}}
                                <div class="p-8 text-center text-slate-500 text-sm font-medium">
                                    Belum ada riwayat pembayaran yang tercatat.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </section>

            </div>

            {{-- KOLOM KANAN (Lebar 1/3): TUTOR AKTIF & BANTUAN --}}
            <div class="space-y-8">
                
                {{-- Fitur 3: Daftar Tutor Aktif Saya (Quick Contact) --}}
                <section>
                    <h2 class="text-xl font-black text-slate-900 mb-4">Tutor Saya</h2>
                    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm p-2">
                        @forelse($tutor_saya ?? [] as $tutor)
                            <div class="flex items-center gap-4 p-3 rounded-2xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                                <div class="w-12 h-12 bg-slate-200 rounded-xl overflow-hidden shrink-0">
                                    {{-- Cek apakah tutor punya foto profil, kalau tidak pakai inisial --}}
                                    @if($tutor->foto)
                                        <img src="{{ asset('storage/'.$tutor->foto) }}" alt="{{ $tutor->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-blue-500 to-blue-700 text-white flex items-center justify-center font-black text-lg">
                                            {{ strtoupper(substr($tutor->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow min-w-0">
                                    <h4 class="font-black text-sm text-slate-900 truncate">{{ $tutor->name }}</h4>
                                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider truncate">{{ $tutor->bidang_utama ?? 'Tutor' }}</p>
                                </div>
                                <a href="https://wa.me/{{ $tutor->whatsapp }}" target="_blank" class="shrink-0 text-emerald-600 hover:text-white hover:bg-emerald-500 bg-emerald-50 w-10 h-10 rounded-xl flex items-center justify-center transition-all" title="Chat Tutor">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884"/></svg>
                                </a>
                            </div>
                        @empty
                            <div class="p-6 text-center text-slate-400">
                                <p class="text-xs font-medium">Belum ada tutor aktif.</p>
                            </div>
                        @endforelse
                        
                        <div class="p-2 pt-0 mt-2 border-t border-slate-100">
                            <a href="{{ route('katalog.publik') }}" class="block w-full text-center py-2.5 rounded-xl text-[11px] font-black text-blue-600 uppercase tracking-widest hover:bg-blue-50 transition-colors">
                                + Cari Tutor Baru
                            </a>
                        </div>
                    </div>
                </section>

                {{-- Fitur 4: Widget Bantuan CS --}}
                <div class="bg-blue-950 rounded-[2rem] p-6 shadow-lg shadow-blue-900/20 relative overflow-hidden">
                    {{-- Hiasan Lingkaran --}}
                    <div class="absolute -right-4 -bottom-4 w-32 h-32 bg-blue-800 rounded-full blur-2xl opacity-50"></div>
                    
                    <h3 class="text-sm font-black text-white mb-2 relative z-10">Butuh Bantuan?</h3>
                    <p class="text-xs font-medium text-blue-200 mb-5 leading-relaxed relative z-10">Admin kami siap membantu memandu pendaftaran kelas atau memecahkan kendala teknis.</p>
                    <a href="https://wa.me/6285859222500" target="_blank" class="flex items-center justify-center gap-2 w-full bg-emerald-500 hover:bg-emerald-400 text-white py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all relative z-10">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.414 0 0 5.414 0 12.05c0 2.123.553 4.197 1.603 6.013L0 24l6.135-1.611a11.79 11.79 0 005.911 1.586h.005c6.632 0 12.045-5.413 12.045-12.051 0-3.21-1.248-6.227-3.511-8.491z"/></svg>
                        Hubungi Admin
                    </a>
                </div>

            </div>
        </div>
    </main>

    {{-- FOOTER (Tetap Sama) --}}
    <footer class="bg-white pt-16 border-t border-slate-200 mt-auto">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <a href="/" class="inline-block mb-6">
                <img src="{{ asset('img/logo.png') }}" alt="tempatles.id Logo" class="h-16 mx-auto opacity-80 hover:opacity-100 transition-opacity">
            </a>
            <p class="text-slate-500 text-sm leading-relaxed mb-8 max-w-2xl mx-auto font-medium">
                Sistem dashboard terintegrasi untuk memudahkanmu mengatur jadwal, memantau riwayat belajar, dan menemukan tutor terbaik di tempatles.id.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-10">
                <a href="{{ route('katalog.publik') }}" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-3 rounded-full transition-all shadow-lg shadow-blue-600/30 transform hover:-translate-y-1">
                    Eksplorasi Katalog Tutor
                </a>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-x-10 gap-y-4 text-xs font-semibold text-slate-500 mb-10">
                <a href="{{ route('profile.edit') }}" class="hover:text-blue-600 transition-colors">Pengaturan Akun</a>
                <a href="#" class="hover:text-blue-600 transition-colors">Kebijakan Privasi</a>
                <a href="#" class="hover:text-blue-600 transition-colors">Syarat Ketentuan</a>
            </div>
        </div>
        <div class="bg-slate-100 py-6 text-center text-xs font-medium text-slate-400">
            Copyright &copy; {{ date('Y') }} <span class="font-bold text-blue-600">tempatles.id</span> | Hak Cipta Dilindungi
        </div>
    </footer>
</body>
</html>