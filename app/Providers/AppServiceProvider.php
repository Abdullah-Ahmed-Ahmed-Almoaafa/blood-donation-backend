<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
// ✅ 1. استيراد المودل والـ Observer
use App\Models\BloodRequest;
use App\Observers\BloodRequestObserver;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // ============================
        // إعدادات Rate Limiting
        // ============================
        
        RateLimiter::for('otp-send', function (Request $request) {
        return Limit::perHour(3)->by($request->email . $request->ip())
            ->response(function () {
                return response()->json([
                    'message' => 'لقد تجاوزت عدد المحاولات المسموح بها. يرجى المحاولة بعد ساعة.'
                ], 429);
            });
         });

        RateLimiter::for('otp-verify', function (Request $request) {
            return Limit::perMinute(5)->by($request->email . $request->ip())
                ->response(function () {
                    return response()->json([
                        'message' => 'لقد تجاوزت عدد محاولات التحقق المسموح بها. يرجى المحاولة بعد دقيقة.'
                    ], 429);
                });
        });

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        RateLimiter::for('blood-requests', function (Request $request) {
            return Limit::perHour(5)->by($request->user()->id);
        });

        RateLimiter::for('donations', function (Request $request) {
            return Limit::perHour(10)->by($request->user()->id);
        });
        
    }
}