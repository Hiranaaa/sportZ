<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\BookingStatus;
use App\Models\Review;
use App\Models\User;

class ReviewPolicy
{
    public function create(User $user): bool
    {
        if (!$user->isCustomer()) {
            return false;
        }

        return $user->bookings()
            ->where('status', BookingStatus::Completed)
            ->exists();
    }

    public function reply(User $user, Review $review): bool
    {
        return $user->isAdmin();
    }
}
