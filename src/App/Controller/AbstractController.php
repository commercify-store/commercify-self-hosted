<?php declare(strict_types=1);

namespace App\Controller;

use App\Config\Constants;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractController
{
    /**
     * @return ResponseInterface
     */
    protected function createMethodNotAllowedResponse(): ResponseInterface {
        $responseFactory = new Psr17Factory();
        return $responseFactory
            ->createResponse(Constants::HTTP_ERRORS[405]['code'])
            ->withBody(
                $responseFactory->createStream(Constants::HTTP_ERRORS[405]['message'])
            );
    }

    /**
     * @return ResponseInterface
     */
    public function get(): ResponseInterface {
        return $this->createMethodNotAllowedResponse();
    }

    /**
     * @return ResponseInterface
     */
    public function post(): ResponseInterface {
        return $this->createMethodNotAllowedResponse();
    }

    /**
     * @return ResponseInterface
     */
    public function put(): ResponseInterface {
        return $this->createMethodNotAllowedResponse();
    }

    /**
     * @return ResponseInterface
     */
    public function delete(): ResponseInterface {
        return $this->createMethodNotAllowedResponse();
    }

    /**
     * @return ResponseInterface
     */
    public function patch(): ResponseInterface {
        return $this->createMethodNotAllowedResponse();
    }

    /**
     * @return ResponseInterface
     */
    public function options(): ResponseInterface {
        return $this->createMethodNotAllowedResponse();
    }

    /**
     * @return ResponseInterface
     */
    public function query(): ResponseInterface {
        return $this->createMethodNotAllowedResponse();
    }

    /**
     * @return ResponseInterface
     */
    public function head(): ResponseInterface {
        return $this->createMethodNotAllowedResponse();
    }
}
