<?php

namespace Hub\Financial\services\Domain\interfaces\infrastructures;

use Hub\Financial\services\Domain\entities\AuthenticationEntity;

interface IAuthenticationInfrastructure
{
    public function ValidAutentication(AuthenticationEntity $authenticationEntity) : bool;
}