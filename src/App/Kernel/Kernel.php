<?php declare(strict_types=1);

namespace App\Kernel;

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
            $this->requestValidator->validate($this->request);

            // TODO Pass the correct controllerName based on routing
            $controller = $this->controllerFactory->create('static');
            $httpRequestMethod = strtolower($this->request->getMethod());
            
            $response = $controller->$httpRequestMethod();

            return $response;
        } catch (HttpException $e) {
            return $this->responseFactory
                ->createResponse($e->getStatusCode())
                ->withBody($this->responseFactory->createStream($e->getMessage()));
        }
    }
}
