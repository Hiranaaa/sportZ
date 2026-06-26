<?php

declare(strict_types=1);

namespace App\DTOs;

use Illuminate\Http\Request;

final readonly class BookingDTO
{
    public function __construct(
        public string $userId,
        public string $courtId,
        public string $bookingDate,
        public string $startTime,
        public string $endTime,
        public int $durationHours,
        public ?string $notes = null,
        public ?string $voucherCode = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            userId: $request->user()->id,
            courtId: $request->input('court_id'),
            bookingDate: $request->input('booking_date'),
            startTime: $request->input('start_time'),
            endTime: $request->input('end_time'),
            durationHours: (int) $request->input('duration_hours'),
            notes: $request->input('notes'),
            voucherCode: $request->input('voucher_code'),
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'court_id' => $this->courtId,
            'booking_date' => $this->bookingDate,
            'start_time' => $this->startTime,
            'end_time' => $this->endTime,
            'duration_hours' => $this->durationHours,
            'notes' => $this->notes,
            'voucher_code' => $this->voucherCode,
        ];
    }
}
