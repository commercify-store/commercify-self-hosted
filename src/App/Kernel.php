<?php declare(strict_types=1);

/*
    Commercify Self Hosted - An e-commerce framework
    Copyright (C) 2024 Erol Simsir

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

namespace App;

use App\Modules\Renderer;
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
