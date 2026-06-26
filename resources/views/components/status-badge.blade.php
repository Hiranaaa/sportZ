@props(['status', 'type' => 'booking'])

@php
    // Convert enum to string if needed
    $statusValue = $status instanceof \BackedEnum ? $status->value : (string) $status;

    $bookingClasses = [
        'pending'   => 'badge-warning',
        'confirmed' => 'badge-success',
        'checked_in'=> 'badge-info',
        'completed' => 'badge-info',
        'cancelled' => 'badge-danger',
        'expired'   => 'badge-neutral',
        'no_show'   => 'badge-neutral',
    ];

    $paymentClasses = [
        'pending'    => 'badge-warning',
        'paid'       => 'badge-success',
        'failed'     => 'badge-danger',
        'refunded'   => 'badge-neutral',
        'expired'    => 'badge-neutral',
    ];

    $bookingLabels = [
        'pending'    => 'Menunggu',
        'confirmed'  => 'Dikonfirmasi',
        'checked_in' => 'Check-in',
        'completed'  => 'Selesai',
        'cancelled'  => 'Dibatalkan',
        'expired'    => 'Kedaluwarsa',
        'no_show'    => 'Tidak Hadir',
    ];

    $paymentLabels = [
        'pending'    => 'Belum Bayar',
        'paid'       => 'Lunas',
        'failed'     => 'Gagal',
        'refunded'   => 'Refund',
        'expired'    => 'Kedaluwarsa',
    ];

    $classes = $type === 'payment' ? $paymentClasses : $bookingClasses;
    $labels = $type === 'payment' ? $paymentLabels : $bookingLabels;

    $badgeClass = $classes[strtolower($statusValue)] ?? 'badge-neutral';
    $label = $labels[strtolower($statusValue)] ?? ucfirst($statusValue);
@endphp

<span {{ $attributes->merge(['class' => $badgeClass]) }}>
    {{-- Status Dot --}}
    @php
        $dotColor = match(strtolower($statusValue)) {
            'pending' => 'bg-amber-500',
            'confirmed', 'paid' => 'bg-emerald-500',
            'checked_in', 'completed' => 'bg-cyan-500',
            'cancelled', 'failed' => 'bg-rose-500',
            default => 'bg-gray-500',
        };
    @endphp
    <span class="w-1.5 h-1.5 rounded-full {{ $dotColor }}"></span>
    {{ $label }}
</span>
