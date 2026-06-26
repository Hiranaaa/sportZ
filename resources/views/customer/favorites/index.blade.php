@extends('layouts.customer')
@section('title', 'Favorit - SportZ')
@section('content')
<div class="space-y-6">
    <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Lapangan Favorit ❤️</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($favorites as $fav)
        <div class="relative"><x-court-card :court="$fav->court" />
            <form action="{{ route('customer.favorites.toggle', $fav->court_id) }}" method="POST" class="absolute top-3 right-3 z-10">@csrf<button class="w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center text-red-500 hover:bg-red-50 transition-colors shadow-lg"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg></button></form>
        </div>
        @empty
        <div class="col-span-full"><x-empty-state title="Belum ada favorit" description="Jelajahi lapangan dan tambahkan ke favorit Anda" action="Jelajahi Lapangan" :actionUrl="route('courts.index')" /></div>
        @endforelse
    </div>
    {{ $favorites->links() }}
</div>
@endsection
