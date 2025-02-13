<?php declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Throwable;

class HttpException extends Exception
{
    private int $statusCode;

    public function __construct(int $statusCode, string $message = "", ?Throwable $previous = null) {
        parent::__construct($message, $statusCode, $previous);
        $this->statusCode = $statusCode;
    }

    public function getStatusCode(): int {
        return $this->statusCode;
    }
}
