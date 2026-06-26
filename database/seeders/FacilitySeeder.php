<?php
declare(strict_types=1);
namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        $facilities = [
            ['name' => 'Parkir Luas', 'icon' => '🅿️', 'description' => 'Area parkir luas untuk mobil dan motor'],
            ['name' => 'WiFi Gratis', 'icon' => '📶', 'description' => 'WiFi berkecepatan tinggi gratis'],
            ['name' => 'Toilet Bersih', 'icon' => '🚻', 'description' => 'Toilet bersih dan terawat'],
            ['name' => 'Musholla', 'icon' => '🕌', 'description' => 'Musholla yang nyaman'],
            ['name' => 'Kantin', 'icon' => '🍽️', 'description' => 'Kantin dengan makanan dan minuman'],
            ['name' => 'Tribun Penonton', 'icon' => '🏟️', 'description' => 'Area tribun untuk penonton'],
            ['name' => 'AC', 'icon' => '❄️', 'description' => 'Ruangan ber-AC sejuk'],
            ['name' => 'Shower', 'icon' => '🚿', 'description' => 'Kamar mandi dengan shower air hangat'],
            ['name' => 'Loker', 'icon' => '🔐', 'description' => 'Loker aman untuk menyimpan barang'],
            ['name' => 'Sound System', 'icon' => '🔊', 'description' => 'Sound system berkualitas tinggi'],
        ];
        foreach ($facilities as $f) { Facility::create($f); }
    }
}
