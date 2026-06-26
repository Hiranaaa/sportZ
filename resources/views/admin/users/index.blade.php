@extends('layouts.admin')
@section('title', 'Manajemen User - SportZ')
@section('content')
<div class="space-y-6">
    <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Manajemen User</h1>
    <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-4 border border-gray-100 dark:border-gray-700/50">
        <form action="{{ route('admin.users.index') }}" method="GET" class="flex gap-4"><div class="flex-1"><x-search-bar placeholder="Cari nama atau email..." name="search" :value="request('search')" /></div><button type="submit" class="px-6 py-2.5 bg-gray-100 dark:bg-gray-700 rounded-xl text-sm font-medium hover:bg-gray-200 transition-colors">Cari</button></form>
    </div>
    <div class="bg-white dark:bg-gray-800/50 rounded-2xl border border-gray-100 dark:border-gray-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full"><thead class="bg-gray-50 dark:bg-gray-900/50"><tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">User</th><th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Email</th><th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Role</th><th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Bergabung</th><th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
            </tr></thead><tbody class="divide-y divide-gray-100 dark:divide-gray-700/50">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/80 transition-colors">
                    <td class="px-6 py-4"><div class="flex items-center gap-3"><div class="w-9 h-9 rounded-full bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center text-white text-sm font-bold">{{ substr($user->name, 0, 1) }}</div><span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $user->name }}</span></div></td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $user->email }}</td>
                    <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-semibold rounded-full {{ $user->role->name === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">{{ ucfirst($user->role->name ?? '-') }}</span></td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4"><a href="{{ route('admin.users.show', $user->id) }}" class="text-sm text-cyan-500 hover:text-cyan-400 font-medium">Detail</a></td>
                </tr>
                @empty<tr><td colspan="5" class="px-6 py-8 text-center text-gray-500">Tidak ada user.</td></tr>@endforelse
            </tbody></table>
        </div>
    </div>
    {{ $users->withQueryString()->links() }}
</div>
@endsection
