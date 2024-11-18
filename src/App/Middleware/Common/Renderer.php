<?php declare(strict_types=1);

namespace App\Middleware\Common;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Renderer
{
    public function configure(): Environment
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../../../Templates');
        $twig = new Environment($loader);

        return $twig;
    }
}
