<?php
declare(strict_types=1);
namespace App\Console\Commands;

use App\Models\Booking;
use Illuminate\Console\Command;

class ExpirePendingBookings extends Command
{
    protected $signature = 'bookings:expire-pending';
    protected $description = 'Expire bookings that have been pending for too long';

    public function handle(): int
    {
        $expireMinutes = (int) (\App\Models\Setting::where('key', 'booking_expire_minutes')->value('value') ?? 60);
        $expired = Booking::where('status', 'pending')
            ->where('created_at', '<=', now()->subMinutes($expireMinutes))
            ->update(['status' => 'expired']);
        $this->info("Expired {$expired} pending bookings.");
        return self::SUCCESS;
    }
}
