<?php

declare(strict_types=1);

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookingReportExport implements FromCollection, WithHeadings
{
    public function __construct(
        private Collection $bookings
    ) {}

    public function collection(): Collection
    {
        return $this->bookings->map(function ($booking) {
            return [
                $booking->booking_code,
                $booking->user->name ?? '-',
                $booking->court->name ?? '-',
                $booking->court->sport->name ?? '-',
                $booking->booking_date,
                substr($booking->start_time, 0, 5),
                substr($booking->end_time, 0, 5),
                $booking->duration_hours,
                $booking->total_price,
                ucfirst($booking->status),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Kode Booking',
            'Pelanggan',
            'Lapangan',
            'Olahraga',
            'Tanggal',
            'Jam Mulai',
            'Jam Selesai',
            'Durasi (Jam)',
            'Total Harga',
            'Status',
        ];
    }
}