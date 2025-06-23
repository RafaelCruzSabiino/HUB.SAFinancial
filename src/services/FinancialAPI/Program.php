<?php

namespace Hub\Financial\services\FinancialAPI;

use Exception;
use DI\ContainerBuilder;
use Hub\Financial\bricks\API\config\RouteSettings;
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

            $controllerInstance = $container->get("Hub\\Financial\\services\\FinancialAPI\\controllers\\{$settings->Controller}");
            $action = $settings->Action;
            
            return $controllerInstance->$action();
        }
        catch(Exception $ex)
        {        
            http_response_code(500);
            return $ex->getMessage();
        }
    }
}