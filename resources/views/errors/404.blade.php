@extends('layouts.guest')
@section('title', '404 - Halaman Tidak Ditemukan')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-950 via-blue-950 to-gray-950 px-4">
    <div class="text-center"><div class="text-8xl font-bold bg-gradient-to-r from-cyan-400 to-blue-400 bg-clip-text text-transparent mb-4">404</div><h1 class="font-heading text-2xl font-bold text-white mb-2">Halaman Tidak Ditemukan</h1><p class="text-gray-400 mb-8">Sepertinya halaman yang Anda cari sudah pindah atau tidak ada.</p><a href="{{ route('home') }}" class="px-8 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-semibold rounded-xl hover:shadow-lg transition-all">Kembali ke Beranda</a></div>
</div>
@endsection
