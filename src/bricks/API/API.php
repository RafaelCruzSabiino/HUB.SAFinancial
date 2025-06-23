<?php

namespace Hub\Financial\bricks\API;

use Exception;
use DI\ContainerBuilder;
use Hub\Financial\bricks\API\config\RouteSettings;
use Hub\Financial\bricks\Core\config\IConfiguration;

class API
{
    public function Build(RouteSettings $settings, IConfiguration $configuration): mixed
    {
        try
        {
            $builder = new ContainerBuilder();
            $builder->addDefinitions($configuration->ConfigureDependencies());
            $container = $builder->build();

            $controllerInstance = $container->get("Hub\\Financial\\services\\{$settings->Project}\\controllers\\{$settings->Controller}");
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