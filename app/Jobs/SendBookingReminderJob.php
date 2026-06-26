<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Notifications\BookingReminderNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendBookingReminderJob implements ShouldQueue
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
        if ($this->booking->status !== BookingStatus::Confirmed) {
            return;
        }

        $this->booking->load(['user', 'court.sport']);

        $this->booking->user->notify(
            new BookingReminderNotification($this->booking)
        );
    }
}
