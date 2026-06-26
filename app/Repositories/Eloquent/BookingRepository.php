<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Booking;
use App\Repositories\Contracts\BookingRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class BookingRepository extends BaseRepository implements BookingRepositoryInterface
{
    public function __construct(Booking $model)
    {
        parent::__construct($model);
    }

    public function getByUser(string $userId): Collection
    {
        return $this->model
            ->where('user_id', $userId)
            ->with(['court.sport', 'payment', 'bookingDetails'])
            ->latest()
            ->get();
    }

    public function getByStatus(string $status): Collection
    {
        return $this->model
            ->where('status', $status)
            ->with(['user', 'court.sport', 'payment'])
            ->latest()
            ->get();
    }

    public function getByDate(string $date): Collection
    {
        return $this->model
            ->where('booking_date', $date)
            ->with(['user', 'court.sport', 'payment'])
            ->orderBy('start_time')
            ->get();
    }

    public function getTodayBookings(): Collection
    {
        return $this->getByDate(now()->toDateString());
    }

    public function getConflicting(
        string $courtId,
        string $date,
        string $startTime,
        string $endTime
    ): Collection {
        return $this->model
            ->where('court_id', $courtId)
            ->where('booking_date', $date)
            ->whereNotIn('status', ['cancelled', 'no_show'])
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where(function ($q) use ($startTime, $endTime) {
                    $q->where('start_time', '<', $endTime)
                      ->where('end_time', '>', $startTime);
                });
            })
            ->get();
    }
}
