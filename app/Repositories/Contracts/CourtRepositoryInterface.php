<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CourtRepositoryInterface extends BaseRepositoryInterface
{
    public function getActiveCourts(): Collection;

    public function getByType(string $sportId): Collection;

    public function searchCourts(string $query, array $filters = []): LengthAwarePaginator;
}
