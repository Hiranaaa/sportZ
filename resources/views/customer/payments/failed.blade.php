@extends('layouts.customer')
@section('title', 'Pembayaran Gagal - SportZ')
@section('content')
<div class="max-w-lg mx-auto text-center py-12">
    <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-red-100 dark:bg-red-900/20 flex items-center justify-center"><svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></div>
    <h1 class="font-heading text-3xl font-bold text-gray-900 dark:text-white mb-2">Pembayaran Gagal 😢</h1>
    <p class="text-gray-500 dark:text-gray-400 mb-8">Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.</p>
    <div class="flex flex-col sm:flex-row gap-3 justify-center">
        <a href="{{ route('customer.bookings.index') }}" class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-semibold rounded-xl hover:shadow-lg transition-all">Coba Lagi</a>
        <a href="{{ route('customer.dashboard') }}" class="px-6 py-3 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 font-semibold rounded-xl hover:bg-gray-200 transition-colors">Ke Dashboard</a>
    </div>
</div>
@endsection
