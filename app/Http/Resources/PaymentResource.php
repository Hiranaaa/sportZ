<?php
declare(strict_types=1);
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id, 'payment_method' => $this->payment_method,
            'transaction_id' => $this->transaction_id, 'amount' => $this->amount,
            'status' => $this->status, 'paid_at' => $this->paid_at,
        ];
    }
}
