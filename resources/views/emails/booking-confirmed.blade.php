@component('mail::message')
# Booking Dikonfirmasi! 🎉

Hai **{{ $booking->user->name }}**,

Booking Anda telah dikonfirmasi. Berikut detailnya:

@component('mail::table')
| Detail | Info |
|:-------|:-----|
| Kode Booking | **{{ $booking->booking_code }}** |
| Lapangan | {{ $booking->court->name ?? '-' }} |
| Tanggal | {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }} |
| Jam | {{ substr($booking->start_time, 0, 5) }} - {{ substr($booking->end_time, 0, 5) }} |
| Durasi | {{ $booking->duration_hours }} jam |
| Total | **Rp {{ number_format($booking->total_amount, 0, ',', '.') }}** |
@endcomponent

@component('mail::button', ['url' => route('customer.bookings.show', $booking->id)])
Lihat Detail Booking
@endcomponent

Sampai jumpa di lapangan! 🏆

Salam,<br>
**{{ config('app.name') }}**
@endcomponent
