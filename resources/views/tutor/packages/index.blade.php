<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etalase Paket - tempatles.id</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-pattern { background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 20px 20px; }
        
        /* Transisi mulus untuk modal */
        dialog[open] { animation: modalFadeIn 0.3s ease-out normal; }
        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(20px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased flex flex-col min-h-screen relative">

    {{-- Latar Belakang Pattern Tipis --}}
    <div class="fixed inset-0 bg-pattern opacity-30 z-[-1] pointer-events-none"></div>

    <main class="py-8 md:py-12 min-h-screen relative z-10">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            
            {{-- Tombol Kembali --}}
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white hover:bg-slate-100 text-slate-600 rounded-full transition-all shadow-sm border border-slate-200 mb-6 w-fit text-xs font-bold hover:-translate-x-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Dashboard
            </a>

            {{-- HEADER BERGAYA KARTU --}}
            <div class="bg-white border border-slate-200 shadow-sm rounded-[2rem] p-8 md:p-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 relative overflow-hidden mb-8 md:mb-12">
                <div class="relative z-10">
                    <div class="flex flex-col items-start">
                        <div class="inline-flex items-center gap-2 bg-orange-50 border border-orange-100 text-orange-600 px-3 py-1.5 rounded-full mb-3 shadow-sm">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                            </span>
                            <span class="text-[10px] font-black uppercase tracking-[0.25em]">Produk Unggulan Anda</span>
                        </div>
                        <h2 class="font-black text-3xl md:text-4xl text-slate-900 leading-tight tracking-tight mb-2">
                            Etalase Paket Belajar
                        </h2>
                        <p class="text-sm text-slate-500 font-medium max-w-xl leading-relaxed">Susun dan kelola daftar mata pelajaran Anda di sini. Aktifkan paket yang siap dipesan dan non-aktifkan jika Anda sedang sibuk.</p>
                    </div>
                </div>

                {{-- Tombol untuk buka modal --}}
                <button onclick="document.getElementById('modal-tambah-paket').showModal()" class="relative z-10 flex-shrink-0 inline-flex items-center justify-center gap-2 bg-blue-950 hover:bg-orange-500 text-white px-8 py-4 rounded-2xl text-sm font-black uppercase tracking-widest transition-all shadow-xl shadow-blue-950/20 active:scale-95 hover:-translate-y-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                    Tambah Paket Baru
                </button>
            </div>
            
            {{-- Pesan Sukses / Alert --}}
            @if(session('success'))
            <div class="mb-8 p-5 bg-emerald-50 border border-emerald-200 shadow-sm rounded-2xl flex items-center gap-4">
                <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div>
                    <h4 class="font-black text-sm text-slate-900">Aksi Berhasil!</h4>
                    <span class="font-medium text-xs text-slate-600">{{ session('success') }}</span>
                </div>
            </div>
            @endif

            {{-- Grid Daftar Paket --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($packages as $package)
                    <div class="bg-white rounded-[2.5rem] border border-slate-200 p-8 shadow-sm flex flex-col h-full transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-blue-300 group relative overflow-hidden {{ $package->is_active ? '' : 'opacity-70 saturate-[0.8]' }}">
                        
                        {{-- Badge Jenjang --}}
                        <div class="absolute top-0 right-0 px-6 py-2.5 {{ $package->is_active ? 'bg-blue-50 text-blue-700 border-blue-100' : 'bg-slate-100 text-slate-500 border-slate-200' }} rounded-bl-3xl border-b border-l text-[10px] font-black uppercase tracking-widest flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full {{ $package->is_active ? 'bg-emerald-500 animate-pulse' : 'bg-slate-400' }}"></span>
                            {{ $package->jenjang }}
                        </div>

                        <div class="mb-6 mt-2">
                            <p class="text-[10px] font-black {{ $package->is_active ? 'text-orange-500' : 'text-slate-400' }} uppercase tracking-widest mb-1.5 transition-colors">Mata Pelajaran</p>
                            <h3 class="text-2xl font-black text-slate-900 leading-tight mb-2">{{ $package->nama_mapel }}</h3>
                            <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed font-medium">{{ $package->deskripsi }}</p>
                        </div>

                        <div class="space-y-3 flex-grow">
                            <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                <span class="text-xs font-bold text-slate-700 flex items-center gap-2.5"><div class="w-2.5 h-2.5 bg-blue-500 rounded-full"></div> {{ $package->jumlah_sesi }} Sesi</span>
                                <span class="text-xs font-bold text-slate-700 flex items-center gap-2.5"><div class="w-2.5 h-2.5 bg-orange-500 rounded-full"></div> {{ $package->metode }}</span>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 text-xs font-bold text-slate-700 flex items-center gap-3">
                                <div class="w-7 h-7 bg-white rounded-lg flex items-center justify-center shadow-sm shrink-0">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <span class="truncate">{{ $package->domisili }}</span>
                            </div>
                            <div class="mt-6 pt-3">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Harga Bersih (Nett)</p>
                                <p class="text-3xl font-black {{ $package->is_active ? 'text-slate-900' : 'text-slate-500' }} tracking-tight">Rp {{ number_format($package->harga_nett, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        {{-- Aksi Bawah: Toggle & Hapus --}}
                        <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-between">
                            {{-- Toggle On/Off Switch Form --}}
                            <form action="{{ route('tutor.packages.toggle', $package->id) }}" method="POST" class="flex items-center gap-3 cursor-pointer group/toggle" onclick="this.submit()">
                                @csrf @method('PATCH')
                                <div class="relative inline-flex h-7 w-12 items-center rounded-full transition-colors duration-300 {{ $package->is_active ? 'bg-emerald-500' : 'bg-slate-300' }}">
                                    <span class="inline-block h-5 w-5 transform rounded-full bg-white shadow-sm transition-transform duration-300 ease-in-out {{ $package->is_active ? 'translate-x-6' : 'translate-x-1' }}"></span>
                                </div>
                                <span class="text-xs font-black {{ $package->is_active ? 'text-emerald-600' : 'text-slate-400' }} uppercase tracking-widest transition-colors">{{ $package->is_active ? 'Aktif Dijual' : 'Non-aktif' }}</span>
                            </form>

                            {{-- Tombol Hapus --}}
                            <form action="{{ route('tutor.packages.destroy', $package->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket ini secara permanen?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-slate-200 text-slate-400 hover:bg-rose-50 hover:text-rose-600 hover:border-rose-200 transition-all" title="Hapus Paket">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    {{-- EMPTY STATE (Tampilan Kosong) --}}
                    <div class="col-span-full bg-white rounded-[3rem] p-16 md:p-24 text-center border-2 border-dashed border-slate-200">
                        <div class="w-24 h-24 bg-orange-50 rounded-[2rem] flex items-center justify-center mx-auto mb-6 border border-orange-100">
                            <svg class="w-12 h-12 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        <h3 class="text-2xl font-black text-slate-800 mb-3">Toko Anda Masih Kosong</h3>
                        <p class="text-slate-500 font-medium max-w-md mx-auto text-sm leading-relaxed mb-8">Anda belum memiliki etalase paket belajar. Tambahkan paket pertama Anda untuk mulai mengajar dan mendapatkan penghasilan.</p>
                        <button onclick="document.getElementById('modal-tambah-paket').showModal()" class="inline-flex items-center gap-2 bg-blue-950 hover:bg-orange-500 text-white px-8 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-xl shadow-blue-950/20 active:scale-95">
                            + Buat Paket Sekarang
                        </button>
                    </div>
                @endforelse
            </div>
        </div>
    </main>

    {{-- MODAL TAMBAH PAKET --}}
    <dialog id="modal-tambah-paket" class="rounded-[2rem] p-0 border border-slate-200 shadow-2xl backdrop:bg-slate-900/60 backdrop:backdrop-blur-sm m-auto w-full max-w-xl overflow-hidden">
        <div class="bg-white relative">
            
            {{-- Tombol Close (X) --}}
            <button type="button" onclick="this.closest('dialog').close()" class="absolute top-6 right-6 w-10 h-10 flex items-center justify-center bg-slate-50 hover:bg-rose-50 text-slate-400 hover:text-rose-500 rounded-full transition-colors z-20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            
            <div class="p-8 md:p-10 relative z-10 overflow-y-auto max-h-[90vh]">
                <div class="mb-8">
                    <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-5 shadow-sm border border-blue-100">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight mb-2">Buat Paket Baru</h3>
                    <p class="text-sm font-medium text-slate-500">Rancang penawaran terbaik untuk memikat calon murid Anda.</p>
                </div>

                <form action="{{ route('tutor.packages.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-widest mb-2">Nama Mata Pelajaran</label>
                        <input type="text" name="nama_mapel" placeholder="Cth: Matematika / Mengaji" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-blue-900 transition-all outline-none placeholder:font-medium placeholder:text-slate-400">
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-widest mb-2">Deskripsi Singkat (Silabus)</label>
                        <textarea name="deskripsi" rows="3" placeholder="Jelaskan keunggulan paket ini, materi yang diajarkan, metode yang dipakai..." required class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-medium text-slate-900 focus:ring-2 focus:ring-blue-900 transition-all outline-none resize-none placeholder:text-slate-400"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-widest mb-2">Jenjang</label>
                            <select name="jenjang" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-blue-900 transition-all outline-none cursor-pointer">
                                <option value="SD">Sekolah Dasar (SD)</option>
                                <option value="SMP">SMP / Sederajat</option>
                                <option value="SMA">SMA / Sederajat</option>
                                <option value="Umum">Mahasiswa / Umum</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-widest mb-2">Jumlah Sesi</label>
                            <input type="number" name="jumlah_sesi" min="1" placeholder="Cth: 8" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-blue-900 transition-all outline-none placeholder:font-medium placeholder:text-slate-400">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-widest mb-2">Metode</label>
                            <select name="metode" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-blue-900 transition-all outline-none cursor-pointer">
                                <option value="Online">Online (Zoom/Meet)</option>
                                <option value="Offline">Offline (Tatap Muka)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-widest mb-2">Domisili/Kota</label>
                            <input type="text" name="domisili" placeholder="Cth: Surabaya" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-blue-900 transition-all outline-none placeholder:font-medium placeholder:text-slate-400">
                        </div>
                    </div>

                    <div class="pt-2">
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-widest mb-2">Pendapatan Bersih (Harga Paket)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                <span class="text-emerald-600 font-black text-lg">Rp</span>
                            </div>
                            <input type="number" name="harga_nett" min="50000" placeholder="50000" required class="w-full bg-emerald-50 border border-emerald-200 rounded-2xl p-4 pl-14 text-xl font-black text-emerald-700 focus:ring-2 focus:ring-emerald-500 transition-all outline-none placeholder:font-bold placeholder:text-emerald-300">
                        </div>
                        <p class="text-xs text-slate-500 font-medium mt-3 flex items-start gap-2 bg-slate-50 p-3 rounded-xl border border-slate-100">
                            <span class="text-lg leading-none">💸</span> 
                            Ini adalah harga bersih yang akan dibayarkan murid dan masuk ke dompet Anda untuk 1 paket kelas.
                        </p>
                    </div>

                    <div class="pt-8 flex gap-4">
                        <button type="submit" class="w-full bg-blue-950 hover:bg-orange-500 text-white px-6 py-4.5 rounded-2xl text-sm font-black uppercase tracking-widest transition-all shadow-xl shadow-blue-950/20 active:scale-95">
                            Simpan ke Etalase
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>
</body>
</html>