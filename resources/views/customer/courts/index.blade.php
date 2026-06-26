@extends('layouts.customer')
@section('title', 'Jelajahi Lapangan - SportZ')
@section('content')
<div class="space-y-6">
    <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Jelajahi Lapangan</h1>
    {{-- Filters --}}
    <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-4 border border-gray-100 dark:border-gray-700/50">
        <form action="{{ route('courts.index') }}" method="GET" class="flex flex-wrap gap-4 items-center">
            <div class="flex-1 min-w-[200px]"><x-search-bar placeholder="Cari lapangan..." name="search" :value="request('search')" /></div>
            <select name="sport_id" class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-sm focus:ring-2 focus:ring-cyan-500"><option value="">Semua Olahraga</option>@foreach($sports as $sport)<option value="{{ $sport->id }}" {{ request('sport_id') == $sport->id ? 'selected' : '' }}>{{ $sport->name }}</option>@endforeach</select>
            <select name="sort" class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-sm focus:ring-2 focus:ring-cyan-500"><option value="">Terbaru</option><option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option><option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option><option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating Tertinggi</option></select>
            <button type="submit" class="px-6 py-2.5 bg-cyan-500 text-white rounded-xl font-medium hover:bg-cyan-600 transition-colors text-sm">Filter</button>
        </form>
    </div>
    {{-- Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($courts as $court)
        <x-court-card :court="$court" />
        @empty
        <div class="col-span-full"><x-empty-state title="Lapangan tidak ditemukan" description="Coba ubah filter pencarian Anda" /></div>
        @endforelse
    </div>
    {{ $courts->withQueryString()->links() }}
</div>
@endsection
