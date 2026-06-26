<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function index(): View
    {
        $reviews = Review::with(['user', 'court.sport', 'booking'])->latest()->paginate(15);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function reply(Request $request, string $id): RedirectResponse
    {
        $request->validate(['admin_reply' => 'required|string|max:1000']);
        $review = Review::findOrFail($id);
        $review->update(['admin_reply' => $request->admin_reply, 'replied_at' => now()]);
        return back()->with('success', 'Balasan berhasil dikirim.');
    }
}
