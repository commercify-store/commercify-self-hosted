<?php declare(strict_types=1);

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
