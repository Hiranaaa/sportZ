<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface PromotionRepositoryInterface extends BaseRepositoryInterface
{
    public function getActivePromotions(): Collection;

    public function getCurrentPromotions(): Collection;
}
