<?php
declare(strict_types=1);
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function __construct(protected PaymentService $paymentService) {}

    public function process(string $bookingId): View
    {
        $booking = Booking::where('user_id', Auth::id())->with(['court.sport', 'payment'])->findOrFail($bookingId);

        if (!$booking->payment) {
            $payment = $this->paymentService->createPayment($bookingId);
        } else {
            $payment = $booking->payment;
        }

        $snapToken = $this->paymentService->getSnapToken($payment);

        return view('customer.payments.process', compact('booking', 'payment', 'snapToken'));
    }

    public function success(): View
    {
        return view('customer.payments.success');
    }

    public function failed(): View
    {
        return view('customer.payments.failed');
    }
}
