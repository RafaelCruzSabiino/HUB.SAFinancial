<?php

namespace Hub\Financial\bricks\Core\exception;

use Exception;

class GeneralException extends Exception
{
    public int $statusCode;

    public function __construct(string $message, int $statusCode = 500)
    {
        parent::__construct($message);
        $this->statusCode = $statusCode;
    }
}