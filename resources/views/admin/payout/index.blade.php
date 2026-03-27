<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <p class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.25em] mb-1">Manajemen Keuangan</p>
                <h2 class="font-black text-2xl text-slate-900 leading-tight tracking-tight">
                    Pencairan Dana (Payout)
                </h2>
                <p class="text-sm text-slate-400 font-medium mt-0.5">Kelola permintaan penarikan saldo dan mutasi ke rekening bank Tutor.</p>
            </div>
            
            <form method="GET" action="{{ route('admin.payout') }}" class="flex flex-wrap md:flex-nowrap gap-2 w-full md:w-auto">
                <div class="relative">
                    <select name="status" onchange="this.form.submit()"
                        class="appearance-none pl-9 pr-8 py-2.5 bg-slate-100 border-transparent rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all shadow-sm cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Antrean Pencairan</option>
                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                        <option value="berhasil" {{ request('status') == 'berhasil' ? 'selected' : '' }}>Sukses Ditransfer</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 left-2.5 flex items-center">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z" /></svg>
                    </div>
                </div>

                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau bank..." 
                        class="pl-9 pr-4 py-2.5 bg-slate-100 border-transparent rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all w-full md:w-52 placeholder:font-medium placeholder:text-slate-400 shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-2.5 flex items-center">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </div>
                </div>

                <button type="submit" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-black text-white px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-md shadow-slate-900/20">
                    Cari
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-[1400px] mx-auto px-6 md:px-12 space-y-8">
            
            {{-- Gradient Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                
                {{-- Permintaan Pencairan (Orange Gradient) --}}
                <div class="bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl shadow-lg shadow-orange-500/20 p-6 relative overflow-hidden group border border-orange-400/50">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-bl-[4rem] -translate-y-4 translate-x-4 transition group-hover:scale-110 duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-tr-full"></div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-start">
                            <div class="inline-flex items-center justify-center w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl mb-4 shadow-sm border border-white/20">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-white/20 backdrop-blur-md rounded-lg text-[9px] font-black text-white uppercase tracking-wider border border-white/20 shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                                Urgent
                            </span>
                        </div>
                        <p class="text-[10px] font-black text-orange-100 uppercase tracking-[0.2em]">Antrean Pencairan</p>
                        <p class="text-4xl font-black text-white mt-1 leading-none">{{ $countPending }} <span class="text-lg text-orange-200">Tiket</span></p>
                    </div>
                </div>

                {{-- Nominal Pending (Blue Gradient) --}}
                <div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl shadow-lg shadow-blue-500/20 p-6 relative overflow-hidden group border border-blue-400/50">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-bl-[4rem] -translate-y-4 translate-x-4 transition group-hover:scale-110 duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-tr-full"></div>
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl mb-4 shadow-sm border border-white/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                        </div>
                        <p class="text-[10px] font-black text-blue-100 uppercase tracking-[0.2em]">Kewajiban Transfer</p>
                        <p class="text-3xl font-black text-white mt-1 leading-none">Rp {{ number_format($totalNominalPending, 0, ',', '.') }}</p>
                    </div>
                </div>

                {{-- Payout Berhasil (Emerald Gradient) --}}
                <div class="bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-2xl shadow-lg shadow-emerald-500/20 p-6 relative overflow-hidden group border border-emerald-400/50">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-bl-[4rem] -translate-y-4 translate-x-4 transition group-hover:scale-110 duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-tr-full"></div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-start">
                            <div class="inline-flex items-center justify-center w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl mb-4 shadow-sm border border-white/20">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                        </div>
                        <p class="text-[10px] font-black text-emerald-100 uppercase tracking-[0.2em]">Total Payout Berhasil</p>
                        <p class="text-3xl font-black text-white mt-1 leading-none">Rp {{ number_format($totalNominalBerhasil, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            {{-- Tabel Payout --}}
            <div class="bg-white shadow-sm rounded-2xl overflow-hidden border border-gray-100">
                <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-white">
                    <div class="flex items-center gap-3">
                        <div class="w-1.5 h-6 bg-emerald-500 rounded-full"></div>
                        <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest">Daftar Penarikan Dana</h3>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="bg-slate-50/50 text-slate-400 uppercase text-[9px] tracking-[0.18em] font-black border-b border-gray-100">
                                <th class="px-6 py-4">Tiket & Waktu</th>
                                <th class="px-6 py-4">Tutor & Nominal</th>
                                <th class="px-6 py-4">Rekening Tujuan</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($payouts as $payout)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                
                                {{-- Kolom 1: Waktu Request --}}
                                <td class="px-6 py-4">
                                    <p class="font-black text-blue-950 text-xs uppercase">{{ $payout->kode_pencairan }}</p>
                                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-wider mt-1">{{ $payout->created_at->format('d M Y • H:i') }}</p>
                                </td>
                                
                                {{-- Kolom 2: Tutor & Nominal --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3 mb-1">
                                        <div class="w-6 h-6 rounded-full bg-blue-950 text-white flex items-center justify-center font-black text-[10px] uppercase shadow-sm">
                                            {{ substr($payout->tutor->name ?? 'T', 0, 1) }}
                                        </div>
                                        <p class="font-bold text-slate-800 text-xs truncate max-w-[150px]">{{ $payout->tutor->name ?? 'User Terhapus' }}</p>
                                    </div>
                                    <p class="font-black text-emerald-600 text-sm ml-9 mt-0.5">Rp {{ number_format($payout->nominal, 0, ',', '.') }}</p>
                                </td>

                                {{-- Kolom 3: Rekening Tujuan --}}
                                <td class="px-6 py-4">
                                    <p class="font-black text-slate-800 text-xs uppercase">{{ $payout->nama_bank }}</p>
                                    <p class="text-xs text-slate-600 font-mono mt-0.5 tracking-wider">{{ $payout->nomor_rekening }}</p>
                                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-wider mt-0.5">A.N {{ $payout->nama_pemilik_rekening }}</p>
                                </td>

                                {{-- Kolom 4: Status --}}
                                <td class="px-6 py-4 text-center">
                                    @php
                                        $statusClasses = [
                                            'pending'  => 'bg-orange-50 text-orange-600 border-orange-200',
                                            'diproses' => 'bg-blue-50 text-blue-600 border-blue-200',
                                            'berhasil' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                            'ditolak'  => 'bg-rose-50 text-rose-600 border-rose-200',
                                        ];
                                        $badgeClass = $statusClasses[$payout->status] ?? 'bg-gray-50 text-gray-600 border-gray-200';
                                    @endphp
                                    <span class="inline-flex items-center justify-center px-2.5 py-1.5 rounded border {{ $badgeClass }} text-[8px] font-black uppercase tracking-wider shadow-sm">
                                        {{ str_replace('_', ' ', $payout->status) }}
                                    </span>
                                </td>

                                {{-- Kolom 5: Aksi --}}
                                <td class="px-6 py-4 text-right">
                                    @if($payout->status == 'pending' || $payout->status == 'diproses')
                                        <a href="#" class="inline-flex items-center gap-1.5 bg-emerald-50 hover:bg-emerald-500 text-emerald-600 hover:text-white font-black py-2 px-3 rounded-xl transition-all duration-200 text-[9px] uppercase tracking-widest border border-emerald-200 shadow-sm group-hover:border-emerald-500">
                                            Transfer
                                        </a>
                                    @elseif($payout->status == 'berhasil')
                                        <a href="#" class="inline-flex items-center gap-1.5 bg-white hover:bg-slate-100 text-slate-600 font-black py-2 px-3 rounded-xl transition-all duration-200 text-[9px] uppercase tracking-widest border border-slate-200 shadow-sm">
                                            <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            Bukti Transfer
                                        </a>
                                    @else
                                        <span class="text-[9px] font-bold text-slate-400 italic">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-20 bg-slate-50/30">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-16 h-16 rounded-3xl bg-white shadow-sm border border-slate-100 flex items-center justify-center">
                                            <svg class="w-7 h-7 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                        </div>
                                        <p class="text-sm font-bold text-slate-500 mt-2">Belum ada request payout</p>
                                        <p class="text-xs text-slate-400">Tutor belum melakukan permintaan penarikan dana.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($payouts->hasPages())
                <div class="px-6 py-4 bg-slate-50/80 border-t border-gray-100">
                    {{ $payouts->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>