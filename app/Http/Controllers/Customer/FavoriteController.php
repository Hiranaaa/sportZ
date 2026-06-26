<?php
declare(strict_types=1);
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FavoriteController extends Controller
{
    public function index(): View
    {
        $favorites = Favorite::where('user_id', Auth::id())->with(['court.sport', 'court.images', 'court.reviews'])->latest()->paginate(12);
        return view('customer.favorites.index', compact('favorites'));
    }

    public function toggle(string $courtId): RedirectResponse
    {
        $existing = Favorite::where('user_id', Auth::id())->where('court_id', $courtId)->first();
        if ($existing) {
            $existing->delete();
            return back()->with('success', 'Lapangan dihapus dari favorit.');
        }
        Favorite::create(['user_id' => Auth::id(), 'court_id' => $courtId]);
        return back()->with('success', 'Lapangan ditambahkan ke favorit.');
    }
}
