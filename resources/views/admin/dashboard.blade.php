<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-black text-2xl text-slate-800 leading-tight tracking-tight">
                    {{ __('Management Center') }}
                </h2>
                <p class="text-sm text-slate-500 font-medium">Pantau pendaftaran dan legalitas mitra tutor Tempatles.id</p>
            </div>

            {{-- Form Filter yang lebih rapi --}}
            <form action="{{ route('admin.dashboard') }}" method="GET" class="flex flex-wrap md:flex-nowrap gap-2 w-full md:w-auto">
                <select name="mapel" class="rounded-lg border-gray-200 text-xs shadow-sm focus:ring-slate-500 focus:border-slate-500">
                    <option value="">Semua Mapel</option>
                    <option value="Matematika">Matematika</option>
                    <option value="IPA">IPA</option>
                </select>
                
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama tutor..."
                    class="rounded-lg border-gray-200 shadow-sm focus:border-slate-500 focus:ring-slate-500 text-xs w-full md:w-48">
                
                <button type="submit"
                    class="bg-slate-800 hover:bg-slate-900 text-white px-4 py-2 rounded-lg text-xs font-bold transition shadow-sm flex items-center justify-center">
                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Filter
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto space-y-6">
            
            {{-- Statistik Card dengan aksen warna Logo --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-3 opacity-10">
                        <svg class="w-12 h-12 text-yellow-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path></svg>
                    </div>
                    <p class="text-xs text-slate-400 uppercase font-black tracking-widest">Pending Review</p>
                    <p class="text-3xl font-black text-slate-800 mt-1">{{ $tutors->where('status', 'Pending')->count() }}</p>
                    <p class="text-[10px] text-yellow-600 font-bold mt-2 underline">Butuh Verifikasi Segera →</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <p class="text-xs text-slate-400 uppercase font-black tracking-widest">Tahap MoU</p>
                    <p class="text-3xl font-black text-slate-800 mt-1">{{ $tutors->where('status', 'Menunggu MoU')->count() }}</p>
                    <div class="w-full bg-gray-100 h-1.5 mt-4 rounded-full">
                        <div class="bg-slate-800 h-1.5 rounded-full" style="width: 45%"></div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 bg-slate-900">
                    <p class="text-xs text-slate-500 uppercase font-black tracking-widest">Total Mitra Aktif</p>
                    <p class="text-3xl font-black text-white mt-1">{{ $tutors->where('status', 'Aktif')->count() }}</p>
                    <p class="text-[10px] text-slate-400 mt-2 italic">Tutor siap dipasarkan</p>
                </div>
            </div>

            {{-- Table Section --}}
            <div class="bg-white shadow-sm rounded-2xl overflow-hidden border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h3 class="font-bold text-slate-800 flex items-center gap-2">
                        <span class="w-2 h-5 bg-yellow-400 rounded-full"></span>
                        Data Pendaftar Terbaru
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="text-slate-400 uppercase text-[10px] tracking-[0.15em] font-black border-b border-gray-100">
                                <th class="px-6 py-4">Tutor & Kontak</th>
                                <th class="px-6 py-4">Spesialisasi</th>
                                <th class="px-6 py-4 text-center">Status Onboarding</th>
                                <th class="px-6 py-4 text-right">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($tutors as $tutor)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-800 text-sm">{{ $tutor->nama_lengkap }}</span>
                                        <span class="text-[10px] text-slate-400 font-mono tracking-tighter">{{ $tutor->email_aktif }}</span>
                                        <a href="https://wa.me/{{ $tutor->no_wa }}" target="_blank" class="text-green-600 font-bold text-[10px] mt-1 hover:underline">
                                            Chat WhatsApp ↗
                                        </a>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-slate-100 text-slate-600 rounded text-[10px] font-bold uppercase">{{ $tutor->bidang }}</span>
                                    <p class="text-xs font-black text-slate-800 mt-1">Rp {{ number_format($tutor->tarif_per_sesi ?? 0, 0, ',', '.') }}</p>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @php
                                        $statusClasses = [
                                            'Pending' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                            'Menunggu MoU' => 'bg-blue-50 text-blue-700 border-blue-200',
                                            'Aktif' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                        ];
                                        $class = $statusClasses[$tutor->status] ?? 'bg-gray-50 text-gray-600';
                                    @endphp
                                    <span class="px-3 py-1 rounded-full border {{ $class }} text-[9px] font-black uppercase tracking-wider">
                                        {{ $tutor->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.tutor.detail', $tutor->id) }}"
                                    class="inline-flex items-center bg-white border border-gray-200 hover:border-slate-800 hover:bg-slate-800 hover:text-white text-slate-700 font-bold py-1.5 px-4 rounded-lg transition-all text-[10px] uppercase tracking-widest shadow-sm">
                                        Periksa Data
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-20 text-slate-400 italic text-xs">
                                    Belum ada data pendaftar tutor.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>