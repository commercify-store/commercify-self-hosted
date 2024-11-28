<?php declare(strict_types=1);

namespace App;

use App\Common\Renderer;
use App\Controller\ControllerFactory;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

class Kernel
{
    private ControllerFactory $controllerFactory;

    private Renderer $renderer;

    private Psr17Factory $responseFactory;

    public function __construct()
    {
        $this->controllerFactory = new ControllerFactory();
        $this->renderer = new Renderer();
        $this->responseFactory = new Psr17Factory();
    }

    public function handle(): ResponseInterface
    {
        /*
         * TODO Add middlewares to prepare request to be handled
         */

        /*
         * TODO Add Controller logic here and replace rendering 
         * implementation with proper one from controller infrastructure
         */

        $controller = $this->controllerFactory->create(
            $this->renderer,
            $this->responseFactory
        );

        $response = $controller->get();

        /*
         * TODO Add middlewares to prepare response to be sent
         */

        return $response;
    }
}
