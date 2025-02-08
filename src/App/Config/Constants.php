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

namespace App\Config;

class Constants
{
    public const THEME_CONFIG_FILE_PATH = __DIR__ . '/../../../templates/themes/themes.yaml';

    public const HTTP_ERRORS = [
        400 => ["code" => 400, "message" => "Bad Request"],
        401 => ["code" => 401, "message" => "Unauthorized"],
        402 => ["code" => 402, "message" => "Payment Required"],
        403 => ["code" => 403, "message" => "Forbidden"],
        404 => ["code" => 404, "message" => "Not Found"],
        405 => ["code" => 405, "message" => "Method Not Allowed"],
        406 => ["code" => 406, "message" => "Not Acceptable"],
        407 => ["code" => 407, "message" => "Proxy Authentication Required"],
        408 => ["code" => 408, "message" => "Request Timeout"],
        409 => ["code" => 409, "message" => "Conflict"],
        410 => ["code" => 410, "message" => "Gone"],
        411 => ["code" => 411, "message" => "Length Required"],
        412 => ["code" => 412, "message" => "Precondition Failed"],
        413 => ["code" => 413, "message" => "Payload Too Large"],
        414 => ["code" => 414, "message" => "URI Too Long"],
        415 => ["code" => 415, "message" => "Unsupported Media Type"],
        416 => ["code" => 416, "message" => "Range Not Satisfiable"],
        417 => ["code" => 417, "message" => "Expectation Failed"],
        418 => ["code" => 418, "message" => "I'm a Teapot"],
        421 => ["code" => 421, "message" => "Misdirected Request"],
        422 => ["code" => 422, "message" => "Unprocessable Entity"],
        423 => ["code" => 423, "message" => "Locked"],
        424 => ["code" => 424, "message" => "Failed Dependency"],
        425 => ["code" => 425, "message" => "Too Early"],
        426 => ["code" => 426, "message" => "Upgrade Required"],
        428 => ["code" => 428, "message" => "Precondition Required"],
        429 => ["code" => 429, "message" => "Too Many Requests"],
        431 => ["code" => 431, "message" => "Request Header Fields Too Large"],
        451 => ["code" => 451, "message" => "Unavailable For Legal Reasons"],
        500 => ["code" => 500, "message" => "Internal Server Error"],
        501 => ["code" => 501, "message" => "Not Implemented"],
        502 => ["code" => 502, "message" => "Bad Gateway"],
        503 => ["code" => 503, "message" => "Service Unavailable"],
        504 => ["code" => 504, "message" => "Gateway Timeout"],
        505 => ["code" => 505, "message" => "HTTP Version Not Supported"],
        506 => ["code" => 506, "message" => "Variant Also Negotiates"],
        507 => ["code" => 507, "message" => "Insufficient Storage"],
        508 => ["code" => 508, "message" => "Loop Detected"],
        510 => ["code" => 510, "message" => "Not Extended"],
        511 => ["code" => 511, "message" => "Network Authentication Required"],
    ];
}
