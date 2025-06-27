<?php

namespace Hub\Financial\projects\FinancialAPI\controllers;

use Hub\Financial\bricks\Core\logging\ILoggerAdapter;
use Hub\Financial\bricks\Core\mapper\IMapper;
use Hub\Financial\services\Domain\dtos\AuthenticationDto;
use Hub\Financial\services\Domain\dtos\TokenDto;
use Hub\Financial\services\Domain\interfaces\applications\IAuthenticationApplication;

class FinancialController
{
    public function __construct(
        private ILoggerAdapter $logger,
        private IAuthenticationApplication $application,
        private IMapper $mapper){}

    public function Consultar(array $request) : TokenDto
    {
        return $this->application->GenerateToken(
            $this->mapper->MapRequest($request, AuthenticationDto::class)
        );
    }
}

