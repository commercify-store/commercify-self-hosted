<?php

declare(strict_types=1);

use App\Config\Constants;
use PHPUnit\Framework\TestCase;
use App\Exceptions\HttpException;
use App\Modules\Security\RequestValidator\RequestValidator;
use Psr\Http\Message\ServerRequestInterface;

class RequestValidatorTest extends TestCase
{
    public function testAllowsGoodUserAgent(): void
    {
        $request = $this->createMockRequest(
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
            'GET'
        );

        $requestValidator = new RequestValidator();

        $this->expectNotToPerformAssertions();

        $requestValidator->validate($request);
    }

    public function testBlocksBadUserAgentWithExactMatch(): void
    {
        $request = $this->createMockRequest(
            'AhrefsBot/7.0 (+http://ahrefs.com/robot/)',
            'GET'
        );

        $requestValidator = new RequestValidator();

        $this->expectException(HttpException::class);
        $this->expectExceptionCode(Constants::HTTP_ERRORS[403]['code']);
        $this->expectExceptionMessage(Constants::HTTP_ERRORS[403]['message']);

        $requestValidator->validate($request);
    }

    public function testBlocksBadUserAgentWithPartialMatch(): void
    {
        $request = $this->createMockRequest(
            'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)',
            'GET'
        );

        $requestValidator = new RequestValidator();

        $this->expectException(HttpException::class);
        $this->expectExceptionCode(Constants::HTTP_ERRORS[403]['code']);
        $this->expectExceptionMessage(Constants::HTTP_ERRORS[403]['message']);

        $requestValidator->validate($request);
    }

    public function testBlocksRequestWithInvalidMethod(): void
    {
        $request = $this->createMockRequest(
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
            'FAKE'
        );

        $requestValidator = new RequestValidator();

        $this->expectException(HttpException::class);
        $this->expectExceptionCode(Constants::HTTP_ERRORS[405]['code']);
        $this->expectExceptionMessage(Constants::HTTP_ERRORS[405]['message']);

        $requestValidator->validate($request);
    }

    public function testAllowsValidHttpMethod(): void
    {
        $request = $this->createMockRequest(
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
            'GET'
        );

        $requestValidator = new RequestValidator();

        $this->expectNotToPerformAssertions();

        $requestValidator->validate($request);
    }

    private function createMockRequest(string $userAgent, string $method): ServerRequestInterface
    {
        $request = $this->createMock(ServerRequestInterface::class);

        $request->method('getHeaderLine')
            ->willReturn($userAgent);

        $request->method('getMethod')
            ->willReturn($method);

        return $request;
    }
}
