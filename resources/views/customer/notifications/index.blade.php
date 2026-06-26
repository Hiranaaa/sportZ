@extends('layouts.customer')
@section('title', 'Notifikasi - SportZ')
@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Notifikasi 🔔</h1>
        <form action="{{ route('customer.notifications.read-all') }}" method="POST">@csrf<button class="text-sm text-cyan-500 hover:text-cyan-400 font-medium">Tandai Semua Dibaca</button></form>
    </div>
    <div class="space-y-3">
        @forelse($notifications as $notif)
        <div class="flex items-start gap-4 p-4 bg-white dark:bg-gray-800/50 rounded-2xl border transition-all {{ $notif->read_at ? 'border-gray-100 dark:border-gray-700/50' : 'border-cyan-200 dark:border-cyan-800/50 bg-cyan-50/50 dark:bg-cyan-900/10' }}">
            <div class="w-10 h-10 rounded-xl {{ $notif->read_at ? 'bg-gray-100 dark:bg-gray-800' : 'bg-cyan-100 dark:bg-cyan-900/30' }} flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 {{ $notif->read_at ? 'text-gray-400' : 'text-cyan-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            </div>
            <div class="flex-1 min-w-0">
                <h4 class="font-semibold text-gray-900 dark:text-white text-sm">{{ $notif->title }}</h4>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">{{ $notif->message }}</p>
                <p class="text-xs text-gray-400 mt-2">{{ $notif->created_at->diffForHumans() }}</p>
            </div>
            @if(!$notif->read_at)<form action="{{ route('customer.notifications.read', $notif->id) }}" method="POST">@csrf<button class="text-xs text-cyan-500 hover:underline">Tandai dibaca</button></form>@endif
        </div>
        @empty
        <x-empty-state title="Tidak ada notifikasi" description="Notifikasi akan muncul di sini" />
        @endforelse
    </div>
    {{ $notifications->links() }}
</div>
@endsection
