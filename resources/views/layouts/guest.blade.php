@extends('layouts.app')

@section('body')
<div class="min-h-screen bg-gradient-hero relative overflow-hidden">
    {{-- Ambient Background Orbs --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-cyan-500/10 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-royal-600/10 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1.5s;"></div>
    </div>

    {{-- Content --}}
    <div class="relative z-10 flex flex-col items-center justify-center min-h-screen px-4 py-12">
        {{-- Logo --}}
        <a href="{{ url('/') }}" class="mb-8 flex items-center gap-3 group">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-cyan-400 to-royal-600 flex items-center justify-center shadow-lg shadow-cyan-500/20 group-hover:shadow-cyan-500/40 transition-shadow duration-300">
                <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                </svg>
            </div>
            <span class="text-2xl font-heading font-bold text-white">Sport<span class="text-cyan-400">Z</span></span>
        </a>

        {{-- Auth Card --}}
        <div class="w-full max-w-md animate-slide-up">
            <div class="bg-white/10 backdrop-blur-2xl rounded-3xl border border-white/10 shadow-2xl shadow-black/20 p-8">
                @yield('content')
            </div>

            {{-- Footer Text --}}
            @hasSection('footer')
                <div class="mt-6 text-center">
                    @yield('footer')
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
