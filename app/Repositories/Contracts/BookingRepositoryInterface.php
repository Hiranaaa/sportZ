<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface BookingRepositoryInterface extends BaseRepositoryInterface
{
    public function getByUser(string $userId): Collection;

    public function getByStatus(string $status): Collection;

    public function getByDate(string $date): Collection;

    public function getTodayBookings(): Collection;

    public function getConflicting(
        string $courtId,
        string $date,
        string $startTime,
        string $endTime
    ): Collection;
}
