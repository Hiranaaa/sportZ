<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Enums\BookingSlotStatus;
use App\Events\BookingCancelled;
use App\Events\BookingCreated;
use App\Models\BookingSlot;

class UpdateBookingSlots
{
    public function handleBookingCreated(BookingCreated $event): void
    {
        $booking = $event->booking;

        BookingSlot::where('court_id', $booking->court_id)
            ->where('slot_date', $booking->booking_date)
            ->where('start_time', '>=', $booking->start_time)
            ->where('end_time', '<=', $booking->end_time)
            ->update([
                'status' => BookingSlotStatus::Booked,
                'booking_id' => $booking->id,
            ]);
    }

    public function handleBookingCancelled(BookingCancelled $event): void
    {
        $booking = $event->booking;

        BookingSlot::where('court_id', $booking->court_id)
            ->where('slot_date', $booking->booking_date)
            ->where('start_time', '>=', $booking->start_time)
            ->where('end_time', '<=', $booking->end_time)
            ->update([
                'status' => BookingSlotStatus::Available,
                'booking_id' => null,
            ]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @return array<string, string>
     */
    public function subscribe(): array
    {
        return [
            BookingCreated::class => 'handleBookingCreated',
            BookingCancelled::class => 'handleBookingCancelled',
        ];
    }
}
