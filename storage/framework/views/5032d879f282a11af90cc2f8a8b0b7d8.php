
<section id="popular-courts" class="relative py-24 lg:py-32 bg-white dark:bg-navy-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4 mb-12 scroll-animate">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 text-sm font-medium mb-4">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z" /></svg>
                    Populer
                </div>
                <h2 class="font-heading text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white">
                    Lapangan <span class="text-gradient">Populer</span>
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Lapangan paling banyak dipesan oleh pengguna kami</p>
            </div>
            <a href="<?php echo e(route('courts.index')); ?>" class="btn-secondary text-sm flex-shrink-0">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
            </a>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($courts) && count($courts) > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $courts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $court): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="scroll-animate stagger-<?php echo e(($loop->index % 3) + 1); ?>">
                        <?php if (isset($component)) { $__componentOriginal98a0b87b7c1003a5cda27a05973fb424 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal98a0b87b7c1003a5cda27a05973fb424 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.court-card','data' => ['court' => $court]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('court-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['court' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($court)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal98a0b87b7c1003a5cda27a05973fb424)): ?>
<?php $attributes = $__attributesOriginal98a0b87b7c1003a5cda27a05973fb424; ?>
<?php unset($__attributesOriginal98a0b87b7c1003a5cda27a05973fb424); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal98a0b87b7c1003a5cda27a05973fb424)): ?>
<?php $component = $__componentOriginal98a0b87b7c1003a5cda27a05973fb424; ?>
<?php unset($__componentOriginal98a0b87b7c1003a5cda27a05973fb424); ?>
<?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php else: ?>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                    $demoCourts = [
                        (object)['id' => 1, 'name' => 'Lapangan Futsal A', 'sport_type' => 'futsal', 'price_per_hour' => 150000, 'average_rating' => 4.8, 'location' => 'Jakarta Selatan', 'image_url' => null, 'slug' => 'futsal-court-a'],
                        (object)['id' => 2, 'name' => 'Court Badminton Premium', 'sport_type' => 'badminton', 'price_per_hour' => 80000, 'average_rating' => 4.9, 'location' => 'Jakarta Selatan', 'image_url' => null, 'slug' => 'badminton-court-a'],
                        (object)['id' => 3, 'name' => 'Lapangan Basket Indoor', 'sport_type' => 'basket', 'price_per_hour' => 200000, 'average_rating' => 4.7, 'location' => 'Jakarta Selatan', 'image_url' => null, 'slug' => 'basket-court-a'],
                    ];
                ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $demoCourts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $court): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="scroll-animate stagger-<?php echo e($index + 1); ?>">
                        <?php if (isset($component)) { $__componentOriginal98a0b87b7c1003a5cda27a05973fb424 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal98a0b87b7c1003a5cda27a05973fb424 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.court-card','data' => ['court' => $court]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('court-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['court' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($court)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal98a0b87b7c1003a5cda27a05973fb424)): ?>
<?php $attributes = $__attributesOriginal98a0b87b7c1003a5cda27a05973fb424; ?>
<?php unset($__attributesOriginal98a0b87b7c1003a5cda27a05973fb424); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal98a0b87b7c1003a5cda27a05973fb424)): ?>
<?php $component = $__componentOriginal98a0b87b7c1003a5cda27a05973fb424; ?>
<?php unset($__componentOriginal98a0b87b7c1003a5cda27a05973fb424); ?>
<?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</section>
<?php /**PATH C:\laragon\www\sportZ\resources\views/landing/partials/popular-courts.blade.php ENDPATH**/ ?>