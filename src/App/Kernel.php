<?php

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

use App\Modules\Renderer\Renderer;
use App\Modules\Themes\ThemeManager;
use App\Controller\ControllerFactory;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

class Kernel
{
    private ControllerFactory $controllerFactory;

    private Renderer $renderer;

    private Psr17Factory $responseFactory;

    private ThemeManager $themeManager;

    public function __construct()
    {
        $this->controllerFactory = new ControllerFactory();
        $this->renderer = new Renderer();
        $this->responseFactory = new Psr17Factory();
        $this->themeManager = new ThemeManager();
    }

    public function handle(): ResponseInterface
    {
        // TODO Add proper controller logic with routing
        $controller = $this->controllerFactory->create(
            $this->renderer,
            $this->responseFactory,
            $this->themeManager
        );

        // TODO Add support for more HTTP methods (currently only supporting GET)
        $response = $controller->get();
        
        return $response;
    }
}
