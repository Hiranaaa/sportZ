@extends('layouts.customer')
@section('title', $court->name . ' - SportZ')
@section('content')
<div class="space-y-6">
    <a href="{{ route('courts.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-cyan-500 transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg> Kembali</a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            {{-- Image Gallery --}}
            <div x-data="{ current: 0, images: {{ json_encode($court->images->pluck('image_path')) }} }" class="relative rounded-2xl overflow-hidden aspect-video bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800">
                <template x-for="(img, i) in images" :key="i"><img x-show="current === i" :src="img" :alt="'{{ $court->name }}'" class="w-full h-full object-cover" x-transition></template>
                <template x-if="images.length === 0"><div class="w-full h-full flex items-center justify-center text-6xl">{{ $court->sport->icon ?? '🏟️' }}</div></template>
                <template x-if="images.length > 1">
                    <div><button @click="current = (current - 1 + images.length) % images.length" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/80 rounded-full flex items-center justify-center hover:bg-white transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></button><button @click="current = (current + 1) % images.length" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/80 rounded-full flex items-center justify-center hover:bg-white transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></button></div>
                </template>
            </div>

            {{-- Court Info --}}
            <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <span class="inline-block px-3 py-1 bg-cyan-50 dark:bg-cyan-900/20 text-cyan-600 dark:text-cyan-400 text-xs font-semibold rounded-full mb-2">{{ $court->sport->name ?? '' }}</span>
                        <h1 class="font-heading text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">{{ $court->name }}</h1>
                    </div>
                    <div class="text-right">
                        <p class="font-heading text-2xl font-bold text-cyan-600 dark:text-cyan-400">Rp {{ number_format($court->price_per_hour, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-500">per jam</p>
                    </div>
                </div>
                @if($court->reviews_avg_rating)<div class="flex items-center gap-2 mb-4"><span class="text-amber-500">⭐</span><span class="font-semibold text-gray-900 dark:text-white">{{ number_format($court->reviews_avg_rating, 1) }}</span><span class="text-gray-400">({{ $court->reviews_count }} review)</span></div>@endif
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ $court->description }}</p>
                @if($court->width && $court->length)<div class="flex gap-4 mt-4 text-sm text-gray-500"><span>📏 {{ $court->width }}m × {{ $court->length }}m</span>@if($court->capacity)<span>👥 Max {{ $court->capacity }} orang</span>@endif</div>@endif
            </div>

            {{-- Facilities --}}
            <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50">
                <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-4">Fasilitas</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    @foreach($court->facilities as $facility)
                    <div class="flex items-center gap-2 p-3 bg-gray-50 dark:bg-gray-900/50 rounded-xl"><span>{{ $facility->icon }}</span><span class="text-sm text-gray-700 dark:text-gray-300">{{ $facility->name }}</span></div>
                    @endforeach
                </div>
            </div>

            {{-- Reviews --}}
            <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50">
                <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-4">Review ({{ $court->reviews_count }})</h3>
                <div class="space-y-4">
                    @forelse($court->reviews->take(5) as $review)
                    <x-review-card :review="$review" />
                    @empty
                    <p class="text-gray-500 text-center py-4">Belum ada review</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">
            <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50 sticky top-24">
                <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-4">Booking Lapangan Ini</h3>
                <a href="{{ route('customer.bookings.create') }}?court={{ $court->id }}" class="block w-full py-4 text-center bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-bold rounded-xl text-lg hover:shadow-xl hover:shadow-cyan-500/25 transition-all duration-300">Book Now 🏆</a>
                <p class="text-xs text-gray-400 text-center mt-3">Booking instan, konfirmasi otomatis</p>
                <hr class="my-4 border-gray-200 dark:border-gray-700">
                <h4 class="font-semibold text-gray-900 dark:text-white text-sm mb-3">Jam Operasional</h4>
                @foreach($court->operatingHours->sortBy('day_of_week') as $oh)
                <div class="flex justify-between text-sm py-1"><span class="text-gray-500">{{ ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'][$oh->day_of_week] }}</span><span class="text-gray-900 dark:text-white">{{ $oh->is_closed ? 'Tutup' : substr($oh->open_time, 0, 5) . ' - ' . substr($oh->close_time, 0, 5) }}</span></div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
