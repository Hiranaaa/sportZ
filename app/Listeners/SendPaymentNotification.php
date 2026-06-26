<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\PaymentReceived;
use App\Notifications\PaymentReceivedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPaymentNotification implements ShouldQueue
{
    public function handle(PaymentReceived $event): void
    {
        $payment = $event->payment->load(['booking.user', 'booking.court']);

        $event->payment->booking->user->notify(
            new PaymentReceivedNotification($payment)
        );
    }
}
