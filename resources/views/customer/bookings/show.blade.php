@extends('layouts.customer')
@section('title', 'Detail Booking - SportZ')
@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('customer.bookings.index') }}" class="p-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-600 hover:bg-gray-200 transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></a>
        <div>
            <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Detail Booking</h1>
            <p class="text-sm text-gray-500 font-mono">{{ $booking->booking_code }}</p>
        </div>
        <div class="ml-auto"><x-status-badge :status="$booking->status" /></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Court Info --}}
            <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50">
                <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-4">Informasi Lapangan</h3>
                <div class="flex items-start gap-4">
                    <div class="w-20 h-20 rounded-xl bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 flex items-center justify-center text-3xl flex-shrink-0">{{ $booking->court->sport->icon ?? '🏟️' }}</div>
                    <div>
                        <h4 class="font-heading font-bold text-gray-900 dark:text-white">{{ $booking->court->name ?? '-' }}</h4>
                        <p class="text-sm text-gray-500">{{ $booking->court->sport->name ?? '' }} • No. {{ $booking->court->court_number ?? '' }}</p>
                        <div class="flex items-center gap-4 mt-3 text-sm text-gray-600 dark:text-gray-400">
                            <span>📅 {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('l, d F Y') }}</span>
                            <span>⏰ {{ substr($booking->start_time, 0, 5) }} - {{ substr($booking->end_time, 0, 5) }}</span>
                            <span>🕐 {{ $booking->duration_hours }} jam</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Payment Info --}}
            <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50">
                <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-4">Informasi Pembayaran</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between"><span class="text-gray-500">Subtotal</span><span class="text-gray-900 dark:text-white">Rp {{ number_format($booking->subtotal, 0, ',', '.') }}</span></div>
                    @if($booking->discount > 0)<div class="flex justify-between text-green-500"><span>Diskon</span><span>- Rp {{ number_format($booking->discount, 0, ',', '.') }}</span></div>@endif
                    <hr class="border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between text-lg font-bold"><span>Total</span><span class="text-cyan-600 dark:text-cyan-400">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</span></div>
                    @if($booking->payment)
                    <div class="mt-4 p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl">
                        <div class="flex justify-between text-sm"><span class="text-gray-500">Metode</span><span>{{ ucfirst($booking->payment->payment_method ?? '-') }}</span></div>
                        <div class="flex justify-between text-sm mt-1"><span class="text-gray-500">Status Pembayaran</span><x-status-badge :status="$booking->payment->status" type="payment" /></div>
                        @if($booking->payment->paid_at)<div class="flex justify-between text-sm mt-1"><span class="text-gray-500">Dibayar</span><span>{{ $booking->payment->paid_at->format('d M Y H:i') }}</span></div>@endif
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Sidebar Actions --}}
        <div class="space-y-6">
            {{-- QR Code --}}
            @if($booking->qr_code)
            <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50 text-center">
                <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-4">QR Check-in</h3>
                <div class="w-48 h-48 mx-auto bg-gray-100 dark:bg-gray-700 rounded-xl flex items-center justify-center">
                    <img src="data:image/png;base64,{{ $booking->qr_code }}" alt="QR Code" class="w-40 h-40" onerror="this.parentElement.innerHTML='<span class=\'text-4xl\'>📱</span>'">
                </div>
                <p class="text-xs text-gray-500 mt-3">Scan saat tiba di lokasi</p>
            </div>
            @endif

            {{-- Actions --}}
            <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50 space-y-3">
                @if($booking->status === 'pending')
                <a href="{{ route('customer.payments.process', $booking->id) }}" class="block w-full py-3 text-center bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-semibold rounded-xl hover:shadow-lg transition-all">Bayar Sekarang</a>
                <form action="{{ route('customer.bookings.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Yakin batalkan booking ini?')">
                    @csrf
                    <button class="w-full py-3 text-center bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 font-semibold rounded-xl hover:bg-red-100 transition-colors">Batalkan Booking</button>
                </form>
                @endif
                @if($booking->invoice)
                <a href="{{ route('customer.invoices.download', $booking->invoice->id) }}" class="block w-full py-3 text-center bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-xl hover:bg-gray-200 transition-colors">📄 Download Invoice</a>
                @endif
                @if($booking->status === 'completed' && !$booking->review)
                <a href="#review-form" class="block w-full py-3 text-center bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400 font-semibold rounded-xl hover:bg-amber-100 transition-colors">⭐ Tulis Review</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
