<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['court']));

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

foreach (array_filter((['court']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<a href="<?php echo e(route('courts.show', $court->slug ?? '')); ?>" class="group block">
    <div class="card-hover rounded-2xl overflow-hidden">
        
        <div class="relative aspect-video overflow-hidden">
            <img
                src="<?php echo e($court->image_url ?? asset('images/courts/default.jpg')); ?>"
                alt="<?php echo e($court->name ?? 'Lapangan'); ?>"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                loading="lazy"
            >
            
            <div class="absolute top-3 left-3">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-full bg-white/90 dark:bg-navy-900/90 backdrop-blur-sm text-gray-900 dark:text-white shadow-sm">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php switch($court->sport_type ?? 'futsal'):
                        case ('futsal'): ?> ⚽ Futsal <?php break; ?>
                        <?php case ('badminton'): ?> 🏸 Badminton <?php break; ?>
                        <?php case ('basket'): ?> 🏀 Basket <?php break; ?>
                        <?php case ('tenis'): ?> 🎾 Tenis <?php break; ?>
                        <?php case ('voli'): ?> 🏐 Voli <?php break; ?>
                        <?php default: ?> 🏟️ <?php echo e(ucfirst($court->sport_type ?? 'Sport')); ?>

                    <?php endswitch; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </span>
            </div>
            
            <button class="absolute top-3 right-3 w-9 h-9 rounded-full bg-white/90 dark:bg-navy-900/90 backdrop-blur-sm flex items-center justify-center text-gray-400 hover:text-rose-500 transition-colors duration-200 shadow-sm" onclick="event.preventDefault(); event.stopPropagation();">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" /></svg>
            </button>
            
            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
        </div>

        
        <div class="p-5">
            
            <h3 class="font-heading font-semibold text-lg text-gray-900 dark:text-white group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors duration-200 line-clamp-1">
                <?php echo e($court->name ?? 'Nama Lapangan'); ?>

            </h3>

            
            <div class="flex items-center gap-1.5 mt-1.5 text-sm text-gray-500 dark:text-gray-400">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                <span class="line-clamp-1"><?php echo e($court->location ?? 'Jakarta Selatan'); ?></span>
            </div>

            
            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100 dark:border-white/5">
                
                <div>
                    <span class="text-xl font-heading font-bold text-gray-900 dark:text-white">
                        Rp <?php echo e(number_format($court->price_per_hour ?? 0, 0, ',', '.')); ?>

                    </span>
                    <span class="text-sm text-gray-400">/jam</span>
                </div>

                
                <div class="flex items-center gap-1.5">
                    <div class="flex items-center gap-0.5">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 1; $i <= 5; $i++): ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($i <= floor($court->average_rating ?? 0)): ?>
                                <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 24 24"><path d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" /></svg>
                            <?php else: ?>
                                <svg class="w-4 h-4 text-gray-200 dark:text-gray-600" fill="currentColor" viewBox="0 0 24 24"><path d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" /></svg>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <span class="text-sm font-medium text-gray-600 dark:text-gray-400"><?php echo e(number_format($court->average_rating ?? 0, 1)); ?></span>
                </div>
            </div>
        </div>
    </div>
</a>
<?php /**PATH C:\laragon\www\sportZ\resources\views/components/court-card.blade.php ENDPATH**/ ?>