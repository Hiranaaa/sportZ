<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookingSlotController;
use App\Http\Controllers\Api\MidtransWebhookController;
use App\Http\Controllers\Api\WeatherController;

Route::get('/slots', [BookingSlotController::class, 'getSlots']);
Route::post('/midtrans/webhook', [MidtransWebhookController::class, 'handle']);
Route::get('/weather', [WeatherController::class, 'forecast']);
