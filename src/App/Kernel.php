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

namespace App;

use App\Constants\Constants;
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

    public function __construct(
        ControllerFactory $controllerFactory,
        Renderer $renderer,
        Psr17Factory $responseFactory,
        BadUserAgentBlocker $badUserAgentBlocker,
        ThemeManager $themeManager
    )
    {
        $this->controllerFactory = $controllerFactory;
        $this->renderer = $renderer;
        $this->responseFactory = $responseFactory;
        $this->badUserAgentBlocker = $badUserAgentBlocker;
        $this->themeManager = $themeManager;
    }

    public function handle(): ResponseInterface
    {
        try {
            $this->checkForRequestErrors();

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

    private function checkForRequestErrors(): void
    {
        // todo Add other error cases here, grouped in if conditions for each error code
        if ($this->badUserAgentBlocker->isBadUserAgent()) {
            throw new HttpException(403, Constants::HTTP_ERRORS[403]['message']);
        }
    }

    private function createErrorResponse(int $code, string $message): ResponseInterface
    {
        // todo Instead of just outputting the error message, render an error page with the message
        return $this->responseFactory
            ->createResponse($code)
            ->withBody(
                $this->responseFactory->createStream($message)
            );
    }
}
