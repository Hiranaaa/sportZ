<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\BookingSlotStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingSlot extends Model
{
    use HasUuids;
    use HasFactory;

    protected $fillable = [
        'court_id',
        'slot_date',
        'start_time',
        'end_time',
        'status',
        'booking_id',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'slot_date' => 'date',
            'status' => BookingSlotStatus::class,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function court(): BelongsTo
    {
        return $this->belongsTo(Court::class);
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('status', BookingSlotStatus::Available);
    }

    public function scopeByDate(Builder $query, string $date): Builder
    {
        return $query->where('slot_date', $date);
    }

    public function scopeByStatus(Builder $query, BookingSlotStatus $status): Builder
    {
        return $query->where('status', $status);
    }
}
