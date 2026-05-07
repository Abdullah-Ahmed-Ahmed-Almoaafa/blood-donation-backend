<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// إعدادات Vercel - قبل بناء التطبيق
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
        // لا تنسى إعادة تعريف الميدل وير هنا لكي يعمل تطبيق Flutter
        $middleware->alias([
            'active' => \App\Http\Middleware\EnsureUserIsActive::class,
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();