<?php

namespace Hub\Financial\services\Application;

use Hub\Financial\bricks\Core\logging\ILoggerAdapter;
use Hub\Financial\services\Domain\dtos\TokenDto;
use Hub\Financial\services\Domain\dtos\AuthenticationDto;
use Hub\Financial\services\Domain\interfaces\applications\IAuthenticationApplication;
use Hub\Financial\services\Domain\interfaces\infrastructures\IAuthenticationInfrastructure;

class AuthenticationApplication implements IAuthenticationApplication
{
    public function __construct(
        private ILoggerAdapter $logger,
        private IAuthenticationInfrastructure $infra){}

    public function GenerateToken(AuthenticationDto $authenticationDto) : TokenDto
    {
        return new TokenDto();
    }
}