<?php
declare(strict_types=1);
namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        Banner::create(['title' => 'Grand Opening SportZ', 'description' => 'Nikmati diskon 50% untuk semua lapangan! Promo terbatas.', 'image_path' => '/images/banners/grand-opening.jpg', 'link' => '/courts', 'sort_order' => 0, 'is_active' => true]);
        Banner::create(['title' => 'Weekend Special', 'description' => 'Booking di weekend, dapatkan 1 jam gratis untuk setiap 3 jam booking!', 'image_path' => '/images/banners/weekend-promo.jpg', 'link' => '/courts', 'sort_order' => 1, 'is_active' => true]);
        Banner::create(['title' => 'Book Now, Play Now!', 'description' => 'Booking lapangan hanya dalam 30 detik. Mudah, cepat, dan aman.', 'image_path' => '/images/banners/book-now.jpg', 'link' => '/register', 'sort_order' => 2, 'is_active' => true]);
    }
}
