<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Enums\DiscountType;
use App\Models\Voucher;
use App\Repositories\Contracts\VoucherRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class VoucherRepository extends BaseRepository implements VoucherRepositoryInterface
{
    public function __construct(Voucher $model)
    {
        parent::__construct($model);
    }

    public function findByCode(string $code): ?Model
    {
        return $this->model
            ->where('code', strtoupper($code))
            ->first();
    }

    public function getUsableVouchers(): Collection
    {
        return $this->model
            ->where('is_active', true)
            ->where('valid_from', '<=', now())
            ->where('valid_until', '>=', now())
            ->whereColumn('used_count', '<', 'max_usage')
            ->orderBy('valid_until')
            ->get();
    }

    public function validateVoucher(string $code, float $orderAmount): array
    {
        $voucher = $this->findByCode($code);

        if (!$voucher) {
            return ['valid' => false, 'message' => 'Kode voucher tidak ditemukan.'];
        }

        if (!$voucher->is_active) {
            return ['valid' => false, 'message' => 'Voucher sudah tidak aktif.'];
        }

        if (now()->lt($voucher->valid_from)) {
            return ['valid' => false, 'message' => 'Voucher belum bisa digunakan.'];
        }

        if (now()->gt($voucher->valid_until)) {
            return ['valid' => false, 'message' => 'Voucher sudah kedaluwarsa.'];
        }

        if ($voucher->used_count >= $voucher->max_usage) {
            return ['valid' => false, 'message' => 'Voucher sudah habis digunakan.'];
        }

        if ($orderAmount < $voucher->min_order_amount) {
            return [
                'valid' => false,
                'message' => "Minimum pemesanan Rp " . number_format($voucher->min_order_amount, 0, ',', '.'),
            ];
        }

        $discountType = DiscountType::from($voucher->discount_type);
        $discount = $discountType->calculate($orderAmount, $voucher->discount_value);

        if ($voucher->max_discount_amount && $discount > $voucher->max_discount_amount) {
            $discount = $voucher->max_discount_amount;
        }

        return [
            'valid' => true,
            'voucher' => $voucher,
            'discount' => $discount,
            'message' => 'Voucher berhasil diterapkan.',
        ];
    }
}
