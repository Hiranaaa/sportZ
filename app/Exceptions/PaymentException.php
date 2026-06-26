<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class PaymentException extends Exception
{
    public static function invalidSignature(): self
    {
        return new self('Tanda tangan pembayaran tidak valid.');
    }

    public static function notFound(string $orderId): self
    {
        return new self("Pembayaran tidak ditemukan untuk order: {$orderId}");
    }

    public static function alreadyPaid(): self
    {
        return new self('Pembayaran sudah diproses sebelumnya.');
    }
}
