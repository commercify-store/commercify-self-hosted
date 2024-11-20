<?php declare(strict_types=1);

use App\Kernel;

require_once(__DIR__ . '/../vendor/autoload.php');

$kernel = new Kernel();
echo $kernel->handle();
