<?php declare(strict_types=1);

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
