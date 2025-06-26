<?php

namespace Hub\Financial\bricks\Core\exception;

class ConfigurationNotImplementedException extends GeneralException
{
    public function __construct(string $message)
    {
        parent::__construct("Erro na configuração: {$message}");
    }
}