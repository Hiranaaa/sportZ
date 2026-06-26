@extends('layouts.customer')
@section('title', 'Booking Baru - SportZ')
@section('content')
<div class="space-y-6" x-data="{ step: 1, selectedCourt: null, selectedCourtName: '', selectedCourtPrice: 0, selectedDate: '', selectedTime: '', duration: 1, voucherCode: '', voucherDiscount: 0 }">
    {{-- Progress Bar --}}
    <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50">
        <div class="flex items-center justify-between max-w-2xl mx-auto">
            <div class="flex items-center gap-3" :class="step >= 1 ? 'text-cyan-500' : 'text-gray-400'">
                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm" :class="step >= 1 ? 'bg-cyan-500 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-500'">1</div>
                <span class="hidden sm:block text-sm font-medium">Pilih Lapangan</span>
            </div>
            <div class="flex-1 h-0.5 mx-4" :class="step >= 2 ? 'bg-cyan-500' : 'bg-gray-200 dark:bg-gray-700'"></div>
            <div class="flex items-center gap-3" :class="step >= 2 ? 'text-cyan-500' : 'text-gray-400'">
                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm" :class="step >= 2 ? 'bg-cyan-500 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-500'">2</div>
                <span class="hidden sm:block text-sm font-medium">Pilih Waktu</span>
            </div>
            <div class="flex-1 h-0.5 mx-4" :class="step >= 3 ? 'bg-cyan-500' : 'bg-gray-200 dark:bg-gray-700'"></div>
            <div class="flex items-center gap-3" :class="step >= 3 ? 'text-cyan-500' : 'text-gray-400'">
                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm" :class="step >= 3 ? 'bg-cyan-500 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-500'">3</div>
                <span class="hidden sm:block text-sm font-medium">Checkout</span>
            </div>
        </div>
    </div>

    {{-- Step 1: Select Court --}}
    <div x-show="step === 1" x-cloak>
        <h2 class="font-heading text-xl font-bold text-gray-900 dark:text-white mb-4">Pilih Lapangan</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($courts as $court)
            <div @click="selectedCourt = '{{ $court->id }}'; selectedCourtName = '{{ $court->name }}'; selectedCourtPrice = {{ $court->price_per_hour }}; step = 2" class="bg-white dark:bg-gray-800/50 rounded-2xl border-2 cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-xl overflow-hidden" :class="selectedCourt === '{{ $court->id }}' ? 'border-cyan-500 shadow-lg shadow-cyan-500/10' : 'border-gray-100 dark:border-gray-700/50'">
                <div class="aspect-video bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 flex items-center justify-center">
                    <span class="text-4xl">{{ $court->sport->icon ?? '🏟️' }}</span>
                </div>
                <div class="p-4">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="px-2 py-0.5 bg-cyan-50 dark:bg-cyan-900/20 text-cyan-600 dark:text-cyan-400 text-xs font-semibold rounded-full">{{ $court->sport->name ?? 'Sport' }}</span>
                        @if($court->reviews_avg_rating)<span class="text-xs text-amber-500">⭐ {{ number_format($court->reviews_avg_rating, 1) }}</span>@endif
                    </div>
                    <h3 class="font-heading font-bold text-gray-900 dark:text-white">{{ $court->name }}</h3>
                    <p class="text-lg font-bold text-cyan-600 dark:text-cyan-400 mt-1">Rp {{ number_format($court->price_per_hour, 0, ',', '.') }}<span class="text-xs text-gray-400 font-normal">/jam</span></p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Step 2: Select Date/Time --}}
    <div x-show="step === 2" x-cloak>
        <div class="flex items-center gap-2 mb-4">
            <button @click="step = 1" class="p-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-600 hover:bg-gray-200 transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></button>
            <h2 class="font-heading text-xl font-bold text-gray-900 dark:text-white">Pilih Waktu</h2>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Bermain</label>
                    <input type="date" x-model="selectedDate" min="{{ date('Y-m-d') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500 transition-all">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jam Mulai</label>
                    <select x-model="selectedTime" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500">
                        <option value="">Pilih Jam</option>
                        @for($h = 8; $h <= 21; $h++)<option value="{{ sprintf('%02d:00', $h) }}">{{ sprintf('%02d:00', $h) }}</option>@endfor
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Durasi</label>
                    <div class="flex gap-3">
                        @for($d = 1; $d <= 4; $d++)
                        <button type="button" @click="duration = {{ $d }}" class="flex-1 py-3 rounded-xl font-semibold text-sm transition-all" :class="duration === {{ $d }} ? 'bg-cyan-500 text-white shadow-lg shadow-cyan-500/25' : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-200'">{{ $d }} Jam</button>
                        @endfor
                    </div>
                </div>
                <button @click="step = 3" class="w-full py-3.5 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-semibold rounded-xl hover:shadow-lg transition-all duration-300" :disabled="!selectedDate || !selectedTime">Lanjut ke Checkout</button>
            </div>
            <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50">
                <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-4">Slot Tersedia</h3>
                <div id="booking-calendar" class="min-h-[300px] flex items-center justify-center text-gray-400">
                    <p>Pilih tanggal untuk melihat slot tersedia</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Step 3: Checkout --}}
    <div x-show="step === 3" x-cloak>
        <div class="flex items-center gap-2 mb-4">
            <button @click="step = 2" class="p-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-600 hover:bg-gray-200 transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></button>
            <h2 class="font-heading text-xl font-bold text-gray-900 dark:text-white">Checkout</h2>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50">
                <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-6">Ringkasan Booking</h3>
                <div class="space-y-4 text-sm">
                    <div class="flex justify-between"><span class="text-gray-500">Lapangan</span><span class="font-semibold text-gray-900 dark:text-white" x-text="selectedCourtName"></span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Tanggal</span><span class="font-semibold text-gray-900 dark:text-white" x-text="selectedDate"></span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Jam</span><span class="font-semibold text-gray-900 dark:text-white" x-text="selectedTime + ' (' + duration + ' jam)'"></span></div>
                    <hr class="border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between"><span class="text-gray-500">Harga/jam</span><span class="text-gray-900 dark:text-white" x-text="'Rp ' + selectedCourtPrice.toLocaleString('id-ID')"></span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Durasi</span><span class="text-gray-900 dark:text-white" x-text="duration + ' jam'"></span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Subtotal</span><span class="text-gray-900 dark:text-white" x-text="'Rp ' + (selectedCourtPrice * duration).toLocaleString('id-ID')"></span></div>
                    <div class="flex justify-between text-green-500" x-show="voucherDiscount > 0"><span>Diskon</span><span x-text="'- Rp ' + voucherDiscount.toLocaleString('id-ID')"></span></div>
                    <hr class="border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between text-lg font-bold"><span class="text-gray-900 dark:text-white">Total</span><span class="text-cyan-600 dark:text-cyan-400" x-text="'Rp ' + ((selectedCourtPrice * duration) - voucherDiscount).toLocaleString('id-ID')"></span></div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50">
                    <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-4">Kode Voucher</h3>
                    <div class="flex gap-3">
                        <input type="text" x-model="voucherCode" placeholder="Masukkan kode voucher" class="flex-1 px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500 transition-all">
                        <button type="button" class="px-5 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl font-medium hover:bg-gray-200 transition-colors">Pakai</button>
                    </div>
                </div>
                <form method="POST" action="{{ route('customer.bookings.store') }}">
                    @csrf
                    <input type="hidden" name="court_id" :value="selectedCourt">
                    <input type="hidden" name="booking_date" :value="selectedDate">
                    <input type="hidden" name="start_time" :value="selectedTime">
                    <input type="hidden" name="end_time" :value="selectedTime ? (parseInt(selectedTime) + duration).toString().padStart(2, '0') + ':00' : ''">
                    <input type="hidden" name="duration_hours" :value="duration">
                    <input type="hidden" name="voucher_code" :value="voucherCode">
                    <textarea name="notes" rows="3" placeholder="Catatan (opsional)" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500 transition-all resize-none mb-4"></textarea>
                    <button type="submit" class="w-full py-4 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-bold rounded-xl text-lg hover:shadow-xl hover:shadow-cyan-500/25 hover:-translate-y-0.5 transition-all duration-300">💳 Bayar Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
