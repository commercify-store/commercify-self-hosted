<?php declare(strict_types=1);

namespace App\Modules\Renderer;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\SyntaxError;
use Twig\Error\RuntimeError;
use Twig\Loader\FilesystemLoader;

class Renderer
{
    private Environment $twig;

    /**
     * @param string $templatesPath
     * @param string $templatesCachePath
     */
    public function __construct(string $templatesPath, string $templatesCachePath) {
        $loader = new FilesystemLoader($templatesPath);

        $this->twig = new Environment($loader, [
            'cache' => $templatesCachePath,
            'debug' => true,
            'auto_reload' => true,
        ]);
    }

    /**
     * @param string $template
     * @param array $context
     * 
     * @return string
     */
    public function render(string $template, array $context = []): string {
        try {
            return $this->twig->render($template, $context);
        } catch (LoaderError | RuntimeError | SyntaxError $e) {
            return "Template Error: " . $e->getMessage();
        }
    }
}

