<x-app-layout>
    <style>
        [x-cloak] { display: none !important; }
    </style>

    {{-- HEADER STICKY --}}
    <div class="sticky top-0 z-[40] bg-slate-50/90 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-5xl mx-auto px-6 py-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.orders') }}" class="w-10 h-10 bg-white border border-slate-200 rounded-full flex items-center justify-center text-slate-500 hover:bg-blue-50 hover:text-blue-600 transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" /></svg>
                </a>
                <div>
                    <p class="text-[9px] font-black text-blue-500 uppercase tracking-[0.2em] mb-0.5">DETAIL TRANSAKSI</p>
                    <h2 class="font-black text-xl text-slate-900 tracking-tight">#ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</h2>
                </div>
            </div>

            {{-- TOMBOL INTERVENSI (Hanya muncul jika pesanan belum selesai/batal) --}}
            @if(!in_array($order->status_pesanan, ['selesai', 'dibatalkan']))
            <div x-data="{ cancelOpen: false }">
                <button @click="cancelOpen = true" type="button" class="bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white border border-rose-200 px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                    Batalkan Pesanan
                </button>

                {{-- MODAL BATALKAN PESANAN --}}
                <template x-teleport="body">
                    <div x-show="cancelOpen" x-cloak class="fixed inset-0 z-[110] flex items-center justify-center p-4" aria-modal="true">
                        <div x-show="cancelOpen" x-transition.opacity class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm" @click="cancelOpen = false"></div>
                        <div x-show="cancelOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" class="relative bg-white rounded-3xl shadow-2xl p-8 w-full max-w-sm text-center border border-slate-100">
                            <div class="w-20 h-20 rounded-full mx-auto flex items-center justify-center mb-5 bg-rose-100 text-rose-500 shadow-inner">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                            </div>
                            <h3 class="text-xl font-black text-slate-800 mb-2">Batalkan Pesanan?</h3>
                            <p class="text-sm font-medium text-slate-500 mb-8 leading-relaxed">
                                Pesanan ini akan dibatalkan secara paksa dan tidak dapat dikembalikan lagi. Lanjutkan?
                            </p>
                            <div class="flex gap-3">
                                <button @click="cancelOpen = false" type="button" class="w-full px-5 py-3 bg-slate-50 hover:bg-slate-100 text-slate-600 text-[10px] font-black uppercase tracking-widest rounded-xl border border-slate-200">Tutup</button>
                                <form action="{{ route('admin.orders.cancel', $order->id) }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" class="w-full px-5 py-3 bg-rose-600 hover:bg-rose-700 text-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-md active:scale-95">Ya, Batalkan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            @endif
        </div>
    </div>

    <div class="py-10 max-w-5xl mx-auto px-6 space-y-8">
        
        {{-- Flash Messages --}}
        @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 shadow-sm rounded-2xl flex items-center gap-4">
            <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
            </div>
            <span class="font-black text-sm text-emerald-800 tracking-wide">{{ session('success') }}</span>
        </div>
        @endif

        {{-- CARD PARTISIPAN --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Card Murid --}}
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-start gap-5">
                <div class="w-14 h-14 bg-orange-100 text-orange-600 rounded-2xl flex items-center justify-center font-black text-xl shrink-0">
                    {{ strtoupper(substr($order->murid->name ?? '?', 0, 1)) }}
                </div>
                <div>
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Pemesan (Murid)</p>
                    <h4 class="font-bold text-slate-900 text-base">{{ $order->murid->name ?? 'User Terhapus' }}</h4>
                    <p class="text-xs text-slate-500 font-mono mt-0.5">{{ $order->murid->email ?? '-' }}</p>
                    @if(isset($order->murid->phone_number))
                    <a href="https://wa.me/{{ $order->murid->phone_number }}" target="_blank" class="text-[10px] text-emerald-600 font-bold inline-flex items-center gap-1 mt-2 hover:underline uppercase tracking-wider">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        Hubungi via WhatsApp
                    </a>
                    @endif
                </div>
            </div>

            {{-- Card Tutor --}}
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-start gap-5">
                <div class="w-14 h-14 bg-blue-950 text-white rounded-2xl flex items-center justify-center font-black text-xl shrink-0">
                    {{ strtoupper(substr($order->tutor->name ?? '?', 0, 1)) }}
                </div>
                <div>
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Pengajar (Tutor)</p>
                    <h4 class="font-bold text-slate-900 text-base">{{ $order->tutor->name ?? 'User Terhapus' }}</h4>
                    <p class="text-xs text-slate-500 font-mono mt-0.5">{{ $order->tutor->email ?? '-' }}</p>
                    @if(isset($order->tutor->phone_number))
                    <a href="https://wa.me/{{ $order->tutor->phone_number }}" target="_blank" class="text-[10px] text-emerald-600 font-bold inline-flex items-center gap-1 mt-2 hover:underline uppercase tracking-wider">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        Hubungi via WhatsApp
                    </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- DETAIL PAKET & KEUANGAN --}}
        <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                <h3 class="font-black text-slate-800 uppercase text-xs tracking-widest">Detail & Keuangan</h3>
                
                @php
                $statusClasses = [
                'menunggu_konfirmasi' => 'bg-gray-100 text-gray-600 border-gray-200',
                'menunggu_pembayaran' => 'bg-orange-100 text-orange-700 border-orange-200',
                'berjalan' => 'bg-blue-100 text-blue-700 border-blue-200',
                'selesai' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                'komplain' => 'bg-rose-100 text-rose-700 border-rose-200',
                'dibatalkan' => 'bg-red-100 text-red-700 border-red-200',
                ];
                $badgeClass = $statusClasses[$order->status_pesanan] ?? 'bg-gray-100 text-gray-600 border-gray-200';
                @endphp
                <span class="px-3 py-1.5 rounded-lg border {{ $badgeClass }} text-[9px] font-black uppercase tracking-widest">
                    Status: {{ str_replace('_', ' ', $order->status_pesanan) }}
                </span>
            </div>
            
            <div class="p-8 grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="col-span-2 md:col-span-1">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Mata Pelajaran</p>
                    <p class="font-bold text-slate-900 text-lg">{{ $order->mata_pelajaran }}</p>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Kuantitas</p>
                    <p class="font-bold text-slate-900 text-lg">{{ $order->jumlah_sesi }} Sesi</p>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Tarif / Sesi</p>
                    <p class="font-bold text-slate-900 text-lg">Rp {{ number_format($order->tarif_per_sesi, 0, ',', '.') }}</p>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Harga Paket</p>
                    <p class="font-bold text-blue-600 text-lg">Rp {{ number_format($order->harga_paket, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="bg-blue-950 p-8 flex flex-col md:flex-row justify-between items-center text-white gap-6">
                <div>
                    <p class="text-[10px] font-black text-blue-300 uppercase tracking-widest mb-1">Grand Total Transaksi (Dibayar Murid)</p>
                    <p class="font-black text-4xl">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                </div>
                <div class="text-right border-l-0 md:border-l border-white/20 pl-0 md:pl-8 w-full md:w-auto">
                    <p class="text-[10px] font-bold text-blue-200 uppercase tracking-widest">Fee Platform: Rp {{ number_format($order->biaya_layanan, 0, ',', '.') }}</p>
                    <p class="text-[11px] font-black text-emerald-400 uppercase tracking-widest mt-1.5">Nett Tutor: Rp {{ number_format($order->total_harga_sesi, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>