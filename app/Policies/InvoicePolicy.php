<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Invoice;
use App\Models\User;

class InvoicePolicy
{
    public function download(User $user, Invoice $invoice): bool
    {
        return $user->isAdmin()
            || $invoice->booking?->user_id === $user->id;
    }
}
