<?php declare(strict_types=1);

namespace App;

use App\Common\Renderer;

class Kernel
{
    private $renderer;

    public function __construct()
    {
        $this->renderer = new Renderer();
    }

    public function handle(): void
    {
        /* 
         * TODO Add Controller logic here and replace rendering 
         * implementation with proper one from controller infrastructure
         */

        echo $this->renderer->render('index.html.twig');
    }
}
