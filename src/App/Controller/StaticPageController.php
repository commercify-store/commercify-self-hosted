<?php declare(strict_types=1);

namespace App\Controller;

use App\Common\Renderer;
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
        $content = $this->renderer->render('pages/index.html.twig');
        $responseBody = $this->responseFactory->createStream($content);

        return $this->responseFactory->createResponse()->withBody($responseBody);
    }
}
