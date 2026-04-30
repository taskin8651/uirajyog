<?php

$projectRoot = '/home/rajyogreen/public_html';
$gitPath = '/usr/local/cpanel/3rdparty/lib/path-bin/git';
$phpPath = '/opt/cpanel/ea-php82/root/usr/bin/php';

if (!is_dir($projectRoot)) {
    http_response_code(500);
    exit('Project folder not found: ' . $projectRoot);
}

chdir($projectRoot);

echo '<pre>';
echo "Current folder: " . getcwd() . "\n\n";

echo "Git status:\n";
echo htmlspecialchars(shell_exec($gitPath . ' status 2>&1') ?? 'git status not working');

echo "\nGit pull:\n";
echo htmlspecialchars(shell_exec($gitPath . ' pull 2>&1') ?? 'git pull not working');

echo "\nLaravel cache clear:\n";
echo htmlspecialchars(shell_exec($phpPath . ' artisan optimize:clear 2>&1') ?? 'artisan not working');

echo '</pre>';