<?php
// Path to the Laravel public directory
$public_path = __DIR__ . '/../public';

// Path to Laravel's index.php
$index_file = $public_path . '/index.php';

// Ensure the requested file exists in the public directory
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$requested_file = $public_path . $uri;

// Set Vercel environment variable
$_ENV['VERCEL'] = '1';
putenv('VERCEL=1');

// Create temporary directories for Laravel
$tmpDir = '/tmp';
if (!is_dir($tmpDir . '/storage/framework/views')) {
    mkdir($tmpDir . '/storage/framework/views', 0755, true);
}
if (!is_dir($tmpDir . '/storage/framework/cache')) {
    mkdir($tmpDir . '/storage/framework/cache', 0755, true);
}
if (!is_dir($tmpDir . '/storage/framework/sessions')) {
    mkdir($tmpDir . '/storage/framework/sessions', 0755, true);
}
if (!is_dir($tmpDir . '/storage/logs')) {
    mkdir($tmpDir . '/storage/logs', 0755, true);
}

// Check if the file exists and isn't a directory
if ($uri !== '/' && file_exists($requested_file) && !is_dir($requested_file)) {
    // Return the file directly
    return false;
}

// Otherwise, include the Laravel index.php
require $index_file;