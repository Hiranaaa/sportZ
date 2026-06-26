@extends('layouts.admin')
@section('title', 'Manajemen Booking - SportZ')
@section('content')
<div class="space-y-6">
    <h1 class="font-heading text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">Manajemen Booking</h1>

    {{-- Status Tabs --}}
    <div class="flex gap-2 overflow-x-auto pb-2">
        @foreach(['all' => 'Semua', 'pending' => 'Pending', 'confirmed' => 'Dikonfirmasi', 'completed' => 'Selesai', 'cancelled' => 'Dibatalkan'] as $key => $label)
        <a href="{{ route('admin.bookings.index', ['status' => $key === 'all' ? null : $key]) }}" class="px-5 py-2.5 rounded-xl text-sm font-medium whitespace-nowrap transition-all {{ (request('status') ?? 'all') === ($key === 'all' ? null : $key) || (request('status') === null && $key === 'all') ? 'bg-cyan-500 text-white shadow-lg shadow-cyan-500/25' : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700' }}">{{ $label }}</a>
        @endforeach
    </div>

    {{-- Bookings Table --}}
    <div class="bg-white dark:bg-gray-800/50 rounded-2xl border border-gray-100 dark:border-gray-700/50 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-900/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kode Booking</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Lapangan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Jam</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700/50">
                    @forelse($bookings as $booking)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/80 transition-colors">
                        <td class="px-6 py-4 text-sm font-mono font-semibold text-cyan-600 dark:text-cyan-400">{{ $booking->booking_code }}</td>
                        <td class="px-6 py-4"><div class="flex items-center gap-3"><div class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center text-white text-xs font-bold">{{ substr($booking->user->name ?? '', 0, 1) }}</div><span class="text-sm text-gray-900 dark:text-white">{{ $booking->user->name ?? '-' }}</span></div></td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $booking->court->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ substr($booking->start_time, 0, 5) }} - {{ substr($booking->end_time, 0, 5) }}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-white">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</td>
                        <td class="px-6 py-4"><x-status-badge :status="$booking->status" /></td>
                        <td class="px-6 py-4"><a href="{{ route('admin.bookings.show', $booking->id) }}" class="text-sm text-cyan-500 hover:text-cyan-400 font-medium">Detail</a></td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="px-6 py-8 text-center text-gray-500">Tidak ada data booking.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ $bookings->withQueryString()->links() }}
</div>
@endsection
