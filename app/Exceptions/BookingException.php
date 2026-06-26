<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class BookingException extends Exception
{
    public static function slotUnavailable(): self
    {
        return new self('Slot waktu yang dipilih sudah tidak tersedia.');
    }

    public static function cannotCancel(): self
    {
        return new self('Booking tidak dapat dibatalkan.');
    }

    public static function alreadyCheckedIn(): self
    {
        return new self('Booking sudah di check-in sebelumnya.');
    }

    public static function expired(): self
    {
        return new self('Booking sudah kedaluwarsa.');
    }
}
