<?php

namespace Hub\Financial\bricks\Core\exception;

use Exception;

class ConfigurationNotImplementedException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct("Erro na configuração: {$message}");
    }
}