<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface BookingSlotRepositoryInterface extends BaseRepositoryInterface
{
    public function getAvailableSlots(string $courtId, string $date): Collection;

    public function updateStatus(string $id, string $status): bool;

    public function getByDateRange(string $courtId, string $startDate, string $endDate): Collection;
}
