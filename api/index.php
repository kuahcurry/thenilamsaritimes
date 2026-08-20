<?php

/**
 * Vercel Serverless Entrypoint for Laravel
 */

// 1. Prepare writable /tmp directories on Serverless Lambda filesystem
$tmpStorage = '/tmp/storage';
$dirs = [
    $tmpStorage,
    $tmpStorage . '/framework',
    $tmpStorage . '/framework/views',
    $tmpStorage . '/framework/sessions',
    $tmpStorage . '/framework/cache',
    $tmpStorage . '/framework/cache/data',
    $tmpStorage . '/logs',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// 2. Set environment overrides for Serverless read-only filesystem
putenv("VIEW_COMPILED_PATH={$tmpStorage}/framework/views");
putenv("APP_CONFIG_CACHE={$tmpStorage}/config.php");
putenv("APP_SERVICES_CACHE={$tmpStorage}/services.php");
putenv("APP_PACKAGES_CACHE={$tmpStorage}/packages.php");
putenv("APP_ROUTES_CACHE={$tmpStorage}/routes.php");
putenv("APP_EVENTS_CACHE={$tmpStorage}/events.php");
putenv("SESSION_DRIVER=cookie");
putenv("LOG_CHANNEL=stderr");

// 3. SQLite database handling for Serverless
$dbConn = getenv('DB_CONNECTION') ?: 'sqlite';
if ($dbConn === 'sqlite') {
    $tmpDb = '/tmp/database.sqlite';
    $sourceDb = __DIR__ . '/../database/database.sqlite';
    
    if (!file_exists($tmpDb)) {
        if (file_exists($sourceDb) && filesize($sourceDb) > 0) {
            copy($sourceDb, $tmpDb);
        } else {
            touch($tmpDb);
        }
    }
    putenv("DB_DATABASE={$tmpDb}");
    $_ENV['DB_DATABASE'] = $tmpDb;
    $_SERVER['DB_DATABASE'] = $tmpDb;
}

// 4. Delegate to Laravel's front controller
require __DIR__ . '/../public/index.php';
