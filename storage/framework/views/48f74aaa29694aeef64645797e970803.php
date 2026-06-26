<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['status', 'type' => 'booking']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['status', 'type' => 'booking']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
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
?>

<span <?php echo e($attributes->merge(['class' => $badgeClass])); ?>>
    
    <?php
        $dotColor = match(strtolower($statusValue)) {
            'pending' => 'bg-amber-500',
            'confirmed', 'paid' => 'bg-emerald-500',
            'checked_in', 'completed' => 'bg-cyan-500',
            'cancelled', 'failed' => 'bg-rose-500',
            default => 'bg-gray-500',
        };
    ?>
    <span class="w-1.5 h-1.5 rounded-full <?php echo e($dotColor); ?>"></span>
    <?php echo e($label); ?>

</span>
<?php /**PATH C:\laragon\www\sportZ\resources\views/components/status-badge.blade.php ENDPATH**/ ?>