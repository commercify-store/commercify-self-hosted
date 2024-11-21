<?php declare(strict_types=1);

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;

interface ControllerInterface
{
    public function get(): ResponseInterface;
}
