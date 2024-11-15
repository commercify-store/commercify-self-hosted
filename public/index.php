<?php declare(strict_types=1);

use App\Initialize;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$initialize = new Initialize();
$initialize->helloCommercify();
