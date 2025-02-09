<?php declare(strict_types=1);

/*
    Commercify Self Hosted - An e-commerce framework
    Copyright (C) 2025 Erol Simsir

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program. If not, see <https://www.gnu.org/licenses/>.
*/

/**
 * This project follows the front controller pattern. All traffic is directed to this file.
 * See the .htaccess file for how the traffic is directed here.
 */

use App\Kernel;
use App\Config\Constants;
use Symfony\Component\Yaml\Yaml;
use App\Modules\Renderer\Renderer;
use App\Modules\Themes\ThemeManager;
use App\Controller\ControllerFactory;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use App\Modules\Security\BadUserAgentBlocker\BadUserAgentBlocker;

require_once(__DIR__ . '/../vendor/autoload.php');

/**
 * We are instantiating the dependencies for Kernel here and injecting them later on below for testing 
 * purposes. Injecting dependencies from this level into Kernel makes the Kernel class more easily testable.
 */
$psr17Factory = new Psr17Factory();
$requestCreator = new ServerRequestCreator(
    $psr17Factory,
    $psr17Factory,
    $psr17Factory,
    $psr17Factory
);
$request = $requestCreator->fromGlobals();
$controllerFactory = new ControllerFactory(
    new Renderer(
        Constants::TEMPLATES_PATH,
        Constants::TEMPLATES_CACHE_PATH
    ),
    $psr17Factory,
    new ThemeManager(
        Yaml::parseFile(Constants::THEME_CONFIG_FILE_PATH)
    )
);
$badUserAgentBlocker = new BadUserAgentBlocker();

$kernel = new Kernel(
    $psr17Factory,
    $request,
    $controllerFactory,
    $badUserAgentBlocker
);

$response = $kernel->handle();
echo $response->getBody();
