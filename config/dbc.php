<?php
return [
    'debug'        => env('APP_DEBUG', false),
    'appDir'       => app_path(),
    'cacheDir'     => storage_path('dbc'),
    'excludePaths' => [
        app_path('Admin'),
        app_path('Exceptions'),
        app_path('Providers'),
    ],
];