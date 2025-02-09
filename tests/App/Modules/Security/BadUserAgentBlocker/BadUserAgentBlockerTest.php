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

use PHPUnit\Framework\TestCase;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use App\Modules\Security\BadUserAgentBlocker\BadUserAgents;
use App\Modules\Security\BadUserAgentBlocker\BadUserAgentBlocker;

class BadUserAgentBlockerTest extends TestCase
{
    private Psr17Factory $psr17Factory;
    private ServerRequestCreator $requestCreator;

    protected function setUp(): void {
        $this->psr17Factory = new Psr17Factory();
        $this->requestCreator = new ServerRequestCreator(
            $this->psr17Factory,
            $this->psr17Factory,
            $this->psr17Factory,
            $this->psr17Factory
        );

        // Reset static cache before each test
        $this->resetRequestCheck();
    }

    private function resetRequestCheck(): void {
        $request = $this->requestCreator->fromGlobals();
        $emptyBlocker = new BadUserAgentBlocker($request);
        $emptyBlocker->isBadUserAgent();
    }

    public function testDetectsBadUserAgent(): void {
        $request = $this->requestCreator
            ->fromGlobals()
            ->withHeader('User-Agent', BadUserAgents::BAD_USER_AGENTS[0]);

        $blocker = new BadUserAgentBlocker($request);
        $this->assertTrue($blocker->isBadUserAgent(), 'Failed to detect bad user agent');
    }

    public function testAllowsGoodUserAgent(): void {
        $request = $this->requestCreator
            ->fromGlobals()
            ->withHeader('User-Agent', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');

        $blocker = new BadUserAgentBlocker($request);
        $this->assertFalse($blocker->isBadUserAgent(), 'Incorrectly blocked a good user agent');
    }

    public function testBlocksBadUserAgentWithPartialMatch(): void {
        $request = $this->requestCreator
            ->fromGlobals()
            ->withHeader('User-Agent', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)');

        $blocker = new BadUserAgentBlocker($request);
        $this->assertTrue($blocker->isBadUserAgent(), 'Failed to block a known bad user agent inside a string');
    }
}
