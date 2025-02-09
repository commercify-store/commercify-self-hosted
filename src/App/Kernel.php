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

use App\Config\Constants;
use App\Exceptions\HttpException;
use App\Controller\ControllerFactory;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Modules\Security\BadUserAgentBlocker\BadUserAgentBlocker;

class Kernel
{
    private ControllerFactory $controllerFactory;

    private ServerRequestInterface $request;

    private Psr17Factory $psr17Factory;

    private BadUserAgentBlocker $badUserAgentBlocker;

    public function __construct(
        Psr17Factory $psr17Factory,
        ServerRequestInterface $request,
        ControllerFactory $controllerFactory,
        BadUserAgentBlocker $badUserAgentBlocker
    ) {
        $this->psr17Factory = $psr17Factory;
        $this->request = $request;
        $this->controllerFactory = $controllerFactory;
        $this->badUserAgentBlocker = $badUserAgentBlocker;
    }

    public function handle(): ResponseInterface {
        try {
            $this->validateRequest();
            
            // todo Pass the correct controllerName based on routing
            $controller = $this->controllerFactory->create('static');

            $httpRequestMethod = strtolower($this->request->getMethod());
            return $controller->$httpRequestMethod();
        } catch (HttpException $e) {
            http_response_code($e->getStatusCode());
            return $this->createErrorResponse($e->getStatusCode(), $e->getMessage());
        }
    }

    private function validateRequest(): void {
        // todo Add other error cases here, grouped in if conditions for each error code
        if ($this->badUserAgentBlocker->isBadUserAgent()) {
            throw new HttpException(
                Constants::HTTP_ERRORS[403]['code'],
                Constants::HTTP_ERRORS[403]['message']
            );
        }

        if (
            !in_array(
                strtolower($this->request->getMethod()),
                Constants::ALLOWED_HTTP_METHODS,
                true
            )
        ) {
            throw new HttpException(
                Constants::HTTP_ERRORS[405]['code'],
                Constants::HTTP_ERRORS[405]['message']
            );
        }
    }

    private function createErrorResponse(int $code, string $message): ResponseInterface {
        // todo Instead of just outputting the error message, render an error page with the message
        return $this->psr17Factory
            ->createResponse($code)
            ->withBody($this->psr17Factory->createStream($message));
    }
}
