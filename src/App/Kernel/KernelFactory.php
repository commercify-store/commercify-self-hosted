<?php declare(strict_types=1);

namespace App\Kernel;

use App\Config\Constants;
use Symfony\Component\Yaml\Yaml;
use App\Modules\Renderer\Renderer;
use App\Modules\Themes\ThemeManager;
use App\Controller\ControllerFactory;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Psr\Http\Message\ServerRequestInterface;
use App\Modules\Security\RequestValidator\RequestValidator;

class KernelFactory
{
    /**
     * @return Kernel
     */
    public function create(): Kernel {
        $responseFactory = $this->createResponseFactory();
        $request = $this->createRequest($responseFactory);
        $requestValidator = $this->createRequestValidator();
        $themeManager = $this->createThemeManager();
        $renderer = $this->createRenderer();
        $controllerFactory = $this->createControllerFactory(
            $request,
            $responseFactory,
            $themeManager,
            $renderer
        );

        return new Kernel(
            $responseFactory,
            $request,
            $controllerFactory,
            $requestValidator
        );
    }

    /**
     * @return Psr17Factory
     */
    private function createResponseFactory(): Psr17Factory {
        return new Psr17Factory();
    }

    /**
     * @param Psr17Factory $responseFactory
     * 
     * @return ServerRequestInterface
     */
    private function createRequest(Psr17Factory $responseFactory): ServerRequestInterface {
        return (new ServerRequestCreator(
            $responseFactory,
            $responseFactory,
            $responseFactory,
            $responseFactory
        ))->fromGlobals();
    }

    /**
     * @return RequestValidator
     */
    private function createRequestValidator(): RequestValidator {
        return new RequestValidator();
    }

    /**
     * @return ThemeManager
     */
    private function createThemeManager(): ThemeManager {
        return new ThemeManager(
            Yaml::parseFile(Constants::THEME_CONFIG_FILE_PATH)
        );
    }

    /**
     * @return Renderer
     */
    private function createRenderer(): Renderer {
        return new Renderer(
            Constants::TEMPLATES_PATH,
            Constants::TEMPLATES_CACHE_PATH
        );
    }

    /**
     * Summary of createControllerFactory
     * @param ServerRequestInterface $request
     * @param Psr17Factory $responseFactory
     * @param ThemeManager $themeManager
     * @param Renderer $renderer
     * 
     * @return ControllerFactory
     */
    private function createControllerFactory(
        ServerRequestInterface $request,
        Psr17Factory $responseFactory,
        ThemeManager $themeManager,
        Renderer $renderer
    ): ControllerFactory {
        return new ControllerFactory(
            $request,
            $responseFactory,
            $themeManager,
            $renderer
        );
    }
}
