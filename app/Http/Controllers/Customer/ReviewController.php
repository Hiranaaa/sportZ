<?php
declare(strict_types=1);
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreReviewRequest;
use App\Services\ReviewService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct(protected ReviewService $reviewService) {}

    public function store(StoreReviewRequest $request): RedirectResponse
    {
        $data = array_merge($request->validated(), ['user_id' => Auth::id()]);
        $this->reviewService->createReview($data);
        return back()->with('success', 'Review berhasil dikirim. Terima kasih!');
    }
}
