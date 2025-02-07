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

    private ThemeManager $themeManager;

    private BadUserAgentBlocker $badUserAgentBlocker;

    public function __construct()
    {
        $this->controllerFactory = new ControllerFactory();
        $this->renderer = new Renderer();
        $this->responseFactory = new Psr17Factory();
        $this->themeManager = new ThemeManager();
        $this->badUserAgentBlocker = new BadUserAgentBlocker();
    }

    public function handle(): ResponseInterface
    {
        /**
         * We want to catch bad requests early. We're handling the response for those here early on instead of 
         * going all the way down to the factory and controller layers.
         */
        if ($this->isForbidden() === true) {
            return $this->createForbiddenResponse();
        }

        $controller = $this->controllerFactory->create(
            $this->renderer,
            $this->responseFactory,
            $this->themeManager
        );

        $response = $controller->get();
        
        return $response;
    }

    private function isForbidden(): bool
    {
        // TODO Add other forbidden cases here
        return $this->isBadUserAgent();
    }

    private function isBadUserAgent(): bool
    {
        return $this->badUserAgentBlocker->isBadUserAgent();
    }

    private function createForbiddenResponse(): ResponseInterface
    {
        $statusCode = Constants::HTTP_ERRORS[403]['code'];
        $message = Constants::HTTP_ERRORS[403]['message'];

        http_response_code($statusCode);
    
        return $this->responseFactory
            ->createResponse($statusCode, $message)
            ->withBody(
                $this->responseFactory->createStream($message)
            );   
    }
}
