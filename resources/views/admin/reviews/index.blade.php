@extends('layouts.admin')
@section('title', 'Manajemen Review - SportZ')
@section('content')
<div class="space-y-6">
    <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Manajemen Review</h1>
    <div class="space-y-4">
        @forelse($reviews as $review)
        <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center text-white font-bold text-sm">{{ substr($review->user->name ?? '', 0, 1) }}</div>
                    <div><p class="font-semibold text-gray-900 dark:text-white">{{ $review->user->name ?? '-' }}</p><p class="text-xs text-gray-500">{{ $review->court->name ?? '-' }} • {{ $review->created_at->format('d M Y') }}</p></div>
                </div>
                <div class="flex items-center gap-1">@for($i = 1; $i <= 5; $i++)<svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor</div>
            </div>
            <p class="text-gray-600 dark:text-gray-400 mb-4">{{ $review->comment }}</p>
            @if($review->admin_reply)
            <div class="ml-6 p-4 bg-cyan-50 dark:bg-cyan-900/10 rounded-xl border-l-4 border-cyan-500"><p class="text-xs text-cyan-600 font-semibold mb-1">Balasan Admin</p><p class="text-sm text-gray-700 dark:text-gray-300">{{ $review->admin_reply }}</p></div>
            @else
            <form action="{{ route('admin.reviews.reply', $review->id) }}" method="POST" class="ml-6 flex gap-3">@csrf
                <input type="text" name="admin_reply" required placeholder="Tulis balasan..." class="flex-1 px-4 py-2 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-sm focus:ring-2 focus:ring-cyan-500">
                <button type="submit" class="px-5 py-2 bg-cyan-500 text-white rounded-xl text-sm font-medium hover:bg-cyan-600 transition-colors">Balas</button>
            </form>
            @endif
        </div>
        @empty
        <x-empty-state title="Belum ada review" description="Review dari customer akan muncul di sini" />
        @endforelse
    </div>
    {{ $reviews->links() }}
</div>
@endsection
