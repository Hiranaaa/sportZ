<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly User $user,
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
            ->subject('Selamat Datang di SportZ!')
            ->greeting('Halo, ' . $this->user->name . '!')
            ->line('Selamat datang di SportZ - Platform Booking Lapangan Olahraga Terbaik.')
            ->line('Dengan SportZ, Anda dapat:')
            ->line('• Memesan lapangan olahraga dengan mudah')
            ->line('• Melihat ketersediaan lapangan secara real-time')
            ->line('• Melakukan pembayaran secara online')
            ->action('Mulai Booking', url('/customer/bookings/create'))
            ->line('Terima kasih telah bergabung dengan SportZ!');
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'welcome',
            'user_id' => $this->user->id,
            'message' => 'Selamat datang di SportZ, ' . $this->user->name . '!',
        ];
    }
}
