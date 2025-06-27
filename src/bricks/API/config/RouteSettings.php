<?php

namespace Hub\Financial\bricks\API\config;

class RouteSettings
{
    public string $Project = "";
    public string $Controller = "";
    public string $Action = "";
    public array $Requests = [];

    public function __construct(
        string $project,
        string $controller,
        string $action,
        array $requests = [])
    {
        $this->Project = $project;
        $this->Controller = $controller;
        $this->Action = $action;
        $this->Requests = $requests;
    }

    public function Dispatch(mixed $route) : mixed
    {
        $action = $this->Action;

        if(count($this->Requests) > 0)
        {
            return call_user_func_array([$route, $action], $this->Requests);
        }

        return $route->$action();
    }
}