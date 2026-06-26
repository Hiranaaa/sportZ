@extends('layouts.admin')
@section('title', 'Manajemen Promo - SportZ')
@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Manajemen Promo</h1>
        <button onclick="document.getElementById('promoModal').classList.remove('hidden')" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-cyan-500/25 transition-all"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg> Tambah Promo</button>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($promotions as $promo)
        <div class="bg-white dark:bg-gray-800/50 rounded-2xl border border-gray-100 dark:border-gray-700/50 overflow-hidden hover:shadow-lg transition-all">
            <div class="h-32 bg-gradient-to-br {{ $promo->type === 'discount' ? 'from-cyan-500 to-blue-600' : ($promo->type === 'cashback' ? 'from-green-500 to-emerald-600' : 'from-purple-500 to-violet-600') }} flex items-center justify-center"><span class="text-white text-4xl font-bold">{{ $promo->type === 'discount' ? '🏷️' : ($promo->type === 'cashback' ? '💰' : '🎉') }}</span></div>
            <div class="p-5">
                <div class="flex items-center gap-2 mb-2"><span class="px-2 py-0.5 bg-gray-100 dark:bg-gray-700 text-xs font-semibold rounded-full text-gray-600 dark:text-gray-300">{{ ucfirst($promo->type) }}</span>@if($promo->is_active)<span class="px-2 py-0.5 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Aktif</span>@else<span class="px-2 py-0.5 bg-red-100 text-red-700 text-xs font-semibold rounded-full">Nonaktif</span>@endif</div>
                <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-1">{{ $promo->title }}</h3>
                <p class="text-sm text-gray-500 mb-3">{{ Str::limit($promo->description, 80) }}</p>
                <div class="flex items-center justify-between text-xs text-gray-400">
                    <span>{{ \Carbon\Carbon::parse($promo->start_date)->format('d M') }} - {{ \Carbon\Carbon::parse($promo->end_date)->format('d M Y') }}</span>
                    <span>{{ $promo->vouchers_count ?? 0 }} voucher</span>
                </div>
                <div class="flex gap-2 mt-4">
                    <form action="{{ route('admin.promotions.destroy', $promo->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus promo ini?')">@csrf @method('DELETE')<button class="w-full py-2 text-sm text-red-500 bg-red-50 dark:bg-red-900/20 rounded-lg hover:bg-red-100 transition-colors">Hapus</button></form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full"><x-empty-state title="Belum ada promo" description="Buat promo pertama untuk menarik pelanggan" /></div>
        @endforelse
    </div>
    {{ $promotions->links() }}
</div>

{{-- Create Modal --}}
<div id="promoModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 w-full max-w-lg mx-4 shadow-2xl">
        <div class="flex items-center justify-between mb-6"><h3 class="font-heading text-xl font-bold text-gray-900 dark:text-white">Tambah Promo</h3><button onclick="document.getElementById('promoModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button></div>
        <form action="{{ route('admin.promotions.store') }}" method="POST" class="space-y-4">@csrf
            <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Judul *</label><input type="text" name="title" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500"></div>
            <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipe *</label><select name="type" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500"><option value="discount">Discount</option><option value="cashback">Cashback</option><option value="event">Event</option></select></div>
            <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label><textarea name="description" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500 resize-none"></textarea></div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Mulai</label><input type="date" name="start_date" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500"></div>
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Berakhir</label><input type="date" name="end_date" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500"></div>
            </div>
            <label class="flex items-center gap-2"><input type="checkbox" name="is_active" value="1" checked class="rounded border-gray-300 text-cyan-500 focus:ring-cyan-500"><span class="text-sm text-gray-700 dark:text-gray-300">Aktif</span></label>
            <button type="submit" class="w-full py-3 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-semibold rounded-xl hover:shadow-lg transition-all">Simpan</button>
        </form>
    </div>
</div>
@endsection
