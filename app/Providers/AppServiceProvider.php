<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Booking;
use App\Models\Court;
use App\Models\Payment;
use App\Observers\BookingObserver;
use App\Observers\CourtObserver;
use App\Observers\PaymentObserver;
use App\Observers\UserObserver;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Register Model Observers
        Booking::observe(BookingObserver::class);
        Court::observe(CourtObserver::class);
        Payment::observe(PaymentObserver::class);
        User::observe(UserObserver::class);

        // Super Admin Gate
        Gate::before(function (User $user, string $ability) {
            if ($user->isAdmin()) {
                return true;
            }
            return null;
        });
    }
}
