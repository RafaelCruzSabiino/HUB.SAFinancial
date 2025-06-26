<?php

namespace Hub\Financial\services\Domain\interfaces\applications;

use Hub\Financial\services\Domain\dtos\AuthenticationDto;
use Hub\Financial\services\Domain\dtos\TokenDto;

interface IAuthenticationApplication
{
    public function GenerateToken(AuthenticationDto $authenticationDto) : TokenDto; 
}