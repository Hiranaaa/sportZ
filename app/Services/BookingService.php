<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\BookingDTO;
use App\Enums\BookingStatus;
use App\Enums\SlotStatus;
use App\Events\BookingCancelled;
use App\Events\BookingCreated;
use App\Exceptions\BookingException;
use App\Exceptions\SlotUnavailableException;
use App\Models\Booking;
use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\Contracts\BookingSlotRepositoryInterface;
use App\Repositories\Contracts\CourtRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookingService
{
    public function __construct(
        private readonly BookingRepositoryInterface $bookingRepository,
        private readonly BookingSlotRepositoryInterface $slotRepository,
        private readonly CourtRepositoryInterface $courtRepository,
        private readonly VoucherService $voucherService,
    ) {}

    public function createBooking(BookingDTO $dto): Booking
    {
        $conflicts = $this->bookingRepository->getConflicting(
            $dto->courtId,
            $dto->bookingDate,
            $dto->startTime,
            $dto->endTime
        );

        if ($conflicts->isNotEmpty()) {
            throw new SlotUnavailableException('Slot waktu yang dipilih sudah tidak tersedia.');
        }

        return DB::transaction(function () use ($dto) {
            $court = $this->courtRepository->findOrFail($dto->courtId);
            $totalPrice = $this->calculatePrice($dto->courtId, $dto->durationHours);

            $discountAmount = 0;
            $voucherId = null;

            if ($dto->voucherCode) {
                $voucherResult = $this->voucherService->validateAndApply($dto->voucherCode, $totalPrice);
                if ($voucherResult['valid']) {
                    $discountAmount = $voucherResult['discount'];
                    $voucherId = $voucherResult['voucher']->id;
                }
            }

            $finalPrice = max(0, $totalPrice - $discountAmount);

            /** @var Booking $booking */
           $booking = $this->bookingRepository->create([
    'user_id' => $dto->userId,
    'court_id' => $dto->courtId,
    'booking_code' => $this->generateBookingCode(),
    'booking_date' => $dto->bookingDate,
    'start_time' => $dto->startTime,
    'end_time' => $dto->endTime,
    'duration_hours' => $dto->durationHours,

    // SESUAI DATABASE
    'subtotal' => $totalPrice,
    'discount' => $discountAmount,
    'total_amount' => $finalPrice,

    'voucher_id' => $voucherId,
    'notes' => $dto->notes,
    'status' => BookingStatus::Pending,
]);

            $this->updateSlotStatuses(
                $dto->courtId,
                $dto->bookingDate,
                $dto->startTime,
                $dto->endTime,
                SlotStatus::PENDING
            );

            if ($voucherId) {
                $this->voucherService->incrementUsage($voucherId);
            }

            event(new BookingCreated($booking));

            return $booking->load(['court.sport', 'user', 'payment']);
        });
    }

    public function cancelBooking(string $bookingId): bool
    {
        return DB::transaction(function () use ($bookingId) {
            /** @var Booking $booking */
            $booking = $this->bookingRepository->findOrFail($bookingId);

            if (!in_array($booking->status, [BookingStatus::Pending, BookingStatus::Confirmed])) {
                throw new BookingException('Booking tidak dapat dibatalkan.');
            }

            $this->bookingRepository->update($bookingId, [
                'status' => BookingStatus::Cancelled,
                'cancelled_at' => now(),
            ]);

            $this->updateSlotStatuses(
                $booking->court_id,
                $booking->booking_date,
                $booking->start_time,
                $booking->end_time,
                SlotStatus::AVAILABLE
            );

            event(new BookingCancelled($booking->fresh()));

            return true;
        });
    }

    public function getAvailableSlots(string $courtId, string $date): Collection
    {
        return $this->slotRepository->getAvailableSlots($courtId, $date);
    }

    public function calculatePrice(string $courtId, int $durationHours): float
    {
        $court = $this->courtRepository->findOrFail($courtId);

        return (float) ($court->price_per_hour * $durationHours);
    }

    public function applyVoucher(string $bookingId, string $voucherCode): Booking
    {
        /** @var Booking $booking */
        $booking = $this->bookingRepository->findOrFail($bookingId);

       $result = $this->voucherService->validateAndApply($voucherCode, $booking->subtotal);

if (!$result['valid']) {
    throw new BookingException($result['message']);
}

$finalPrice = max(0, $booking->subtotal - $result['discount']);

$this->bookingRepository->update($bookingId, [
    'voucher_id'   => $result['voucher']->id,
    'discount'     => $result['discount'],
    'total_amount' => $finalPrice,
]);
        $this->voucherService->incrementUsage($result['voucher']->id);

        return $booking->fresh();
    }

    public function generateBookingCode(): string
    {
        $prefix = config('sportz.booking_code_prefix', 'SPZ');
        $date = now()->format('Ymd');
        $random = strtoupper(Str::random(5));

        return "{$prefix}-{$date}-{$random}";
    }

    public function checkIn(string $bookingId): Booking
    {
        /** @var Booking $booking */
        $booking = $this->bookingRepository->findOrFail($bookingId);

        if ($booking->status !== BookingStatus::Confirmed) {
            throw new BookingException('Hanya booking yang sudah dikonfirmasi yang dapat check-in.');
        }

        $this->bookingRepository->update($bookingId, [
            'checked_in_at' => now(),
        ]);

        return $booking->fresh();
    }

    private function updateSlotStatuses(
        string $courtId,
        string $date,
        string $startTime,
        string $endTime,
        SlotStatus $status
    ): void {
        $slots = $this->slotRepository->getAvailableSlots($courtId, $date);

        $slots->filter(function ($slot) use ($startTime, $endTime) {
            return $slot->start_time >= $startTime && $slot->end_time <= $endTime;
        })->each(function ($slot) use ($status) {
            $this->slotRepository->updateStatus($slot->id, $status->value);
        });
    }
}
