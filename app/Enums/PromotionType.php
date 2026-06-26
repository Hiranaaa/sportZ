<?php

declare(strict_types=1);

namespace App\Enums;

enum PromotionType: string
{
    case Discount = 'discount';
    case Cashback = 'cashback';
    case Event = 'event';

    public function label(): string
    {
        return match ($this) {
            self::Discount => 'Discount',
            self::Cashback => 'Cashback',
            self::Event => 'Event',
        };
    }
}
