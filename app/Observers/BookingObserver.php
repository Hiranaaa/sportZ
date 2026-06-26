<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Booking;
use App\Services\ActivityLogService;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BookingObserver
{
    public function __construct(
        private readonly ActivityLogService $activityLogService,
    ) {}

    public function creating(Booking $booking): void
    {
        if (empty($booking->booking_code)) {
            $date = now()->format('Ymd');
            $random = strtoupper(Str::random(5));
            $booking->booking_code = "SPZ-{$date}-{$random}";
        }

        if (empty($booking->qr_code)) {
            $booking->qr_code = $booking->booking_code;
        }
    }

    public function updated(Booking $booking): void
    {
        if ($booking->wasChanged('status')) {
            $this->activityLogService->log(
                action: 'booking_status_changed',
                modelType: Booking::class,
                modelId: $booking->id,
                oldValues: ['status' => $booking->getOriginal('status')],
                newValues: ['status' => $booking->status->value ?? $booking->status],
            );
        }
    }
}
