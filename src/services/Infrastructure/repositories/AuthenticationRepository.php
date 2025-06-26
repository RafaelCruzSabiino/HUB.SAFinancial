<?php

namespace Hub\Financial\services\Infrastructure\repositories;

use Hub\Financial\services\Domain\entities\AuthenticationEntity;
use Hub\Financial\services\Domain\interfaces\infrastructures\IAuthenticationInfrastructure;

class AuthenticationRepository implements IAuthenticationInfrastructure
{
    public function ValidAutentication(AuthenticationEntity $authenticationEntity) : bool
    {
        return AuthenticationEntity::where('user', $authenticationEntity->user)
                                    ->where('password', $authenticationEntity->password)
                                    ->exists();
    }
}