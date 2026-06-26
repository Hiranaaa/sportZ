<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\CourtStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Court extends Model
{
    use HasUuids;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'sport_id',
        'name',
        'slug',
        'court_number',
        'price_per_hour',
        'description',
        'status',
        'width',
        'length',
        'capacity',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price_per_hour' => 'decimal:2',
            'width' => 'decimal:2',
            'length' => 'decimal:2',
            'capacity' => 'integer',
            'status' => CourtStatus::class,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class);
    }

   public function images()
{
    return $this->hasMany(CourtImage::class)
        ->orderByDesc('is_primary')
        ->orderByDesc('created_at');
}

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function bookingSlots(): HasMany
    {
        return $this->hasMany(BookingSlot::class);
    }

    public function operatingHours(): HasMany
    {
        return $this->hasMany(OperatingHour::class)->orderBy('day_of_week');
    }

    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class, 'court_facilities')
            ->using(CourtFacility::class)
            ->withTimestamps();
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', CourtStatus::Active);
    }

    public function scopeByStatus(Builder $query, CourtStatus $status): Builder
    {
        return $query->where('status', $status);
    }

    public function scopeBySport(Builder $query, string $sportId): Builder
    {
        return $query->where('sport_id', $sportId);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getAverageRatingAttribute(): float
    {
        return (float) $this->reviews()->avg('rating') ?: 0.0;
    }

    public function getTotalReviewsAttribute(): int
    {
        return (int) $this->reviews()->count();
    }

    public function getPrimaryImageAttribute(): ?CourtImage
    {
        return $this->images()->where('is_primary', true)->first()
            ?? $this->images()->first();
    }

    public function getImageUrlAttribute(): ?string
{
    $primary = $this->primaryImage;

    return $primary?->image_url;
}
    public function getSportTypeAttribute(): string
    {
        return strtolower($this->sport->name ?? 'sport');
    }

    public function getLocationAttribute(): string
    {
        return $this->description ? \Illuminate\Support\Str::limit($this->description, 40) : 'Jakarta Selatan';
    }
}
