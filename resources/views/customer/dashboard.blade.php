@extends('layouts.customer')
@section('title', 'Dashboard - SportZ')
@section('content')
<div class="space-y-8">
    <div>
        <h1 class="font-heading text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">Halo, {{ auth()->user()->name }}! 👋</h1>
        <p class="text-gray-500 dark:text-gray-400 mt-1">Selamat datang kembali di SportZ</p>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <x-stat-card icon="calendar" label="Total Booking" :value="$stats['total_bookings'] ?? 0" color="cyan" />
        <x-stat-card icon="check" label="Booking Aktif" :value="$stats['active_bookings'] ?? 0" color="green" />
        <x-stat-card icon="flag" label="Selesai" :value="$stats['completed_bookings'] ?? 0" color="blue" />
        <x-stat-card icon="currency" label="Total Pengeluaran" :value="'Rp ' . number_format($stats['total_spent'] ?? 0, 0, ',', '.')" color="purple" />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Today's Schedule --}}
        <div class="lg:col-span-2 bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-heading font-bold text-gray-900 dark:text-white">📅 Jadwal Hari Ini</h3>
                <a href="{{ route('customer.bookings.create') }}" class="text-sm text-cyan-500 hover:text-cyan-400 font-medium">+ Booking Baru</a>
            </div>
            @forelse($todayBookings as $booking)
            <div class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl mb-3 last:mb-0">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center text-white font-bold text-sm">{{ substr($booking->start_time, 0, 5) }}</div>
                <div class="flex-1">
                    <p class="font-semibold text-gray-900 dark:text-white">{{ $booking->court->name ?? '-' }}</p>
                    <p class="text-sm text-gray-500">{{ substr($booking->start_time, 0, 5) }} - {{ substr($booking->end_time, 0, 5) }} • {{ $booking->court->sport->name ?? '' }}</p>
                </div>
                <x-status-badge :status="$booking->status" />
            </div>
            @empty
            <div class="text-center py-8">
                <p class="text-gray-400 mb-4">Tidak ada jadwal hari ini</p>
                <a href="{{ route('customer.bookings.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-xl text-sm font-medium hover:shadow-lg transition-all">Booking Sekarang</a>
            </div>
            @endforelse
        </div>

        {{-- Active Promos --}}
        <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50">
            <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-4">🎉 Promo Aktif</h3>
            <div class="space-y-3">
                @forelse($vouchers->take(3) as $voucher)
                <div class="p-4 bg-gradient-to-r from-cyan-500/10 to-blue-500/10 rounded-xl border border-cyan-500/20">
                    <p class="font-mono font-bold text-cyan-600 dark:text-cyan-400">{{ $voucher->code }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $voucher->discount_type === 'percentage' ? $voucher->discount_value . '% OFF' : 'Rp ' . number_format($voucher->discount_value, 0, ',', '.') . ' OFF' }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">s/d {{ \Carbon\Carbon::parse($voucher->end_date)->format('d M Y') }}</p>
                </div>
                @empty
                <p class="text-sm text-gray-400 text-center py-4">Tidak ada promo saat ini</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Recent Bookings --}}
    <div class="bg-white dark:bg-gray-800/50 rounded-2xl border border-gray-100 dark:border-gray-700/50 overflow-hidden">
        <div class="p-6 border-b border-gray-100 dark:border-gray-700/50 flex items-center justify-between">
            <h3 class="font-heading font-bold text-gray-900 dark:text-white">Booking Terbaru</h3>
            <a href="{{ route('customer.bookings.index') }}" class="text-sm text-cyan-500 hover:text-cyan-400 font-medium">Lihat Semua →</a>
        </div>
        <div class="divide-y divide-gray-100 dark:divide-gray-700/50">
            @forelse($recentBookings as $booking)
            <a href="{{ route('customer.bookings.show', $booking->id) }}" class="flex items-center gap-4 p-4 hover:bg-gray-50 dark:hover:bg-gray-800/80 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 flex items-center justify-center text-xl">{{ $booking->court->sport->icon ?? '🏟️' }}</div>
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-gray-900 dark:text-white truncate">{{ $booking->court->name ?? '-' }}</p>
                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }} • {{ substr($booking->start_time, 0, 5) }}</p>
                </div>
                <div class="text-right">
                    <p class="font-semibold text-gray-900 dark:text-white text-sm">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</p>
                    <x-status-badge :status="$booking->status" />
                </div>
            </a>
            @empty
            <div class="p-8 text-center text-gray-500">Belum ada booking</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
