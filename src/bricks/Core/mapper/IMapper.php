<?php

namespace Hub\Financial\bricks\Core\mapper;

interface IMapper
{
    public function MapObject(object $obj, string $model) : object;
    public function MapRequest(array $data, string $model): object;
}