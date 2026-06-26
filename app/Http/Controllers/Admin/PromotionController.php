<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePromotionRequest;
use App\Models\Promotion;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PromotionController extends Controller
{
    public function index(): View
    {
        $promotions = Promotion::withCount('vouchers')->latest()->paginate(15);
        return view('admin.promotions.index', compact('promotions'));
    }

    public function store(StorePromotionRequest $request): RedirectResponse
    {
        Promotion::create($request->validated());
        return redirect()->route('admin.promotions.index')->with('success', 'Promo berhasil ditambahkan.');
    }

    public function update(StorePromotionRequest $request, string $id): RedirectResponse
    {
        Promotion::findOrFail($id)->update($request->validated());
        return redirect()->route('admin.promotions.index')->with('success', 'Promo berhasil diperbarui.');
    }

    public function destroy(string $id): RedirectResponse
    {
        Promotion::findOrFail($id)->delete();
        return redirect()->route('admin.promotions.index')->with('success', 'Promo berhasil dihapus.');
    }
}
