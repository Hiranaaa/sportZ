<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Models\User;
use App\Notifications\BookingConfirmedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class NotifyAdminNewBooking implements ShouldQueue
{
    public function handle(BookingCreated $event): void
    {
        $booking = $event->booking->load(['court.sport', 'user']);
        $admins = User::admins()->get();

        Notification::send(
            $admins,
            new BookingConfirmedNotification($booking)
        );
    }
}
