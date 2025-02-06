<?php

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

namespace App\Modules\Renderer;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Renderer
{
    const TEMPLATES_PATH = '/../../../../templates';

    public function render(string $name, array $context = []): string
    {
        $loader = new FilesystemLoader(__DIR__ . self::TEMPLATES_PATH);
        $renderer = new Environment($loader);

        $content = $renderer->render($name, $context);

        return $content;
    }
}
