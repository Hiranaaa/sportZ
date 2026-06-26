@component('mail::message')
# Booking Dibatalkan 😢

Hai **{{ $booking->user->name }}**,

Booking Anda dengan kode **{{ $booking->booking_code }}** telah dibatalkan.

@component('mail::table')
| Detail | Info |
|:-------|:-----|
| Lapangan | {{ $booking->court->name ?? '-' }} |
| Tanggal | {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }} |
| Jam | {{ substr($booking->start_time, 0, 5) }} - {{ substr($booking->end_time, 0, 5) }} |
@endcomponent

Jika Anda ingin melakukan booking ulang, silakan kunjungi website kami.

@component('mail::button', ['url' => route('courts.index')])
Booking Lagi
@endcomponent

Salam,<br>
**{{ config('app.name') }}**
@endcomponent
