<?php

namespace Hub\Financial\bricks\Core\config;

use AutoMapperPlus\AutoMapperInterface;

interface IConfiguration
{
    public function getEnvLoader() : EnvLoader;
    public function ConfigureDependencies() : array;
    public function ConfigureMapper() : AutoMapperInterface;
}