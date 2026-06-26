<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface ReviewRepositoryInterface extends BaseRepositoryInterface
{
    public function getByCourtId(string $courtId): Collection;

    public function getAverageRating(string $courtId): float;
}
