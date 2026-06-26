<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface VoucherRepositoryInterface extends BaseRepositoryInterface
{
    public function findByCode(string $code): ?Model;

    public function getUsableVouchers(): Collection;

    public function validateVoucher(string $code, float $orderAmount): array;
}
