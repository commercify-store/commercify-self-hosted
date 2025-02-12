<?php declare(strict_types=1);

/*
    Commercify Self Hosted - An e-commerce framework
    Copyright (C) 2025 Erol Simsir

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program. If not, see <https://www.gnu.org/licenses/>.
*/

namespace App\Modules\Security\RequestValidator;

use App\Config\Constants;
use App\Exceptions\HttpException;
use Psr\Http\Message\ServerRequestInterface;
use App\Modules\Security\RequestValidator\BadUserAgents;

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
