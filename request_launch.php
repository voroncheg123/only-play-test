<?php
declare(strict_types=1);

require_once 'classes/Loader.php';
require_once 'var_params.php';

Loader::loadClasses();

$filesPath = '/Users/andrewvorona/only-play-test/test_task/requests/';
$logStorage = '/Users/andrewvorona/only-play-test/test_root/logs/';
new Handler($filesPath, $logStorage, ['json' => 'GenerateRequestParamsFromJson', 'xml' => 'GenerateRequestParamsFromXml']);