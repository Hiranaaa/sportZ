<?php
declare(strict_types=1);
namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'SportZ', 'group' => 'general'],
            ['key' => 'tagline', 'value' => 'Book Your Game, Anytime', 'group' => 'general'],
            ['key' => 'phone', 'value' => '+62 812 3456 7890', 'group' => 'contact'],
            ['key' => 'email', 'value' => 'info@sportz.id', 'group' => 'contact'],
            ['key' => 'address', 'value' => 'Jl. Olahraga No. 123, Jakarta Selatan, DKI Jakarta 12345', 'group' => 'contact'],
            ['key' => 'whatsapp', 'value' => '6281234567890', 'group' => 'contact'],
            ['key' => 'booking_expire_minutes', 'value' => '60', 'group' => 'booking'],
            ['key' => 'max_booking_hours', 'value' => '4', 'group' => 'booking'],
            ['key' => 'min_booking_hours', 'value' => '1', 'group' => 'booking'],
            ['key' => 'currency', 'value' => 'IDR', 'group' => 'payment'],
            ['key' => 'tax_percentage', 'value' => '0', 'group' => 'payment'],
            ['key' => 'google_maps_api_key', 'value' => '', 'group' => 'integration'],
            ['key' => 'latitude', 'value' => '-6.2088', 'group' => 'location'],
            ['key' => 'longitude', 'value' => '106.8456', 'group' => 'location'],
        ];
        foreach ($settings as $s) { Setting::create($s); }
    }
}
