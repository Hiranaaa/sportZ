<?php
declare(strict_types=1);
namespace App\Console\Commands;

use App\Models\Booking;
use App\Notifications\BookingReminderNotification;
use Illuminate\Console\Command;

class SendBookingReminders extends Command
{
    protected $signature = 'bookings:send-reminders';
    protected $description = 'Send reminders for bookings starting within 1 hour';

    public function handle(): int
    {
        $bookings = Booking::where('status', 'confirmed')
            ->where('booking_date', today())
            ->whereRaw("start_time BETWEEN ? AND ?", [now()->format('H:i:s'), now()->addHour()->format('H:i:s')])
            ->where('reminder_sent', false)
            ->with('user', 'court')
            ->get();

        foreach ($bookings as $booking) {
            $booking->user->notify(new BookingReminderNotification($booking));
            $booking->update(['reminder_sent' => true]);
        }
        $this->info("Sent {$bookings->count()} reminders.");
        return self::SUCCESS;
    }
}
