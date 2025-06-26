<?php

namespace Hub\Financial\bricks\Core\mapper;

interface IMapper
{
    public function MapObject(object $obj, string $model) : object;
}