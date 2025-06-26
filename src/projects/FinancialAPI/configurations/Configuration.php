<?php

namespace Hub\Financial\projects\FinancialAPI\configurations;

use Hub\Financial\bricks\Core\config\EnvLoader;
use Hub\Financial\bricks\Core\config\IConfiguration;
use Hub\Financial\bricks\Core\logging\MonoLogger;
use Hub\Financial\bricks\Core\logging\ILoggerAdapter;
use Hub\Financial\bricks\Core\logging\LoggerSettings;
use Hub\Financial\bricks\Core\mapper\IMapper;
use Hub\Financial\bricks\Core\mapper\Mapper;
use Hub\Financial\services\Application\AuthenticationApplication;
use Hub\Financial\services\Infrastructure\config\RepositoryConfiguration;
use Hub\Financial\services\Infrastructure\repositories\AuthenticationRepository;
use Hub\Financial\services\Domain\interfaces\applications\IAuthenticationApplication;
use Hub\Financial\services\Domain\interfaces\infrastructures\IAuthenticationInfrastructure;

class Configuration implements IConfiguration
{   
    private static EnvLoader $envLoader;
    
    public function __construct()
    {
        self::$envLoader = new EnvLoader("FinancialAPI.env");
    }

    public static function ConfigureApp() : array
    {
        RepositoryConfiguration::ConfigureRepository(self::$envLoader);

        return  [
                    IMapper::class => \DI\create(Mapper::class)->constructor(
                        MapperConfiguration::ConfigureMapper()),
                    LoggerSettings::class => \DI\create(LoggerSettings::class)->constructor(
                        self::$envLoader->get('APP_NAME') ?? "",
                        self::$envLoader->get('PATH_LOG') ?? ""                 
                    ),
                    ILoggerAdapter::class => \DI\get(MonoLogger::class),
                    IAuthenticationApplication::class => \DI\get(AuthenticationApplication::class),
                    IAuthenticationInfrastructure::class => \DI\get(AuthenticationRepository::class)
                ];
    }
}