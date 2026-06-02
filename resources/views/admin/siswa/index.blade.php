<x-app-layout>
    <style>
        [x-cloak] { display: none !important; }
    </style>

    {{-- ========================================================================= --}}
    {{-- WRAPPER UTAMA STICKY (Mengunci Header + Filter)                           --}}
    {{-- ========================================================================= --}}
    <div class="sticky top-0 z-[40] w-full pb-4">
        
        <div class="bg-white/95 backdrop-blur-md border-b border-slate-200 pt-6 pb-6 px-6 md:px-8 shadow-sm">
            <div class="max-w-[1400px] mx-auto flex flex-col xl:flex-row justify-between items-start xl:items-center gap-6">
                
                {{-- Kiri: Judul --}}
                <div>
                    <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 px-3 py-1 rounded-full mb-3 shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                        <p class="text-[10px] font-black text-blue-600 uppercase tracking-[0.2em]">Manajemen Pengguna</p>
                    </div>
                    <h2 class="font-black text-2xl text-slate-900 leading-tight tracking-tight">
                        Direktori Murid (Siswa)
                    </h2>
                    <p class="text-sm text-slate-400 font-medium mt-0.5">Kelola data murid yang terdaftar di platform Tempatles.id.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ========================================================================= --}}
    {{-- KONTEN UTAMA (Scrollable) DENGAN STATE ALPINE UNTUK MODAL HAPUS           --}}
    {{-- ========================================================================= --}}
    <div x-data="{ confirmOpen: false, confirmSiswaId: null }" class="py-6 relative z-10">
        <div class="max-w-[1400px] mx-auto px-6 md:px-8 space-y-8">

            {{-- Flash Message --}}
            @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 shadow-sm rounded-2xl flex items-center gap-4">
                <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                </div>
                <span class="font-black text-sm text-emerald-800 uppercase tracking-wide">{{ session('success') }}</span>
            </div>
            @endif

            {{-- Stats Card --}}
            <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-[2rem] shadow-xl shadow-blue-500/20 p-8 md:p-10 relative overflow-hidden group border border-blue-400">
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-white/10 rounded-full blur-3xl group-hover:scale-110 transition-transform duration-700"></div>
                <div class="relative z-10 flex items-center gap-6">
                    <div class="w-20 h-20 bg-white/20 backdrop-blur-md rounded-3xl flex items-center justify-center text-white border border-white/30 shadow-inner shrink-0">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs font-black text-blue-200 uppercase tracking-[0.2em] mb-2">Total Murid Terdaftar @if(request('month') || request('year')) (Filter Aktif) @endif</p>
                        <p class="text-6xl font-black text-white leading-none tracking-tighter">{{ $totalSiswa }}</p>
                    </div>
                </div>
            </div>

            {{-- Tabel Siswa --}}
            <div class="bg-white shadow-xl rounded-[2rem] border border-slate-200 overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-slate-50/50">
                    {{-- Kiri: Judul --}}
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center text-blue-600 border border-blue-200 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                        </div>
                        <div>
                            <h3 class="font-black text-slate-800 text-lg tracking-tight">Database Akun Murid</h3>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Menampilkan data sesuai filter</p>
                        </div>
                    </div>

                    {{-- Kanan: Form Filter --}}
                    <form method="GET" action="{{ route('admin.siswa.index') }}" class="flex flex-wrap items-center justify-end gap-3 w-full xl:w-auto">
                        
                        {{-- Grup Dropdown --}}
                        <div class="flex flex-wrap gap-2 flex-grow sm:flex-grow-0">
                            {{-- Pilih Bulan --}}
                            <div class="relative flex-1 sm:w-32">
                                <select name="month" onchange="this.form.submit()" class="appearance-none w-full pl-9 pr-6 py-2.5 bg-white border border-slate-200 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-600 focus:ring-2 focus:ring-blue-500 transition-all shadow-sm cursor-pointer outline-none">
                                    <option value="">Bulan</option>
                                    @foreach(['01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'Mei','06'=>'Jun','07'=>'Jul','08'=>'Agu','09'=>'Sep','10'=>'Okt','11'=>'Nov','12'=>'Des'] as $num => $name)
                                        <option value="{{ $num }}" {{ request('month') == $num ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                </div>
                            </div>

                            {{-- Pilih Tahun --}}
                            <div class="relative w-26">
                                <select name="year" onchange="this.form.submit()" class="appearance-none w-full pl-9 pr-6 py-2.5 bg-white border border-slate-200 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-600 focus:ring-2 focus:ring-blue-500 transition-all shadow-sm cursor-pointer outline-none">
                                    <option value="">Tahun</option>
                                    @for($y = 2024; $y <= date('Y') + 1; $y++) 
                                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                    @endfor
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                </div>
                            </div>
                        </div>

                        {{-- Kolom Cari --}}
                        <div class="relative w-full sm:w-64">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari..." class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all outline-none placeholder:text-slate-400 shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-3.5 flex items-center">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            </div>
                        </div>

                        {{-- Tombol --}}
                        <div class="flex gap-2 w-full sm:w-auto">
                            <button type="submit" class="flex-1 sm:flex-none inline-flex items-center justify-center bg-slate-900 hover:bg-blue-600 text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-sm">
                                Cari
                            </button>
                            
                            @if(request('search') || request('month') || request('year'))
                                <a href="{{ route('admin.siswa.index') }}" class="px-5 py-2.5 bg-white hover:bg-rose-50 text-slate-500 hover:text-rose-600 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all border border-slate-200 hover:border-rose-200 text-center flex items-center justify-center">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest whitespace-nowrap">Profil Murid</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest">Kontak</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest">Tanggal Bergabung</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest text-right">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($siswas as $siswa)
                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center text-orange-600 font-black text-lg shadow-sm border border-orange-200 shrink-0 group-hover:scale-105 transition-transform">
                                            {{ strtoupper(substr($siswa->name ?? 'M', 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-black text-slate-900 text-sm leading-tight">{{ $siswa->name }}</p>
                                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1 bg-slate-100 inline-block px-2 py-0.5 rounded border border-slate-200">
                                                ID: {{ str_pad($siswa->id, 4, '0', STR_PAD_LEFT) }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <p class="font-bold text-slate-800 text-xs">{{ $siswa->email }}</p>
                                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-1">
                                        {{ $siswa->phone_number ?? 'Belum ada No. HP' }}
                                    </p>
                                </td>
                                <td class="px-8 py-5">
                                    <p class="font-black text-slate-700 text-xs">
                                        {{ $siswa->created_at->translatedFormat('d M Y') }}
                                    </p>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">
                                        {{ $siswa->created_at->format('H:i') }} WIB
                                    </p>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    {{-- Mengubah Tombol Hapus: Mengganti trigger submit dengan pop-up konfirmasi Alpine --}}
                                    <button type="button" @click.prevent="confirmOpen = true; confirmSiswaId = {{ $siswa->id }}" 
                                        class="inline-flex items-center gap-2 bg-white border border-slate-200 hover:bg-rose-600 hover:border-rose-600 hover:text-white text-rose-600 font-black py-2.5 px-4 rounded-xl transition-all duration-300 text-[10px] uppercase tracking-widest shadow-sm active:scale-95 group/btn">
                                        Hapus
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-20 bg-slate-50/50">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-20 h-20 rounded-full bg-slate-100 border-8 border-white shadow-sm flex items-center justify-center">
                                            <span class="text-3xl grayscale opacity-40">📂</span>
                                        </div>
                                        <p class="text-base font-black text-slate-800 mt-2">Belum Ada Data</p>
                                        <p class="text-xs font-medium text-slate-500 max-w-sm">Tidak ada murid yang mendaftar pada periode bulan/tahun tersebut.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($siswas->hasPages())
                <div class="px-8 py-6 bg-slate-50 border-t border-slate-200">
                    {{ $siswas->links() }}
                </div>
                @endif
            </div>
        </div>

        {{-- ======================================================== --}}
        {{-- MODAL KONFIRMASI HAPUS (Diteleport ke body - FIXED)     --}}
        {{-- ======================================================== --}}
        <template x-teleport="body">
            <div x-show="confirmOpen" 
                x-cloak
                class="fixed inset-0 z-[110] flex items-center justify-center p-4 sm:p-6" 
                role="dialog"
                aria-modal="true">
                
                {{-- Overlay Background --}}
                <div x-show="confirmOpen" 
                    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm" @click="confirmOpen = false; confirmSiswaId = null"></div>

                {{-- Modal Box (Cukup 1 Box Dinamis - Bebas Looping Bentrok) --}}
                <div x-show="confirmOpen" 
                    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="relative bg-white rounded-[2rem] shadow-2xl p-6 md:p-8 w-full max-w-md text-center border border-slate-100 z-10">
                    
                    {{-- Trash Icon Header --}}
                    <div class="w-16 h-16 rounded-2xl mx-auto flex items-center justify-center mb-5 bg-rose-50 text-rose-500 shadow-inner border border-rose-100/50">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>

                    <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight mb-2">Hapus Akun Murid?</h3>
                    <p class="text-sm font-medium text-slate-500 mb-6 leading-relaxed">
                        Anda akan menghapus data siswa ini secara permanen dari sistem. Tindakan ini menghapus seluruh riwayat kelas dan tidak dapat dibatalkan.
                    </p>

                    {{-- FORM FORM AKSI BUTTON (DIJADIKAN FLEX ROW BERJEJER SAMPING) --}}
                    {{-- Menggunakan route dinamis JavaScript agar menyesuaikan confirmSiswaId dari Alpine --}}
                    <form :action="'{{ url('admin/siswa') }}/' + confirmSiswaId" method="POST" class="w-full">
                        @csrf
                        @method('DELETE')
                        
                        <div class="flex flex-row items-center gap-3 w-full">
                            {{-- Tombol Batal Sisi Kiri --}}
                            <button @click="confirmOpen = false; confirmSiswaId = null" type="button" 
                                    class="flex-1 px-4 py-3.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-500 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all shadow-sm active:scale-95 whitespace-nowrap">
                                Batal
                            </button>
                            
                            {{-- Tombol Hapus Sisi Kanan --}}
                            <button type="submit" 
                                    class="flex-1 px-4 py-3.5 bg-rose-600 hover:bg-rose-700 text-white text-[10px] font-black uppercase tracking-widest rounded-xl transition-all shadow-lg shadow-rose-500/20 active:scale-95 border border-rose-700 whitespace-nowrap">
                                Ya, Hapus
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </template>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success') || session('error'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "{{ session('success') ? 'success' : 'error' }}",
                title: "{{ session('success') ? 'Berhasil!' : 'Oops, Terjadi Kesalahan' }}",
                text: "{{ session('success') ?? session('error') }}",
                confirmButtonText: 'Mengerti',
                buttonsStyling: false, // Wajib agar customClass bekerja
                customClass: {
                    popup: 'rounded-[2rem] border border-slate-200 shadow-2xl',
                    title: 'text-lg font-black text-slate-900',
                    htmlContainer: 'text-sm font-medium text-slate-500',
                    confirmButton: 'w-full mt-4 bg-slate-900 hover:bg-slate-800 text-white px-8 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all active:scale-95 shadow-lg'
                }
            });
        });
    </script>
    @endif
</x-app-layout>