<?php

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

namespace App;

use App\Constants\Constants;
use Symfony\Component\Yaml\Yaml;
use App\Exceptions\HttpException;
use App\Modules\Renderer\Renderer;
use App\Modules\Themes\ThemeManager;
use App\Controller\ControllerFactory;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use App\Modules\Security\BadUserAgentBlocker\BadUserAgentBlocker;

class Kernel
{
    private ControllerFactory $controllerFactory;
    
    private Renderer $renderer;
    
    private Psr17Factory $responseFactory;
    
    private BadUserAgentBlocker $badUserAgentBlocker;
    
    private ThemeManager $themeManager;

    public function __construct()
    {
        $this->controllerFactory = new ControllerFactory();
        $this->renderer = new Renderer();
        $this->responseFactory = new Psr17Factory();
        $this->badUserAgentBlocker = new BadUserAgentBlocker();
        $this->themeManager = new ThemeManager(
            Yaml::parseFile(Constants::THEME_CONFIG_FILE_PATH)
        );
    }

    public function handle(): ResponseInterface
    {
        try {
            $this->isRequestError();

            $controller = $this->controllerFactory->create(
                $this->renderer,
                $this->responseFactory,
                $this->themeManager
            );

            return $controller->get();
        } catch (HttpException $e) {
            http_response_code($e->getStatusCode());
            return $this->createErrorResponse($e->getStatusCode(), $e->getMessage());
        }
    }

    private function isRequestError(): void
    {
        // todo Add other error cases here, grouped in if conditions for each error code
        if ($this->badUserAgentBlocker->isBadUserAgent()) {
            throw new HttpException(403, Constants::HTTP_ERRORS[403]['message']);
        }
    }

    private function createErrorResponse(int $code, string $message): ResponseInterface
    {
        return $this->responseFactory
            ->createResponse($code)
            ->withBody(
                $this->responseFactory->createStream($message)
            );
    }
}
