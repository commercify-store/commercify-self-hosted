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

namespace App\Controller;

use App\Config\Constants;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseFactoryInterface;

abstract class AbstractController
{
    protected Psr17Factory $psr17Factory;

    public function __construct() {
        $this->psr17Factory = new Psr17Factory();
    }

    protected function methodNotAllowed(): ResponseInterface {
        $notAllowedError = Constants::HTTP_ERRORS[405];

        http_response_code($notAllowedError['code']);
        return $this->psr17Factory
            ->createResponse($notAllowedError['code'])
            ->withBody($this->psr17Factory->createStream($notAllowedError['message']));
    }

    public function get(): ResponseInterface {
        return $this->methodNotAllowed();
    }
    public function post(): ResponseInterface {
        return $this->methodNotAllowed();
    }
    public function put(): ResponseInterface {
        return $this->methodNotAllowed();
    }
    public function delete(): ResponseInterface {
        return $this->methodNotAllowed();
    }
    public function patch(): ResponseInterface {
        return $this->methodNotAllowed();
    }
    public function options(): ResponseInterface {
        return $this->methodNotAllowed();
    }
    public function query(): ResponseInterface {
        return $this->methodNotAllowed();
    }
    public function head(): ResponseInterface {
        return $this->methodNotAllowed();
    }

    // todo Check if this function is still good
    protected function redirectToRoute(string $route, ResponseFactoryInterface $psr17Factory): ResponseInterface {
        return $psr17Factory->createResponse(302)->withHeader('Location', $route);
    }

    // todo Check if this function is still good
    protected function getRequestBody(): ?array {
        $queryString = $this->psr17Factory->createStreamFromFile('php://input');

        if (empty($queryString->getContents())) {
            return null;
        }

        $data = [];
        parse_str($queryString->getContents(), $data);

        return $data;
    }
}
