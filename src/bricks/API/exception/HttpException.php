<?php

namespace Hub\Financial\bricks\API\exception;

use Exception;

class HttpException extends Exception
{
    public int $statusCode;

    public function __construct(string $message, int $statusCode = 500)
    {
        parent::__construct($message);
        $this->statusCode = $statusCode;
    }
}
