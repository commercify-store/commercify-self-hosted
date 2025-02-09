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

use App\Config\Constants;
use App\Exceptions\HttpException;
use App\Modules\Renderer\Renderer;
use App\Modules\Themes\ThemeManager;
use Nyholm\Psr7\Factory\Psr17Factory;

class ControllerFactory
{
    private Renderer $renderer;

    private Psr17Factory $psr17Factory;

    private ThemeManager $themeManager;

    public function __construct(
        Renderer $renderer,
        Psr17Factory $psr17Factory,
        ThemeManager $themeManager
    ) {
        $this->renderer = $renderer;
        $this->psr17Factory = $psr17Factory;
        $this->themeManager = $themeManager;
    }

    public function create(string $controllerName): AbstractController {
        $controllers = [
            // todo Load this list from a YAML file (related to routes)
            'static' => StaticPageController::class,
        ];

        // todo Check if this fault is caught early on in Kernel, so we can skip this check here. Or, we can
        // throw a different exception. The route might actually exist, but for whatever reason the wrong name
        // can be passed down here. The error should reflect that.
        if (!isset($controllers[$controllerName])) {
            throw new HttpException(
                Constants::HTTP_ERRORS[404]['code'],
                Constants::HTTP_ERRORS[404]['message']
            );
        }

        $controllerClass = $controllers[$controllerName];

        return new $controllerClass(
            $this->renderer,
            $this->psr17Factory,
            $this->themeManager->getActiveTheme()
        );
    }
}
