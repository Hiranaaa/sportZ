@extends('layouts.guest')
@section('title', '500 - Server Error')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-950 via-blue-950 to-gray-950 px-4">
    <div class="text-center"><div class="text-8xl font-bold bg-gradient-to-r from-red-400 to-pink-400 bg-clip-text text-transparent mb-4">500</div><h1 class="font-heading text-2xl font-bold text-white mb-2">Server Error</h1><p class="text-gray-400 mb-8">Terjadi kesalahan pada server. Silakan coba beberapa saat lagi.</p><a href="{{ route('home') }}" class="px-8 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-semibold rounded-xl hover:shadow-lg transition-all">Kembali ke Beranda</a></div>
</div>
@endsection
