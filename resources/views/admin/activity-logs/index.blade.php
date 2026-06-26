@extends('layouts.admin')
@section('title', 'Activity Log - SportZ')
@section('content')
<div class="space-y-6">
    <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Activity Log</h1>
    <div class="bg-white dark:bg-gray-800/50 rounded-2xl border border-gray-100 dark:border-gray-700/50 overflow-hidden">
        <div class="overflow-x-auto"><table class="w-full"><thead class="bg-gray-50 dark:bg-gray-900/50"><tr>
            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Waktu</th><th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">User</th><th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th><th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Model</th><th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">IP</th>
        </tr></thead><tbody class="divide-y divide-gray-100 dark:divide-gray-700/50">
            @forelse($logs as $log)
            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/80"><td class="px-6 py-4 text-sm text-gray-500">{{ $log->created_at->format('d M Y H:i:s') }}</td><td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $log->user->name ?? 'System' }}</td><td class="px-6 py-4"><span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">{{ $log->action }}</span></td><td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400 font-mono">{{ $log->model_type ? class_basename($log->model_type) : '-' }}</td><td class="px-6 py-4 text-sm text-gray-500 font-mono">{{ $log->ip_address ?? '-' }}</td></tr>
            @empty<tr><td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada aktivitas.</td></tr>@endforelse
        </tbody></table></div>
    </div>
    {{ $logs->links() }}
</div>
@endsection
