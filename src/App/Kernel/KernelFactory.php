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

namespace App\Kernel;

use App\Config\Constants;
use Symfony\Component\Yaml\Yaml;
use App\Modules\Renderer\Renderer;
use App\Modules\Themes\ThemeManager;
use App\Controller\ControllerFactory;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Psr\Http\Message\ServerRequestInterface;
use App\Modules\Security\RequestValidator\RequestValidator;

class KernelFactory
{
    public function create(): Kernel {
        $responseFactory = $this->createResponseFactory();
        $request = $this->createRequest($responseFactory);
        $requestValidator = $this->createRequestValidator($request);
        $themeManager = $this->createThemeManager();
        $renderer = $this->createRenderer();
        $controllerFactory = $this->createControllerFactory(
            $request,
            $responseFactory,
            $themeManager,
            $renderer
        );

        return new Kernel(
            $responseFactory,
            $request,
            $controllerFactory,
            $requestValidator
        );
    }

    private function createResponseFactory(): Psr17Factory {
        return new Psr17Factory();
    }

    private function createRequest(Psr17Factory $responseFactory): ServerRequestInterface {
        return (new ServerRequestCreator(
            $responseFactory,
            $responseFactory,
            $responseFactory,
            $responseFactory
        ))->fromGlobals();
    }

    private function createRequestValidator(ServerRequestInterface $request): RequestValidator {
        return new RequestValidator($request);
    }

    private function createThemeManager(): ThemeManager {
        return new ThemeManager(
            Yaml::parseFile(Constants::THEME_CONFIG_FILE_PATH)
        );
    }

    private function createRenderer(): Renderer {
        return new Renderer(
            Constants::TEMPLATES_PATH,
            Constants::TEMPLATES_CACHE_PATH
        );
    }

    private function createControllerFactory(
        ServerRequestInterface $request,
        Psr17Factory $responseFactory,
        ThemeManager $themeManager,
        Renderer $renderer
    ): ControllerFactory {
        return new ControllerFactory(
            $request,
            $responseFactory,
            $themeManager,
            $renderer
        );
    }
}
