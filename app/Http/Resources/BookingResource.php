<?php
declare(strict_types=1);
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id, 'booking_code' => $this->booking_code,
            'booking_date' => $this->booking_date, 'start_time' => $this->start_time,
            'end_time' => $this->end_time, 'duration_hours' => $this->duration_hours,
            'subtotal' => $this->subtotal, 'discount' => $this->discount,
            'total_amount' => $this->total_amount, 'status' => $this->status,
            'is_checked_in' => $this->is_checked_in,
            'court' => new CourtResource($this->whenLoaded('court')),
            'payment' => new PaymentResource($this->whenLoaded('payment')),
        ];
    }
}
