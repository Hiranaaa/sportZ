<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\CourtFacility;

class Facility extends Model
{
    use HasUuids;
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'description',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function courts(): BelongsToMany
    {
        return $this->belongsToMany(Court::class, 'court_facilities')
            ->using(CourtFacility::class)
            ->withTimestamps();
    }
}
