<?php

namespace Hub\Financial\projects\FinancialAPI\configurations;

use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use Hub\Financial\services\Domain\dtos\AuthenticationDto;
use Hub\Financial\services\Domain\entities\AuthenticationEntity;

class MapperConfiguration
{
    public static function ConfigureMapper() : AutoMapperInterface
    {
        return AutoMapper::initialize(function (AutoMapperConfig $config) 
        {
            $config->registerMapping(AuthenticationDto::class, AuthenticationEntity::class);
        });
    }
}