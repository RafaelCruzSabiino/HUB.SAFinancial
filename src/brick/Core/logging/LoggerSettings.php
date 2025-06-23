<?php

namespace Hub\Financial\brick\Core\logging;

class LoggerSettings
{
    public string $AppName = "";
    public string $Path = "";
    
    public function __construct(
        string $appName, 
        string $path)
    {
        $this->AppName = $appName;
        $this->Path = $path;
    }
}