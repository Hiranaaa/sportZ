<?php

declare(strict_types=1);

namespace App\Observers;

use App\Enums\PaymentStatus;
use App\Events\PaymentReceived;
use App\Models\Payment;

class PaymentObserver
{
    public function updated(Payment $payment): void
    {
        if (
            $payment->wasChanged('status')
            && $payment->status === PaymentStatus::Paid
        ) {
            event(new PaymentReceived($payment));
        }
    }
}
