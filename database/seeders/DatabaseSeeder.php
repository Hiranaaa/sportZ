<?php
declare(strict_types=1);
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            AdminUserSeeder::class,
            SportSeeder::class,
            FacilitySeeder::class,
            CourtSeeder::class,
            OperatingHourSeeder::class,
            FaqSeeder::class,
            TestimonialSeeder::class,
            BannerSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
