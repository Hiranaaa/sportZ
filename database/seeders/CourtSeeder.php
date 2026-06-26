<?php
declare(strict_types=1);
namespace Database\Seeders;

use App\Models\Court;
use App\Models\CourtImage;
use App\Models\Facility;
use App\Models\Sport;
use Illuminate\Database\Seeder;

class CourtSeeder extends Seeder
{
    public function run(): void
    {
        $futsal = Sport::where('slug', 'futsal')->first();
        $badminton = Sport::where('slug', 'badminton')->first();
        $facilities = Facility::all();

        $futsalCourts = [
            ['name' => 'Futsal Court A', 'court_number' => 'FTS-A', 'price_per_hour' => 150000, 'description' => 'Lapangan futsal premium dengan rumput sintetis terbaik dan pencahayaan LED.', 'width' => 20, 'length' => 40, 'capacity' => 14],
            ['name' => 'Futsal Court B', 'court_number' => 'FTS-B', 'price_per_hour' => 125000, 'description' => 'Lapangan futsal standar internasional dengan fasilitas lengkap.', 'width' => 18, 'length' => 36, 'capacity' => 14],
            ['name' => 'Futsal Court C', 'court_number' => 'FTS-C', 'price_per_hour' => 100000, 'description' => 'Lapangan futsal ekonomis cocok untuk latihan dan pertandingan santai.', 'width' => 16, 'length' => 32, 'capacity' => 14],
        ];

        $badmintonCourts = [
            ['name' => 'Badminton Court A', 'court_number' => 'BDM-A', 'price_per_hour' => 100000, 'description' => 'Lapangan badminton premium dengan lantai vinyl pro dan AC.', 'width' => 6.1, 'length' => 13.4, 'capacity' => 4],
            ['name' => 'Badminton Court B', 'court_number' => 'BDM-B', 'price_per_hour' => 85000, 'description' => 'Lapangan badminton standar dengan net original PBSI.', 'width' => 6.1, 'length' => 13.4, 'capacity' => 4],
            ['name' => 'Badminton Court C', 'court_number' => 'BDM-C', 'price_per_hour' => 75000, 'description' => 'Lapangan badminton ekonomis, cocok untuk latihan rutin.', 'width' => 6.1, 'length' => 13.4, 'capacity' => 4],
        ];

        foreach ($futsalCourts as $data) {
            $court = Court::create(array_merge($data, ['sport_id' => $futsal->id, 'status' => 'active']));
            $court->facilities()->sync($facilities->random(rand(5, 8))->pluck('id'));
            CourtImage::create(['court_id' => $court->id, 'image_path' => '/images/courts/futsal-placeholder.jpg', 'is_primary' => true, 'sort_order' => 0]);
        }

        foreach ($badmintonCourts as $data) {
            $court = Court::create(array_merge($data, ['sport_id' => $badminton->id, 'status' => 'active']));
            $court->facilities()->sync($facilities->random(rand(5, 8))->pluck('id'));
            CourtImage::create(['court_id' => $court->id, 'image_path' => '/images/courts/badminton-placeholder.jpg', 'is_primary' => true, 'sort_order' => 0]);
        }
    }
}
