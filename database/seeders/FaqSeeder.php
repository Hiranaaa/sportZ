<?php
declare(strict_types=1);
namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            ['question' => 'Bagaimana cara melakukan booking lapangan?', 'answer' => 'Anda dapat melakukan booking melalui website kami. Pilih lapangan, tentukan tanggal dan jam, lalu lakukan pembayaran. Booking akan terkonfirmasi setelah pembayaran berhasil.'],
            ['question' => 'Metode pembayaran apa saja yang tersedia?', 'answer' => 'Kami mendukung berbagai metode pembayaran melalui Midtrans, termasuk QRIS, Transfer Bank (VA), GoPay, ShopeePay, OVO, dan Kartu Kredit/Debit.'],
            ['question' => 'Bagaimana kebijakan pembatalan booking?', 'answer' => 'Pembatalan dapat dilakukan maksimal 2 jam sebelum jadwal bermain. Refund akan diproses dalam 3-5 hari kerja sesuai metode pembayaran awal.'],
            ['question' => 'Apakah bisa reschedule jadwal booking?', 'answer' => 'Ya, Anda dapat melakukan reschedule maksimal 3 jam sebelum jadwal bermain, tergantung ketersediaan slot. Hubungi admin untuk bantuan reschedule.'],
            ['question' => 'Berapa jam operasional SportZ?', 'answer' => 'SportZ beroperasi setiap hari dari pukul 08:00 - 22:00 WIB. Jam operasional dapat berbeda pada hari libur nasional.'],
            ['question' => 'Berapa harga sewa lapangan per jam?', 'answer' => 'Harga sewa bervariasi tergantung jenis lapangan. Futsal mulai dari Rp 100.000/jam dan Badminton mulai dari Rp 75.000/jam. Cek halaman lapangan untuk detail harga.'],
            ['question' => 'Fasilitas apa saja yang tersedia?', 'answer' => 'Kami menyediakan fasilitas lengkap termasuk parkir luas, WiFi gratis, toilet bersih, musholla, kantin, shower, loker, dan tribun penonton.'],
            ['question' => 'Apakah tersedia program membership?', 'answer' => 'Ya, kami memiliki program membership dengan berbagai keuntungan seperti diskon khusus, prioritas booking, dan akses ke promo eksklusif. Hubungi admin untuk informasi lebih lanjut.'],
        ];
        foreach ($faqs as $i => $faq) {
            Faq::create(array_merge($faq, ['sort_order' => $i, 'is_active' => true]));
        }
    }
}
