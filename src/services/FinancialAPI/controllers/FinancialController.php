<?php

namespace Hub\Financial\services\FinancialAPI\controllers;

use Hub\Financial\bricks\Core\logging\ILoggerAdapter;

class FinancialController
{
    public function __construct(private ILoggerAdapter $logger){}

    public function Consultar() : string
    {
        $this->logger->SetInfo("Teste");
        return "teste";
    }
}

