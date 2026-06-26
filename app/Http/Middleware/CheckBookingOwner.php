<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Booking;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBookingOwner
{
    public function handle(Request $request, Closure $next): Response
    {
        $bookingId = $request->route('id') ?? $request->route('booking');
        $user = $request->user();

        if (!$user) {
            abort(403, 'Akses ditolak.');
        }

        if ($user->isAdmin()) {
            return $next($request);
        }

        $booking = Booking::find($bookingId);

        if (!$booking || $booking->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke booking ini.');
        }

        return $next($request);
    }
}
