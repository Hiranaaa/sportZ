<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Review;
use App\Repositories\Contracts\ReviewRepositoryInterface;

class ReviewService
{
    public function __construct(
        private readonly ReviewRepositoryInterface $reviewRepository,
    ) {}

    public function createReview(array $data): Review
    {
        /** @var Review */
        return $this->reviewRepository->create($data);
    }

    public function adminReply(string $reviewId, string $reply): Review
    {
        /** @var Review */
        return $this->reviewRepository->update($reviewId, [
            'admin_reply' => $reply,
            'replied_at' => now(),
        ]);
    }
}
