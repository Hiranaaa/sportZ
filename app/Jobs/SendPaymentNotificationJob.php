<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Payment;
use App\Notifications\PaymentReceivedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendPaymentNotificationJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly Payment $payment,
    ) {}

    public function handle(): void
    {
        $this->payment->load(['booking.user', 'booking.court']);

        $this->payment->booking->user->notify(
            new PaymentReceivedNotification($this->payment)
        );
    }
}
