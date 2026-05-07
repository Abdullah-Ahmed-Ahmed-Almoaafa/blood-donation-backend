<?php

// إعدادات Vercel الإجبارية
putenv('VIEW_COMPILED_PATH=/tmp');
putenv('CACHE_STORE=array');
putenv('SESSION_DRIVER=cookie');
putenv('APP_STORAGE=/tmp');

$_ENV['VIEW_COMPILED_PATH'] = '/tmp';
$_ENV['CACHE_STORE'] = 'array';
$_ENV['SESSION_DRIVER'] = 'cookie';
$_ENV['APP_STORAGE'] = '/tmp';

// إعادة توجيه التخزين المؤقت
if (!defined('STORAGE_PATH')) {
    define('STORAGE_PATH', '/tmp');
}

require __DIR__ . '/../public/index.php';