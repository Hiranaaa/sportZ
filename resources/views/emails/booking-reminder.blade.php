@component('mail::message')
# Pengingat Booking ⏰

Hai **{{ $booking->user->name }}**,

Jangan lupa! Anda memiliki booking yang akan dimulai segera:

@component('mail::table')
| Detail | Info |
|:-------|:-----|
| Kode | **{{ $booking->booking_code }}** |
| Lapangan | {{ $booking->court->name ?? '-' }} |
| Tanggal | {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }} |
| Jam | {{ substr($booking->start_time, 0, 5) }} - {{ substr($booking->end_time, 0, 5) }} |
@endcomponent

Pastikan Anda tiba tepat waktu! Gunakan QR Code di aplikasi untuk check-in.

@component('mail::button', ['url' => route('customer.bookings.show', $booking->id)])
Lihat Booking
@endcomponent

See you on the court! 🏆

Salam,<br>
**{{ config('app.name') }}**
@endcomponent
