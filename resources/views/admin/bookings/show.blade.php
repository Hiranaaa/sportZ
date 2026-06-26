@extends('layouts.admin')
@section('title', 'Detail Booking - SportZ')
@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.bookings.index') }}" class="p-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-600 hover:bg-gray-200 transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></a>
        <div><h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Detail Booking</h1><p class="text-sm text-gray-500 font-mono">{{ $booking->booking_code }}</p></div>
        <div class="ml-auto"><x-status-badge :status="$booking->status" /></div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50 grid grid-cols-2 gap-4 text-sm">
                <div><span class="text-gray-500 block">Customer</span><span class="font-semibold text-gray-900 dark:text-white">{{ $booking->user->name ?? '-' }}</span></div>
                <div><span class="text-gray-500 block">Email</span><span class="text-gray-900 dark:text-white">{{ $booking->user->email ?? '-' }}</span></div>
                <div><span class="text-gray-500 block">Lapangan</span><span class="font-semibold text-gray-900 dark:text-white">{{ $booking->court->name ?? '-' }}</span></div>
                <div><span class="text-gray-500 block">Olahraga</span><span class="text-gray-900 dark:text-white">{{ $booking->court->sport->name ?? '-' }}</span></div>
                <div><span class="text-gray-500 block">Tanggal</span><span class="text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('l, d F Y') }}</span></div>
                <div><span class="text-gray-500 block">Jam</span><span class="text-gray-900 dark:text-white">{{ substr($booking->start_time, 0, 5) }} - {{ substr($booking->end_time, 0, 5) }} ({{ $booking->duration_hours }} jam)</span></div>
                <div><span class="text-gray-500 block">Subtotal</span><span class="text-gray-900 dark:text-white">Rp {{ number_format($booking->subtotal, 0, ',', '.') }}</span></div>
                <div><span class="text-gray-500 block">Diskon</span><span class="text-green-500">{{ $booking->discount > 0 ? '- Rp ' . number_format($booking->discount, 0, ',', '.') : '-' }}</span></div>
                <div class="col-span-2 pt-3 border-t border-gray-200 dark:border-gray-700"><span class="text-gray-500 block">Total</span><span class="text-xl font-bold text-cyan-600">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</span></div>
            </div>
        </div>
        <div class="space-y-4">
            <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50 space-y-3">
                <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-2">Aksi</h3>
                @if($booking->status === 'pending')<form action="{{ route('admin.bookings.update-status', $booking->id) }}" method="POST">@csrf @method('PATCH')<input type="hidden" name="status" value="confirmed"><button class="w-full py-2.5 bg-green-500 text-white rounded-xl text-sm font-medium hover:bg-green-600 transition-colors mb-2">✅ Konfirmasi</button></form>@endif
                @if($booking->status === 'confirmed')<form action="{{ route('admin.bookings.check-in', $booking->id) }}" method="POST">@csrf<button class="w-full py-2.5 bg-blue-500 text-white rounded-xl text-sm font-medium hover:bg-blue-600 transition-colors mb-2">📱 Check-in</button></form>@endif
                @if(in_array($booking->status, ['pending', 'confirmed']))<form action="{{ route('admin.bookings.update-status', $booking->id) }}" method="POST" onsubmit="return confirm('Batalkan booking?')">@csrf @method('PATCH')<input type="hidden" name="status" value="cancelled"><button class="w-full py-2.5 bg-red-50 dark:bg-red-900/20 text-red-600 rounded-xl text-sm font-medium hover:bg-red-100 transition-colors">❌ Batalkan</button></form>@endif
            </div>
            @if($booking->payment)
            <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50 text-sm space-y-2">
                <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-2">Pembayaran</h3>
                <div class="flex justify-between"><span class="text-gray-500">Metode</span><span>{{ ucfirst($booking->payment->payment_method ?? '-') }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Status</span><x-status-badge :status="$booking->payment->status" /></div>
                <div class="flex justify-between"><span class="text-gray-500">Transaction ID</span><span class="font-mono text-xs">{{ $booking->payment->transaction_id ?? '-' }}</span></div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
