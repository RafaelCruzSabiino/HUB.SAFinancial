<?php

namespace Hub\Financial\brick\API\config;

class RouteSettings
{
    public string $Controller = "";
    public string $Action = "";

    public function __construct(
        string $controller,
        string $action)
    {
        $this->Controller = $controller;
        $this->Action = $action;
    }
}