@extends('layouts.admin')
@section('title', 'Manajemen Lapangan - SportZ')
@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <h1 class="font-heading text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">Manajemen Lapangan</h1>
        <a href="{{ route('admin.courts.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-cyan-500/25 transition-all duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Lapangan
        </a>
    </div>

    {{-- Filters --}}
    <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-4 border border-gray-100 dark:border-gray-700/50 flex flex-wrap gap-4 items-center">
        <form action="{{ route('admin.courts.index') }}" method="GET" class="flex flex-wrap gap-4 items-center w-full">
            <div class="flex-1 min-w-[200px]"><x-search-bar placeholder="Cari lapangan..." name="search" :value="request('search')" /></div>
            <select name="sport_id" class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 text-sm focus:ring-2 focus:ring-cyan-500">
                <option value="">Semua Olahraga</option>
                @foreach($sports as $sport)<option value="{{ $sport->id }}" {{ request('sport_id') == $sport->id ? 'selected' : '' }}>{{ $sport->name }}</option>@endforeach
            </select>
            <select name="status" class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 text-sm focus:ring-2 focus:ring-cyan-500">
                <option value="">Semua Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
            </select>
            <button type="submit" class="px-6 py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors text-sm font-medium">Filter</button>
        </form>
    </div>

    {{-- Courts Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($courts as $court)
        <div class="bg-white dark:bg-gray-800/50 rounded-2xl border border-gray-100 dark:border-gray-700/50 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
            <div class="relative aspect-video bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800">

    @php
        $image = $court->images
            ->sortByDesc('is_primary')
            ->sortByDesc('created_at')
            ->first();
    @endphp

    @if($image)

        <img
            src="{{ $image->image_url ?: asset($image->image_path) }}"
            alt="{{ $court->name }}"
            class="w-full h-full object-cover">

    @else

        <div class="w-full h-full flex items-center justify-center">
            <span class="text-4xl">
                {{ $court->sport->icon ?? '🏟️' }}
            </span>
        </div>

    @endif

    <div class="absolute top-3 left-3">
        <span class="px-3 py-1 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-full text-xs font-semibold text-gray-700 dark:text-gray-300">
            {{ $court->sport->name ?? 'Sport' }}
        </span>
    </div>

    <div class="absolute top-3 right-3">
        <x-status-badge :status="$court->status" />
    </div>

</div>
            <div class="p-5">
                <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-1">{{ $court->name }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">No. {{ $court->court_number }}</p>
                <div class="flex items-center justify-between">
                    <span class="font-heading font-bold text-lg text-cyan-600 dark:text-cyan-400">Rp {{ number_format($court->price_per_hour, 0, ',', '.') }}<span class="text-xs text-gray-400 font-normal">/jam</span></span>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.courts.edit', $court->id) }}" class="p-2 rounded-lg bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <form action="{{ route('admin.courts.destroy', $court->id) }}" method="POST" onsubmit="return confirm('Yakin hapus lapangan ini?')">
                            @csrf @method('DELETE')
                            <button class="p-2 rounded-lg bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900/40 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full"><x-empty-state title="Belum ada lapangan" description="Tambahkan lapangan pertama Anda" action="Tambah Lapangan" :actionUrl="route('admin.courts.create')" /></div>
        @endforelse
    </div>

    {{ $courts->withQueryString()->links() }}
</div>
@endsection
