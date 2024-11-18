<?php declare(strict_types=1);

namespace App;

use App\Middleware\Common\Renderer;

class Kernel
{
    private $rendererMiddleware;

    public function __construct()
    {
        $this->rendererMiddleware = new Renderer();
    }

    public function handle(): void
    {
        echo 'Handle';
    }

    private function configure(): void
    {
        $this->rendererMiddleware->configure();
    }
}
