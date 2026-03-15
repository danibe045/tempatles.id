<aside x-data="{ open: false }"class="fixed inset-y-0 left-0 w-64 bg-slate-900 border-r border-slate-800 shadow-2xl flex flex-col z-[100] transition-transform duration-300 md:translate-x-0"
    :class="{'translate-x-0': open, '-translate-x-full': !open}">
    
    <div class="h-20 flex items-center px-6 bg-white border-b border-gray-100 flex-shrink-0">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <img src="{{ asset('img/logo.jpg') }}" alt="Logo" class="h-10 w-auto">
            <span class="ml-3 font-black text-slate-800 tracking-tight text-xs uppercase">Tempatles.id</span>
        </a>
    </div>

    <nav class="flex-1 mt-6 overflow-y-auto custom-scrollbar">
        <p class="px-6 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-4">Main Menu</p>
        
        <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-xs font-bold uppercase tracking-widest transition duration-150 ease-in-out border-l-4 {{ request()->routeIs('dashboard') ? 'bg-slate-800/50 border-yellow-400 text-white' : 'border-transparent text-slate-400 hover:text-white hover:bg-slate-800/30' }}">
            <span class="mr-3 text-lg">📊</span> {{ __('Dashboard') }}
        </a>

        {{-- Menu Khusus Admin --}}
        @can('access-admin')
            <div class="mt-8">
                <p class="px-6 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-4">Admin Panel</p>
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 text-xs font-bold uppercase tracking-widest transition duration-150 ease-in-out border-l-4 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800/50 border-yellow-400 text-white' : 'border-transparent text-slate-400 hover:text-white hover:bg-slate-800/30' }}">
                    <span class="mr-3 text-lg">👨‍🏫</span> {{ __('Data Tutor') }}
                </a>

                <a href="#" class="flex items-center px-6 py-3 text-xs font-bold uppercase tracking-widest transition duration-150 ease-in-out border-l-4 border-transparent text-slate-400 hover:text-white hover:bg-slate-800/30">
                    <span class="mr-3 text-lg">💰</span> {{ __('Keuangan') }}
                </a>
            </div>
        @endcan

        <div class="mt-8">
            <p class="px-6 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-4">Personal</p>
            
            <a href="{{ route('profile.edit') }}" class="flex items-center px-6 py-3 text-xs font-bold uppercase tracking-widest transition duration-150 ease-in-out border-l-4 {{ request()->routeIs('profile.edit') ? 'bg-slate-800/50 border-yellow-400 text-white' : 'border-transparent text-slate-400 hover:text-white hover:bg-slate-800/30' }}">
                <span class="mr-3 text-lg">👤</span> {{ __('Profile Saya') }}
            </a>
        </div>
    </nav>

    <div class="p-4 bg-slate-950 border-t border-slate-800 flex-shrink-0">
        <div class="flex items-center mb-4 px-2">
            <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white font-black text-xs mr-3 shadow-lg">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="overflow-hidden">
                <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-slate-500 uppercase font-bold tracking-tighter">{{ Auth::user()->role }}</p>
            </div>
        </div>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center w-full px-3 py-2 text-[11px] font-black uppercase tracking-widest text-red-400 hover:text-white hover:bg-red-600 rounded-lg transition-all duration-200 group">
                <svg class="w-4 h-4 mr-3 text-red-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</aside>