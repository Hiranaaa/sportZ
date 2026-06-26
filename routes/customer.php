<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer;

Route::prefix('customer')->name('customer.')->middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/dashboard', [Customer\DashboardController::class, 'index'])->name('dashboard');

    // Bookings
    Route::get('/bookings', [Customer\BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [Customer\BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [Customer\BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{id}', [Customer\BookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings/{id}/cancel', [Customer\BookingController::class, 'cancel'])->name('bookings.cancel');

    // Payments
    Route::get('/payments/{bookingId}/process', [Customer\PaymentController::class, 'process'])->name('payments.process');
    Route::get('/payments/success', [Customer\PaymentController::class, 'success'])->name('payments.success');
    Route::get('/payments/failed', [Customer\PaymentController::class, 'failed'])->name('payments.failed');

    // Reviews
    Route::post('/reviews', [Customer\ReviewController::class, 'store'])->name('reviews.store');

    // Favorites
    Route::get('/favorites', [Customer\FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/{courtId}', [Customer\FavoriteController::class, 'toggle'])->name('favorites.toggle');

    // Notifications
    Route::get('/notifications', [Customer\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [Customer\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [Customer\NotificationController::class, 'markAllRead'])->name('notifications.read-all');

    // Profile
    Route::get('/profile', [Customer\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [Customer\ProfileController::class, 'update'])->name('profile.update');

    // Invoices
    Route::get('/invoices/{id}', [Customer\InvoiceController::class, 'show'])->name('invoices.show');
    Route::get('/invoices/{id}/download', [Customer\InvoiceController::class, 'download'])->name('invoices.download');
});
