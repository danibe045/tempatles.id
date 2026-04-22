<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pesanan - tempatles.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .bg-pattern {
        background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
        background-size: 20px 20px;
    }

    /* Logika Tab pakai CSS murni */
    .tab-content {
        display: none;
        animation: fadeIn 0.3s ease;
    }

    input[type="radio"]:checked+label {
        background-color: #1e3a8a;
        color: white;
        border-color: #1e3a8a;
    }

    #tab-1:checked~#content-1,
    #tab-2:checked~#content-2,
    #tab-3:checked~#content-3,
    #tab-4:checked~#content-4 {
        display: block;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(5px);
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

    <main class="py-8 md:py-12 min-h-screen relative z-10">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-white hover:bg-slate-100 text-slate-600 rounded-full transition-all shadow-sm border border-slate-200 mb-6 w-fit text-xs font-bold hover:-translate-x-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Dashboard
            </a>

            <div
                class="bg-white border border-slate-200 shadow-sm rounded-[2rem] p-8 md:p-10 mb-8 relative overflow-hidden">
                <div class="relative z-10">
                    <div
                        class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 text-blue-600 px-3 py-1.5 rounded-full mb-3 shadow-sm">
                        <span class="text-[10px] font-black uppercase tracking-[0.25em]">Riwayat Transaksi</span>
                    </div>
                    <h2 class="font-black text-3xl md:text-4xl text-slate-900 leading-tight tracking-tight mb-2">
                        Manajemen Pesanan</h2>
                    <p class="text-sm text-slate-500 font-medium max-w-xl">Kelola permintaan murid, periksa jadwal, dan
                        hubungi murid untuk memulai kelas.</p>
                </div>
            </div>

            @if(session('success'))
            <div class="mb-8 p-5 bg-emerald-50 border border-emerald-200 shadow-sm rounded-2xl flex items-center gap-4">
                <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-black text-sm text-slate-900">Berhasil!</h4>
                    <span class="font-medium text-xs text-slate-600">{{ session('success') }}</span>
                </div>
            </div>
            @endif

            {{-- SISTEM TABS (CSS Only) --}}
            <div class="mb-8 flex flex-wrap gap-3 border-b border-slate-200 pb-4">
                <input type="radio" name="tabs" id="tab-1" class="hidden" checked>
                <label for="tab-1"
                    class="cursor-pointer px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-black uppercase tracking-widest text-slate-500 hover:bg-slate-100 transition-all shadow-sm">
                    Pesanan Baru ({{ $pesananBaru->count() }})
                </label>

                <input type="radio" name="tabs" id="tab-2" class="hidden">
                <label for="tab-2"
                    class="cursor-pointer px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-black uppercase tracking-widest text-slate-500 hover:bg-slate-100 transition-all shadow-sm">
                    Sedang Berjalan ({{ $pesananBerjalan->count() }})
                </label>

                <input type="radio" name="tabs" id="tab-3" class="hidden">
                <label for="tab-3"
                    class="cursor-pointer px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-black uppercase tracking-widest text-slate-500 hover:bg-slate-100 transition-all shadow-sm">
                    Selesai ({{ $pesananSelesai->count() }})
                </label>

                <input type="radio" name="tabs" id="tab-4" class="hidden">
                <label for="tab-4"
                    class="cursor-pointer px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-black uppercase tracking-widest text-slate-500 hover:bg-slate-100 transition-all shadow-sm">
                    Batal/Komplain ({{ $pesananDibatalkan->count() }})
                </label>

                {{-- KONTEN TAB 1: PESANAN BARU --}}
                <div id="content-1" class="tab-content w-full mt-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($pesananBaru as $order)
                        <div
                            class="bg-white rounded-[2rem] border border-orange-200 shadow-sm p-6 lg:p-8 relative overflow-hidden group">
                            <div class="absolute top-0 left-0 w-full h-2 bg-orange-400"></div>

                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">
                                        #ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</p>
                                    <h3 class="text-xl font-black text-slate-900">{{ $order->mata_pelajaran }}</h3>
                                    <p class="text-sm font-bold text-slate-600 mt-1">Murid: {{ $order->murid->name }}
                                    </p>
                                </div>
                                <span
                                    class="bg-orange-100 text-orange-700 px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest">Menunggu
                                    Respons</span>
                            </div>

                            <div class="bg-slate-50 rounded-xl p-4 mb-6 grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">
                                        Pendapatan Sesi</p>
                                    <p class="text-sm font-black text-emerald-600">Rp
                                        {{ number_format($order->total_harga_sesi, 0, ',', '.') }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Total
                                        Pertemuan</p>
                                    <p class="text-sm font-black text-slate-800">{{ $order->jumlah_sesi }} Sesi</p>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <form action="{{ route('tutor.orders.accept', $order->id) }}" method="POST"
                                    class="flex-1">
                                    @csrf
                                    <button type="submit"
                                        class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-md shadow-emerald-500/20">
                                        Terima
                                    </button>
                                </form>
                                <form action="{{ route('tutor.orders.reject', $order->id) }}" method="POST"
                                    class="flex-1"
                                    onsubmit="return confirm('Yakin ingin menolak pesanan ini? Kuota tidak akan dipotong.')">
                                    @csrf
                                    <button type="submit"
                                        class="w-full bg-white border border-rose-200 text-rose-500 hover:bg-rose-50 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all">
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <div
                            class="col-span-full py-16 text-center bg-white rounded-[2rem] border border-slate-200 border-dashed">
                            <p class="text-slate-400 font-bold">Belum ada pesanan baru masuk.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                {{-- KONTEN TAB 2: SEDANG BERJALAN --}}
                <div id="content-2" class="tab-content w-full mt-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($pesananBerjalan as $order)
                        <div class="bg-white rounded-[2rem] border border-blue-200 shadow-sm p-6 lg:p-8 relative">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-lg font-black text-slate-900">{{ $order->mata_pelajaran }}</h3>
                                    <p class="text-sm font-bold text-slate-600 mt-1">Murid: {{ $order->murid->name }}
                                    </p>
                                </div>
                                <span
                                    class="bg-blue-100 text-blue-700 px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest">Aktif
                                    Mengajar</span>
                            </div>
                            <div class="mt-4 border-t border-slate-100 pt-4 flex gap-3">
                                <a href="https://wa.me/{{ $order->murid->phone_number ?? '' }}" target="_blank"
                                    class="w-full bg-slate-50 hover:bg-emerald-50 border border-slate-200 hover:border-emerald-200 text-slate-600 hover:text-emerald-600 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all text-center flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    Chat Murid
                                </a>
                            </div>
                        </div>
                        @empty
                        <div
                            class="col-span-full py-16 text-center bg-white rounded-[2rem] border border-slate-200 border-dashed">
                            <p class="text-slate-400 font-bold">Belum ada kelas yang sedang berjalan.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                {{-- KONTEN TAB 3: SELESAI --}}
                <div id="content-3" class="tab-content w-full mt-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @forelse($pesananSelesai as $order)
                        <div
                            class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 relative opacity-70 hover:opacity-100 transition-opacity">
                            <h3 class="text-base font-black text-slate-900">{{ $order->mata_pelajaran }}</h3>
                            <p class="text-xs font-bold text-slate-500 mb-3">Murid: {{ $order->murid->name }}</p>
                            <span
                                class="bg-slate-100 text-slate-500 px-3 py-1 rounded-md text-[9px] font-black uppercase tracking-widest">Selesai</span>
                        </div>
                        @empty
                        <div class="col-span-full py-12 text-center">
                            <p class="text-slate-400 font-bold text-sm">Riwayat pesanan selesai masih kosong.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                {{-- KONTEN TAB 4: DIBATALKAN --}}
                <div id="content-4" class="tab-content w-full mt-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @forelse($pesananDibatalkan as $order)
                        <div class="bg-rose-50 rounded-2xl border border-rose-100 shadow-sm p-5 relative">
                            <h3 class="text-base font-black text-rose-900">{{ $order->mata_pelajaran }}</h3>
                            <p class="text-xs font-bold text-rose-500 mb-3">Murid: {{ $order->murid->name }}</p>
                            <span
                                class="bg-rose-200 text-rose-700 px-3 py-1 rounded-md text-[9px] font-black uppercase tracking-widest">Batal
                                / Komplain</span>
                        </div>
                        @empty
                        <div class="col-span-full py-12 text-center">
                            <p class="text-slate-400 font-bold text-sm">Tidak ada riwayat pembatalan.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </main>
</body>

</html>