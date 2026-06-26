<?php

declare(strict_types=1);

namespace App\Enums;

enum CourtStatus: string
{
    case Active = 'active';
    case Maintenance = 'maintenance';
    case Inactive = 'inactive';

    public function label(): string
    {
        return match ($this) {
            self::Active => 'Active',
            self::Maintenance => 'Maintenance',
            self::Inactive => 'Inactive',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Active => 'green',
            self::Maintenance => 'yellow',
            self::Inactive => 'red',
        };
    }
}
