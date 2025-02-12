<?php

namespace App\Modules\Security\RequestValidator;

use App\Config\Constants;
use App\Exceptions\HttpException;
use Psr\Http\Message\ServerRequestInterface;
use App\Modules\Security\BadUserAgentBlocker\BadUserAgents;

class RequestValidator
{
    private ServerRequestInterface $request;


    public function __construct(ServerRequestInterface $request) {
        $this->request = $request;
    }

    public function validate(): void {
        // todo Add other error cases here, grouped in if conditions for each error code
        if ($this->isBadUserAgent()) {
            throw new HttpException(
                Constants::HTTP_ERRORS[403]['code'],
                Constants::HTTP_ERRORS[403]['message']
            );
        }

        if (
            !in_array(
                strtolower($this->request->getMethod()),
                Constants::ALLOWED_HTTP_METHODS,
                true
            )
        ) {
            throw new HttpException(
                Constants::HTTP_ERRORS[405]['code'],
                Constants::HTTP_ERRORS[405]['message']
            );
        }
    }

    private function isBadUserAgent(): bool {
        static $pattern = null;

        if ($pattern === null) {
            $escapedAgents = array_map(
                fn($agent) => preg_quote($agent, '~'),
                BadUserAgents::BAD_USER_AGENTS
            );
            $pattern = '~(' . implode('|', $escapedAgents) . ')~i';
        }

        $userAgent = $this->request->getHeaderLine('User-Agent');
        if (preg_match($pattern, $userAgent)) {
            return true;
        }

        return false;
    }
}
