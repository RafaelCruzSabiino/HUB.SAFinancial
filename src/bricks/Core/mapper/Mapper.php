<?php

namespace Hub\Financial\bricks\Core\mapper;

use AutoMapperPlus\AutoMapperInterface;

class Mapper implements IMapper
{
    public function __construct(private AutoMapperInterface $mapper){}
    
    public function MapObject(object $obj, string $model) : object
    {
        return $this->mapper->map($obj, $model);
    }
    
    public function MapRequest(array $data, string $model): object
    {   
        return $this->mapper->map($data, $model);
    }
}