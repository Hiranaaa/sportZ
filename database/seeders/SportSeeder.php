<?php
declare(strict_types=1);
namespace Database\Seeders;

use App\Models\Sport;
use Illuminate\Database\Seeder;

class SportSeeder extends Seeder
{
    public function run(): void
    {
        Sport::create(['name' => 'Futsal', 'slug' => 'futsal', 'icon' => '⚽', 'description' => 'Lapangan futsal indoor dengan standar internasional', 'is_active' => true]);
        Sport::create(['name' => 'Badminton', 'slug' => 'badminton', 'icon' => '🏸', 'description' => 'Lapangan badminton indoor ber-AC dengan lantai vinyl', 'is_active' => true]);
    }
}
