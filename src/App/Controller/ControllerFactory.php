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

use App\Modules\Renderer\Renderer;
use App\Modules\Themes\ThemeManager;
use Nyholm\Psr7\Factory\Psr17Factory;
use App\Controller\ControllerInterface;
use App\Controller\StaticPageController;

class ControllerFactory {
    public function create(Renderer $renderer, Psr17Factory $responseFactory, ThemeManager $themeManager): ControllerInterface
    {
        // todo Implement proper controller creation here according to routes etc.
        $controller = new StaticPageController(
            $renderer,
            $responseFactory,
            $themeManager->getActiveTheme()
        );

        return $controller;
    }
}
