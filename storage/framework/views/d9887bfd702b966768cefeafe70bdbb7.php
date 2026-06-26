<!DOCTYPE html>
<html lang="id" x-data :class="$store.theme.dark ? 'dark' : ''">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    
    <title><?php echo $__env->yieldContent('title', 'SportZ - Book Your Game, Anytime'); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('description', 'SportZ - Platform booking lapangan olahraga premium. Pesan lapangan futsal, badminton, basket, tenis & voli dengan mudah dan cepat.'); ?>">
    <meta name="keywords" content="booking lapangan, futsal, badminton, basket, tenis, olahraga, SportZ">
    <meta name="author" content="SportZ">

    
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo $__env->yieldContent('title', 'SportZ - Book Your Game, Anytime'); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('description', 'Platform booking lapangan olahraga premium terbaik'); ?>">
    <meta property="og:image" content="<?php echo $__env->yieldContent('og_image', asset('images/og-image.jpg')); ?>">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:site_name" content="SportZ">

    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $__env->yieldContent('title', 'SportZ - Book Your Game, Anytime'); ?>">
    <meta name="twitter:description" content="<?php echo $__env->yieldContent('description', 'Platform booking lapangan olahraga premium terbaik'); ?>">

    
    <link rel="icon" type="image/svg+xml" href="<?php echo e(asset('favicon.svg')); ?>">
    <link rel="apple-touch-icon" href="<?php echo e(asset('apple-touch-icon.png')); ?>">

    
    <link rel="manifest" href="<?php echo e(asset('manifest.json')); ?>">
    <meta name="theme-color" content="#0a1628">

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>


    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="min-h-screen bg-white dark:bg-navy-950 text-gray-900 dark:text-gray-100 font-sans antialiased transition-colors duration-300"
      x-init="$store.theme.init()">

    
    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-[9999] btn-primary">
        Skip to content
    </a>

    
    <?php echo $__env->yieldContent('body'); ?>

    
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>


    
    <?php echo $__env->yieldPushContent('scripts'); ?>

    
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js').catch(() => {});
            });
        }
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\sportZ\resources\views/layouts/app.blade.php ENDPATH**/ ?>