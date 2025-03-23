<?php

/*
|--------------------------------------------------------------------------
| Configure Laravel for Vercel
|--------------------------------------------------------------------------
|
| This file sets up Laravel for running on Vercel's serverless platform.
| It ensures logs go to stderr instead of files and configures temp dirs.
|
*/

// Override the storage path if running on Vercel
if (isset($_ENV['VERCEL']) && $_ENV['VERCEL'] === '1') {
    // Set storage path to /tmp for Vercel
    $app->useStoragePath('/tmp/storage');
}

// Create storage directory structure if it doesn't exist
if (!is_dir('/tmp/storage/framework/views')) {
    mkdir('/tmp/storage/framework/views', 0755, true);
}

if (!is_dir('/tmp/storage/framework/cache')) {
    mkdir('/tmp/storage/framework/cache', 0755, true);
}

if (!is_dir('/tmp/storage/framework/sessions')) {
    mkdir('/tmp/storage/framework/sessions', 0755, true);
}

// Add any other required directories
if (!is_dir('/tmp/storage/logs')) {
    mkdir('/tmp/storage/logs', 0755, true);
}

return $app;