<?php declare(strict_types=1);

namespace App\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseFactoryInterface;

class BaseController
{
    protected function redirectToRoute(string $route, ResponseFactoryInterface $responseFactory): ResponseInterface
    {
        return $responseFactory
            ->createResponse(501)
            ->withHeader('Location', $route)
            ->withStatus(302);
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
