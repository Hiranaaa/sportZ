<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Enums\CourtStatus;
use App\Models\Court;
use App\Repositories\Contracts\CourtRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CourtRepository extends BaseRepository implements CourtRepositoryInterface
{
    public function __construct(Court $model)
    {
        parent::__construct($model);
    }

    public function getActiveCourts(): Collection
    {
        return $this->model
            ->where('status', CourtStatus::Active)
            ->with(['sport', 'images'])
            ->latest()
            ->get();
    }

    public function getByType(string $sportId): Collection
    {
        return $this->model
            ->where('sport_id', $sportId)
            ->where('status', CourtStatus::Active)
            ->with(['sport', 'images'])
            ->get();
    }

    public function searchCourts(string $query, array $filters = []): LengthAwarePaginator
    {
        $builder = $this->model
            ->with(['sport', 'images', 'reviews'])
            ->where('status', CourtStatus::Active);

        if (!empty($query)) {
            $builder->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhereHas('sport', function ($q2) use ($query) {
                      $q2->where('name', 'like', "%{$query}%");
                  });
            });
        }

        if (!empty($filters['sport_id'])) {
            $builder->where('sport_id', $filters['sport_id']);
        }

        if (!empty($filters['min_price'])) {
            $builder->where('price_per_hour', '>=', $filters['min_price']);
        }

        if (!empty($filters['max_price'])) {
            $builder->where('price_per_hour', '<=', $filters['max_price']);
        }

        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortOrder = $filters['sort_order'] ?? 'desc';
        $builder->orderBy($sortBy, $sortOrder);

        $perPage = (int) ($filters['per_page'] ?? config('sportz.items_per_page', 15));

        return $builder->paginate($perPage);
    }
}
