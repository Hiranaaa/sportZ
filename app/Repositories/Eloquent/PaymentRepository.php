<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Enums\PaymentStatus;
use App\Models\Payment;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PaymentRepository extends BaseRepository implements PaymentRepositoryInterface
{
    public function __construct(Payment $model)
    {
        parent::__construct($model);
    }

    public function findByTransactionId(string $transactionId): ?Model
    {
        return $this->model
            ->where('transaction_id', $transactionId)
            ->with(['booking.user', 'booking.court'])
            ->first();
    }

    public function getByStatus(string $status): Collection
    {
        return $this->model
            ->where('status', $status)
            ->with(['booking.user', 'booking.court'])
            ->latest()
            ->get();
    }

    public function getTodayRevenue(): float
    {
        return (float) $this->model
            ->where('status', PaymentStatus::Paid)
            ->whereDate('paid_at', now()->toDateString())
            ->sum('amount');
    }

    public function getMonthlyRevenue(int $year, int $month): float
    {
        return (float) $this->model
            ->where('status', PaymentStatus::Paid)
            ->whereYear('paid_at', $year)
            ->whereMonth('paid_at', $month)
            ->sum('amount');
    }
}
