<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\CourtDTO;
use App\Enums\CourtStatus;
use App\Models\Court;
use App\Models\CourtImage;
use App\Repositories\Contracts\CourtRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class CourtService
{
    public function __construct(
        private readonly CourtRepositoryInterface $courtRepository,
        private readonly SupabaseStorageService $storageService,
    ) {}

    public function createCourt(CourtDTO $dto): Court
    {
        $data = $dto->toArray();
        $data['slug'] = Str::slug($dto->name);

        /** @var Court $court */
        $court = $this->courtRepository->create($data);

        if (!empty($dto->facilityIds)) {
            $court->facilities()->sync($dto->facilityIds);
        }

        return $court->load(['sport', 'facilities', 'images']);
    }

    public function updateCourt(string $id, CourtDTO $dto): Court
    {
        $data = $dto->toArray();
        $data['slug'] = Str::slug($dto->name);

        /** @var Court $court */
        $court = $this->courtRepository->update($id, $data);

        if (!empty($dto->facilityIds)) {
            $court->facilities()->sync($dto->facilityIds);
        }

        return $court->load(['sport', 'facilities', 'images']);
    }

    public function deleteCourt(string $id): bool
    {
        /** @var Court $court */
        $court = $this->courtRepository->findOrFail($id);

        // Delete images from Supabase Storage
        foreach ($court->images as $image) {
            $this->storageService->delete(
                config('supabase.storage.bucket'),
                $image->image_path
            );
        }

        return $this->courtRepository->delete($id);
    }

 public function uploadImage(string $courtId, UploadedFile $file): CourtImage
{
    $court = $this->courtRepository->findOrFail($courtId);

    // Jadikan semua gambar lama bukan primary
    $court->images()->update([
        'is_primary' => false,
    ]);

    $path = "courts/{$courtId}/" . Str::uuid() . '.' . $file->getClientOriginalExtension();

    $publicUrl = $this->storageService->upload(
        config('supabase.storage.bucket'),
        $path,
        $file
    );

    return $court->images()->create([
        'image_path' => $path,
        'image_url' => $publicUrl,
        'is_primary' => true,
        'sort_order' => 0,
    ]);
}
    public function toggleMaintenance(string $courtId): Court
    {
        /** @var Court $court */
        $court = $this->courtRepository->findOrFail($courtId);

        $newStatus = $court->status === CourtStatus::Maintenance
            ? CourtStatus::Active
            : CourtStatus::Maintenance;

        /** @var Court */
        return $this->courtRepository->update($courtId, [
            'status' => $newStatus,
        ]);
    }

    public function getPopularCourts(int $limit = 6): Collection
    {
        return Court::where('status', CourtStatus::Active)
            ->withCount('bookings')
            ->with(['sport', 'images'])
            ->orderByDesc('bookings_count')
            ->limit($limit)
            ->get();
    }
}
