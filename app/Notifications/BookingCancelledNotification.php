<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingCancelledNotification extends Notification implements ShouldQueue
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
            ->subject('Booking Dibatalkan - ' . $this->booking->booking_code)
            ->greeting('Halo, ' . $notifiable->name . '.')
            ->line('Booking Anda telah dibatalkan.')
            ->line('Kode Booking: ' . $this->booking->booking_code)
            ->line('Lapangan: ' . ($this->booking->court?->name ?? '-'))
            ->line('Tanggal: ' . ($this->booking->booking_date?->format('d M Y') ?? '-'))
            ->line('Waktu: ' . $this->booking->start_time . ' - ' . $this->booking->end_time)
            ->action('Buat Booking Baru', url('/customer/bookings/create'))
            ->line('Jika ada pertanyaan, silakan hubungi kami.');
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'booking_cancelled',
            'booking_id' => $this->booking->id,
            'booking_code' => $this->booking->booking_code,
            'court_name' => $this->booking->court?->name,
            'message' => 'Booking ' . $this->booking->booking_code . ' telah dibatalkan.',
        ];
    }
}
