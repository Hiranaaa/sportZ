@extends('layouts.customer')
@section('title', 'Edit Profil - SportZ')
@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Edit Profil</h1>
    <form action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')
        {{-- Avatar --}}
        <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50 flex items-center gap-6">
            <div class="relative">
                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center text-white text-2xl font-bold overflow-hidden">
                    @if($user->avatar)<img src="{{ $user->avatar }}" class="w-full h-full object-cover">@else{{ substr($user->name, 0, 1) }}@endif
                </div>
                <label class="absolute -bottom-1 -right-1 w-8 h-8 bg-cyan-500 rounded-full flex items-center justify-center cursor-pointer hover:bg-cyan-600 transition-colors"><svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg><input type="file" name="avatar" class="hidden" accept="image/*"></label>
            </div>
            <div><p class="font-semibold text-gray-900 dark:text-white">{{ $user->name }}</p><p class="text-sm text-gray-500">{{ $user->email }}</p></div>
        </div>

        <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50 space-y-5">
            <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama</label><input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500 transition-all">@error('name')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror</div>
            <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label><input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500 transition-all">@error('email')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror</div>
            <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">No. Telepon</label><input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500 transition-all">@error('phone')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror</div>
        </div>
        <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-cyan-500/25 transition-all duration-300">Simpan Perubahan</button>
    </form>
</div>
@endsection
