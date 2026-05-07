<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\UpdateDonationAvailability;
use App\Console\Commands\ExpireBloodRequests;
use Illuminate\Support\Facades\DB;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('donation:update-availability', function () {
    $this->info('بدء تحديث أهلية التبرع...');
    $exitCode = $this->call(UpdateDonationAvailability::class);
    if ($exitCode === 0) {
        $this->info('تم تحديث أهلية التبرع بنجاح');
    } else {
        $this->error('فشل تحديث أهلية التبرع');
    }
})->describe('تحديث حالة أهلية المستخدمين للتبرع');

// جدولة تحديث الأهلية
Schedule::command('donation:update-availability')
    ->dailyAt('00:00')
    ->timezone('Asia/Aden')
    ->withoutOverlapping()
    ->appendOutputTo(storage_path('logs/donation-update.log'));

// أمر إنهاء الطلبات منتهية الصلاحية
Artisan::command('blood-requests:expire', function () {
    $this->call(ExpireBloodRequests::class);
})->describe('إنهاء طلبات التبرع منتهية الصلاحية');

// جدولة إنهاء الطلبات منتهية الصلاحية
Schedule::command('blood-requests:expire')->daily();

// تنظيف جدول password_reset_tokens
Schedule::call(function () {
    DB::table('password_reset_tokens')
        ->where(function ($query) {
            $query->whereNotNull('used_at')
                ->orWhere('reset_expires_at', '<', now())
                ->orWhere('otp_expires_at', '<', now()->subMinutes(30));
        })
        ->delete();
})->daily();

// تنظيف توكنات Sanctum المنتهية
Schedule::command('sanctum:clean-expired-tokens')->daily();