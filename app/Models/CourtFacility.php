<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CourtFacility extends Pivot
{
    use HasUuids;

    protected $table = 'court_facilities';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'court_id',
        'facility_id',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function court(): BelongsTo
    {
        return $this->belongsTo(Court::class);
    }

    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }
}
