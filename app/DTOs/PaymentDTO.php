<?php

declare(strict_types=1);

namespace App\DTOs;

use Illuminate\Http\Request;

final readonly class PaymentDTO
{
    public function __construct(
        public string $bookingId,
        public ?string $paymentMethod = null,
        public float $amount = 0,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            bookingId: $request->input('booking_id'),
            paymentMethod: $request->input('payment_method'),
            amount: (float) $request->input('amount', 0),
        );
    }

    public function toArray(): array
    {
        return [
            'booking_id' => $this->bookingId,
            'payment_method' => $this->paymentMethod,
            'amount' => $this->amount,
        ];
    }
}
