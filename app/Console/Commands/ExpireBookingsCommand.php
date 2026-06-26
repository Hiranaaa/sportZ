<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Jobs\ExpireBookingJob;
use Illuminate\Console\Command;

class ExpireBookingsCommand extends Command
{
    protected $signature = 'bookings:expire';

    protected $description = 'Expire pending bookings that have exceeded the time limit';

    public function handle(): int
    {
        $this->info('Dispatching expire booking job...');

        ExpireBookingJob::dispatch();

        $this->info('Expire booking job dispatched successfully.');

        return self::SUCCESS;
    }
}
