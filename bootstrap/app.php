<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// هذه الأسطر قبل الـ return
if (isset($_SERVER['VERCEL_URL'])) {
    putenv('APP_STORAGE=/tmp');
    putenv('VIEW_COMPILED_PATH=/tmp');
    putenv('CACHE_STORE=array');
    putenv('SESSION_DRIVER=cookie');
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
    // استخدام المجلد المؤقت رسمياً
    ->withStorage(env('APP_STORAGE', base_path('storage'))) 
    ->create();