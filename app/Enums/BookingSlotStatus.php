<?php

declare(strict_types=1);

namespace App\Enums;

enum BookingSlotStatus: string
{
    case Available = 'available';
    case Booked = 'booked';
    case Pending = 'pending';
    case Maintenance = 'maintenance';

    public function label(): string
    {
        return match ($this) {
            self::Available => 'Available',
            self::Booked => 'Booked',
            self::Pending => 'Pending',
            self::Maintenance => 'Maintenance',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Available => 'green',
            self::Booked => 'red',
            self::Pending => 'yellow',
            self::Maintenance => 'gray',
        };
    }
}
