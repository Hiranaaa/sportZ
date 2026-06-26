<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Supabase Configuration
    |--------------------------------------------------------------------------
    */

    'url' => env('SUPABASE_URL', ''),
    'anon_key' => env('SUPABASE_ANON_KEY', ''),
    'service_key' => env('SUPABASE_SERVICE_KEY', ''),

    'storage' => [
        'bucket' => env('SUPABASE_STORAGE_BUCKET', 'sportz'),
        'buckets' => [
            'avatars' => 'avatars',
            'courts' => 'courts',
            'payment_proofs' => 'payment-proofs',
            'reviews' => 'reviews',
            'banners' => 'banners',
        ],
    ],

    'realtime' => [
        'enabled' => env('SUPABASE_REALTIME_ENABLED', true),
    ],

];
