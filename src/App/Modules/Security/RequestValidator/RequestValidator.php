<?php

declare(strict_types=1);

namespace App\Modules\Security\RequestValidator;

use App\Config\Constants;
use App\Exceptions\HttpException;
use Psr\Http\Message\ServerRequestInterface;
use App\Modules\Security\RequestValidator\BadUserAgents;

class RequestValidator
{
    /**
     * @param ServerRequestInterface $request
     * 
     * @return void
     */
    public function validate(ServerRequestInterface $request): bool
    {
        // TODO Add other error cases here, grouped in if conditions for each error code
        if ($this->isBadUserAgent($request)) {
            throw new HttpException(
                Constants::HTTP_ERRORS[403]['code'],
                Constants::HTTP_ERRORS[403]['message']
            );
        }

        if ($this->isInvalidHttpMethod($request)) {
            throw new HttpException(
                Constants::HTTP_ERRORS[405]['code'],
                Constants::HTTP_ERRORS[405]['message']
            );
        }

        return true;
    }

    /**
     * @param ServerRequestInterface $request
     * 
     * @return bool
     */
    private function isBadUserAgent(ServerRequestInterface $request): bool
    {
        static $pattern = null;

        if ($pattern === null) {
            $escapedAgents = array_map(
                fn($agent) => preg_quote($agent, '~'),
                BadUserAgents::BAD_USER_AGENTS
            );
            $pattern = '~(' . implode('|', $escapedAgents) . ')~i';
        }

        $userAgent = $request->getHeaderLine('User-Agent');
        if (preg_match($pattern, $userAgent)) {
            return true;
        }

        return false;
    }

    /**
     * @param ServerRequestInterface $request
     * 
     * @return bool
     */
    private function isInvalidHttpMethod(ServerRequestInterface $request): bool
    {
        return !in_array(
            strtolower($request->getMethod()),
            Constants::ALLOWED_HTTP_METHODS,
            true
        );
    }
}
