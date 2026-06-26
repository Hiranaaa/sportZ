<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentReceivedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly Payment $payment,
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
        $booking = $this->payment->booking;

        return (new MailMessage())
            ->subject('Pembayaran Diterima - ' . $this->payment->transaction_id)
            ->greeting('Halo, ' . $notifiable->name . '!')
            ->line('Pembayaran Anda telah berhasil diterima.')
            ->line('ID Transaksi: ' . $this->payment->transaction_id)
            ->line('Kode Booking: ' . ($booking?->booking_code ?? '-'))
            ->line('Jumlah: Rp ' . number_format((float) $this->payment->amount, 0, ',', '.'))
            ->line('Metode: ' . ($this->payment->payment_method ?? '-'))
            ->action('Lihat Booking', url('/customer/bookings/' . ($booking?->id ?? '')))
            ->line('Terima kasih telah menggunakan SportZ!');
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'payment_received',
            'payment_id' => $this->payment->id,
            'transaction_id' => $this->payment->transaction_id,
            'amount' => $this->payment->amount,
            'booking_id' => $this->payment->booking_id,
            'booking_code' => $this->payment->booking?->booking_code,
            'message' => 'Pembayaran Rp ' . number_format((float) $this->payment->amount, 0, ',', '.') . ' berhasil diterima.',
        ];
    }
}
