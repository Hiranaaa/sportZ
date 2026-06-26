<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () { $this->comment(Inspiring::quote()); })->purpose('Display an inspiring quote');

// Expire pending bookings after 60 minutes
Schedule::command('bookings:expire-pending')->everyFiveMinutes()->withoutOverlapping();

// Send booking reminders 1 hour before
Schedule::command('bookings:send-reminders')->everyFifteenMinutes()->withoutOverlapping();

// Generate daily booking slots for next 7 days
Schedule::command('slots:generate')->dailyAt('00:01')->withoutOverlapping();

// Clean up expired sessions
Schedule::command('session:gc')->daily();

// Database backup via Supabase (log reminder)
Schedule::command('backup:notify')->weeklyOn(1, '02:00');
