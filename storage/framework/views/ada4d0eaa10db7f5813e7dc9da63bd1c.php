<?php $__env->startSection('title', $court->name . ' - SportZ'); ?>
<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <a href="<?php echo e(route('courts.index')); ?>" class="inline-flex items-center gap-2 text-gray-500 hover:text-cyan-500 transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg> Kembali</a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            
            <div x-data="{ current: 0, images: <?php echo e(json_encode($court->images->pluck('image_path'))); ?> }" class="relative rounded-2xl overflow-hidden aspect-video bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800">
                <template x-for="(img, i) in images" :key="i"><img x-show="current === i" :src="img" :alt="'<?php echo e($court->name); ?>'" class="w-full h-full object-cover" x-transition></template>
                <template x-if="images.length === 0"><div class="w-full h-full flex items-center justify-center text-6xl"><?php echo e($court->sport->icon ?? '🏟️'); ?></div></template>
                <template x-if="images.length > 1">
                    <div><button @click="current = (current - 1 + images.length) % images.length" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/80 rounded-full flex items-center justify-center hover:bg-white transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></button><button @click="current = (current + 1) % images.length" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/80 rounded-full flex items-center justify-center hover:bg-white transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></button></div>
                </template>
            </div>

            
            <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <span class="inline-block px-3 py-1 bg-cyan-50 dark:bg-cyan-900/20 text-cyan-600 dark:text-cyan-400 text-xs font-semibold rounded-full mb-2"><?php echo e($court->sport->name ?? ''); ?></span>
                        <h1 class="font-heading text-2xl md:text-3xl font-bold text-gray-900 dark:text-white"><?php echo e($court->name); ?></h1>
                    </div>
                    <div class="text-right">
                        <p class="font-heading text-2xl font-bold text-cyan-600 dark:text-cyan-400">Rp <?php echo e(number_format($court->price_per_hour, 0, ',', '.')); ?></p>
                        <p class="text-sm text-gray-500">per jam</p>
                    </div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($court->reviews_avg_rating): ?><div class="flex items-center gap-2 mb-4"><span class="text-amber-500">⭐</span><span class="font-semibold text-gray-900 dark:text-white"><?php echo e(number_format($court->reviews_avg_rating, 1)); ?></span><span class="text-gray-400">(<?php echo e($court->reviews_count); ?> review)</span></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed"><?php echo e($court->description); ?></p>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($court->width && $court->length): ?><div class="flex gap-4 mt-4 text-sm text-gray-500"><span>📏 <?php echo e($court->width); ?>m × <?php echo e($court->length); ?>m</span><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($court->capacity): ?><span>👥 Max <?php echo e($court->capacity); ?> orang</span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50">
                <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-4">Fasilitas</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $court->facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center gap-2 p-3 bg-gray-50 dark:bg-gray-900/50 rounded-xl"><span><?php echo e($facility->icon); ?></span><span class="text-sm text-gray-700 dark:text-gray-300"><?php echo e($facility->name); ?></span></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            
            <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50">
                <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-4">Review (<?php echo e($court->reviews_count); ?>)</h3>
                <div class="space-y-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $court->reviews->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php if (isset($component)) { $__componentOriginal9c755b64b7bb8b6a080bedeeb703c319 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9c755b64b7bb8b6a080bedeeb703c319 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.review-card','data' => ['review' => $review]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('review-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['review' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($review)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9c755b64b7bb8b6a080bedeeb703c319)): ?>
<?php $attributes = $__attributesOriginal9c755b64b7bb8b6a080bedeeb703c319; ?>
<?php unset($__attributesOriginal9c755b64b7bb8b6a080bedeeb703c319); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9c755b64b7bb8b6a080bedeeb703c319)): ?>
<?php $component = $__componentOriginal9c755b64b7bb8b6a080bedeeb703c319; ?>
<?php unset($__componentOriginal9c755b64b7bb8b6a080bedeeb703c319); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-gray-500 text-center py-4">Belum ada review</p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="space-y-6">
            <div class="bg-white dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50 sticky top-24">
                <h3 class="font-heading font-bold text-gray-900 dark:text-white mb-4">Booking Lapangan Ini</h3>
                <a href="<?php echo e(route('customer.bookings.create')); ?>?court=<?php echo e($court->id); ?>" class="block w-full py-4 text-center bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-bold rounded-xl text-lg hover:shadow-xl hover:shadow-cyan-500/25 transition-all duration-300">Book Now 🏆</a>
                <p class="text-xs text-gray-400 text-center mt-3">Booking instan, konfirmasi otomatis</p>
                <hr class="my-4 border-gray-200 dark:border-gray-700">
                <h4 class="font-semibold text-gray-900 dark:text-white text-sm mb-3">Jam Operasional</h4>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $court->operatingHours->sortBy('day_of_week'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex justify-between text-sm py-1"><span class="text-gray-500"><?php echo e(['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'][$oh->day_of_week]); ?></span><span class="text-gray-900 dark:text-white"><?php echo e($oh->is_closed ? 'Tutup' : substr($oh->open_time, 0, 5) . ' - ' . substr($oh->close_time, 0, 5)); ?></span></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sportZ\resources\views/customer/courts/show.blade.php ENDPATH**/ ?>