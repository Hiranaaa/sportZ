<?php
declare(strict_types=1);
namespace App\Console\Commands;

use App\Models\BookingSlot;
use App\Models\Court;
use App\Models\OperatingHour;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateBookingSlots extends Command
{
    protected $signature = 'slots:generate {--days=7}';
    protected $description = 'Generate booking slots for courts based on operating hours';

    public function handle(): int
    {
        $days = (int) $this->option('days');
        $courts = Court::where('status', 'active')->with('operatingHours')->get();
        $count = 0;

        for ($d = 0; $d < $days; $d++) {
            $date = Carbon::today()->addDays($d);
            $dayOfWeek = $date->dayOfWeek;

            foreach ($courts as $court) {
                $oh = $court->operatingHours->firstWhere('day_of_week', $dayOfWeek);
                if (!$oh || $oh->is_closed) continue;

                $openHour = (int) substr($oh->open_time, 0, 2);
                $closeHour = (int) substr($oh->close_time, 0, 2);

                for ($h = $openHour; $h < $closeHour; $h++) {
                    BookingSlot::firstOrCreate([
                        'court_id' => $court->id,
                        'slot_date' => $date->format('Y-m-d'),
                        'start_time' => sprintf('%02d:00:00', $h),
                        'end_time' => sprintf('%02d:00:00', $h + 1),
                    ], ['status' => 'available']);
                    $count++;
                }
            }
        }
        $this->info("Generated/verified {$count} slots.");
        return self::SUCCESS;
    }
}
