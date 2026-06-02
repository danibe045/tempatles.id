{{-- FILE: resources/views/user/riwayat-kelas.blade.php --}}
@extends('layouts.main')

@section('title', 'Riwayat Belajar - tempatles.id')

@section('content')
<main class="flex-grow w-full pt-8 pb-24 font-['Plus_Jakarta_Sans'] bg-[#F8FAFC] relative min-h-screen">
    
    {{-- Latar Belakang Estetik --}}
    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="absolute inset-0 bg-[radial-gradient(#cbd5e1_1px,transparent_1px)] [background-size:24px_24px] opacity-40"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-500/10 blur-[120px] rounded-full"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 md:px-12 relative z-10">
        
        {{-- Header Halaman --}}
        <div class="mb-10">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-[10px] font-black text-blue-600 uppercase tracking-widest mb-4 hover:text-blue-800 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" /></svg>
                Kembali ke Dasbor
            </a>
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center border border-slate-200 shadow-sm shrink-0">
                    <span class="text-2xl">🗄️</span>
                </div>
                <div>
                    <h1 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight mb-1">Riwayat Belajar</h1>
                    <p class="text-sm font-medium text-slate-500">Arsip seluruh kelas dan transaksi yang telah lalu.</p>
                </div>
            </div>
        </div>

        {{-- GRID KARTU RIWAYAT --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($riwayatOrders as $transaksi)
            @php
                $isSelesai = $transaksi->status_pesanan == 'selesai';
                $isBatal = $transaksi->status_pesanan == 'dibatalkan';
                
                if($isSelesai) {
                    $badgeTheme = 'bg-emerald-100 text-emerald-700 border-emerald-200';
                } elseif($isBatal) {
                    $badgeTheme = 'bg-slate-100 text-slate-600 border-slate-200';
                } else {
                    $badgeTheme = 'bg-rose-100 text-rose-700 border-rose-200'; // Untuk status komplain
                }
            @endphp

            <div class="bg-white border border-slate-200 shadow-sm rounded-[2rem] hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col group">
                <div class="p-6 flex-grow">
                    <div class="flex justify-between items-start mb-4">
                        <span class="inline-block px-2.5 py-1 rounded-lg {{ $badgeTheme }} border text-[9px] font-black uppercase tracking-widest">
                            {{ str_replace('_', ' ', $transaksi->status_pesanan) }}
                        </span>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">{{ \Carbon\Carbon::parse($transaksi->created_at)->translatedFormat('d M Y') }}</p>
                    </div>

                    <h3 class="font-black text-slate-900 text-lg mb-2 line-clamp-1 group-hover:text-blue-600 transition-colors">{{ $transaksi->mata_pelajaran }}</h3>
                    
                    <div class="flex items-center gap-2 text-xs font-bold text-slate-500">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            Kak {{ $transaksi->tutor->name ?? 'Tutor' }}
                        </span>
                        <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                        <span>{{ $transaksi->jumlah_sesi ?? 0 }} Sesi</span>
                    </div>
                </div>

                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-between group-hover:bg-blue-50/50 transition-colors">
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Total Biaya</p>
                        <p class="font-black text-slate-800 text-sm">Rp {{ number_format($transaksi->grand_total, 0, ',', '.') }}</p>
                    </div>
                    
                    {{-- Tombol Arsip Materi (Hanya muncul jika Selesai dan punya sesi) --}}
                    @if($isSelesai && count($transaksi->sessions) > 0)
                    <button onclick="document.getElementById('modal-jurnal-riwayat-{{ $transaksi->id }}').showModal()" class="text-[10px] font-black text-blue-600 bg-white border border-blue-200 hover:bg-blue-600 hover:text-white px-4 py-2.5 rounded-xl uppercase tracking-widest shadow-sm transition-all active:scale-95 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477-4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                        Arsip Materi
                    </button>

                    {{-- Modal Arsip Jurnal --}}
                    <dialog id="modal-jurnal-riwayat-{{ $transaksi->id }}" class="rounded-[2.5rem] p-0 border border-slate-200 shadow-2xl backdrop:bg-slate-900/70 backdrop:backdrop-blur-sm m-auto w-full max-w-lg overflow-hidden transition-all duration-300">
                        <div class="bg-white relative flex flex-col max-h-[85vh]">
                            <div class="p-8 pb-6 border-b border-slate-100 bg-slate-50 sticky top-0 z-20 flex justify-between items-center">
                                <div>
                                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Arsip Jurnal Belajar</h3>
                                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-1">Paket {{ $transaksi->mata_pelajaran }}</p>
                                </div>
                                <button type="button" onclick="this.closest('dialog').close()" class="w-10 h-10 flex items-center justify-center bg-white border border-slate-200 hover:bg-rose-50 text-slate-400 hover:text-rose-500 rounded-full transition-colors shadow-sm active:scale-95">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </div>
                            <div class="p-8 overflow-y-auto custom-scrollbar bg-white">
                                <div class="space-y-4">
                                    @foreach($transaksi->sessions as $session)
                                    <div class="p-5 bg-slate-50 rounded-2xl border border-slate-200">
                                        <div class="flex justify-between items-center mb-3">
                                            <p class="font-black text-xs text-slate-800 uppercase">Sesi {{ $session->pertemuan_ke }}</p>
                                            <p class="text-[10px] font-bold text-slate-500">{{ \Carbon\Carbon::parse($session->tanggal_jadwal)->format('d M Y') }}</p>
                                        </div>
                                        @if($session->teachingJournal)
                                        <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm mb-4">
                                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1.5">Catatan Tutor</p>
                                            <p class="text-xs text-slate-700 leading-relaxed font-medium italic">"{{ $session->teachingJournal->catatan_materi }}"</p>
                                        </div>
                                        <div class="flex gap-2">
                                            @if($session->teachingJournal->foto_bukti_path)
                                            <a href="{{ asset('storage/' . $session->teachingJournal->foto_bukti_path) }}" target="_blank" class="flex-1 flex items-center justify-center gap-1.5 py-2 text-[10px] font-black text-blue-600 bg-blue-50 rounded-xl hover:bg-blue-600 hover:text-white border border-blue-100 transition-colors uppercase tracking-widest">
                                                📸 Bukti Foto
                                            </a>
                                            @endif
                                            @if($session->teachingJournal->file_materi)
                                            <a href="{{ asset('storage/' . $session->teachingJournal->file_materi) }}" target="_blank" class="flex-1 flex items-center justify-center gap-1.5 py-2 text-[10px] font-black text-orange-600 bg-orange-50 rounded-xl hover:bg-orange-500 hover:text-white border border-orange-100 transition-colors uppercase tracking-widest">
                                                📄 Modul
                                            </a>
                                            @endif
                                        </div>
                                        @else
                                        <p class="text-[10px] font-bold text-slate-400 italic">Tidak ada catatan untuk sesi ini.</p>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </dialog>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center opacity-60">
                <span class="text-6xl mb-4 block">🗄️</span>
                <h3 class="text-lg font-black text-slate-800">Belum ada riwayat</h3>
                <p class="text-sm font-medium text-slate-500">Anda belum memiliki transaksi kelas yang sudah selesai atau dibatalkan.</p>
            </div>
            @endforelse
        </div>

        {{-- Komponen Pagination Bawaan Laravel --}}
        @if($riwayatOrders->hasPages())
        <div class="mt-12">
            {{ $riwayatOrders->links() }}
        </div>
        @endif

    </div>
</main>
@endsection