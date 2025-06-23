<?php

namespace Hub\Financial\bricks\Core\logging;

use Exception;

interface ILoggerAdapter
{    
    public function SetError(Exception $e) : void;
    public function SetWarning(Exception $e) : void;
    public function SetInfo(Exception $e) : void;
}