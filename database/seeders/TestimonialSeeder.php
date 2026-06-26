<?php
declare(strict_types=1);
namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            ['name' => 'Ahmad Rizki', 'role' => 'Futsal Player', 'content' => 'SportZ adalah tempat terbaik untuk bermain futsal! Lapangannya berkualitas tinggi dan sistem bookingnya sangat mudah digunakan. Recommended banget!', 'rating' => 5],
            ['name' => 'Siti Nurhaliza', 'role' => 'Badminton Enthusiast', 'content' => 'Saya sangat puas dengan fasilitas badminton di SportZ. AC-nya adem, lantainya nyaman, dan harga sangat terjangkau. Pasti booking lagi!', 'rating' => 5],
            ['name' => 'Budi Santoso', 'role' => 'Community Leader', 'content' => 'Komunitas futsal kami rutin booking di SportZ. Pelayanannya profesional dan booking online-nya memudahkan koordinasi tim. Top markotop!', 'rating' => 4],
            ['name' => 'Dewi Lestari', 'role' => 'Fitness Enthusiast', 'content' => 'Pertama kali coba booking online di SportZ dan langsung jatuh hati. Prosesnya cepat, pembayarannya aman, dan lapangannya bersih terawat.', 'rating' => 5],
            ['name' => 'Fajar Nugroho', 'role' => 'Weekend Warrior', 'content' => 'Setiap weekend pasti main di SportZ. Sistemnya canggih, ada QR check-in dan invoice digital. Modern banget! Gak mau pindah ke tempat lain.', 'rating' => 5],
            ['name' => 'Rina Wati', 'role' => 'Sports Mom', 'content' => 'Anak-anak saya sangat senang bermain di SportZ. Fasilitasnya lengkap dan aman untuk anak-anak. Parkir luas dan ada kantin juga. Perfect!', 'rating' => 4],
        ];
        foreach ($testimonials as $i => $t) {
            Testimonial::create(array_merge($t, ['sort_order' => $i, 'is_active' => true]));
        }
    }
}
