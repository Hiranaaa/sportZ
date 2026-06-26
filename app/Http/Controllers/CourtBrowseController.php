<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\Sport;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourtBrowseController extends Controller
{
    public function index(Request $request): View
    {
        $query = Court::where('status', 'active')->with(['sport', 'images', 'facilities'])->withAvg('reviews', 'rating')->withCount('reviews');

        if ($request->filled('sport_id')) { $query->where('sport_id', $request->sport_id); }
        if ($request->filled('min_price')) { $query->where('price_per_hour', '>=', $request->min_price); }
        if ($request->filled('max_price')) { $query->where('price_per_hour', '<=', $request->max_price); }
        if ($request->filled('search')) { $query->where('name', 'like', '%' . $request->search . '%'); }
        if ($request->filled('sort')) {
            match ($request->sort) {
                'price_asc' => $query->orderBy('price_per_hour'),
                'price_desc' => $query->orderByDesc('price_per_hour'),
                'rating' => $query->orderByDesc('reviews_avg_rating'),
                default => $query->latest(),
            };
        } else { $query->latest(); }

        $courts = $query->paginate(12);
        $sports = Sport::where('is_active', true)->get();
        $facilities = Facility::all();

        return view('customer.courts.index', compact('courts', 'sports', 'facilities'));
    }

    public function show(string $slug): View
    {
        $court = Court::where('slug', $slug)->with(['sport', 'images', 'facilities', 'operatingHours', 'reviews.user'])->withAvg('reviews', 'rating')->withCount('reviews')->firstOrFail();
        $similarCourts = Court::where('sport_id', $court->sport_id)->where('id', '!=', $court->id)->where('status', 'active')->with(['images', 'sport'])->withAvg('reviews', 'rating')->take(3)->get();
        return view('customer.courts.show', compact('court', 'similarCourts'));
    }
}
