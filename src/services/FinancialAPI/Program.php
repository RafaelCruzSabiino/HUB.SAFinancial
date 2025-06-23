<?php

namespace Hub\Financial\services\FinancialAPI;

use Exception;
use DI\ContainerBuilder;
use Hub\Financial\brick\API\config\RouteSettings;
use Hub\Financial\services\FinancialAPI\configurations\Configuration;

class Program
{
    public function __construct(private Configuration $configuration = new Configuration()){}

    public function Main(RouteSettings $settings): mixed
    {
        try
        {
            $builder = new ContainerBuilder();
            $builder->addDefinitions($this->configuration->ConfigureDependencies());
            $container = $builder->build();

            $controllerInstance = $container->get("Hub\\Financial\\src\\services\\FinancialAPI\\controllers\\".$settings->Controller);
            
            return $controllerInstance->$settings->Action();
        }
        catch(Exception $ex)
        {        
            throw $ex;
        }
    }
}