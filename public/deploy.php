<?php

$projectRoot = '/home/rajyogreen/public_html';

if (!is_dir($projectRoot)) {
    http_response_code(500);
    exit('Project folder not found: ' . $projectRoot);
}

chdir($projectRoot);

echo '<pre>';
echo "Current folder: " . getcwd() . "\n\n";

echo "Whoami:\n";
echo htmlspecialchars(shell_exec('whoami 2>&1') ?? 'shell_exec not working');

echo "\nPHP user:\n";
echo htmlspecialchars(get_current_user());

echo "\n\nGit path:\n";
echo htmlspecialchars(shell_exec('which git 2>&1') ?? 'git not found');

echo "\nGit version:\n";
echo htmlspecialchars(shell_exec('git --version 2>&1') ?? 'git version not working');

echo "\nGit status:\n";
echo htmlspecialchars(shell_exec('git status 2>&1') ?? 'git status not working');

echo "\nGit pull:\n";
echo htmlspecialchars(shell_exec('git pull 2>&1') ?? 'git pull not working');

echo "\nLaravel cache clear:\n";
echo htmlspecialchars(shell_exec('/opt/cpanel/ea-php82/root/usr/bin/php artisan optimize:clear 2>&1') ?? 'artisan not working');

echo '</pre>';