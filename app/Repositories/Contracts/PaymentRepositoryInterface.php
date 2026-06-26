<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface PaymentRepositoryInterface extends BaseRepositoryInterface
{
    public function findByTransactionId(string $transactionId): ?Model;

    public function getByStatus(string $status): Collection;

    public function getTodayRevenue(): float;

    public function getMonthlyRevenue(int $year, int $month): float;
}
