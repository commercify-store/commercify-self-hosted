<?php declare(strict_types=1);

namespace App\Common;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Renderer
{
    public function render(string $name, array $context = []): string
    {
        $twig = $this->configure();
        
        return $twig->render($name, $context);
    }

    private function configure(): Environment
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../../Templates');
        $twig = new Environment($loader);

        return $twig;
    }
}
