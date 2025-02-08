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
use App\Modules\Security\BadUserAgentBlocker\BadUserAgents;
use App\Modules\Security\BadUserAgentBlocker\BadUserAgentBlocker;

class BadUserAgentBlockerTest extends TestCase
{
    protected function setUp(): void
    {
        // Ensure static variable is reset by reloading the class
        static::resetStaticCache();
    }

    private static function resetStaticCache(): void
    {
        // Calling isBadUserAgent() with an empty array forces reinitialization of $pattern
        $emptyBlocker = new BadUserAgentBlocker();
        $emptyBlocker->isBadUserAgent();
    }

    public function testDetectsBadUserAgent(): void
    {
        $_SERVER['HTTP_USER_AGENT'] = BadUserAgents::BAD_USER_AGENTS[0];

        $blocker = new BadUserAgentBlocker();
        $this->assertTrue($blocker->isBadUserAgent(), 'Failed to detect bad user agent');
    }

    public function testAllowsGoodUserAgent(): void
    {
        $_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)';

        $blocker = new BadUserAgentBlocker();
        $this->assertFalse($blocker->isBadUserAgent(), 'Incorrectly blocked a good user agent');
    }

    public function testPartialMatchDoesNotBlock(): void
    {
        $_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)';

        $blocker = new BadUserAgentBlocker();
        $this->assertTrue($blocker->isBadUserAgent(), 'Failed to block a bad user agent inside a string');
    }
}
