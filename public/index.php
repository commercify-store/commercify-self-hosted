<?php declare(strict_types=1);

use App\Kernel;

require_once(__DIR__ . '/../vendor/autoload.php');

$kernel = new Kernel();

/*
 * TODO Setup request here and send as a parameter to $kernel->handle()
 */

$response = $kernel->handle();

echo (string)$response->getBody();
