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
use Hub\Financial\bricks\Core\mapper\IMapper;
use Hub\Financial\bricks\Core\mapper\Mapper;
use Hub\Financial\services\Application\AuthenticationApplication;
use Hub\Financial\services\Domain\dtos\AuthenticationDto;
use Hub\Financial\services\Domain\entities\AuthenticationEntity;
use Hub\Financial\services\Infrastructure\config\RepositoryConfiguration;
use Hub\Financial\services\Infrastructure\repositories\AuthenticationRepository;
use Hub\Financial\services\Domain\interfaces\applications\IAuthenticationApplication;
use Hub\Financial\services\Domain\interfaces\infrastructures\IAuthenticationInfrastructure;

class Configuration implements IConfiguration
{    
    public function __construct(private EnvLoader $envLoader = new EnvLoader("FinancialAPI.env")){}
    
    public function getEnvLoader() : EnvLoader
    {
        return $this->envLoader;
    }

    public function ConfigureDependencies() : array
    {
        RepositoryConfiguration::ConfigureRepository($this->envLoader);

        return  [
                    IConfiguration::class => \DI\get(Configuration::class),
                    IMapper::class => \DI\get(Mapper::class),
                    LoggerSettings::class => \DI\create(LoggerSettings::class)->constructor(
                        $this->envLoader->get('APP_NAME') ?? "",
                        $this->envLoader->get('PATH_LOG') ?? ""                 
                    ),
                    ILoggerAdapter::class => \DI\get(MonoLogger::class),
                    IAuthenticationApplication::class => \DI\get(AuthenticationApplication::class),
                    IAuthenticationInfrastructure::class => \DI\get(AuthenticationRepository::class)
                ];
    }

    public function ConfigureMapper() : AutoMapperInterface
    {
        return AutoMapper::initialize(function (AutoMapperConfig $config) 
        {
            $config->registerMapping(AuthenticationDto::class, AuthenticationEntity::class);
        });
    }
}