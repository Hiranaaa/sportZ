@extends('layouts.admin')
@section('title', 'Pengaturan - SportZ')
@section('content')
<div class="space-y-6">
    <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Pengaturan</h1>
    <form action="{{ route('admin.settings.update') }}" method="POST">@csrf @method('PUT')
        @foreach($settings as $group => $items)
        <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50 mb-6">
            <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-4 capitalize">{{ $group }}</h3>
            <div class="space-y-4">
                @foreach($items as $setting)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300 capitalize">{{ str_replace('_', ' ', $setting->key) }}</label>
                    <div class="md:col-span-2"><input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500 text-sm"></div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
        <button type="submit" class="px-8 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-semibold rounded-xl hover:shadow-lg transition-all">Simpan Pengaturan</button>
    </form>
</div>
@endsection
