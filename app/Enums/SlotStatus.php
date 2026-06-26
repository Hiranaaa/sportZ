<?php

declare(strict_types=1);

namespace App\Enums;

enum SlotStatus: string
{
    case AVAILABLE = 'available';
    case BOOKED = 'booked';
    case PENDING = 'pending';
    case MAINTENANCE = 'maintenance';

    public function label(): string
    {
        return match ($this) {
            self::AVAILABLE => 'Tersedia',
            self::BOOKED => 'Sudah Dipesan',
            self::PENDING => 'Menunggu',
            self::MAINTENANCE => 'Dalam Perawatan',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::AVAILABLE => 'green',
            self::BOOKED => 'red',
            self::PENDING => 'yellow',
            self::MAINTENANCE => 'gray',
        };
    }
}
