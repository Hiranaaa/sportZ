<?php
declare(strict_types=1);
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBannerRequest;
use App\Models\Banner;
use App\Services\SupabaseStorageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BannerController extends Controller
{
    public function __construct(protected SupabaseStorageService $storage) {}

    public function index(): View
    {
        $banners = Banner::orderBy('sort_order')->paginate(15);
        return view('admin.banners.index', compact('banners'));
    }

    public function store(StoreBannerRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $url = $this->storage->upload('banners', 'banners/' . uniqid() . '.' . $request->file('image')->extension(), $request->file('image'));
            $data['image_path'] = $url;
            $data['image_url'] = $url;
        }
        Banner::create($data);
        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil ditambahkan.');
    }

    public function update(StoreBannerRequest $request, string $id): RedirectResponse
    {
        $banner = Banner::findOrFail($id);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $url = $this->storage->upload('banners', 'banners/' . uniqid() . '.' . $request->file('image')->extension(), $request->file('image'));
            $data['image_path'] = $url;
            $data['image_url'] = $url;
        }
        $banner->update($data);
        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil diperbarui.');
    }

    public function destroy(string $id): RedirectResponse
    {
        Banner::findOrFail($id)->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil dihapus.');
    }
}
