@props(['placeholder' => 'Cari lapangan, booking...', 'action' => '#', 'name' => 'search'])

<form action="{{ $action }}" method="GET" {{ $attributes->merge(['class' => 'relative']) }}>
    <div class="relative">
        {{-- Search Icon --}}
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
        </div>

        {{-- Input --}}
        <input
            type="search"
            name="{{ $name }}"
            value="{{ request($name) }}"
            placeholder="{{ $placeholder }}"
            class="w-full pl-12 pr-4 py-3 text-sm rounded-xl bg-white/70 dark:bg-white/5 backdrop-blur-xl border border-gray-200 dark:border-white/10 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:border-cyan-500 dark:focus:border-cyan-400 focus:ring-2 focus:ring-cyan-500/20 dark:focus:ring-cyan-400/20 transition-all duration-200"
        >

        {{-- Clear Button --}}
        @if(request($name))
            <a href="{{ $action }}" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
            </a>
        @endif
    </div>
</form>
