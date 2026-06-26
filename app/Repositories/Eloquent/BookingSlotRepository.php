<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Enums\SlotStatus;
use App\Models\BookingSlot;
use App\Repositories\Contracts\BookingSlotRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class BookingSlotRepository extends BaseRepository implements BookingSlotRepositoryInterface
{
    public function __construct(BookingSlot $model)
    {
        parent::__construct($model);
    }

    public function getAvailableSlots(string $courtId, string $date): Collection
    {
        return $this->model
            ->where('court_id', $courtId)
            ->where('date', $date)
            ->where('status', SlotStatus::AVAILABLE)
            ->orderBy('start_time')
            ->get();
    }

    public function updateStatus(string $id, string $status): bool
    {
        $slot = $this->findOrFail($id);

        return $slot->update(['status' => $status]);
    }

    public function getByDateRange(string $courtId, string $startDate, string $endDate): Collection
    {
        return $this->model
            ->where('court_id', $courtId)
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();
    }
}
