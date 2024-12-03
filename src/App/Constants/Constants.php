<?php declare(strict_types=1);

if (!defined('SERVER_ROOT')) {
    define(
        'SERVER_ROOT',
        (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']
    );
}

if (!defined('WEB_SERVER_ROOT')) {
    define(
        'WEB_SERVER_ROOT',
        'https://self-hosted.commercify.store'
    );
}

if (!defined('DOCS_ROOT')) {
    define(
        'DOCS_ROOT',
        WEB_SERVER_ROOT . '/docs'
    );
}

if (!defined('ERRORS_ROOT')) {
    define(
        'ERRORS_ROOT',
        WEB_SERVER_ROOT . '/error'
    );
}
