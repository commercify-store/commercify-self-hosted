<?php declare(strict_types=1);

namespace App\Controller;

use App\Config\Constants;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseFactoryInterface;

// TODO Clean up repetitive code in this file

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
