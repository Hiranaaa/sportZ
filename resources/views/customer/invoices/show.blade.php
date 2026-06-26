@extends('layouts.customer')
@section('title', 'Invoice - SportZ')
@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Invoice</h1>
        <a href="{{ route('customer.invoices.download', $invoice->id) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-xl font-medium hover:shadow-lg transition-all">📄 Download PDF</a>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 border border-gray-100 dark:border-gray-700 shadow-sm">
        <div class="flex justify-between items-start mb-8">
            <div><span class="font-heading text-2xl font-bold bg-gradient-to-r from-cyan-500 to-blue-500 bg-clip-text text-transparent">SportZ</span><p class="text-sm text-gray-500 mt-1">Jl. Olahraga No. 123, Jakarta Selatan</p></div>
            <div class="text-right"><p class="font-heading font-bold text-gray-900 dark:text-white">INVOICE</p><p class="text-sm text-gray-500 font-mono">{{ $invoice->invoice_number }}</p><p class="text-sm text-gray-500">{{ $invoice->issued_at ? $invoice->issued_at->format('d M Y') : '' }}</p></div>
        </div>
        <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl"><p class="text-sm text-gray-500">Diterbitkan untuk:</p><p class="font-semibold text-gray-900 dark:text-white">{{ $invoice->booking->user->name ?? '-' }}</p><p class="text-sm text-gray-500">{{ $invoice->booking->user->email ?? '-' }}</p></div>
        <table class="w-full mb-6"><thead><tr class="border-b border-gray-200 dark:border-gray-700"><th class="text-left py-3 text-sm font-semibold text-gray-500">Deskripsi</th><th class="text-center py-3 text-sm font-semibold text-gray-500">Durasi</th><th class="text-right py-3 text-sm font-semibold text-gray-500">Harga</th></tr></thead><tbody><tr class="border-b border-gray-100 dark:border-gray-800"><td class="py-4"><p class="font-semibold text-gray-900 dark:text-white">{{ $invoice->booking->court->name ?? '-' }}</p><p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($invoice->booking->booking_date)->format('d M Y') }} • {{ substr($invoice->booking->start_time, 0, 5) }} - {{ substr($invoice->booking->end_time, 0, 5) }}</p></td><td class="text-center text-gray-700 dark:text-gray-300">{{ $invoice->booking->duration_hours }} jam</td><td class="text-right font-semibold text-gray-900 dark:text-white">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</td></tr></tbody></table>
        <div class="flex justify-end"><div class="w-64 space-y-2 text-sm"><div class="flex justify-between"><span class="text-gray-500">Subtotal</span><span>Rp {{ number_format($invoice->amount, 0, ',', '.') }}</span></div><div class="flex justify-between"><span class="text-gray-500">Pajak</span><span>Rp {{ number_format($invoice->tax, 0, ',', '.') }}</span></div><div class="flex justify-between pt-2 border-t text-lg font-bold"><span>Total</span><span class="text-cyan-600">Rp {{ number_format($invoice->total, 0, ',', '.') }}</span></div></div></div>
        <p class="text-center text-sm text-gray-400 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">Terima kasih telah bermain di SportZ! 🏆</p>
    </div>
</div>
@endsection
