<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\BookingSlotStatus;
use App\Models\BookingSlot;
use App\Models\Court;
use App\Models\OperatingHour;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class GenerateBookingSlotsCommand extends Command
{
    protected $signature = 'slots:generate {days=7 : Number of days to generate slots for}';

    protected $description = 'Generate booking slots for each court based on operating hours';

    public function handle(): int
    {
        $days = (int) $this->argument('days');
        $courts = Court::active()->get();

        $this->info("Generating slots for {$courts->count()} court(s) over {$days} day(s)...");

        $totalSlots = 0;

        foreach ($courts as $court) {
            $operatingHours = OperatingHour::where('court_id', $court->id)->get();

            for ($day = 0; $day < $days; $day++) {
                $date = Carbon::now()->addDays($day);
                $dayOfWeek = (int) $date->dayOfWeek;

                $hours = $operatingHours->firstWhere('day_of_week', $dayOfWeek);

                if (!$hours || $hours->is_closed) {
                    continue;
                }

                $openTime = Carbon::parse($hours->open_time);
                $closeTime = Carbon::parse($hours->close_time);
                $currentTime = $openTime->copy();

                while ($currentTime->lt($closeTime)) {
                    $slotEnd = $currentTime->copy()->addHour();

                    if ($slotEnd->gt($closeTime)) {
                        break;
                    }

                    $exists = BookingSlot::where('court_id', $court->id)
                        ->where('slot_date', $date->toDateString())
                        ->where('start_time', $currentTime->format('H:i:s'))
                        ->where('end_time', $slotEnd->format('H:i:s'))
                        ->exists();

                    if (!$exists) {
                        BookingSlot::create([
                            'court_id' => $court->id,
                            'slot_date' => $date->toDateString(),
                            'start_time' => $currentTime->format('H:i:s'),
                            'end_time' => $slotEnd->format('H:i:s'),
                            'status' => BookingSlotStatus::Available,
                        ]);

                        $totalSlots++;
                    }

                    $currentTime->addHour();
                }
            }

            $this->line("  → Generated slots for court: {$court->name}");
        }

        $this->info("Total {$totalSlots} new slot(s) generated successfully.");

        return self::SUCCESS;
    }
}
