<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Services\ActivityLogService;

class LogBookingActivity
{
    public function __construct(
        private readonly ActivityLogService $activityLogService,
    ) {}

    public function handle(BookingCreated $event): void
    {
        $this->activityLogService->log(
            action: 'booking_created',
            modelType: 'App\\Models\\Booking',
            modelId: $event->booking->id,
            newValues: [
                'booking_code' => $event->booking->booking_code,
                'court_id' => $event->booking->court_id,
                'user_id' => $event->booking->user_id,
                'booking_date' => $event->booking->booking_date?->format('Y-m-d'),
                'start_time' => $event->booking->start_time,
                'end_time' => $event->booking->end_time,
            ],
        );
    }
}
