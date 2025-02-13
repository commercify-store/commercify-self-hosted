<?php declare(strict_types=1);

namespace App\Controller;

use App\Modules\Themes\Theme;
use App\Modules\Renderer\Renderer;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ServerRequestInterface;

interface ControllerInterface
{
    public function __construct(
        ServerRequestInterface $request,
        Psr17Factory $responseFactory,
        Theme $activeTheme,
        Renderer $renderer
    );
}
