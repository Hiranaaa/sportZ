<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Review;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    public function __construct(Review $model)
    {
        parent::__construct($model);
    }

    public function getByCourtId(string $courtId): Collection
    {
        return $this->model
            ->whereHas('booking', function ($query) use ($courtId) {
                $query->where('court_id', $courtId);
            })
            ->with(['user', 'booking.court'])
            ->latest()
            ->get();
    }

    public function getAverageRating(string $courtId): float
    {
        return (float) $this->model
            ->whereHas('booking', function ($query) use ($courtId) {
                $query->where('court_id', $courtId);
            })
            ->avg('rating') ?? 0.0;
    }
}
