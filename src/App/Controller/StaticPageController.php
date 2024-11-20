<?php declare(strict_types=1);

namespace App\Controller;

use App\Common\Renderer;
use App\Controller\BaseController;
use App\Controller\ControllerInterface;

class StaticPageController extends BaseController implements ControllerInterface
{
    private $renderer;

    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function get(): string
    {
        return $this->renderer->render('pages/index.html.twig');
    }
}
