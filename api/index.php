<?php

putenv('APP_ENV=production');
putenv('APP_DEBUG=true');
putenv('APP_STORAGE=/tmp');
putenv('VIEW_COMPILED_PATH=/tmp');
putenv('SESSION_DRIVER=cookie');
putenv('CACHE_STORE=array');
putenv('LOG_CHANNEL=stderr');

require __DIR__ . '/../public/index.php';