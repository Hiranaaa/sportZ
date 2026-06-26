<?php
declare(strict_types=1);
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourtResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id, 'name' => $this->name, 'slug' => $this->slug,
            'court_number' => $this->court_number, 'price_per_hour' => $this->price_per_hour,
            'description' => $this->description, 'status' => $this->status,
            'sport' => $this->whenLoaded('sport', fn () => ['id' => $this->sport->id, 'name' => $this->sport->name]),
            'images' => $this->whenLoaded('images'), 'facilities' => $this->whenLoaded('facilities'),
            'avg_rating' => $this->reviews_avg_rating, 'reviews_count' => $this->reviews_count,
        ];
    }
}
