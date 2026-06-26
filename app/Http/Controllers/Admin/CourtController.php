<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCourtRequest;
use App\Http\Requests\Admin\UpdateCourtRequest;
use App\Services\CourtService;
use App\DTOs\CourtDTO;
use App\Models\Court;
use App\Models\Sport;
use App\Models\Facility;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourtController extends Controller
{
    public function __construct(
        protected CourtService $courtService
    ) {}

    public function index(Request $request): View
    {
$query = Court::with([
    'sport',
    'facilities',
    'images' => function ($q) {
        $q->orderBy('is_primary', 'desc')
          ->orderBy('created_at', 'desc');
    }
])->withTrashed();
        if ($request->filled('sport_id')) {
            $query->where('sport_id', $request->sport_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $courts = $query->latest()->paginate(12);
        $sports = Sport::where('is_active', true)->get();

        return view('admin.courts.index', compact('courts', 'sports'));
    }

    public function create(): View
    {
        $sports = Sport::where('is_active', true)->get();
        $facilities = Facility::all();
        return view('admin.courts.create', compact('sports', 'facilities'));
    }

    public function store(StoreCourtRequest $request): RedirectResponse
    {
        $dto = CourtDTO::fromRequest($request);
        $court = $this->courtService->createCourt($dto);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $this->courtService->uploadImage($court->id, $image);
            }
        }

        return redirect()->route('admin.courts.index')
            ->with('success', 'Lapangan berhasil ditambahkan.');
    }

    public function show(string $id): View
    {
        $court = Court::with(['sport', 'images', 'facilities', 'operatingHours', 'reviews.user'])->findOrFail($id);
        return view('admin.courts.show', compact('court'));
    }

    public function edit(string $id): View
    {
        $court = Court::with(['facilities', 'images', 'operatingHours'])->findOrFail($id);
        $sports = Sport::where('is_active', true)->get();
        $facilities = Facility::all();
        return view('admin.courts.edit', compact('court', 'sports', 'facilities'));
    }
public function update(UpdateCourtRequest $request, string $id): RedirectResponse
{
    $dto = CourtDTO::fromRequest($request);

    $court = $this->courtService->updateCourt($id, $dto);

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $this->courtService->uploadImage($court->id, $image);
        }
    }

    return redirect()->route('admin.courts.index')
        ->with('success', 'Lapangan berhasil diperbarui.');
}   public function destroy(string $id): RedirectResponse
    {
        $this->courtService->deleteCourt($id);

        return redirect()->route('admin.courts.index')
            ->with('success', 'Lapangan berhasil dihapus.');
    }

    public function toggleMaintenance(string $id): RedirectResponse
    {
        $this->courtService->toggleMaintenance($id);

        return back()->with('success', 'Status lapangan berhasil diperbarui.');
    }
}
