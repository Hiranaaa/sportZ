<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\BookingStatus;
use App\Jobs\SendBookingReminderJob;
use App\Models\Booking;
use Illuminate\Console\Command;

class SendBookingRemindersCommand extends Command
{
    protected $signature = 'bookings:remind';

    protected $description = 'Send reminder notifications for bookings starting within 1 hour';

    public function handle(): int
    {
        $this->info('Finding bookings starting within 1 hour...');

        $bookings = Booking::where('status', BookingStatus::Confirmed)
            ->where('booking_date', now()->toDateString())
            ->where('start_time', '>=', now()->format('H:i'))
            ->where('start_time', '<=', now()->addHour()->format('H:i'))
            ->with(['user', 'court'])
            ->get();

        $this->info("Found {$bookings->count()} booking(s) to remind.");

        foreach ($bookings as $booking) {
            SendBookingReminderJob::dispatch($booking);
            $this->line("  → Reminder dispatched for booking: {$booking->booking_code}");
        }

        $this->info('Booking reminders dispatched successfully.');

        return self::SUCCESS;
    }
}
