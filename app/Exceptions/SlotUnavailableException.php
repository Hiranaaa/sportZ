<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class SlotUnavailableException extends Exception
{
    public function __construct(string $message = 'Slot waktu yang dipilih sudah tidak tersedia.')
    {
        parent::__construct($message);
    }
}
