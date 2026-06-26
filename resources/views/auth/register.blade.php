@extends('layouts.guest')
@section('title', 'Daftar - SportZ')
@section('content')
    <h2 class="font-heading text-2xl font-bold text-white mb-2">Buat Akun Baru 🚀</h2>
    <p class="text-gray-400 mb-8">Bergabung dan mulai booking lapangan favorit Anda</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all" placeholder="Nama lengkap Anda">
            @error('name')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all" placeholder="email@anda.com">
            @error('email')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">No. Telepon</label>
            <input type="tel" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all" placeholder="08xxxxxxxxxx">
            @error('phone')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Password</label>
            <input type="password" name="password" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all" placeholder="Minimal 8 karakter">
            @error('password')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all" placeholder="Ulangi password">
        </div>
        <label class="flex items-start gap-2 cursor-pointer">
            <input type="checkbox" name="terms" required class="mt-1 w-4 h-4 rounded border-white/20 bg-white/5 text-cyan-500 focus:ring-cyan-500">
            <span class="text-sm text-gray-400">Saya setuju dengan <a href="#" class="text-cyan-400 hover:underline">Syarat & Ketentuan</a> dan <a href="#" class="text-cyan-400 hover:underline">Kebijakan Privasi</a></span>
        </label>
        <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-cyan-500/25 hover:-translate-y-0.5 transition-all duration-300">Daftar Sekarang</button>
    </form>
@endsection

@section('footer')
    <p class="text-gray-400">Sudah punya akun? <a href="{{ route('login') }}" class="text-cyan-400 hover:text-cyan-300 font-semibold transition-colors">Masuk</a></p>
@endsection
