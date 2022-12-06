<?php
declare(strict_types=1);

require_once 'classes/Loader.php';
require_once 'var_params.php';

Loader::loadClasses();

$filesPath = PROJECT_ROOT.'/requests/';
$logStorage = PROJECT_ROOT.'/logs/';

$handlerObj = new Handler($filesPath, $logStorage, ['json' => 'GenerateRequestParamsFromJson', 'xml' => 'GenerateRequestParamsFromXml']);
$handlerObj->launchRequests();