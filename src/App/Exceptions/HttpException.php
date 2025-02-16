<?php declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Throwable;

class HttpException extends Exception
{
    private int $statusCode;

    /**
     * @param int $statusCode
     * @param string $message
     * @param Throwable|null $previous
     */
    public function __construct(int $statusCode, string $message = "", ?Throwable $previous = null) {
        parent::__construct($message, $statusCode, $previous);
        $this->statusCode = $statusCode;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int {
        return $this->statusCode;
    }
}
