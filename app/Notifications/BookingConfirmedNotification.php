<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingConfirmedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly Booking $booking,
    ) {}

    /**
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject('Booking Berhasil - ' . $this->booking->booking_code)
            ->greeting('Halo, ' . $notifiable->name . '!')
            ->line('Booking Anda telah berhasil dibuat.')
            ->line('Kode Booking: ' . $this->booking->booking_code)
            ->line('Lapangan: ' . ($this->booking->court?->name ?? '-'))
            ->line('Tanggal: ' . ($this->booking->booking_date?->format('d M Y') ?? '-'))
            ->line('Waktu: ' . $this->booking->start_time . ' - ' . $this->booking->end_time)
            ->line('Total: Rp ' . number_format((float) $this->booking->total_amount, 0, ',', '.'))
            ->action('Lihat Booking', url('/customer/bookings/' . $this->booking->id))
            ->line('Silakan lakukan pembayaran sebelum booking kedaluwarsa.');
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'booking_confirmed',
            'booking_id' => $this->booking->id,
            'booking_code' => $this->booking->booking_code,
            'court_name' => $this->booking->court?->name,
            'booking_date' => $this->booking->booking_date?->format('Y-m-d'),
            'start_time' => $this->booking->start_time,
            'end_time' => $this->booking->end_time,
            'total_amount' => $this->booking->total_amount,
            'message' => 'Booking ' . $this->booking->booking_code . ' berhasil dibuat.',
        ];
    }
}
