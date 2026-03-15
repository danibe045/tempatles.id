@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-6 py-3 text-xs font-black uppercase tracking-widest text-white bg-slate-800/50 border-r-4 border-yellow-400 transition duration-150 ease-in-out'
            : 'flex items-center px-6 py-3 text-xs font-bold uppercase tracking-widest text-slate-400 hover:text-white hover:bg-slate-800/30 border-r-4 border-transparent hover:border-slate-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>