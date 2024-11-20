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

    public function handle(): void
    {
        /* 
         * TODO Add Controller logic here and replace rendering 
         * implementation with proper one from controller infrastructure
         */

        $controllerFactory = new ControllerFactory();
        $controller = $this->controllerFactory->create($this->renderer);

        $controller->get();
    }
}
