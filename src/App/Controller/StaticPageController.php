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

namespace App\Controller;

use App\Modules\Renderer\Renderer;
use App\Controller\BaseController;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use App\Controller\ControllerInterface;

class StaticPageController extends BaseController implements ControllerInterface
{
    private Renderer $renderer;

    private Psr17Factory $responseFactory;

    public function __construct(Renderer $renderer, Psr17Factory $responseFactory,)
    {
        $this->renderer = $renderer;
        $this->responseFactory = $responseFactory;
    }

    public function get(): ResponseInterface
    {
        $content = $this->renderer->render('themes/commercify-default.ctheme/pages/index.html.twig');
        $responseBody = $this->responseFactory->createStream($content);

        return $this->responseFactory->createResponse()->withBody($responseBody);
    }
}
