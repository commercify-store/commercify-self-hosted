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
use App\Modules\Security\RequestValidator\RequestValidator;
use Psr\Http\Message\ServerRequestInterface;

class RequestValidatorTest extends TestCase
{
    public function testAllowsGoodUserAgent(): void {
        $request = $this->createMockRequest(
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
            'GET'
        );

        $blocker = new RequestValidator();

        $this->expectNotToPerformAssertions();

        $blocker->validate($request);
    }

    public function testBlocksBadUserAgentWithExactMatch(): void {
        $request = $this->createMockRequest(
            'AhrefsBot/7.0 (+http://ahrefs.com/robot/)',
            'GET'
        );

        $blocker = new RequestValidator();

        $this->expectException(HttpException::class);
        $this->expectExceptionCode(Constants::HTTP_ERRORS[403]['code']);
        $this->expectExceptionMessage(Constants::HTTP_ERRORS[403]['message']);

        $blocker->validate($request);
    }

    public function testBlocksBadUserAgentWithPartialMatch(): void {
        $request = $this->createMockRequest(
            'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)',
            'GET'
        );

        $blocker = new RequestValidator();

        $this->expectException(HttpException::class);
        $this->expectExceptionCode(Constants::HTTP_ERRORS[403]['code']);
        $this->expectExceptionMessage(Constants::HTTP_ERRORS[403]['message']);

        $blocker->validate($request);
    }

    public function testBlocksRequestWithInvalidMethod(): void {
        $request = $this->createMockRequest(
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
            'FAKE'
        );

        $blocker = new RequestValidator();

        $this->expectException(HttpException::class);
        $this->expectExceptionCode(Constants::HTTP_ERRORS[405]['code']);
        $this->expectExceptionMessage(Constants::HTTP_ERRORS[405]['message']);

        $blocker->validate($request);
    }

    public function testAllowsValidHttpMethod(): void {
        $request = $this->createMockRequest(
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
            'GET'
        );

        $blocker = new RequestValidator();

        $this->expectNotToPerformAssertions();

        $blocker->validate($request);
    }

    private function createMockRequest(string $userAgent, string $method): ServerRequestInterface {
        $request = $this->createMock(ServerRequestInterface::class);

        $request->method('getHeaderLine')
            ->willReturn($userAgent);

        $request->method('getMethod')
            ->willReturn($method);

        return $request;
    }
}
