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

    public function GetSettings(array $routes): RouteSettings
    {
        $uri     = parse_url($_SERVER["REQUEST_URI"])["path"];
        $request = $_SERVER["REQUEST_METHOD"];

        if(!isset($routes[$request]) || !array_key_exists($uri, $routes[$request]))
        {
            http_response_code(404);
            echo "Rota não encontrada!"; die;
        }

        return $routes[$request][$uri];
    }
}