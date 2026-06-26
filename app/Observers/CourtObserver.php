<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Court;
use Illuminate\Support\Str;

class CourtObserver
{
    public function creating(Court $court): void
    {
        if (empty($court->slug)) {
            $court->slug = Str::slug($court->name);
        }
    }
}
