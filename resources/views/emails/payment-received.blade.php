@component('mail::message')
# Pembayaran Berhasil! 💰

Hai **{{ $payment->booking->user->name }}**,

Pembayaran Anda untuk booking **{{ $payment->booking->booking_code }}** telah kami terima.

@component('mail::table')
| Detail | Info |
|:-------|:-----|
| Transaction ID | {{ $payment->transaction_id }} |
| Metode | {{ ucfirst($payment->payment_method) }} |
| Jumlah | **Rp {{ number_format($payment->amount, 0, ',', '.') }}** |
| Status | Lunas ✅ |
@endcomponent

@component('mail::button', ['url' => route('customer.bookings.show', $payment->booking->id)])
Lihat Booking
@endcomponent

Terima kasih!<br>
**{{ config('app.name') }}**
@endcomponent
