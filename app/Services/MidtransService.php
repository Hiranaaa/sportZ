<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\PaymentException;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function createSnapTransaction(array $params): string
    {
        try {
            $snapToken = Snap::getSnapToken($params);

            return $snapToken;
        } catch (\Exception $e) {
            throw new PaymentException(
                'Gagal membuat transaksi Midtrans: ' . $e->getMessage()
            );
        }
    }

    public function getTransactionStatus(string $orderId): object
    {
        try {
            return Transaction::status($orderId);
        } catch (\Exception $e) {
            throw new PaymentException(
                'Gagal mengambil status transaksi: ' . $e->getMessage()
            );
        }
    }
}
