<?php

// GitHub webhook secret
$secret = 'mysecret';

// Verify GitHub signature
$payload = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';

if ($secret) {
    $hash = 'sha256=' . hash_hmac('sha256', $payload, $secret);

    if (!hash_equals($hash, $signature)) {
        http_response_code(403);
        exit('Invalid signature');
    }
}

// Correct project folder
$projectRoot = '/home/rajyogreen/public_html';

if (!is_dir($projectRoot)) {
    http_response_code(500);
    exit('Project folder not found');
}

chdir($projectRoot);

// Pull latest code
$output = shell_exec('git pull 2>&1');

// Laravel cache clear
$output .= "\n\n";
$output .= shell_exec('/opt/cpanel/ea-php82/root/usr/bin/php artisan optimize:clear 2>&1');

echo '<pre>';
echo htmlspecialchars($output);
echo '</pre>';