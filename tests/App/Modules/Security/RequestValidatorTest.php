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

use App\Config\Constants;
use PHPUnit\Framework\TestCase;
use App\Exceptions\HttpException;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use App\Modules\Security\RequestValidator\RequestValidator;

class RequestValidatorTest extends TestCase
{
    private Psr17Factory $responseFactory;

    private ServerRequestCreator $requestCreator;

    protected function setUp(): void {
        $this->responseFactory = new Psr17Factory();
        $this->requestCreator = new ServerRequestCreator(
            $this->responseFactory,
            $this->responseFactory,
            $this->responseFactory,
            $this->responseFactory
        );
    }

    public function testAllowsGoodUserAgent(): void {
        $request = $this->requestCreator
            ->fromGlobals()
            ->withHeader('User-Agent', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');

        $blocker = new RequestValidator($request);

        $this->expectNotToPerformAssertions();

        $blocker->validate();
    }

    public function testBlocksBadUserAgentWithExactMatch(): void {
        $request = $this->requestCreator
            ->fromGlobals()
            ->withHeader('User-Agent', 'AhrefsBot/7.0 (+http://ahrefs.com/robot/)');

        $blocker = new RequestValidator($request);

        $this->expectException(HttpException::class);
        $this->expectExceptionCode(Constants::HTTP_ERRORS[403]['code']);
        $this->expectExceptionMessage(Constants::HTTP_ERRORS[403]['message']);

        $blocker->validate();
    }

    public function testBlocksBadUserAgentWithPartialMatch(): void {
        $request = $this->requestCreator
            ->fromGlobals()
            ->withHeader('User-Agent', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)');

        $blocker = new RequestValidator($request);

        $this->expectException(HttpException::class);
        $this->expectExceptionCode(Constants::HTTP_ERRORS[403]['code']);
        $this->expectExceptionMessage(Constants::HTTP_ERRORS[403]['message']);

        $blocker->validate();
    }

    public function testBlocksRequestWithInvalidMethod(): void {
        $request = $this->requestCreator
            ->fromGlobals()
            ->withHeader('User-Agent', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)')
            ->withMethod('FAKE');

        $blocker = new RequestValidator($request);

        $this->expectException(HttpException::class);
        $this->expectExceptionCode(Constants::HTTP_ERRORS[405]['code']);
        $this->expectExceptionMessage(Constants::HTTP_ERRORS[405]['message']);

        $blocker->validate();
    }

    public function testAllowsValidHttpMethod(): void {
        $request = $this->requestCreator
            ->fromGlobals()
            ->withHeader('User-Agent', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)')
            ->withMethod('GET');

        $blocker = new RequestValidator($request);

        $this->expectNotToPerformAssertions();

        $blocker->validate();
    }
}
