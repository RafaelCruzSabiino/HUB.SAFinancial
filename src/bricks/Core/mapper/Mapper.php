<?php

namespace Hub\Financial\bricks\Core\mapper;

use AutoMapperPlus\AutoMapperInterface;
use Hub\Financial\bricks\Core\config\IConfiguration;

class Mapper implements IMapper
{
    private AutoMapperInterface $mapper;

    public function __construct(private IConfiguration $config)
    {
        $this->mapper = $config->ConfigureMapper();
    }
    
    public function MapObject(object $obj, string $model) : object
    {
        return $this->mapper->map($obj, $model);
    }
}