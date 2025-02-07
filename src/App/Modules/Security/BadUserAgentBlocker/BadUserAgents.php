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

class BadUserAgents
{
    const BAD_USER_AGENTS = [
        'AhrefsBot',
        'MJ12bot',
        'SemrushBot',
        'DotBot',
        'SeznamBot',
        'Baiduspider',
        'YandexBot',
        'SpiderBot',
        'Exabot',
        'GrapeshotCrawler',
        'CCBot',
        'PetalBot',
        'ZoominfoBot',
        'DataForSeoBot',
        'MegaIndex.ru',
        'BLEXBot',
        'LinkpadBot',
        'Sogou web spider',
        'Scrapy',
        'HttpClient',
        'Python-urllib',
        'curl',
        'Wget',
        'Go-http-client',
        'Java/',
        'libwww-perl',
        'PHPCrawl',
        'WebZIP',
        'sqlmap',
        'nikto',
        'Acunetix',
        'Netsparker',
        'dirbuster',
        'wpscan',
        'owasp',
        'nessus',
        'OpenVAS',
        'Qualys',
        'Burp Suite',
        'ZAP',
        'Arachni',
        'Hydra',
        'Metasploit',
        'Nmap',
        'masscan',
        'zgrab',
        'Xenu Link Sleuth',
        'HTTrack',
        'WinHTTP',
        'WinInet',
        'WebDAV',
        'spbot',
        'SiteLockSpider',
        'Mail.RU_Bot',
        'ia_archiver',
        'archive.org_bot',
        'Barkrowler',
        'BaiduSpark',
        'Ezooms',
        'Genieo',
        'heritrix',
        'IstellaBot',
        'Linguee Bot',
        'lmspider',
        'meanpathbot',
        'Mediatoolkitbot',
        'omgili',
        'PageThing',
        'Panscient.com',
        'proximic',
        'Qwantify',
        'rogerbot',
        'SafeDNSBot',
        'Scanbot',
        'Screaming Frog SEO Spider',
        'SISTRIX',
        'Siteimprove.com',
        'SMTBot',
        'SurveyBot',
        'TurnitinBot',
        'Uptimebot',
        'WebCollage',
        'WebStripper',
        'WebSucker',
        'WebCopier',
        'WebAuto',
        'WebReaper',
        'WebShrinker',
        'WebZIP',
        'Wotbox',
        'YisouSpider',
        'ZmEu',
        'ZumBot'
    ];
}
