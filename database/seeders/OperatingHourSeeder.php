<?php
declare(strict_types=1);
namespace Database\Seeders;

use App\Models\Court;
use App\Models\OperatingHour;
use Illuminate\Database\Seeder;

class OperatingHourSeeder extends Seeder
{
    public function run(): void
    {
        $courts = Court::all();
        foreach ($courts as $court) {
            for ($day = 0; $day <= 6; $day++) {
                OperatingHour::create([
                    'court_id' => $court->id,
                    'day_of_week' => $day,
                    'open_time' => '08:00',
                    'close_time' => '22:00',
                    'is_closed' => false,
                ]);
            }
        }
    }
}
