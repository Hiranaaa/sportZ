@extends('layouts.admin')
@section('title', 'Detail Pembayaran - SportZ')
@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.payments.index') }}" class="p-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-600 hover:bg-gray-200 transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></a>
        <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Detail Pembayaran</h1>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50 space-y-3 text-sm">
            <h3 class="font-heading font-bold text-gray-900 dark:text-white text-lg mb-4">Info Pembayaran</h3>
            <div class="flex justify-between"><span class="text-gray-500">Transaction ID</span><span class="font-mono">{{ $payment->transaction_id ?? '-' }}</span></div>
            <div class="flex justify-between"><span class="text-gray-500">Metode</span><span>{{ ucfirst($payment->payment_method ?? '-') }}</span></div>
            <div class="flex justify-between"><span class="text-gray-500">Jumlah</span><span class="font-bold text-lg text-cyan-600">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span></div>
            <div class="flex justify-between"><span class="text-gray-500">Status</span><x-status-badge :status="$payment->status" /></div>
            @if($payment->paid_at)<div class="flex justify-between"><span class="text-gray-500">Dibayar</span><span>{{ $payment->paid_at->format('d M Y H:i') }}</span></div>@endif
            <div class="flex justify-between"><span class="text-gray-500">Dibuat</span><span>{{ $payment->created_at->format('d M Y H:i') }}</span></div>
        </div>
        <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50 space-y-3 text-sm">
            <h3 class="font-heading font-bold text-gray-900 dark:text-white text-lg mb-4">Info Booking</h3>
            <div class="flex justify-between"><span class="text-gray-500">Kode</span><span class="font-mono text-cyan-600">{{ $payment->booking->booking_code ?? '-' }}</span></div>
            <div class="flex justify-between"><span class="text-gray-500">Customer</span><span>{{ $payment->booking->user->name ?? '-' }}</span></div>
            <div class="flex justify-between"><span class="text-gray-500">Lapangan</span><span>{{ $payment->booking->court->name ?? '-' }}</span></div>
            <div class="flex justify-between"><span class="text-gray-500">Tanggal</span><span>{{ \Carbon\Carbon::parse($payment->booking->booking_date)->format('d M Y') }}</span></div>
            <div class="flex justify-between"><span class="text-gray-500">Jam</span><span>{{ substr($payment->booking->start_time, 0, 5) }} - {{ substr($payment->booking->end_time, 0, 5) }}</span></div>
        </div>
    </div>
    @if($payment->paymentLogs && $payment->paymentLogs->count())
    <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50">
        <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-4">Payment Logs</h3>
        <div class="space-y-2">@foreach($payment->paymentLogs as $log)<div class="p-3 bg-gray-50 dark:bg-gray-900/50 rounded-lg text-sm"><span class="text-gray-500">{{ $log->created_at->format('d M H:i:s') }}</span> — <span class="font-mono text-xs">{{ $log->status }}</span><p class="text-xs text-gray-400 mt-1">{{ Str::limit(json_encode($log->raw_response), 200) }}</p></div>@endforeach</div>
    </div>
    @endif
</div>
@endsection
