<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\BookingStatus;
use App\Enums\PaymentStatus;
use App\Events\PaymentReceived;
use App\Exceptions\PaymentException;
use App\Models\Booking;
use App\Models\Payment;
use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use Illuminate\Support\Str;

class PaymentService
{
    public function __construct(
        private readonly PaymentRepositoryInterface $paymentRepository,
        private readonly BookingRepositoryInterface $bookingRepository,
        private readonly MidtransService $midtransService,
    ) {}

    public function createPayment(string $bookingId): Payment
    {
        /** @var Booking $booking */
        $booking = $this->bookingRepository->findOrFail($bookingId);

        if ($booking->payment) {
            return $booking->payment;
        }

        $transactionId = 'SPZ-' . now()->format('YmdHis') . '-' . strtoupper(Str::random(6));

        /** @var Payment */
       return $this->paymentRepository->create([
    'booking_id' => $bookingId,
    'transaction_id' => $transactionId,
    'amount' => $booking->total_amount,
    'status' => PaymentStatus::Pending,
]);
    }

    public function getSnapToken(Payment $payment): string
    {
        $payment->load('booking.user', 'booking.court');

        $params = [
            'transaction_details' => [
                'order_id' => $payment->transaction_id,
                'gross_amount' => (int) $payment->amount,
            ],
            'customer_details' => [
                'first_name' => $payment->booking->user->name,
                'email' => $payment->booking->user->email,
                'phone' => $payment->booking->user->phone ?? '',
            ],
            'item_details' => [
                [
                    'id' => $payment->booking->court_id,
                    'price' => (int) $payment->amount,
                    'quantity' => 1,
                    'name' => substr(
                        "Booking {$payment->booking->court->name} - {$payment->booking->booking_date}",
                        0,
                        50
                    ),
                ],
            ],
        ];

        $snapToken = $this->midtransService->createSnapTransaction($params);

        $payment->update(['snap_token' => $snapToken]);

        return $snapToken;
    }

    public function handleWebhook(array $payload): void
    {
        if (!$this->verifySignature($payload)) {
            throw new PaymentException('Invalid payment signature.');
        }

        $orderId = $payload['order_id'] ?? '';
        $transactionStatus = $payload['transaction_status'] ?? '';
        $fraudStatus = $payload['fraud_status'] ?? 'accept';

        $payment = $this->paymentRepository->findByTransactionId($orderId);

        if (!$payment) {
            throw new PaymentException("Payment not found for order: {$orderId}");
        }

        match ($transactionStatus) {
            'capture' => $this->handleCapture($payment, $fraudStatus),
            'settlement' => $this->handleSettlement($payment, $payload),
            'pending' => $payment->update(['status' => PaymentStatus::Pending]),
            'deny', 'cancel' => $this->handleCancel($payment),
            'expire' => $this->handleExpire($payment),
            default => null,
        };
    }

    public function verifySignature(array $payload): bool
    {
        $orderId = $payload['order_id'] ?? '';
        $statusCode = $payload['status_code'] ?? '';
        $grossAmount = $payload['gross_amount'] ?? '';
        $serverKey = config('midtrans.server_key');

        $signatureKey = $payload['signature_key'] ?? '';
        $expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        return $signatureKey === $expectedSignature;
    }

    private function handleCapture(Payment $payment, string $fraudStatus): void
    {
        if ($fraudStatus === 'accept') {
            $payment->update([
                'status' => PaymentStatus::Paid,
                'paid_at' => now(),
            ]);

            $this->bookingRepository->update($payment->booking_id, [
                'status' => BookingStatus::Confirmed,
            ]);

            event(new PaymentReceived($payment->fresh()));
        }
    }

    private function handleSettlement(Payment $payment, array $payload): void
    {
        $payment->update([
            'status' => PaymentStatus::Paid,
            'payment_method' => $payload['payment_type'] ?? null,
            'paid_at' => now(),
        ]);

        $this->bookingRepository->update($payment->booking_id, [
            'status' => BookingStatus::Confirmed,
        ]);

        event(new PaymentReceived($payment->fresh()));
    }

    private function handleCancel(Payment $payment): void
    {
        $payment->update(['status' => PaymentStatus::Cancelled]);

        $this->bookingRepository->update($payment->booking_id, [
            'status' => BookingStatus::Cancelled,
        ]);
    }

    private function handleExpire(Payment $payment): void
    {
        $payment->update(['status' => PaymentStatus::Expired]);

        $this->bookingRepository->update($payment->booking_id, [
            'status' => BookingStatus::Cancelled,
        ]);
    }
}
