<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 w-full">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.dashboard') }}"
                    class="w-10 h-10 bg-white border border-slate-200 rounded-full flex items-center justify-center text-slate-500 hover:bg-slate-50 hover:text-blue-600 transition-colors shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <div>
                    <p class="text-[10px] font-black text-orange-500 uppercase tracking-[0.25em] mb-1">Manajemen Tutor
                    </p>
                    <h2 class="font-black text-2xl text-slate-900 leading-tight tracking-tight">Detail Profil Pengajar
                    </h2>
                </div>
            </div>
            <a href="{{ route('admin.tutor.edit', $tutor->id) }}"
                class="bg-blue-950 hover:bg-blue-800 text-white px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-lg shadow-blue-900/20">
                Edit Data Tutor
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 md:px-12">

            {{-- Header Card (Nama & Status) --}}
            <div
                class="bg-white rounded-[2rem] p-6 md:p-8 shadow-sm border border-slate-100 mb-6 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-6">
                    <div
                        class="w-20 h-20 bg-blue-950 text-white rounded-[1.5rem] flex items-center justify-center text-3xl font-black shadow-md">
                        {{ strtoupper(substr($tutor->user->name ?? 'T', 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-slate-900">{{ $tutor->user->name }}</h3>
                        <p class="text-sm font-bold text-orange-500 uppercase tracking-widest mt-1">
                            {{ $tutor->bidang ?? 'Umum' }}</p>
                    </div>
                </div>
                <div>
                    @php
                    $statusConfig = [
                    'pending' => ['class' => 'bg-orange-50 text-orange-600 border-orange-200', 'dot' =>
                    'bg-orange-400'],
                    'menunggu_mou' => ['class' => 'bg-blue-50 text-blue-700 border-blue-200', 'dot' => 'bg-blue-500'],
                    'aktif' => ['class' => 'bg-emerald-50 text-emerald-700 border-emerald-200', 'dot' =>
                    'bg-emerald-500'],
                    ];
                    $cfg = $statusConfig[strtolower($tutor->status_akun)] ?? ['class' => 'bg-gray-50 text-gray-600
                    border-gray-200', 'dot' => 'bg-gray-400'];
                    @endphp
                    <span
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border {{ $cfg['class'] }} text-[10px] font-black uppercase tracking-widest shadow-sm">
                        <span class="w-2 h-2 rounded-full {{ $cfg['dot'] }}"></span>
                        STATUS: {{ $tutor->status_akun }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- KIRI: Kontak & Biodata --}}
                <div class="space-y-6">
                    {{-- Kontak --}}
                    <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-slate-100">
                        <div class="space-y-4">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 shrink-0 border border-slate-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Email
                                        Aktif</p>
                                    <p class="text-sm font-bold text-slate-800">{{ $tutor->user->email }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500 shrink-0 border border-emerald-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">
                                        WhatsApp</p>
                                    <p class="text-sm font-bold text-slate-800">{{ $tutor->user->phone_number ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Biodata Personal --}}
                    <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-slate-100">
                        <h3
                            class="text-xs font-black text-slate-800 uppercase tracking-widest mb-6 flex items-center gap-2">
                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Biodata Personal
                        </h3>
                        <div class="space-y-5">
                            <div>
                                <p
                                    class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1 flex items-center gap-1.5">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg> Jenis Kelamin</p>
                                <p class="text-sm font-bold text-slate-800">{{ $tutor->jenis_kelamin }}</p>
                            </div>
                            <div>
                                <p
                                    class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1 flex items-center gap-1.5">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg> Tempat, Tgl Lahir</p>
                                <p class="text-sm font-bold text-slate-800">{{ $tutor->tempat_lahir }},
                                    {{ \Carbon\Carbon::parse($tutor->tanggal_lahir)->translatedFormat('d M Y') }}</p>
                            </div>
                            <div>
                                <p
                                    class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1 flex items-center gap-1.5">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg> Alamat Domisili</p>
                                <p class="text-sm font-bold text-slate-800 leading-relaxed">
                                    {{ $tutor->alamat_domisili }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KANAN: Pengalaman & Dokumen --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Pengalaman --}}
                    <div class="bg-white rounded-[2rem] p-6 md:p-8 shadow-sm border border-slate-100">
                        <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Riwayat Pengalaman
                            Mengajar</h3>
                        <div class="bg-slate-50 border border-slate-100 rounded-2xl p-5">
                            <p class="text-sm font-medium text-slate-700 leading-relaxed whitespace-pre-wrap">
                                {{ $tutor->pengalaman }}</p>
                        </div>
                    </div>

                    {{-- Dokumen Silabus & MoU --}}
                    <div class="bg-white rounded-[2rem] p-6 md:p-8 shadow-sm border border-slate-100">
                        <h3
                            class="text-xs font-black text-slate-800 uppercase tracking-widest mb-6 flex items-center gap-2">
                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Dokumen Silabus & MoU
                        </h3>

                        {{-- Logika untuk menampilkan Link GDrive (Selalu Tampil Jika Ada Link) --}}
                        @if($tutor->link_silabus)
                        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6 flex flex-col gap-5">

                            {{-- Bagian Atas: Icon dan Link Text --}}
                            <div class="flex items-start gap-4 text-left">
                                <div
                                    class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-blue-600 shadow-sm shrink-0 mt-1">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                    </svg>
                                </div>
                                <div class="w-full">
                                    <p class="font-bold text-slate-800 text-sm">Folder Google Drive</p>
                                    <a href="{{ $tutor->link_silabus }}" target="_blank"
                                        class="text-[11px] text-blue-600 hover:text-blue-800 font-medium mt-1 break-all block underline underline-offset-2 transition-colors">
                                        {{ $tutor->link_silabus }}
                                    </a>
                                </div>
                            </div>

                            {{-- Bagian Bawah: Tombol Besar --}}
                            <a href="{{ $tutor->link_silabus }}" target="_blank"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-3.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-md shadow-blue-600/20 text-center flex items-center justify-center gap-2">
                                Buka Folder Link
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        </div>
                        @else
                        <div
                            class="bg-slate-50/50 border border-dashed border-slate-200 rounded-2xl p-10 flex flex-col items-center justify-center text-center">
                            <div
                                class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-slate-300 shadow-sm mb-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Tutor Belum
                                Mengunggah Link Silabus</p>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>