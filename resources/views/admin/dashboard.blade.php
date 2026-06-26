@extends('layouts.admin')
@section('title', 'Dashboard Admin - SportZ')
@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="font-heading text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Selamat datang, {{ auth()->user()->name }}! 👋</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-sm text-gray-500">{{ now()->translatedFormat('l, d F Y') }}</span>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
        <x-stat-card icon="users" label="Total Customer" :value="number_format($stats['total_customers'] ?? 0)" color="cyan" />
        <x-stat-card icon="calendar" label="Total Booking" :value="number_format($stats['total_bookings'] ?? 0)" color="blue" />
        <x-stat-card icon="currency" label="Pendapatan Hari Ini" :value="'Rp ' . number_format($stats['today_revenue'] ?? 0, 0, ',', '.')" color="green" />
        <x-stat-card icon="chart" label="Pendapatan Bulan Ini" :value="'Rp ' . number_format($stats['monthly_revenue'] ?? 0, 0, ',', '.')" color="purple" />
        <x-stat-card icon="check" label="Lapangan Aktif" :value="$stats['active_courts'] ?? 0" color="emerald" />
        <x-stat-card icon="wrench" label="Maintenance" :value="$stats['maintenance_courts'] ?? 0" color="amber" />
    </div>

    {{-- Charts Row --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50 shadow-sm">
            <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-4">Booking Harian (7 Hari Terakhir)</h3>
            <canvas id="bookingChart" height="250"></canvas>
        </div>
        <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50 shadow-sm">
            <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-4">Pendapatan Bulanan</h3>
            <canvas id="revenueChart" height="250"></canvas>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50 shadow-sm">
            <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-4">Jam Terfavorit</h3>
            <canvas id="hourChart" height="250"></canvas>
        </div>
        <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50 shadow-sm">
            <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-4">Distribusi Olahraga</h3>
            <canvas id="sportChart" height="250"></canvas>
        </div>
    </div>

    {{-- Recent Bookings --}}
    <div class="bg-white dark:bg-gray-800/50 rounded-2xl border border-gray-100 dark:border-gray-700/50 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 dark:border-gray-700/50 flex items-center justify-between">
            <h3 class="font-heading font-bold text-gray-900 dark:text-white">Booking Terbaru</h3>
            <a href="{{ route('admin.bookings.index') }}" class="text-sm text-cyan-500 hover:text-cyan-400 font-medium">Lihat Semua →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-900/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Lapangan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700/50">
                    @forelse($stats['recent_bookings'] ?? [] as $booking)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/80 transition-colors">
                        <td class="px-6 py-4 text-sm font-mono font-semibold text-cyan-600 dark:text-cyan-400">{{ $booking->booking_code }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $booking->user->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $booking->court->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-white">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</td>
                        <td class="px-6 py-4"><x-status-badge :status="$booking->status" /></td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada booking.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
<script>
    const chartColors = { cyan: '#06b6d4', blue: '#3b82f6', purple: '#8b5cf6', green: '#10b981', amber: '#f59e0b', red: '#ef4444' };
    const darkMode = document.documentElement.classList.contains('dark');
    const gridColor = darkMode ? 'rgba(255,255,255,0.06)' : 'rgba(0,0,0,0.06)';
    const textColor = darkMode ? '#9ca3af' : '#6b7280';

    // Booking Chart
    new Chart(document.getElementById('bookingChart'), {
        type: 'line',
        data: { labels: {!! json_encode($bookingChart['labels'] ?? ['Sen','Sel','Rab','Kam','Jum','Sab','Min']) !!}, datasets: [{ label: 'Booking', data: {!! json_encode($bookingChart['data'] ?? [0,0,0,0,0,0,0]) !!}, borderColor: chartColors.cyan, backgroundColor: 'rgba(6,182,212,0.1)', fill: true, tension: 0.4, pointRadius: 4, pointBackgroundColor: chartColors.cyan }] },
        options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, grid: { color: gridColor }, ticks: { color: textColor } }, x: { grid: { display: false }, ticks: { color: textColor } } } }
    });

    // Revenue Chart
    new Chart(document.getElementById('revenueChart'), {
        type: 'bar',
        data: { labels: {!! json_encode($revenueChart['labels'] ?? ['Jan','Feb','Mar','Apr','May','Jun']) !!}, datasets: [{ label: 'Pendapatan', data: {!! json_encode($revenueChart['data'] ?? [0,0,0,0,0,0]) !!}, backgroundColor: [chartColors.cyan, chartColors.blue, chartColors.purple, chartColors.green, chartColors.amber, chartColors.cyan], borderRadius: 8 }] },
        options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, grid: { color: gridColor }, ticks: { color: textColor, callback: v => 'Rp ' + (v/1000) + 'K' } }, x: { grid: { display: false }, ticks: { color: textColor } } } }
    });

    // Hour Chart
    new Chart(document.getElementById('hourChart'), {
        type: 'polarArea',
        data: { labels: {!! json_encode($hourChart['labels'] ?? ['08:00','09:00','10:00','17:00','19:00','20:00']) !!}, datasets: [{ data: {!! json_encode($hourChart['data'] ?? [5,8,6,12,15,10]) !!}, backgroundColor: ['rgba(6,182,212,0.6)','rgba(59,130,246,0.6)','rgba(139,92,246,0.6)','rgba(16,185,129,0.6)','rgba(245,158,11,0.6)','rgba(239,68,68,0.6)'] }] },
        options: { responsive: true, plugins: { legend: { position: 'right', labels: { color: textColor } } } }
    });

    // Sport Chart
    new Chart(document.getElementById('sportChart'), {
        type: 'doughnut',
        data: { labels: {!! json_encode($sportChart['labels'] ?? ['Futsal','Badminton']) !!}, datasets: [{ data: {!! json_encode($sportChart['data'] ?? [60,40]) !!}, backgroundColor: [chartColors.cyan, chartColors.purple], borderWidth: 0 }] },
        options: { responsive: true, cutout: '65%', plugins: { legend: { position: 'bottom', labels: { color: textColor, padding: 20 } } } }
    });
</script>
@endpush
@endsection
