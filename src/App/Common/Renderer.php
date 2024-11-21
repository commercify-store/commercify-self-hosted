<?php declare(strict_types=1);

namespace App\Common;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Renderer
{
    private Environment $environment;

    public function __construct()
    {
        $this->environment = $this->configure();
    }

    public function render(string $name, array $context = []): string
    {

        return $this->environment->render($name, $context);
    }

    private function configure(): Environment
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../../templates');
        $twig = new Environment($loader);

        return $twig;
    }
}
