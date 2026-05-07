<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// إعدادات Vercel - منع الكتابة على نظام الملفات قبل تشغيل التطبيق
if (function_exists('putenv')) {
    putenv('VIEW_COMPILED_PATH=/tmp');
    putenv('CACHE_STORE=array');
    putenv('SESSION_DRIVER=cookie');
    putenv('APP_STORAGE=/tmp');
}

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'active' => \App\Http\Middleware\EnsureUserIsActive::class,
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->registered(function ($app) {
        // الحل الحاسم لمشكلة bootstrap/cache: توجيهه للمجلد المؤقت
        if (isset($_SERVER['VERCEL_URL'])) {
            $app->useBootstrapPath('/tmp');
        }
    })
    ->create();