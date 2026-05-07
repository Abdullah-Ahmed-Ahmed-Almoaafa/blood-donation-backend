<?php
// إجبار النظام على استخدام المجلد المؤقت في Vercel
$_ENV['APP_STORAGE'] = '/tmp';
$_ENV['APP_CONFIG_CACHE'] = '/tmp/config.php';
$_ENV['APP_ROUTES_CACHE'] = '/tmp/routes.php';
$_ENV['APP_SERVICES_CACHE'] = '/tmp/services.php';
$_ENV['APP_PACKAGES_CACHE'] = '/tmp/packages.php';

require __DIR__ . '/../public/index.php';