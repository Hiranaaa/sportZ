<?php
declare(strict_types=1);
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use App\Models\Voucher;
use App\Models\Booking;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(protected DashboardService $dashboardService) {}

    public function index(): View
    {
        $userId = Auth::id();
        $stats = $this->dashboardService->getCustomerStats($userId);
        $todayBookings = Booking::where('user_id', $userId)->whereDate('booking_date', today())->with('court.sport')->get();
        $recentBookings = Booking::where('user_id', $userId)->with(['court.sport', 'payment'])->latest()->take(5)->get();
        $favorites = Favorite::where('user_id', $userId)->with('court.sport', 'court.images')->latest()->take(6)->get();
        $vouchers = Voucher::where('is_active', true)->where('end_date', '>=', today())->where(function ($q) { $q->whereNull('max_uses')->orWhereColumn('used_count', '<', 'max_uses'); })->get();

        return view('customer.dashboard', compact('stats', 'todayBookings', 'recentBookings', 'favorites', 'vouchers'));
    }
}
