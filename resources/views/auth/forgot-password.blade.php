@extends('layouts.guest')
@section('title', 'Lupa Password - SportZ')
@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 bg-gradient-to-br from-gray-950 via-blue-950 to-gray-950">
    <div class="absolute top-20 left-20 w-72 h-72 bg-cyan-500/10 rounded-full blur-3xl"></div>
    <div class="relative w-full max-w-md">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}"><span class="font-heading text-4xl font-bold bg-gradient-to-r from-cyan-400 to-blue-400 bg-clip-text text-transparent">SportZ</span></a>
        </div>
        <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-8 shadow-2xl">
            <h2 class="font-heading text-2xl font-bold text-white mb-2">Lupa Password? 🔑</h2>
            <p class="text-gray-400 mb-8">Masukkan email Anda dan kami akan mengirimkan link reset password.</p>
            @if(session('status'))
                <div class="mb-4 p-4 bg-green-500/10 border border-green-500/20 rounded-xl text-green-400 text-sm">{{ session('status') }}</div>
            @endif
            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all" placeholder="email@anda.com">
                    @error('email')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-cyan-500/25 transition-all duration-300">Kirim Link Reset</button>
            </form>
        </div>
        <p class="text-center mt-6 text-gray-400"><a href="{{ route('login') }}" class="text-cyan-400 hover:text-cyan-300 font-semibold transition-colors">← Kembali ke halaman masuk</a></p>
    </div>
</div>
@endsection
