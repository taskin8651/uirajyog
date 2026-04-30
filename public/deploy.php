<?php

$projectRoot = '/home/rajyogreen/public_html';
$gitPath     = '/usr/local/cpanel/3rdparty/lib/path-bin/git';
$phpPath     = '/opt/cpanel/ea-php82/root/usr/bin/php';
$homePath    = '/home/rajyogreen';

header('Content-Type: text/html; charset=utf-8');

function runCommand($command)
{
    $output = shell_exec($command . ' 2>&1');

    if ($output === null || trim($output) === '') {
        return "No output / command not executed. shell_exec may be disabled or permission issue.\n";
    }

    return $output;
}

echo '<pre>';

echo "Deploy Started...\n\n";

if (!is_dir($projectRoot)) {
    http_response_code(500);
    exit("Project folder not found: {$projectRoot}");
}

echo "Project folder: {$projectRoot}\n";
echo "Current user: " . trim(runCommand('whoami')) . "\n\n";

echo "Git version:\n";
echo htmlspecialchars(runCommand($gitPath . ' --version'));

echo "\nGit status before pull:\n";
echo htmlspecialchars(runCommand('HOME=' . $homePath . ' ' . $gitPath . ' -C ' . $projectRoot . ' status'));

echo "\nGit pull:\n";
$pullOutput = runCommand('HOME=' . $homePath . ' ' . $gitPath . ' -C ' . $projectRoot . ' pull');

if (stripos($pullOutput, 'Already up to date') !== false || stripos($pullOutput, 'Already up-to-date') !== false) {
    echo "Already up to date.\n";
} else {
    echo htmlspecialchars($pullOutput);
}

echo "\nLaravel optimize clear:\n";
echo htmlspecialchars(runCommand($phpPath . ' ' . $projectRoot . '/artisan optimize:clear'));

echo "\nGit status after pull:\n";
echo htmlspecialchars(runCommand('HOME=' . $homePath . ' ' . $gitPath . ' -C ' . $projectRoot . ' status'));

echo "\nDeploy Finished.";

echo '</pre>';