<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\Sport;
use App\Models\Facility;
use App\Models\Banner;
use App\Models\Faq;
use App\Models\Testimonial;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    public function index(): View
    {
        $courts = Court::query()
            ->where('status', 'active')
            ->with(['sport', 'images', 'reviews', 'facilities'])
            ->withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->take(6)
            ->get();

        $sports = Sport::where('is_active', true)->get();
        $facilities = Facility::all();
        $banners = Banner::where('is_active', true)->orderBy('sort_order')->get();
        $faqs = Faq::where('is_active', true)->orderBy('sort_order')->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('sort_order')->get();

        return view('landing.index', compact(
            'courts', 'sports', 'facilities', 'banners', 'faqs', 'testimonials'
        ));
    }
}
