<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Enums\BookingSlotStatus;
use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\BookingSlot;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ExpireBookingJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function handle(): void
    {
        $expireMinutes = (int) config('sportz.booking_expire_minutes', 60);

        $expiredBookings = Booking::where('status', BookingStatus::Pending)
            ->where('created_at', '<=', now()->subMinutes($expireMinutes))
            ->get();

        foreach ($expiredBookings as $booking) {
            DB::transaction(function () use ($booking) {
                $booking->update([
                    'status' => BookingStatus::Cancelled,
                ]);

                BookingSlot::where('court_id', $booking->court_id)
                    ->where('slot_date', $booking->booking_date)
                    ->where('start_time', '>=', $booking->start_time)
                    ->where('end_time', '<=', $booking->end_time)
                    ->where('booking_id', $booking->id)
                    ->update([
                        'status' => BookingSlotStatus::Available,
                        'booking_id' => null,
                    ]);

                Log::info('Booking expired and cancelled.', [
                    'booking_id' => $booking->id,
                    'booking_code' => $booking->booking_code,
                ]);
            });
        }

        Log::info('Expire booking job completed.', [
            'expired_count' => $expiredBookings->count(),
        ]);
    }
}
