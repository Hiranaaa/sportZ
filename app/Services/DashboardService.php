<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\BookingStatus;
use App\Enums\CourtStatus;
use App\Enums\PaymentStatus;
use App\Models\Booking;
use App\Models\Court;
use App\Models\Payment;
use App\Models\User;
use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use Illuminate\Support\Carbon;

class DashboardService
{
    public function __construct(
        private readonly BookingRepositoryInterface $bookingRepository,
        private readonly PaymentRepositoryInterface $paymentRepository,
    ) {}

    public function getAdminStats(): array
    {
        $today = now()->toDateString();
        $currentMonth = now()->month;
        $currentYear = now()->year;

        return [
            'total_customers' => User::customers()->count(),
            'total_bookings' => Booking::count(),
            'today_bookings' => Booking::whereDate('booking_date', $today)->count(),
            'pending_bookings' => Booking::where('status', BookingStatus::Pending)->count(),
            'confirmed_bookings' => Booking::where('status', BookingStatus::Confirmed)->count(),
            'revenue_today' => $this->paymentRepository->getTodayRevenue(),
            'revenue_monthly' => $this->paymentRepository->getMonthlyRevenue($currentYear, $currentMonth),
            'active_courts' => Court::where('status', CourtStatus::Active)->count(),
            'maintenance_courts' => Court::where('status', CourtStatus::Maintenance)->count(),
            'total_courts' => Court::count(),
        ];
    }

    public function getCustomerStats(string $userId): array
    {
        $bookings = Booking::where('user_id', $userId);

        return [
            'total_bookings' => (clone $bookings)->count(),
            'active_bookings' => (clone $bookings)
                ->whereIn('status', [BookingStatus::Pending->value, BookingStatus::Confirmed->value])
                ->count(),
            'completed_bookings' => (clone $bookings)
                ->where('status', BookingStatus::Completed)
                ->count(),
            'cancelled_bookings' => (clone $bookings)
                ->where('status', BookingStatus::Cancelled)
                ->count(),
            'total_spending' => Payment::whereHas('booking', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })->where('status', PaymentStatus::Paid)->sum('amount'),
        ];
    }

    public function getChartData(string $type, ?string $period = null): array
    {
        $period = $period ?? 'monthly';

        return match ($type) {
            'revenue' => $this->getRevenueChartData($period),
            'bookings' => $this->getBookingChartData($period),
            default => [],
        };
    }

    private function getRevenueChartData(string $period): array
    {
        $labels = [];
        $data = [];

        if ($period === 'monthly') {
            for ($i = 11; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $labels[] = $date->translatedFormat('M Y');
                $data[] = $this->paymentRepository->getMonthlyRevenue(
                    (int) $date->format('Y'),
                    (int) $date->format('m')
                );
            }
        } elseif ($period === 'weekly') {
            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i);
                $labels[] = $date->translatedFormat('D, d M');
                $data[] = (float) Payment::where('status', PaymentStatus::Paid)
                    ->whereDate('paid_at', $date->toDateString())
                    ->sum('amount');
            }
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Pendapatan',
                    'data' => $data,
                ],
            ],
        ];
    }

    private function getBookingChartData(string $period): array
    {
        $labels = [];
        $data = [];

        if ($period === 'monthly') {
            for ($i = 11; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $labels[] = $date->translatedFormat('M Y');
                $data[] = Booking::whereYear('booking_date', $date->year)
                    ->whereMonth('booking_date', $date->month)
                    ->count();
            }
        } elseif ($period === 'weekly') {
            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i);
                $labels[] = $date->translatedFormat('D, d M');
                $data[] = Booking::whereDate('booking_date', $date->toDateString())->count();
            }
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Booking',
                    'data' => $data,
                ],
            ],
        ];
    }
}
