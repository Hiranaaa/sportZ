@extends('layouts.admin')
@section('title', 'Manajemen Voucher - SportZ')
@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Manajemen Voucher</h1>
        <button onclick="document.getElementById('voucherModal').classList.remove('hidden')" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-semibold rounded-xl hover:shadow-lg transition-all"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg> Tambah Voucher</button>
    </div>
    <div class="bg-white dark:bg-gray-800/50 rounded-2xl border border-gray-100 dark:border-gray-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full"><thead class="bg-gray-50 dark:bg-gray-900/50"><tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kode</th><th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Promo</th><th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Diskon</th><th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Penggunaan</th><th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Berlaku</th><th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th><th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
            </tr></thead><tbody class="divide-y divide-gray-100 dark:divide-gray-700/50">
                @forelse($vouchers as $voucher)
                <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/80">
                    <td class="px-6 py-4 font-mono font-bold text-cyan-600 dark:text-cyan-400 text-sm">{{ $voucher->code }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $voucher->promotion->title ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm font-semibold">{{ $voucher->discount_type === 'percentage' ? $voucher->discount_value . '%' : 'Rp ' . number_format($voucher->discount_value, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $voucher->used_count }}/{{ $voucher->max_uses ?? '∞' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ \Carbon\Carbon::parse($voucher->end_date)->format('d M Y') }}</td>
                    <td class="px-6 py-4">@if($voucher->is_active)<span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Aktif</span>@else<span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">Nonaktif</span>@endif</td>
                    <td class="px-6 py-4"><form action="{{ route('admin.vouchers.destroy', $voucher->id) }}" method="POST" onsubmit="return confirm('Hapus voucher?')">@csrf @method('DELETE')<button class="text-red-500 hover:text-red-700 text-sm">Hapus</button></form></td>
                </tr>
                @empty<tr><td colspan="7" class="px-6 py-8 text-center text-gray-500">Belum ada voucher.</td></tr>@endforelse
            </tbody></table>
        </div>
    </div>
    {{ $vouchers->links() }}
</div>
{{-- Create Modal --}}
<div id="voucherModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 w-full max-w-lg mx-4 shadow-2xl">
        <div class="flex items-center justify-between mb-6"><h3 class="font-heading text-xl font-bold text-gray-900 dark:text-white">Tambah Voucher</h3><button onclick="document.getElementById('voucherModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button></div>
        <form action="{{ route('admin.vouchers.store') }}" method="POST" class="space-y-4">@csrf
            <div class="grid grid-cols-2 gap-4">
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kode Voucher *</label><input type="text" name="code" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500" placeholder="SPORTZ50"></div>
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Promo</label><select name="promotion_id" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500"><option value="">Tanpa Promo</option>@foreach($promotions as $p)<option value="{{ $p->id }}">{{ $p->title }}</option>@endforeach</select></div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipe Diskon *</label><select name="discount_type" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-cyan-500"><option value="percentage">Persentase</option><option value="fixed">Nominal</option></select></div>
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nilai Diskon *</label><input type="number" name="discount_value" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-cyan-500"></div>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Min. Order</label><input type="number" name="min_order" value="0" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-cyan-500"></div>
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Max Diskon</label><input type="number" name="max_discount" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-cyan-500"></div>
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Max Penggunaan</label><input type="number" name="max_uses" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-cyan-500"></div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Mulai</label><input type="date" name="start_date" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-cyan-500"></div>
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Berakhir</label><input type="date" name="end_date" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-cyan-500"></div>
            </div>
            <button type="submit" class="w-full py-3 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-semibold rounded-xl hover:shadow-lg transition-all">Simpan</button>
        </form>
    </div>
</div>
@endsection
