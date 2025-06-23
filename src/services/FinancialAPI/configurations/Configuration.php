<?php

namespace Hub\Financial\services\FinancialAPI\configurations;

use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\AutoMapperInterface;
use Hub\Financial\brick\Core\config\EnvLoader;
use AutoMapperPlus\Configuration\AutoMapperConfig;

class Configuration
{    
    public function __construct(public EnvLoader $envLoader = new EnvLoader("FinancialAPI.env")){}
    
    public function ConfigureDependencies() : array
    {
        return [];
    }

    public function ConfigureMapper() : AutoMapperInterface
    {
        return AutoMapper::initialize(function (AutoMapperConfig $config) 
        {});
    }
}