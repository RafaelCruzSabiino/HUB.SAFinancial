<?php

namespace Hub\Financial\bricks\API;

use Throwable;
use DI\ContainerBuilder;
use Hub\Financial\bricks\API\config\RouteSettings;
use Hub\Financial\bricks\Core\config\IConfiguration;
use Hub\Financial\bricks\API\exception\HttpException;
use Hub\Financial\bricks\Core\exception\ConfigurationNotImplementedException;

class API
{
    public function RunApp(array $routes, IConfiguration $configuration): mixed
    {
        try
        {
            $settings = $this->GetSettings($routes);
            $controllerInstance = $this->Build($settings, $configuration);
            $action = $settings->Action;
            
            return $controllerInstance->$action();
        }
        catch(HttpException $ex)
        {
            http_response_code($ex->statusCode);
            return ["error" => $ex->getMessage()];
        }
        catch(Throwable $ex)
        {  
            http_response_code(500);
            return ["error" => $ex->getMessage()];
        }
    }

    private function GetSettings(array $routes): RouteSettings
    {
        $uri     = parse_url($_SERVER["REQUEST_URI"])["path"];
        $request = $_SERVER["REQUEST_METHOD"];

        if(!isset($routes[$request]) || !array_key_exists($uri, $routes[$request]))
            throw new HttpException("Rota não encontrada", 404);

        $settings = $routes[$request][$uri];

        if(empty($settings->Project)
            || empty($settings->Controller)
            || empty($settings->Action))
            throw new ConfigurationNotImplementedException("Build Rotas");

        return $settings;
    }

    private function Build(RouteSettings $settings, IConfiguration $configuration): mixed
    {  
        $builder = new ContainerBuilder();
        $builder->addDefinitions($configuration->ConfigureDependencies());
        $container = $builder->build();

        return $container->get("Hub\\Financial\\services\\{$settings->Project}\\controllers\\{$settings->Controller}");
    }
}