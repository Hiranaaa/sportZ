<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function __construct(
        protected BookingService $bookingService
    ) {}

    public function index(Request $request): View
    {
        $query = Booking::with(['user', 'court.sport', 'payment']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('date')) {
            $query->whereDate('booking_date', $request->date);
        }
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('booking_code', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', fn ($q2) => $q2->where('name', 'like', '%' . $request->search . '%'));
            });
        }

        $bookings = $query->latest()->paginate(15);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(string $id): View
    {
        $booking = Booking::with(['user', 'court.sport', 'court.images', 'payment.logs', 'invoice', 'details', 'review'])->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, string $id): RedirectResponse
    {
        $request->validate(['status' => 'required|in:confirmed,completed,cancelled,no_show']);

        $booking = Booking::findOrFail($id);
        $booking->update(['status' => $request->status]);

        if ($request->status === 'cancelled') {
            $this->bookingService->cancelBooking($id);
        }

        return back()->with('success', 'Status booking berhasil diperbarui.');
    }

    public function checkIn(string $id): RedirectResponse
    {
        $this->bookingService->checkIn($id);
        return back()->with('success', 'Check-in berhasil.');
    }
}
