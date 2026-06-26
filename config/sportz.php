<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | SportZ Application Configuration
    |--------------------------------------------------------------------------
    |
    | Core configuration values for the SportZ booking platform.
    |
    */

    'booking_expire_minutes' => env('SPORTZ_BOOKING_EXPIRE_MINUTES', 60),

    'max_booking_hours' => env('SPORTZ_MAX_BOOKING_HOURS', 4),

    'operating_start' => env('SPORTZ_OPERATING_START', '06:00'),

    'operating_end' => env('SPORTZ_OPERATING_END', '23:00'),

    'currency' => env('SPORTZ_CURRENCY', 'IDR'),

    'currency_symbol' => env('SPORTZ_CURRENCY_SYMBOL', 'Rp'),

    'timezone' => env('APP_TIMEZONE', 'Asia/Jakarta'),

    'booking_code_prefix' => 'SPZ',

    'invoice_prefix' => 'INV',

    'items_per_page' => 15,

    'max_upload_size' => 2048, // KB

    'allowed_image_types' => ['jpg', 'jpeg', 'png', 'webp'],

];
