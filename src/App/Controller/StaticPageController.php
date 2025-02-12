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
use App\Controller\AbstractController;
use App\Controller\ControllerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class StaticPageController extends AbstractController implements ControllerInterface
{
    private ServerRequestInterface $request;

    private Renderer $renderer;

    private Psr17Factory $responseFactory;

    private Theme $activeTheme;

    public function __construct(
        ServerRequestInterface $request,
        Psr17Factory $responseFactory,
        Theme $activeTheme,
        Renderer $renderer
    ) {
        $this->request = $request;
        $this->renderer = $renderer;
        $this->responseFactory = $responseFactory;
        $this->activeTheme = $activeTheme;
    }

    public function get(): ResponseInterface {
        $content = $this->renderer->render("{$this->activeTheme->getPath()}/pages/index.html.twig");
        $responseBody = $this->responseFactory->createStream($content);

        return $this->responseFactory->createResponse()->withBody($responseBody);
    }
}
