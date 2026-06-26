<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Booking;
use App\Notifications\BookingConfirmedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendBookingConfirmationJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly Booking $booking,
    ) {}

    public function handle(): void
    {
        $this->booking->load(['user', 'court.sport']);

        $this->booking->user->notify(
            new BookingConfirmedNotification($this->booking)
        );
    }
}
