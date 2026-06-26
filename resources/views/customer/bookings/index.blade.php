@extends('layouts.customer')
@section('title', 'Booking Saya - SportZ')
@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Booking Saya</h1>
        <a href="{{ route('customer.bookings.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-cyan-500/25 transition-all duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Booking Baru
        </a>
    </div>

    {{-- Tabs --}}
    <div class="flex gap-2 overflow-x-auto pb-2">
        @foreach(['all' => 'Semua', 'pending' => 'Pending', 'confirmed' => 'Aktif', 'completed' => 'Selesai', 'cancelled' => 'Dibatalkan'] as $key => $label)
        <a href="{{ route('customer.bookings.index', ['status' => $key === 'all' ? null : $key]) }}" class="px-5 py-2.5 rounded-xl text-sm font-medium whitespace-nowrap transition-all {{ (request('status') ?? 'all') === ($key === 'all' ? null : $key) || (!request('status') && $key === 'all') ? 'bg-cyan-500 text-white shadow-lg shadow-cyan-500/25' : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-gray-700' }}">{{ $label }}</a>
        @endforeach
    </div>

    {{-- Bookings List --}}
    <div class="space-y-4">
        @forelse($bookings as $booking)
        <x-booking-card :booking="$booking" />
        @empty
        <x-empty-state title="Belum ada booking" description="Yuk mulai booking lapangan favorit Anda!" action="Booking Sekarang" :actionUrl="route('customer.bookings.create')" />
        @endforelse
    </div>
    {{ $bookings->withQueryString()->links() }}
</div>
@endsection
