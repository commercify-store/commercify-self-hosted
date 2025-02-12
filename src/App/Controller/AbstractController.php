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

namespace App\Controller;

use App\Config\Constants;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseFactoryInterface;

// todo Clean up repetitive code in this file

abstract class AbstractController
{
    public function get(): ResponseInterface {
        $responseFactory = new Psr17Factory();
        
        return $responseFactory
            ->createResponse(Constants::HTTP_ERRORS[405]['code'])
            ->withBody(
                $responseFactory->createStream(Constants::HTTP_ERRORS[405]['message'])
            );
    }

    public function post(): ResponseInterface {
        $responseFactory = new Psr17Factory();
        
        return $responseFactory
            ->createResponse(Constants::HTTP_ERRORS[405]['code'])
            ->withBody(
                $responseFactory->createStream(Constants::HTTP_ERRORS[405]['message'])
            );
    }

    public function put(): ResponseInterface {
        $responseFactory = new Psr17Factory();
        
        return $responseFactory
            ->createResponse(Constants::HTTP_ERRORS[405]['code'])
            ->withBody(
                $responseFactory->createStream(Constants::HTTP_ERRORS[405]['message'])
            );
    }

    public function delete(): ResponseInterface {
        $responseFactory = new Psr17Factory();
        
        return $responseFactory
            ->createResponse(Constants::HTTP_ERRORS[405]['code'])
            ->withBody(
                $responseFactory->createStream(Constants::HTTP_ERRORS[405]['message'])
            );
    }

    public function patch(): ResponseInterface {
        $responseFactory = new Psr17Factory();
        
        return $responseFactory
            ->createResponse(Constants::HTTP_ERRORS[405]['code'])
            ->withBody(
                $responseFactory->createStream(Constants::HTTP_ERRORS[405]['message'])
            );
    }

    public function options(): ResponseInterface {
        $responseFactory = new Psr17Factory();
        
        return $responseFactory
            ->createResponse(Constants::HTTP_ERRORS[405]['code'])
            ->withBody(
                $responseFactory->createStream(Constants::HTTP_ERRORS[405]['message'])
            );
    }

    public function query(): ResponseInterface {
        $responseFactory = new Psr17Factory();
        
        return $responseFactory
            ->createResponse(Constants::HTTP_ERRORS[405]['code'])
            ->withBody(
                $responseFactory->createStream(Constants::HTTP_ERRORS[405]['message'])
            );
    }

    public function head(): ResponseInterface {
        $responseFactory = new Psr17Factory();
        
        return $responseFactory
            ->createResponse(Constants::HTTP_ERRORS[405]['code'])
            ->withBody(
                $responseFactory->createStream(Constants::HTTP_ERRORS[405]['message'])
            );
    }
}
