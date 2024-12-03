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

namespace App\Modules\Renderer;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class RendererFactory {
    public function create(): Environment
    {
        /*
            We always default to Twig as it's built-in already.

            If you want to use another templating language, it is recommended to replace the Twig
            implementation below with your own templating setup.

            Remember that when replacing Twig with another templating language, you need to modify the code
            in App\Modules\Renderer\Renderer to accomodate for it. See instructions for that in the Renderer
            class.
        */
        $loader = new FilesystemLoader(__DIR__ . '/../../../../templates');
        $renderer = new Environment($loader);

        return $renderer;
    }
}
