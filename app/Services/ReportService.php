<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\BookingStatus;
use App\Enums\PaymentStatus;
use App\Models\Booking;
use App\Models\Payment;
use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Exports\BookingReportExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ReportService
{
    public function __construct(
        private readonly BookingRepositoryInterface $bookingRepository,
        private readonly PaymentRepositoryInterface $paymentRepository,
    ) {}

    public function getBookingReport(string $startDate, string $endDate): array
    {
        $bookings = Booking::whereBetween('booking_date', [$startDate, $endDate])
            ->with(['user', 'court.sport', 'payment'])
            ->get();

        $grouped = $bookings->groupBy('status');

        return [
            'period' => ['start' => $startDate, 'end' => $endDate],
            'total_bookings' => $bookings->count(),
            'by_status' => [
                'pending' => $grouped->get(BookingStatus::Pending->value, collect())->count(),
                'confirmed' => $grouped->get(BookingStatus::Confirmed->value, collect())->count(),
                'completed' => $grouped->get(BookingStatus::Completed->value, collect())->count(),
                'cancelled' => $grouped->get(BookingStatus::Cancelled->value, collect())->count(),
                'no_show' => $grouped->get(BookingStatus::NoShow->value, collect())->count(),
            ],
            'bookings' => $bookings,
        ];
    }

    public function getRevenueReport(string $startDate, string $endDate): array
    {
        $payments = Payment::where('status', PaymentStatus::Paid)
            ->whereBetween('paid_at', [$startDate, $endDate])
            ->with(['booking.court.sport'])
            ->get();

        $dailyRevenue = $payments->groupBy(function ($payment) {
            return Carbon::parse($payment->paid_at)->format('Y-m-d');
        })->map(fn ($group) => $group->sum('amount'));

        return [
            'period' => ['start' => $startDate, 'end' => $endDate],
            'total_revenue' => $payments->sum('amount'),
            'total_transactions' => $payments->count(),
            'average_transaction' => $payments->count() > 0
                ? round($payments->sum('amount') / $payments->count(), 2)
                : 0,
            'daily_revenue' => $dailyRevenue,
            'payments' => $payments,
        ];
    }

    public function getCourtUtilization(): array
    {
        $bookings = Booking::whereIn('status', [
            BookingStatus::Confirmed->value,
            BookingStatus::Completed->value,
        ])
            ->with('court.sport')
            ->get();

        $utilization = $bookings->groupBy('court_id')->map(function ($courtBookings) {
            $court = $courtBookings->first()->court;
            return [
                'court_name' => $court->name,
                'sport' => $court->sport->name ?? '-',
                'total_bookings' => $courtBookings->count(),
                'total_hours' => $courtBookings->sum('duration_hours'),
                'total_revenue' => $courtBookings->sum('total_price'),
            ];
        })->sortByDesc('total_bookings')->values();

        return [
            'courts' => $utilization,
            'total_courts' => $utilization->count(),
        ];
    }

    public function exportToPdf(array $data, string $view)
{
    return Pdf::loadView($view, $data)
        ->setPaper('A4', 'portrait');
}
   public function exportToExcel(array $data): BookingReportExport
{
    return new BookingReportExport($data['bookings']);
}
}
