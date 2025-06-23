<?php

namespace Hub\Financial\bricks\API\config;

class RouteSettings
{
    public string $Project = "";
    public string $Controller = "";
    public string $Action = "";

    public function __construct(
        string $project,
        string $controller,
        string $action)
    {
        $this->Project = $project;
        $this->Controller = $controller;
        $this->Action = $action;
    }
}