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

use App\Modules\Themes\Theme;
use App\Modules\Renderer\Renderer;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use App\Controller\AbstractController;

class StaticPageController extends AbstractController
{
    private Renderer $renderer;

    private Psr17Factory $psr17Factory;

    private Theme $activeTheme;

    public function __construct(Renderer $renderer, Psr17Factory $psr17Factory, Theme $activeTheme) {
        $this->renderer = $renderer;
        $this->psr17Factory = $psr17Factory;
        $this->activeTheme = $activeTheme;
    }

    public function get(): ResponseInterface {
        $content = $this->renderer->render("{$this->activeTheme->getPath()}/pages/index.html.twig");
        $responseBody = $this->psr17Factory->createStream($content);

        return $this->psr17Factory->createResponse()->withBody($responseBody);
    }
}
