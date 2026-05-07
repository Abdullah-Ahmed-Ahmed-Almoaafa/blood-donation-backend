<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BloodRequestController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\PasswordResetController;
use App\Http\Controllers\Api\DonationController;
use App\Http\Controllers\Api\DeviceController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\Admin\ReportController;

// ============================
// المسارات العامة (Public Routes)
// ============================
Route::post('/register', [AuthController::class, 'register'])->name('api.register');
Route::post('/login', [AuthController::class, 'login'])->name('api.login');
Route::post('/login-biometric', [AuthController::class, 'loginWithBiometric']);

Route::prefix('password')->name('api.password.')->group(function () {
    Route::post('forgot', [PasswordResetController::class, 'sendOtp'])
        ->middleware('throttle:otp-send')
        ->name('forgot');
    Route::post('verify', [PasswordResetController::class, 'verifyOtp'])
        ->middleware('throttle:otp-verify')
        ->name('verify');
    Route::post('reset', [PasswordResetController::class, 'resetPassword'])->name('reset');
    Route::post('resend', [PasswordResetController::class, 'resendOtp'])
        ->middleware('throttle:otp-send')
        ->name('resend');
});

// ============================
// المسارات المحمية (Protected Routes)
// ============================
Route::middleware(['auth:sanctum', 'active', 'throttle:api'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->name('api.user');

    // ============================
    // مسارات البصمة (Biometric)
    // ============================
    Route::post('/enable-biometric', [AuthController::class, 'enableBiometric']);
    Route::post('/disable-biometric', [AuthController::class, 'disableBiometric']);

    // ============================
    // مسارات طلبات الدم (Blood Requests)
    // ============================
    Route::prefix('requests')->name('api.requests.')->group(function () {
        Route::get('/general', [BloodRequestController::class, 'index'])->name('general');
        Route::get('/my-requests', [BloodRequestController::class, 'myRequests'])->name('my-requests');
        Route::get('/{id}', [BloodRequestController::class, 'show'])->name('show');

        Route::post('/create', [BloodRequestController::class, 'store'])
            ->middleware('throttle:blood-requests')
            ->name('create');

        Route::put('/{id}', [BloodRequestController::class, 'update'])->name('update');
        Route::delete('/{id}', [BloodRequestController::class, 'destroy'])->name('destroy');

        Route::post('/{id}/accept', [BloodRequestController::class, 'acceptRequest'])
            ->middleware('throttle:donations')
            ->name('accept');

        Route::get('/{requestId}/donations', [BloodRequestController::class, 'getRequestDonations'])->name('donations.index');
        Route::post('/{requestId}/donations/{donationId}/confirm', [BloodRequestController::class, 'confirmDonation'])->name('donations.confirm');
        Route::post('/{requestId}/donations/{donationId}/reject', [BloodRequestController::class, 'rejectDonation'])->name('donations.reject');
    });

    // ============================
    // مسارات التبرعات (Donations)
    // ============================
    Route::prefix('donations')->name('api.donations.')->group(function () {
        Route::get('/', [DonationController::class, 'index'])->name('index');
        Route::get('/{id}', [DonationController::class, 'show'])->name('show');
        Route::post('/{id}/cancel', [DonationController::class, 'cancel'])->name('cancel');
    });

    // ============================
    // مسارات الاشعارات
    // ============================
    Route::prefix('notifications')->name('api.notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::post('/{id}/read', [NotificationController::class, 'markAsRead'])->name('read');
        Route::post('/read-all', [NotificationController::class, 'markAllRead'])->name('read-all');
    });

    // ============================
    // مسارات الملف الشخصي
    // ============================
    Route::prefix('profile')->name('api.profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password'); // المسار الصحيح
        Route::post('/image', [ProfileController::class, 'uploadImage'])->name('image');
        Route::post('/location', [ProfileController::class, 'updateLocation'])->name('location');
        Route::post('/visit-requests', [ProfileController::class, 'updateLastVisit'])->name('visit-requests');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // ============================
    // مسارات الأجهزة
    // ============================
    Route::prefix('devices')->name('api.devices.')->group(function () {
        Route::post('/register', [DeviceController::class, 'register'])->name('register');
        Route::post('/unregister', [DeviceController::class, 'unregister'])->name('unregister');
    });

    // ============================
    // مسارات الأدمن والتقارير
    // ============================
    Route::get('/reports/donors/export', [ReportController::class, 'exportDonors'])
        ->middleware('role:admin')
        ->name('reports.donors.export');

    });