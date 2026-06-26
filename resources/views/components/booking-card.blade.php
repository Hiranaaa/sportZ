@props(['booking'])

<div class="card-modern rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row gap-4 sm:gap-5 items-start group hover:shadow-card-hover transition-all duration-300">
    {{-- Court Thumbnail --}}
    <div class="w-full sm:w-28 h-32 sm:h-24 rounded-xl overflow-hidden flex-shrink-0">
        <img
            src="{{ $booking->court->image_url ?? asset('images/courts/default.jpg') }}"
            alt="{{ $booking->court->name ?? 'Lapangan' }}"
            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
            loading="lazy"
        >
    </div>

    {{-- Booking Info --}}
    <div class="flex-1 min-w-0 w-full">
        <div class="flex items-start justify-between gap-3">
            <div class="min-w-0">
                {{-- Booking Code --}}
                <p class="text-xs font-mono font-medium text-cyan-600 dark:text-cyan-400 mb-1">
                    #{{ $booking->booking_code ?? 'BK-000000' }}
                </p>
                {{-- Court Name --}}
                <h4 class="font-heading font-semibold text-gray-900 dark:text-white line-clamp-1">
                    {{ $booking->court->name ?? 'Nama Lapangan' }}
                </h4>
            </div>
            {{-- Status Badge --}}
            <x-status-badge :status="$booking->status ?? 'pending'" type="booking" />
        </div>

        {{-- Date & Time --}}
        <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-2 text-sm text-gray-500 dark:text-gray-400">
            <div class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>
                <span>{{ $booking->booking_date ? \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') : '-- --- ----' }}</span>
            </div>
            <div class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>{{ $booking->start_time ?? '--:--' }} - {{ $booking->end_time ?? '--:--' }}</span>
            </div>
            <div class="flex items-center gap-1.5 font-semibold text-gray-900 dark:text-white">
                <span>Rp {{ number_format($booking->total_amount ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-2 mt-3">
            <a href="{{ route('customer.bookings.show', $booking->id ?? 0) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg bg-gray-50 dark:bg-white/5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                Detail
            </a>
            @if(($booking->status ?? 'pending') === 'pending')
                <button onclick="event.preventDefault();" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 hover:bg-rose-100 dark:hover:bg-rose-500/20 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                    Batalkan
                </button>
            @endif
            @if(($booking->status ?? '') === 'completed')
                <a href="#" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 hover:bg-amber-100 dark:hover:bg-amber-500/20 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" /></svg>
                    Beri Ulasan
                </a>
            @endif
        </div>
    </div>
</div>
