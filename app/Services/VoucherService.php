<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\VoucherRepositoryInterface;

class VoucherService
{
    public function __construct(
        private readonly VoucherRepositoryInterface $voucherRepository,
    ) {}

    public function validateAndApply(string $code, float $amount): array
    {
        return $this->voucherRepository->validateVoucher($code, $amount);
    }

    public function incrementUsage(string $voucherId): void
    {
        $voucher = $this->voucherRepository->findOrFail($voucherId);

        $voucher->increment('used_count');
    }
}
