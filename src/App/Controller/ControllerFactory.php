<?php declare(strict_types=1);

namespace App\Controller;

use App\Common\Renderer;
use App\Controller\ControllerInterface;
use App\Controller\StaticPageController;

class ControllerFactory {
    public function create(Renderer $renderer): ControllerInterface
    {
        /*
         * TODO Implement proper controller creation here according to routes etc.
         */
        $controller = new StaticPageController($renderer);

        return $controller;
    }
}
