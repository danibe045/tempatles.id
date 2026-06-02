<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 w-full">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.absensi') }}"
                    class="w-10 h-10 bg-white border border-slate-200 rounded-full flex items-center justify-center text-slate-500 hover:bg-slate-50 hover:text-blue-600 transition-colors shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <div>
                    <p class="text-[10px] font-black text-orange-500 uppercase tracking-[0.25em] mb-1">Investigasi
                        Jurnal</p>
                    <h2 class="font-black text-2xl text-slate-900 leading-tight tracking-tight">Sesi
                        Ke-{{ $session->pertemuan_ke }}</h2>
                </div>
            </div>

            @if($session->teachingJournal)
            <form action="{{ route('admin.absensi.override', $session->id) }}" method="POST"
                onsubmit="return confirm('PERINGATAN: Apakah Anda yakin foto/jurnal ini palsu? Ini akan menghapus jurnal dan mengubah status tutor menjadi Absen.');">
                @csrf
                <button type="submit"
                    class="bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white border border-rose-200 px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    Tolak Jurnal
                </button>
            </form>
            @endif
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 md:px-12 space-y-6">

            @if(session('error'))
            <div class="p-4 bg-rose-50 border border-rose-200 shadow-sm rounded-2xl flex items-center gap-4">
                <div class="w-8 h-8 bg-rose-100 rounded-full flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <span class="font-bold text-sm text-rose-800">{{ session('error') }}</span>
            </div>
            @endif

            {{-- Detail Sesi & Paket --}}
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                <div
                    class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-slate-100 pb-4 mb-4">
                    <div>
                        <p class="text-[10px] font-black text-blue-600 uppercase tracking-widest mb-1">
                            {{ $session->order->mata_pelajaran }}</p>
                        <h4 class="font-bold text-slate-900 text-lg">Jadwal:
                            {{ \Carbon\Carbon::parse($session->tanggal_jadwal)->translatedFormat('d F Y') }}
                            ({{ \Carbon\Carbon::parse($session->waktu_mulai)->format('H:i') }})</h4>
                    </div>
                    @php
                    $statusClasses = [
                    'dijadwalkan' => 'bg-gray-100 text-gray-600 border-gray-200',
                    'selesai' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                    'absen_tutor' => 'bg-rose-100 text-rose-700 border-rose-200',
                    'absen_murid' => 'bg-orange-100 text-orange-700 border-orange-200',
                    ];
                    $badgeClass = $statusClasses[$session->status_sesi] ?? 'bg-gray-100 text-gray-600 border-gray-200';
                    @endphp
                    <span
                        class="px-3 py-1.5 text-[10px] font-black uppercase tracking-widest rounded-lg border {{ $badgeClass }}">
                        Status: {{ str_replace('_', ' ', $session->status_sesi) }}
                    </span>
                </div>

                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-2">
                        <div
                            class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs">
                            T</div>
                        <p class="text-sm font-medium text-slate-700">
                            {{ $session->order->tutor->name ?? 'Tutor Terhapus' }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <div
                            class="w-6 h-6 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold text-xs">
                            M</div>
                        <p class="text-sm font-medium text-slate-700">
                            {{ $session->order->murid->name ?? 'Murid Terhapus' }}</p>
                    </div>
                </div>
            </div>

            {{-- Laporan Jurnal Mengajar --}}
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                <div class="bg-slate-50 px-6 py-4 border-b border-slate-100">
                    <h3 class="font-black text-sm text-slate-800 uppercase tracking-widest">Laporan Jurnal Mengajar</h3>
                </div>
                <div class="p-6">
                    @if($session->teachingJournal)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Catatan
                                Materi dari Tutor</p>
                            <div
                                class="p-4 bg-blue-50 border border-blue-100 rounded-2xl text-sm font-medium text-slate-700 leading-relaxed whitespace-pre-wrap">
                                {{ $session->teachingJournal->catatan_materi }}
                            </div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-4">Waktu Submit:
                                {{ $session->teachingJournal->waktu_submit }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Foto Bukti
                                Mengajar</p>
                            <div class="rounded-2xl overflow-hidden border-2 border-slate-100 shadow-sm">
                                <img src="{{ asset('storage/' . $session->teachingJournal->foto_bukti_path) }}"
                                    alt="Bukti Mengajar" class="w-full object-cover">
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="py-12 text-center">
                        <div
                            class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-4 border border-slate-100">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="font-black text-slate-700 text-lg mb-1">Jurnal Belum Diisi</h4>
                        <p class="text-sm text-slate-500">Tutor belum mengunggah laporan dan foto bukti mengajar untuk
                            sesi ini.</p>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>