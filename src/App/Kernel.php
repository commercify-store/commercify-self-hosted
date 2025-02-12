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

use App\Exceptions\HttpException;
use App\Controller\ControllerFactory;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Modules\Security\RequestValidator\RequestValidator;

class Kernel
{
    private ControllerFactory $controllerFactory;

    private ServerRequestInterface $request;

    private Psr17Factory $responseFactory;

    private RequestValidator $requestValidator;

    public function __construct(
        Psr17Factory $responseFactory,
        ServerRequestInterface $request,
        ControllerFactory $controllerFactory,
        RequestValidator $requestValidator
    ) {
        $this->responseFactory = $responseFactory;
        $this->request = $request;
        $this->controllerFactory = $controllerFactory;
        $this->requestValidator = $requestValidator;
    }

    public function handle(): ResponseInterface {
        try {
            $this->requestValidator->validate();

            // todo Pass the correct controllerName based on routing
            $controller = $this->controllerFactory->create('static');
            $httpRequestMethod = strtolower($this->request->getMethod());

            return $controller->$httpRequestMethod();
        } catch (HttpException $e) {
            return $this->responseFactory
                ->createResponse($e->getStatusCode())
                ->withBody($this->responseFactory->createStream($e->getMessage()));
        }
    }
}
