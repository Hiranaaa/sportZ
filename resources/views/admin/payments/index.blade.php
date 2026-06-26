@extends('layouts.admin')
@section('title', 'Manajemen Pembayaran - SportZ')
@section('content')
<div class="space-y-6">
    <h1 class="font-heading text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">Manajemen Pembayaran</h1>
    <div class="bg-white dark:bg-gray-800/50 rounded-2xl border border-gray-100 dark:border-gray-700/50 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-gray-100 dark:border-gray-700/50 flex gap-2">
            @foreach(['all' => 'Semua', 'pending' => 'Pending', 'paid' => 'Lunas', 'expired' => 'Expired', 'cancelled' => 'Dibatalkan'] as $key => $label)
            <a href="{{ route('admin.payments.index', ['status' => $key === 'all' ? null : $key]) }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all {{ (request('status', 'all') === $key || (!request('status') && $key === 'all')) ? 'bg-cyan-500 text-white' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800' }}">{{ $label }}</a>
            @endforeach
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-900/50"><tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Booking</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Customer</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Metode</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Jumlah</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                </tr></thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700/50">
                    @forelse($payments as $payment)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/80 transition-colors">
                        <td class="px-6 py-4 text-sm font-mono text-cyan-600 dark:text-cyan-400">{{ $payment->booking->booking_code ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $payment->booking->user->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ ucfirst($payment->payment_method ?? '-') }}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-white">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                        <td class="px-6 py-4"><x-status-badge :status="$payment->status" type="payment" /></td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $payment->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada data pembayaran.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ $payments->withQueryString()->links() }}
</div>
@endsection
