<?php declare(strict_types=1);

namespace App\Controller;

use App\Config\Constants;
use App\Exceptions\HttpException;
use App\Modules\Renderer\Renderer;
use App\Modules\Themes\ThemeManager;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ServerRequestInterface;

class ControllerFactory
{
    private ServerRequestInterface $request;

    private Psr17Factory $responseFactory;

    private ThemeManager $themeManager;

    private Renderer $renderer;

    public function __construct(
        ServerRequestInterface $request,
        Psr17Factory $responseFactory,
        ThemeManager $themeManager,
        Renderer $renderer
    ) {
        $this->request = $request;
        $this->responseFactory = $responseFactory;
        $this->themeManager = $themeManager;
        $this->renderer = $renderer;
    }

    public function create(string $controllerName): ControllerInterface {
        $controllers = [
            // TODO Load this list from a YAML file (related to routes)
            'static' => StaticPageController::class,
        ];

        if (!isset($controllers[$controllerName])) {
            throw new HttpException(
                Constants::HTTP_ERRORS[404]['code'],
                Constants::HTTP_ERRORS[404]['message']
            );
        }

        /** @var class-string<ControllerInterface> $controllerClass */
        $controllerClass = $controllers[$controllerName];

        return new $controllerClass(
            $this->request,
            $this->responseFactory,
            $this->themeManager->getActiveTheme(),
            $this->renderer
        );
    }
}
