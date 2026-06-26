<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVoucherRequest;
use App\Models\Voucher;
use App\Models\Promotion;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VoucherController extends Controller
{
    public function index(): View
    {
        $vouchers = Voucher::with('promotion')->latest()->paginate(15);
        $promotions = Promotion::where('is_active', true)->get();
        return view('admin.vouchers.index', compact('vouchers', 'promotions'));
    }

    public function store(StoreVoucherRequest $request): RedirectResponse
    {
        Voucher::create($request->validated());
        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil ditambahkan.');
    }

    public function update(StoreVoucherRequest $request, string $id): RedirectResponse
    {
        Voucher::findOrFail($id)->update($request->validated());
        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil diperbarui.');
    }

    public function destroy(string $id): RedirectResponse
    {
        Voucher::findOrFail($id)->delete();
        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil dihapus.');
    }
}
