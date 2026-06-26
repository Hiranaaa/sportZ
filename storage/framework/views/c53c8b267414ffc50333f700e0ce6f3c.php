
<section id="facilities" class="relative py-24 lg:py-32 bg-gray-50 dark:bg-navy-950/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-16 scroll-animate">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-cyan-50 dark:bg-cyan-500/10 text-cyan-600 dark:text-cyan-400 text-sm font-medium mb-4">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 00-2.455 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" /></svg>
                Fasilitas
            </div>
            <h2 class="font-heading text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                Fasilitas <span class="text-gradient">Lengkap</span>
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-400">
                Nikmati berbagai fasilitas premium yang kami sediakan untuk kenyamanan Anda
            </p>
        </div>

        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-6">
            <?php
                $facilities = [
                    ['icon' => 'car', 'name' => 'Area Parkir', 'desc' => 'Luas dan aman untuk kendaraan'],
                    ['icon' => 'wifi', 'name' => 'WiFi Gratis', 'desc' => 'Internet cepat di seluruh area'],
                    ['icon' => 'toilet', 'name' => 'Toilet Bersih', 'desc' => 'Toilet dan kamar mandi modern'],
                    ['icon' => 'mosque', 'name' => 'Musholla', 'desc' => 'Tempat ibadah yang nyaman'],
                    ['icon' => 'food', 'name' => 'Kantin', 'desc' => 'Makanan dan minuman tersedia'],
                    ['icon' => 'ac', 'name' => 'AC & Ventilasi', 'desc' => 'Ruangan sejuk dan nyaman'],
                    ['icon' => 'shower', 'name' => 'Shower Room', 'desc' => 'Air panas dan dingin tersedia'],
                    ['icon' => 'sound', 'name' => 'Sound System', 'desc' => 'Audio berkualitas tinggi'],
                ];
            ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="scroll-animate stagger-<?php echo e(($index % 6) + 1); ?>">
                    <div class="bg-white dark:bg-white/5 backdrop-blur-xl border border-gray-100 dark:border-white/10 rounded-2xl p-6 text-center hover:border-cyan-500/50 hover:shadow-lg hover:shadow-cyan-500/10 hover:-translate-y-1 transition-all duration-300 group h-full">
                        
                        <div class="w-14 h-14 rounded-2xl bg-gray-50 dark:bg-white/5 flex items-center justify-center mx-auto mb-4 group-hover:bg-cyan-50 dark:group-hover:bg-cyan-500/10 transition-colors duration-300">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php switch($facility['icon']):
                                case ('car'): ?>
                                    <svg class="w-7 h-7 text-gray-400 group-hover:text-cyan-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" /></svg>
                                    <?php break; ?>
                                <?php case ('wifi'): ?>
                                    <svg class="w-7 h-7 text-gray-400 group-hover:text-cyan-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.288 15.038a5.25 5.25 0 017.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 011.06 0z" /></svg>
                                    <?php break; ?>
                                <?php case ('toilet'): ?>
                                    <svg class="w-7 h-7 text-gray-400 group-hover:text-cyan-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" /></svg>
                                    <?php break; ?>
                                <?php case ('mosque'): ?>
                                    <svg class="w-7 h-7 text-gray-400 group-hover:text-cyan-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" /></svg>
                                    <?php break; ?>
                                <?php case ('food'): ?>
                                    <svg class="w-7 h-7 text-gray-400 group-hover:text-cyan-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.87c1.355 0 2.697.055 4.024.165C17.155 8.51 18 9.473 18 10.608v2.513m-3-4.87v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5m15-3.38a48.474 48.474 0 00-6-.371c-2.032 0-4.034.126-6 .37m12 .002l.893.45c.372.186.739.377 1.107.573v2.284a2.997 2.997 0 01-1.321 2.488A21.39 21.39 0 0112 21a21.39 21.39 0 01-7.679-1.403 2.997 2.997 0 01-1.321-2.488v-2.284c.368-.196.735-.387 1.107-.573L5 13.12" /></svg>
                                    <?php break; ?>
                                <?php case ('ac'): ?>
                                    <svg class="w-7 h-7 text-gray-400 group-hover:text-cyan-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" /></svg>
                                    <?php break; ?>
                                <?php case ('shower'): ?>
                                    <svg class="w-7 h-7 text-gray-400 group-hover:text-cyan-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" /></svg>
                                    <?php break; ?>
                                <?php case ('sound'): ?>
                                    <svg class="w-7 h-7 text-gray-400 group-hover:text-cyan-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z" /></svg>
                                    <?php break; ?>
                            <?php endswitch; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        
                        <h3 class="font-heading font-semibold text-gray-900 dark:text-white mb-1"><?php echo e($facility['name']); ?></h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400"><?php echo e($facility['desc']); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</section>
<?php /**PATH C:\laragon\www\sportZ\resources\views/landing/partials/facilities.blade.php ENDPATH**/ ?>