<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\User;
use App\Notifications\WelcomeNotification;

class UserObserver
{
    public function created(User $user): void
    {
        $user->notify(new WelcomeNotification($user));
    }
}
