<?php

$projectRoot = '/home/rajyogreen/public_html';
$gitPath     = '/usr/local/cpanel/3rdparty/lib/path-bin/git';
$phpPath     = '/opt/cpanel/ea-php82/root/usr/bin/php';
$homePath    = '/home/rajyogreen';

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', 1);

function runCmd($command)
{
    if (!function_exists('exec')) {
        return "ERROR: exec() function disabled on server.\n";
    }

    $output = [];
    $returnCode = 0;

    exec($command . ' 2>&1', $output, $returnCode);

    $text = implode("\n", $output);

    if (trim($text) === '') {
        $text = "No output returned from command.";
    }

    return $text . "\nReturn code: " . $returnCode . "\n";
}

echo '<pre>';

echo "Deploy Started...\n\n";

if (!is_dir($projectRoot)) {
    http_response_code(500);
    exit("Project folder not found: {$projectRoot}");
}

echo "Project folder: {$projectRoot}\n\n";

echo "PHP current user:\n";
echo get_current_user() . "\n\n";

echo "Disabled functions:\n";
echo ini_get('disable_functions') . "\n\n";

echo "Whoami:\n";
echo htmlspecialchars(runCmd('whoami')) . "\n";

echo "Git version:\n";
echo htmlspecialchars(runCmd($gitPath . ' --version')) . "\n";

echo "Git status before pull:\n";
echo htmlspecialchars(runCmd('HOME=' . $homePath . ' ' . $gitPath . ' -C ' . $projectRoot . ' status')) . "\n";

echo "Git pull:\n";
$pull = runCmd('HOME=' . $homePath . ' ' . $gitPath . ' -C ' . $projectRoot . ' pull');
echo htmlspecialchars($pull) . "\n";

echo "Laravel optimize clear:\n";
echo htmlspecialchars(runCmd($phpPath . ' ' . $projectRoot . '/artisan optimize:clear')) . "\n";

echo "Git status after pull:\n";
echo htmlspecialchars(runCmd('HOME=' . $homePath . ' ' . $gitPath . ' -C ' . $projectRoot . ' status')) . "\n";

echo "Deploy Finished.";

echo '</pre>';