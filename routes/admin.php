<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Courts CRUD
    Route::resource('courts', Admin\CourtController::class);
    Route::post('/courts/{id}/toggle-maintenance', [Admin\CourtController::class, 'toggleMaintenance'])->name('courts.toggle-maintenance');

    // Bookings
    Route::get('/bookings', [Admin\BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{id}', [Admin\BookingController::class, 'show'])->name('bookings.show');
    Route::patch('/bookings/{id}/status', [Admin\BookingController::class, 'updateStatus'])->name('bookings.update-status');
    Route::post('/bookings/{id}/check-in', [Admin\BookingController::class, 'checkIn'])->name('bookings.check-in');

    // Payments
    Route::get('/payments', [Admin\PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{id}', [Admin\PaymentController::class, 'show'])->name('payments.show');

    // Promotions
    Route::get('/promotions', [Admin\PromotionController::class, 'index'])->name('promotions.index');
    Route::post('/promotions', [Admin\PromotionController::class, 'store'])->name('promotions.store');
    Route::put('/promotions/{id}', [Admin\PromotionController::class, 'update'])->name('promotions.update');
    Route::delete('/promotions/{id}', [Admin\PromotionController::class, 'destroy'])->name('promotions.destroy');

    // Vouchers
    Route::get('/vouchers', [Admin\VoucherController::class, 'index'])->name('vouchers.index');
    Route::post('/vouchers', [Admin\VoucherController::class, 'store'])->name('vouchers.store');
    Route::put('/vouchers/{id}', [Admin\VoucherController::class, 'update'])->name('vouchers.update');
    Route::delete('/vouchers/{id}', [Admin\VoucherController::class, 'destroy'])->name('vouchers.destroy');

    // Reviews
    Route::get('/reviews', [Admin\ReviewController::class, 'index'])->name('reviews.index');
    Route::post('/reviews/{id}/reply', [Admin\ReviewController::class, 'reply'])->name('reviews.reply');

    // Users
    Route::get('/users', [Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [Admin\UserController::class, 'show'])->name('users.show');

    // Reports
    Route::get('/reports', [Admin\ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export-pdf', [Admin\ReportController::class, 'exportPdf'])->name('reports.export-pdf');
    Route::get('/reports/export-excel', [Admin\ReportController::class, 'exportExcel'])->name('reports.export-excel');

    // CMS
    Route::get('/banners', [Admin\BannerController::class, 'index'])->name('banners.index');
    Route::post('/banners', [Admin\BannerController::class, 'store'])->name('banners.store');
    Route::put('/banners/{id}', [Admin\BannerController::class, 'update'])->name('banners.update');
    Route::delete('/banners/{id}', [Admin\BannerController::class, 'destroy'])->name('banners.destroy');

    Route::get('/faqs', [Admin\FaqController::class, 'index'])->name('faqs.index');
    Route::post('/faqs', [Admin\FaqController::class, 'store'])->name('faqs.store');
    Route::put('/faqs/{id}', [Admin\FaqController::class, 'update'])->name('faqs.update');
    Route::delete('/faqs/{id}', [Admin\FaqController::class, 'destroy'])->name('faqs.destroy');

    Route::get('/testimonials', [Admin\TestimonialController::class, 'index'])->name('testimonials.index');
    Route::post('/testimonials', [Admin\TestimonialController::class, 'store'])->name('testimonials.store');
    Route::put('/testimonials/{id}', [Admin\TestimonialController::class, 'update'])->name('testimonials.update');
    Route::delete('/testimonials/{id}', [Admin\TestimonialController::class, 'destroy'])->name('testimonials.destroy');

    // Settings
    Route::get('/settings', [Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [Admin\SettingController::class, 'update'])->name('settings.update');

    // Activity Logs
    Route::get('/activity-logs', [Admin\ActivityLogController::class, 'index'])->name('activity-logs.index');
});
