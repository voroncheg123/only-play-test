<?php
declare(strict_types=1);

require_once 'var_params.php';
require_once 'autoload.php';

$filesPath = PROJECT_ROOT.'/requests/';
$logStorage = PROJECT_ROOT.'/logs/';

$handlerObj = new Handler($filesPath, $logStorage, ['json' => 'GenerateRequestParamsFromJson', 'xml' => 'GenerateRequestParamsFromXml']);
$handlerObj->launchRequests();