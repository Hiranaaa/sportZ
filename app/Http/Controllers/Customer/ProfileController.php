<?php
declare(strict_types=1);
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\UpdateProfileRequest;
use App\Services\SupabaseStorageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(protected SupabaseStorageService $storage) {}

    public function edit(): View
    {
        $user = Auth::user();
        return view('customer.profile.edit', compact('user'));
    }

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $url = $this->storage->upload('avatars', 'avatars/' . $user->id . '.' . $request->file('avatar')->extension(), $request->file('avatar'));
            $data['avatar'] = $url;
        }

        $user->update($data);
        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
