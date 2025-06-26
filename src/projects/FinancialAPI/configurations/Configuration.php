<?php

namespace Hub\Financial\projects\FinancialAPI\configurations;

use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\AutoMapperInterface;
use Hub\Financial\bricks\Core\config\EnvLoader;
use Hub\Financial\bricks\Core\logging\MonoLogger;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use Illuminate\Database\Capsule\Manager as Capsule;
use Hub\Financial\bricks\Core\config\IConfiguration;
use Hub\Financial\bricks\Core\logging\ILoggerAdapter;
use Hub\Financial\bricks\Core\logging\LoggerSettings;
use Hub\Financial\bricks\Core\exception\ConfigurationNotImplementedException;

class Configuration implements IConfiguration
{    
    public function __construct(private EnvLoader $envLoader = new EnvLoader("FinancialAPI.env")){}
    
    public function getEnvLoader() : EnvLoader
    {
        return $this->envLoader;
    }

    public function ConfigureDependencies() : array
    {
        $this->ConfigureRepository();

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

    private function ConfigureRepository() : void
    {
        if(empty($this->envLoader->get('DB_DRIVER'))
            || empty($this->envLoader->get('DB_HOST'))
            || empty($this->envLoader->get('DB_BASE'))
            || empty($this->envLoader->get('DB_USER'))
            || empty($this->envLoader->get('DB_SENHA')))
            throw new ConfigurationNotImplementedException("Repository");

        $capsule = new Capsule;

        $capsule->addConnection([
            'driver'    => $this->envLoader->get('DB_DRIVER'),
            'host'      => $this->envLoader->get('DB_HOST'),
            'database'  => $this->envLoader->get('DB_BASE'),
            'username'  => $this->envLoader->get('DB_USER'),
            'password'  => $this->envLoader->get('DB_SENHA'),
            'charset'   => $this->envLoader->get('DB_CHARSET') ?? "utf8",
            'collation' => $this->envLoader->get('DB_COLLATION') ?? "utf8_unicode_ci",
            'prefix'    => $this->envLoader->get('DB_PREFIX') ?? ""
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}