{{-- Popular Courts Section --}}
<section id="popular-courts" class="relative py-24 lg:py-32 bg-white dark:bg-navy-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4 mb-12 scroll-animate">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 text-sm font-medium mb-4">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z" /></svg>
                    Populer
                </div>
                <h2 class="font-heading text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white">
                    Lapangan <span class="text-gradient">Populer</span>
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Lapangan paling banyak dipesan oleh pengguna kami</p>
            </div>
            <a href="{{ route('courts.index') }}" class="btn-secondary text-sm flex-shrink-0">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
            </a>
        </div>

        {{-- Courts Grid --}}
        @if(isset($courts) && count($courts) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($courts as $court)
                    <div class="scroll-animate stagger-{{ ($loop->index % 3) + 1 }}">
                        <x-court-card :court="$court" />
                    </div>
                @endforeach
            </div>
        @else
            {{-- Default Demo Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $demoCourts = [
                        (object)['id' => 1, 'name' => 'Lapangan Futsal A', 'sport_type' => 'futsal', 'price_per_hour' => 150000, 'average_rating' => 4.8, 'location' => 'Jakarta Selatan', 'image_url' => null, 'slug' => 'futsal-court-a'],
                        (object)['id' => 2, 'name' => 'Court Badminton Premium', 'sport_type' => 'badminton', 'price_per_hour' => 80000, 'average_rating' => 4.9, 'location' => 'Jakarta Selatan', 'image_url' => null, 'slug' => 'badminton-court-a'],
                        (object)['id' => 3, 'name' => 'Lapangan Basket Indoor', 'sport_type' => 'basket', 'price_per_hour' => 200000, 'average_rating' => 4.7, 'location' => 'Jakarta Selatan', 'image_url' => null, 'slug' => 'basket-court-a'],
                    ];
                @endphp
                @foreach($demoCourts as $index => $court)
                    <div class="scroll-animate stagger-{{ $index + 1 }}">
                        <x-court-card :court="$court" />
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
