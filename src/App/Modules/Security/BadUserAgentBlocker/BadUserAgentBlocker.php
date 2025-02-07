<?php

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

namespace App\Modules\Security\BadUserAgentBlocker;

class BadUserAgentBlocker
{
    private $userAgent;

    public function __construct()
    {
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    }

    public function isBadUserAgent(): bool
    {
        foreach (BadUserAgents::BAD_USER_AGENTS as $badAgent) {
            if (stripos($this->userAgent, $badAgent) !== false) {
                error_log("Blocked bad user agent: $this->userAgent");
                return true;
            }
        }  
        
        return false;
    }
}
