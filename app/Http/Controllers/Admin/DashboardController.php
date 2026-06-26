<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService
    ) {}

    public function index(): View
    {
        $stats = $this->dashboardService->getAdminStats();
        $bookingChart = $this->dashboardService->getChartData('daily_bookings');
        $revenueChart = $this->dashboardService->getChartData('monthly_revenue');
        $hourChart = $this->dashboardService->getChartData('popular_hours');
        $sportChart = $this->dashboardService->getChartData('sport_distribution');

        return view('admin.dashboard', compact('stats', 'bookingChart', 'revenueChart', 'hourChart', 'sportChart'));
    }
}
