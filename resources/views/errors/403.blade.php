@extends('layouts.guest')
@section('title', '403 - Akses Ditolak')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-950 via-blue-950 to-gray-950 px-4">
    <div class="text-center"><div class="text-8xl font-bold bg-gradient-to-r from-amber-400 to-orange-400 bg-clip-text text-transparent mb-4">403</div><h1 class="font-heading text-2xl font-bold text-white mb-2">Akses Ditolak</h1><p class="text-gray-400 mb-8">Anda tidak memiliki izin untuk mengakses halaman ini.</p><a href="{{ route('home') }}" class="px-8 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-semibold rounded-xl hover:shadow-lg transition-all">Kembali ke Beranda</a></div>
</div>
@endsection
