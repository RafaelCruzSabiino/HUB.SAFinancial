<?php

namespace Hub\Financial\services\Application;

use Hub\Financial\bricks\Core\exception\GeneralException;
use Hub\Financial\bricks\Core\logging\ILoggerAdapter;
use Hub\Financial\bricks\Core\mapper\IMapper;
use Hub\Financial\services\Domain\dtos\TokenDto;
use Hub\Financial\services\Domain\dtos\AuthenticationDto;
use Hub\Financial\services\Domain\entities\AuthenticationEntity;
use Hub\Financial\services\Domain\interfaces\applications\IAuthenticationApplication;
use Hub\Financial\services\Domain\interfaces\infrastructures\IAuthenticationInfrastructure;
use Throwable;

class AuthenticationApplication implements IAuthenticationApplication
{
    public function __construct(
        private ILoggerAdapter $logger,
        private IAuthenticationInfrastructure $infra,
        private IMapper $mapper){}

    public function GenerateToken(AuthenticationDto $authenticationDto) : TokenDto
    {
        try
        {
            $authenticationDto->Encrypt();

            if(!$this->infra->ValidAutentication(
                $this->mapper->MapObject($authenticationDto, AuthenticationEntity::class)))
                throw new GeneralException("Usuário não encontrado!", 401);

            return new TokenDto();
        }
        catch(Throwable $ex)
        {
            $this->logger->SetError($ex);
            throw $ex;
        }
    }
}