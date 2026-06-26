<?php

declare(strict_types=1);

namespace App\DTOs;

use Illuminate\Http\Request;

final readonly class CourtDTO
{
    public function __construct(
        public string $sportId,
        public string $name,
        public ?string $courtNumber,
        public float $pricePerHour,
        public ?string $description = null,
        public string $status = 'active',
        public ?float $width = null,
        public ?float $length = null,
        public ?int $capacity = null,
        public array $facilityIds = [],
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            sportId: $request->input('sport_id'),
            name: $request->input('name'),
            courtNumber: $request->input('court_number'),
            pricePerHour: (float) $request->input('price_per_hour'),
            description: $request->input('description'),
            status: $request->input('status', 'active'),
            width: $request->filled('width') ? (float) $request->input('width') : null,
            length: $request->filled('length') ? (float) $request->input('length') : null,
            capacity: $request->filled('capacity') ? (int) $request->input('capacity') : null,
            facilityIds: $request->input('facility_ids', []),
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'sport_id' => $this->sportId,
            'name' => $this->name,
            'court_number' => $this->courtNumber,
            'price_per_hour' => $this->pricePerHour,
            'description' => $this->description,
            'status' => $this->status,
            'width' => $this->width,
            'length' => $this->length,
            'capacity' => $this->capacity,
        ], fn ($value) => $value !== null);
    }
}
