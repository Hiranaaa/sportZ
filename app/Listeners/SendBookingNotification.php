<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Notifications\BookingConfirmedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendBookingNotification implements ShouldQueue
{
    public function handle(BookingCreated $event): void
    {
        $booking = $event->booking->load(['court.sport', 'user']);

        $event->booking->user->notify(
            new BookingConfirmedNotification($booking)
        );
    }
}
