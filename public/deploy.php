<?php

// Project folder path
$projectRoot = '/home/rajyogreen/public_html';

if (!is_dir($projectRoot)) {
    http_response_code(500);
    exit('Project folder not found: ' . $projectRoot);
}

chdir($projectRoot);

echo '<pre>';

echo "Current folder: " . getcwd() . "\n\n";

echo "Git pull:\n";
$output = shell_exec('git pull 2>&1');
echo htmlspecialchars($output);

echo "\nLaravel cache clear:\n";
$cache = shell_exec('/opt/cpanel/ea-php82/root/usr/bin/php artisan optimize:clear 2>&1');
echo htmlspecialchars($cache);

echo '</pre>';