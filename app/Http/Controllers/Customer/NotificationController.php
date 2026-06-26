<?php
declare(strict_types=1);
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\AppNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function index(): View
    {
        $notifications = AppNotification::where('user_id', Auth::id())->latest()->paginate(20);
        return view('customer.notifications.index', compact('notifications'));
    }

    public function markAsRead(string $id): RedirectResponse
    {
        AppNotification::where('user_id', Auth::id())->where('id', $id)->update(['read_at' => now()]);
        return back();
    }

    public function markAllRead(): RedirectResponse
    {
        AppNotification::where('user_id', Auth::id())->whereNull('read_at')->update(['read_at' => now()]);
        return back()->with('success', 'Semua notifikasi telah dibaca.');
    }
}
