<?php

namespace Hub\Financial\projects\FinancialAPI\configurations;

use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\AutoMapperInterface;
use Hub\Financial\bricks\Core\config\EnvLoader;
use Hub\Financial\bricks\Core\logging\MonoLogger;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use Hub\Financial\bricks\Core\config\IConfiguration;
use Hub\Financial\bricks\Core\logging\ILoggerAdapter;
use Hub\Financial\bricks\Core\logging\LoggerSettings;

class Configuration implements IConfiguration
{    
    public function __construct(private EnvLoader $envLoader = new EnvLoader("FinancialAPI.env")){}
    
    public function getEnvLoader() : EnvLoader
    {
        return $this->envLoader;
    }

    public function ConfigureDependencies() : array
    {
        return  [
                    LoggerSettings::class => \DI\create(LoggerSettings::class)->constructor(
                        $this->envLoader->get('APP_NAME') ?? "",
                        $this->envLoader->get('PATH_LOG') ?? ""                 
                    ),
                    ILoggerAdapter::class => \DI\get(MonoLogger::class)
                ];
    }

    public function ConfigureMapper() : AutoMapperInterface
    {
        return AutoMapper::initialize(function (AutoMapperConfig $config) 
        {});
    }
}