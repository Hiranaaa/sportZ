<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppNotification extends Model
{
    use HasUuids;
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'notifications';

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'data',
        'read_at',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'data' => 'json',
            'read_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $notification) {
            $data = $notification->data;
            if (is_string($data)) {
                $data = json_decode($data, true);
            }

            if (is_array($data)) {
                if (empty($notification->title)) {
                    $type = $data['type'] ?? '';
                    $notification->title = match ($type) {
                        'welcome' => 'Selamat Datang',
                        'booking_confirmed' => 'Booking Dikonfirmasi',
                        'booking_cancelled' => 'Booking Dibatalkan',
                        'booking_reminder' => 'Pengingat Jadwal',
                        'payment_received' => 'Pembayaran Diterima',
                        default => ucwords(str_replace('_', ' ', (string) $type ?: 'Notifikasi')),
                    };
                }

                if (empty($notification->message)) {
                    $notification->message = $data['message'] ?? '';
                }
            }

            // Fallback just in case
            if (empty($notification->title)) {
                $notification->title = 'Notifikasi Baru';
            }
            if (empty($notification->message)) {
                $notification->message = 'Anda menerima notifikasi baru.';
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeUnread(Builder $query): Builder
    {
        return $query->whereNull('read_at');
    }

    public function scopeRead(Builder $query): Builder
    {
        return $query->whereNotNull('read_at');
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    public function markAsRead(): void
    {
        if ($this->read_at === null) {
            $this->update(['read_at' => now()]);
        }
    }

    public function isRead(): bool
    {
        return $this->read_at !== null;
    }
}
