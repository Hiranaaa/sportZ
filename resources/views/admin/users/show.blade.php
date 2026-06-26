@extends('layouts.admin')
@section('title', 'Detail User - SportZ')
@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.users.index') }}" class="p-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-600 hover:bg-gray-200 transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></a>
        <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Detail User</h1>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50 text-center">
            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center text-white text-2xl font-bold mx-auto mb-4">{{ substr($user->name, 0, 1) }}</div>
            <h3 class="font-heading font-bold text-gray-900 dark:text-white text-lg">{{ $user->name }}</h3>
            <p class="text-sm text-gray-500">{{ $user->email }}</p>
            <p class="text-sm text-gray-500">{{ $user->phone ?? '-' }}</p>
            <span class="inline-block mt-3 px-3 py-1 text-xs font-semibold rounded-full {{ $user->role->name === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">{{ ucfirst($user->role->name ?? '-') }}</span>
            <p class="text-xs text-gray-400 mt-2">Bergabung {{ $user->created_at->format('d M Y') }}</p>
        </div>
        <div class="lg:col-span-2 space-y-6">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <x-stat-card icon="calendar" label="Total Booking" :value="$user->bookings_count ?? 0" color="cyan" />
                <x-stat-card icon="currency" label="Total Bayar" :value="'Rp ' . number_format($user->bookings_sum_total_amount ?? 0, 0, ',', '.')" color="green" />
                <x-stat-card icon="check" label="Selesai" :value="$user->bookings->where('status', 'completed')->count()" color="blue" />
                <x-stat-card icon="flag" label="Dibatalkan" :value="$user->bookings->where('status', 'cancelled')->count()" color="red" />
            </div>
            <div class="bg-white dark:bg-gray-800/50 rounded-2xl border border-gray-100 dark:border-gray-700/50 overflow-hidden">
                <div class="p-4 border-b border-gray-100 dark:border-gray-700/50"><h3 class="font-heading font-bold text-gray-900 dark:text-white">Riwayat Booking</h3></div>
                <div class="divide-y divide-gray-100 dark:divide-gray-700/50">
                    @forelse($user->bookings->take(10) as $booking)
                    <div class="flex items-center gap-4 p-4">
                        <div class="flex-1"><p class="font-mono text-sm text-cyan-600 font-semibold">{{ $booking->booking_code }}</p><p class="text-xs text-gray-500">{{ $booking->court->name ?? '-' }} • {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</p></div>
                        <span class="text-sm font-semibold">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</span>
                        <x-status-badge :status="$booking->status" />
                    </div>
                    @empty<div class="p-6 text-center text-gray-500">Belum ada booking</div>@endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
