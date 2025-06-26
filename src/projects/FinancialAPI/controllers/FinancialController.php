<?php

namespace Hub\Financial\projects\FinancialAPI\controllers;

use Hub\Financial\bricks\Core\logging\ILoggerAdapter;
use Hub\Financial\services\Domain\dtos\AuthenticationDto;
use Hub\Financial\services\Domain\dtos\TokenDto;
use Hub\Financial\services\Domain\interfaces\applications\IAuthenticationApplication;

class FinancialController
{
    public function __construct(
        private ILoggerAdapter $logger,
        private IAuthenticationApplication $application){}

    public function Consultar() : TokenDto
    {
        $dto = new AuthenticationDto();
        $dto->User = "rcsabino@pascholotto.com.br";
        $dto->Password = "123456";

        return $this->application->GenerateToken($dto);
    }
}

