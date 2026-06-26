<?php
declare(strict_types=1);
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingSlotResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'court_id' => $this->court_id,
            'slot_date' => $this->slot_date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'status' => $this->status,
            'color' => match($this->status) {
                'available' => '#10b981',
                'booked' => '#ef4444',
                'pending' => '#f59e0b',
                'maintenance' => '#6b7280',
                default => '#6b7280',
            },
        ];
    }
}
