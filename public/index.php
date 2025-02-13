<?php declare(strict_types=1);

/**
 * This project follows the front controller pattern. All traffic is directed to this file.
 * See the .htaccess file for how the traffic is directed here.
 */

use App\Kernel\KernelFactory;

require_once(__DIR__ . '/../vendor/autoload.php');

// TODO Add some error handling here in case Kernel creation goes wrong
$kernel = (new KernelFactory())->create();
$response = $kernel->handle();
http_response_code($response->getStatusCode());

// TODO Make sure to execute the appropiate action based on the response. For redirects we might not want to
// echo anything for example.
echo $response->getBody();
