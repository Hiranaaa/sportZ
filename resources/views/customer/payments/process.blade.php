@extends('layouts.customer')
@section('title', 'Pembayaran - SportZ')
@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white text-center">Pembayaran</h1>
    <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center text-2xl text-white">{{ $booking->court->sport->icon ?? '🏟️' }}</div>
            <div><h3 class="font-heading font-bold text-gray-900 dark:text-white">{{ $booking->court->name ?? '-' }}</h3><p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }} • {{ substr($booking->start_time, 0, 5) }} - {{ substr($booking->end_time, 0, 5) }}</p></div>
        </div>
        <div class="border-t border-gray-200 dark:border-gray-700 pt-4 space-y-2 text-sm">
            <div class="flex justify-between"><span class="text-gray-500">Kode Booking</span><span class="font-mono font-semibold text-cyan-600">{{ $booking->booking_code }}</span></div>
            <div class="flex justify-between"><span class="text-gray-500">Durasi</span><span>{{ $booking->duration_hours }} Jam</span></div>
            <div class="flex justify-between text-lg font-bold pt-2 border-t border-gray-200 dark:border-gray-700"><span>Total Bayar</span><span class="text-cyan-600">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</span></div>
        </div>
    </div>
    <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50 text-center">
        <p class="text-gray-500 mb-4">Klik tombol di bawah untuk melanjutkan pembayaran via Midtrans</p>
        <button id="pay-button" class="w-full py-4 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-bold rounded-xl text-lg hover:shadow-xl hover:shadow-cyan-500/25 transition-all duration-300">💳 Bayar Sekarang</button>
        <p class="text-xs text-gray-400 mt-4">Pembayaran diproses secara aman oleh Midtrans</p>
    </div>
</div>
@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
document.getElementById('pay-button').addEventListener('click', function() {
    snap.pay('{{ $snapToken ?? '' }}', {
        onSuccess: function(result) { window.location.href = '{{ route("customer.payments.success") }}'; },
        onPending: function(result) { window.location.href = '{{ route("customer.payments.success") }}'; },
        onError: function(result) { window.location.href = '{{ route("customer.payments.failed") }}'; },
        onClose: function() { alert('Pembayaran belum selesai. Silakan coba lagi.'); }
    });
});
</script>
@endpush
@endsection
