@extends('layouts.main')

@section('title', 'Ruang Belajar Murid - tempatles.id')

@section('content')
    {{-- KONTEN UTAMA --}}
    <main class="flex-grow max-w-7xl mx-auto w-full px-6 md:px-12 pt-10 pb-20 space-y-10">

        {{-- 1. SECTION: GREETING --}}
        <section class="flex flex-col lg:flex-row gap-6 items-stretch">
            
            {{-- Greeting Card --}}
            <div class="bg-blue-950 rounded-[2rem] p-8 md:p-10 flex-grow relative overflow-hidden flex flex-col justify-center shadow-lg">
                <div class="absolute right-0 top-0 w-64 h-64 bg-orange-500 rounded-full blur-3xl opacity-20 translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
                <h1 class="text-3xl md:text-4xl font-black text-white mb-2 relative z-10">
                    Semangat Belajar, {{ explode(' ', auth()->user()->name ?? 'Siswa')[0] }}! 🚀
                </h1>
                <p class="text-blue-200 font-medium text-sm md:text-base max-w-md relative z-10">
                    Ada target baru hari ini? Telusuri katalog kami untuk menemukan tutor yang tepat.
                </p>
                <div class="mt-8 relative z-10">
                    <a href="{{ route('katalog.publik') }}" class="inline-flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-md">
                        <span>Cari Tutor Baru</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

            {{-- Action Required Card --}}
            @if(isset($pesanan_aktif) && count($pesanan_aktif) > 0)
                <div class="lg:w-1/3 bg-white rounded-[2rem] border border-slate-200 p-6 md:p-8 flex flex-col shadow-sm">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-2.5 h-2.5 bg-rose-500 rounded-full animate-ping"></div>
                        <h2 class="text-xs font-black text-slate-500 uppercase tracking-widest">Tindakan Diperlukan</h2>
                    </div>
                    
                    <div class="flex-grow space-y-4 overflow-y-auto hide-scroll max-h-[200px]">
                        @foreach($pesanan_aktif as $pesanan)
                            @php $isBayar = $pesanan->status_pesanan == 'menunggu_pembayaran'; @endphp
                            
                            <div class="p-4 rounded-xl {{ $isBayar ? 'bg-orange-50 border border-orange-200' : 'bg-slate-50 border border-slate-200' }}">
                                <h3 class="font-bold text-slate-900 text-sm mb-1">Paket {{ $pesanan->mata_pelajaran }}</h3>
                                @if($isBayar)
                                    <p class="text-xs font-medium text-slate-600 mb-3">Tutor menyetujui. Lunasi tagihan <b class="text-orange-600">Rp {{ number_format($pesanan->grand_total, 0, ',', '.') }}</b>.</p>
                                    <a href="#" class="block w-full text-center bg-orange-500 text-white py-2.5 rounded-lg text-xs font-bold shadow-sm hover:bg-orange-600 transition-colors">Bayar Sekarang</a>
                                @else
                                    <p class="text-[11px] font-bold text-blue-600 bg-blue-100 py-1.5 px-3 rounded-lg mt-2 inline-block">Menunggu Konfirmasi...</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>

        {{-- 2. SECTION: JADWAL KELAS (Horizontal Scroll) --}}
        <section>
            <div class="flex items-center justify-between mb-4 px-1">
                <h2 class="text-xl font-black text-blue-950">Jadwal Kelasmu</h2>
            </div>

            @if(empty($jadwal_les))
                <div class="bg-white border border-slate-200 rounded-[2rem] p-10 text-center flex flex-col items-center justify-center shadow-sm">
                    <div class="w-16 h-16 bg-slate-50 text-slate-400 rounded-full flex items-center justify-center mb-4 border border-slate-100"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                    <p class="text-slate-600 font-medium">Jadwal masih kosong. Chat tutormu untuk menentukan hari!</p>
                </div>
            @else
                <div class="flex overflow-x-auto gap-6 pb-6 pt-2 hide-scroll snap-x">
                    @foreach($jadwal_les as $jadwal)
                        <div class="snap-start shrink-0 w-[280px] sm:w-[320px] bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden flex flex-col group hover:border-blue-300 transition-colors hover:shadow-md hover:-translate-y-1 transform duration-300">
                            {{-- Header Tiket --}}
                            <div class="bg-slate-50 p-5 border-b border-slate-100 flex items-center justify-between">
                                <div class="bg-white px-3 py-1.5 rounded-lg border border-slate-200 shadow-sm text-center">
                                    <p class="text-[10px] font-black text-blue-600 uppercase">{{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('M') }}</p>
                                    <p class="text-xl font-black text-slate-800 leading-none">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Jam</p>
                                    <p class="text-lg font-black text-blue-950">{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}</p>
                                </div>
                            </div>
                            {{-- Body Tiket --}}
                            <div class="p-5 flex-grow bg-white">
                                <span class="inline-block px-2 py-0.5 bg-slate-100 text-slate-600 rounded text-[9px] font-black uppercase tracking-widest mb-2 border border-slate-200">{{ $jadwal->metode }}</span>
                                <h3 class="font-black text-slate-900 text-lg mb-1">{{ $jadwal->mapel }}</h3>
                                <p class="text-xs font-medium text-slate-500">Tutor: <span class="font-bold text-slate-800">{{ $jadwal->tutor->name ?? 'Tutor' }}</span></p>
                            </div>
                            {{-- Footer Action --}}
                            @if($jadwal->link_zoom)
                                <div class="p-4 bg-white border-t border-slate-100">
                                    <a href="{{ $jadwal->link_zoom }}" target="_blank" class="block w-full py-2.5 bg-blue-50 text-blue-600 border border-blue-200 text-center rounded-xl text-xs font-bold hover:bg-blue-600 hover:text-white transition-colors">Masuk Kelas</a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        {{-- 3. SECTION: KONTEN BAWAH --}}
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            {{-- KOLOM KIRI: Daftar Tutor Aktif --}}
            <div class="bg-white rounded-[2rem] border border-slate-200 p-6 md:p-8 shadow-sm">
                <h2 class="text-lg font-black text-blue-950 mb-6">Tutor Aktif Saya</h2>
                <div class="space-y-3">
                    @forelse($tutor_saya ?? [] as $tutor)
                        <div class="flex items-center gap-4 p-4 rounded-2xl bg-white border border-slate-100 shadow-sm hover:border-slate-300 transition-colors">
                            <div class="w-12 h-12 rounded-full overflow-hidden bg-slate-100 shrink-0 border border-slate-200">
                                @if($tutor->foto)
                                    <img src="{{ asset('storage/'.$tutor->foto) }}" alt="{{ $tutor->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center font-black text-slate-500">{{ strtoupper(substr($tutor->name, 0, 1)) }}</div>
                                @endif
                            </div>
                            <div class="flex-grow min-w-0">
                                <h4 class="font-bold text-slate-900 text-sm truncate">{{ $tutor->name }}</h4>
                                <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest mt-0.5 flex items-center gap-1"><span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Chat Aktif</p>
                            </div>
                            <a href="https://wa.me/{{ $tutor->whatsapp }}" target="_blank" class="px-4 py-2 rounded-xl bg-emerald-50 text-emerald-700 text-xs font-bold flex items-center gap-1 hover:bg-emerald-500 hover:text-white transition-colors shrink-0 border border-emerald-100">
                                Chat
                            </a>
                        </div>
                    @empty
                        <div class="text-center py-8 bg-slate-50 rounded-2xl border border-slate-200">
                            <p class="text-sm text-slate-500 font-medium">Belum ada tutor aktif.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- KOLOM KANAN: Riwayat Transaksi & CS --}}
            <div class="flex flex-col gap-8">
                
                {{-- Riwayat Transaksi --}}
                <div class="bg-white rounded-[2rem] border border-slate-200 p-6 md:p-8 shadow-sm flex-grow">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-black text-blue-950">Riwayat Transaksi</h2>
                    </div>
                    <div class="space-y-3">
                        @forelse($riwayat_transaksi ?? [] as $transaksi)
                            @php $isSuccess = ($transaksi->status_pesanan == 'berjalan' || $transaksi->status_pesanan == 'selesai'); @endphp
                            <div class="flex items-center justify-between p-4 bg-white border border-slate-100 shadow-sm rounded-2xl">
                                <div>
                                    <p class="font-bold text-slate-900 text-sm">Paket {{ $transaksi->mata_pelajaran }}</p>
                                    <p class="text-xs text-slate-500 mt-1">{{ \Carbon\Carbon::parse($transaksi->created_at)->translatedFormat('d M Y') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-slate-900 text-sm mb-1">Rp {{ number_format($transaksi->grand_total, 0, ',', '.') }}</p>
                                    <span class="text-[9px] font-bold uppercase tracking-widest px-2 py-1 rounded-md border {{ $isSuccess ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-slate-100 text-slate-600 border-slate-200' }}">
                                        {{ str_replace('_', ' ', $transaksi->status_pesanan) }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 bg-slate-50 rounded-2xl border border-slate-200">
                                <p class="text-sm text-slate-500 font-medium">Belum ada transaksi.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- WIDGET BANTUAN CS --}}
                <div class="bg-blue-950 rounded-[2rem] p-6 shadow-lg relative overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 w-32 h-32 bg-white/5 rounded-full blur-2xl pointer-events-none"></div>
                    
                    <div class="flex items-center gap-4 mb-5 relative z-10">
                        <div class="w-12 h-12 bg-white/10 border border-white/20 rounded-xl flex items-center justify-center text-white backdrop-blur-sm shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-black text-white leading-tight">Butuh Bantuan?</h3>
                            <p class="text-xs font-medium text-blue-200 mt-1">Tim CS siap membantu keluhan Anda.</p>
                        </div>
                    </div>
                    
                    <a href="https://wa.me/6285859222500" target="_blank" class="block w-full bg-emerald-500 hover:bg-emerald-400 text-white text-center py-3 rounded-xl text-sm font-bold transition-all shadow-sm relative z-10">
                        Chat via WhatsApp
                    </a>
                </div>

            </div>
        </section>

    </main>
@endsection