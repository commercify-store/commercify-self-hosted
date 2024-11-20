<?php declare(strict_types=1);

namespace App;

use App\Common\Renderer;
use App\Controller\ControllerFactory;

class Kernel
{
    private Renderer $renderer;

    private ControllerFactory $controllerFactory;

    public function __construct()
    {
        $this->renderer = new Renderer();
        $this->controllerFactory = new ControllerFactory();
    }

    public function handle(): string
    {
        /* 
         * TODO Add middlewares to prepare request to be handled
         */

        /* 
         * TODO Add Controller logic here and replace rendering 
         * implementation with proper one from controller infrastructure
         */

        $controller = $this->controllerFactory->create($this->renderer);

        $response = $controller->get();

        /* 
         * TODO Add middlewares to prepare response to be sent
         */

        return $response;
    }
}
