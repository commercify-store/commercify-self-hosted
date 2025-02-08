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

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseFactoryInterface;

abstract class AbstractController {
    public function get(): ResponseInterface {

        $psr17Factory = new Psr17Factory();
        http_response_code(405);

        return $psr17Factory
            ->createResponse(405)
            ->withBody(
                $psr17Factory->createStream('Method Not Allowed')
            );
    }

    public function post(): ResponseInterface {
        $psr17Factory = new Psr17Factory();
        http_response_code(405);
        
        return $psr17Factory
            ->createResponse(405)
            ->withBody(
                $psr17Factory->createStream('Method Not Allowed')
            );
    }

    public function put(): ResponseInterface {
        $psr17Factory = new Psr17Factory();
        http_response_code(405);
        
        return $psr17Factory
            ->createResponse(405)
            ->withBody(
                $psr17Factory->createStream('Method Not Allowed')
            );
    }

    public function delete(): ResponseInterface {
        $psr17Factory = new Psr17Factory();
        http_response_code(405);
        
        return $psr17Factory
            ->createResponse(405)
            ->withBody(
                $psr17Factory->createStream('Method Not Allowed')
            );
    }

    public function patch(): ResponseInterface {
        $psr17Factory = new Psr17Factory();
        http_response_code(405);
        
        return $psr17Factory
            ->createResponse(405)
            ->withBody(
                $psr17Factory->createStream('Method Not Allowed')
            );
    }

    public function options(): ResponseInterface {
        $psr17Factory = new Psr17Factory();
        http_response_code(405);
        
        return $psr17Factory
            ->createResponse(405)
            ->withBody(
                $psr17Factory->createStream('Method Not Allowed')
            );
    }

    public function query(): ResponseInterface {
        $psr17Factory = new Psr17Factory();
        http_response_code(405);
        
        return $psr17Factory
            ->createResponse(405)
            ->withBody(
                $psr17Factory->createStream('Method Not Allowed')
            );
    }

    public function head(): ResponseInterface {
        $psr17Factory = new Psr17Factory();
        http_response_code(405);
        
        return $psr17Factory
            ->createResponse(405)
            ->withBody(
                $psr17Factory->createStream('Method Not Allowed')
            );
    }

    protected function redirectToRoute(
        string $route,
        ResponseFactoryInterface $psr17Factory
    ): ResponseInterface {
        return $psr17Factory->createResponse(302) ->withHeader('Location', $route);
    }

    protected function getRequestBody(): ?array
    {
        $requestFactory = new Psr17Factory();
        $queryString = $requestFactory->createStreamFromFile('php://input');

        if (!isset($queryString) || empty($queryString) || $queryString === '') {
            return null;
        }

        $data = [];
        parse_str($queryString->getContents(), $data);

        return $data;
    }
}
