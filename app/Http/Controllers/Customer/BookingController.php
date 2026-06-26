<?php
declare(strict_types=1);
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreBookingRequest;
use App\Services\BookingService;
use App\DTOs\BookingDTO;
use App\Models\Booking;
use App\Models\Court;
use App\Models\Sport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function __construct(protected BookingService $bookingService) {}

    public function index(Request $request): View
    {
        $query = Booking::where('user_id', Auth::id())->with(['court.sport', 'court.images', 'payment']);
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $bookings = $query->latest()->paginate(10);
        return view('customer.bookings.index', compact('bookings'));
    }

    public function create(): View
    {
        $sports = Sport::where('is_active', true)->get();
        $courts = Court::where('status', 'active')->with(['sport', 'images', 'facilities'])->withAvg('reviews', 'rating')->get();
        return view('customer.bookings.create', compact('sports', 'courts'));
    }

    public function store(StoreBookingRequest $request): RedirectResponse
    {
        $dto = BookingDTO::fromRequest($request);
        $booking = $this->bookingService->createBooking($dto);

        return redirect()->route('customer.payments.process', $booking->id)
            ->with('success', 'Booking berhasil dibuat. Silakan lakukan pembayaran.');
    }

    public function show(string $id): View
    {
        $booking = Booking::where('user_id', Auth::id())
            ->with(['court.sport', 'court.images', 'payment', 'invoice', 'details', 'review'])
            ->findOrFail($id);
        return view('customer.bookings.show', compact('booking'));
    }

    public function cancel(string $id): RedirectResponse
    {
        $booking = Booking::where('user_id', Auth::id())->where('status', 'pending')->findOrFail($id);
        $this->bookingService->cancelBooking($id);
        return redirect()->route('customer.bookings.index')->with('success', 'Booking berhasil dibatalkan.');
    }
}
