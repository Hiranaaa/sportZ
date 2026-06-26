@extends('layouts.admin')
@section('title', 'Laporan - SportZ')
@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Laporan</h1>
        <div class="flex gap-3">
            <a href="{{ route('admin.reports.export-pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-500 text-white rounded-xl text-sm font-medium hover:bg-red-600 transition-colors">📄 Export PDF</a>
            <a href="{{ route('admin.reports.export-excel', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-green-500 text-white rounded-xl text-sm font-medium hover:bg-green-600 transition-colors">📊 Export Excel</a>
        </div>
    </div>
    {{-- Date Filter --}}
    <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-4 border border-gray-100 dark:border-gray-700/50">
        <form action="{{ route('admin.reports.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
            <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Dari</label><input type="date" name="start_date" value="{{ $startDate }}" class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-cyan-500 text-sm"></div>
            <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sampai</label><input type="date" name="end_date" value="{{ $endDate }}" class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-cyan-500 text-sm"></div>
            <button type="submit" class="px-6 py-2.5 bg-cyan-500 text-white rounded-xl text-sm font-medium hover:bg-cyan-600 transition-colors">Tampilkan</button>
        </form>
    </div>
    {{-- Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <x-stat-card icon="calendar" label="Total Booking" :value="$bookingReport['total'] ?? 0" color="cyan" />
        <x-stat-card icon="currency" label="Total Pendapatan" :value="'Rp ' . number_format($revenueReport['total'] ?? 0, 0, ',', '.')" color="green" />
        <x-stat-card icon="check" label="Booking Selesai" :value="$bookingReport['completed'] ?? 0" color="blue" />
        <x-stat-card icon="chart" label="Rata-rata/Hari" :value="number_format($bookingReport['avg_per_day'] ?? 0, 1)" color="purple" />
    </div>
    {{-- Chart --}}
    <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50">
        <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-4">Trend Booking & Pendapatan</h3>
        <canvas id="reportChart" height="300"></canvas>
    </div>
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
<script>
new Chart(document.getElementById('reportChart'), { type: 'bar', data: { labels: {!! json_encode($revenueReport['labels'] ?? []) !!}, datasets: [{ label: 'Pendapatan (Rp)', data: {!! json_encode($revenueReport['data'] ?? []) !!}, backgroundColor: 'rgba(6,182,212,0.5)', borderColor: '#06b6d4', borderRadius: 8 }] }, options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } } });
</script>
@endpush
@endsection
