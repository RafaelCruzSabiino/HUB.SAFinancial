<?php

namespace Hub\Financial\brick\Core\logging;

use Exception;
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class MonoLogger implements ILoggerAdapter
{
    public function __construct(private LoggerSettings $settings){}
    
    public function SetError(Exception $e) : void
    {   
        $log = $this->Set(Level::Error);
        $log->error($e->getMessage(), $e->getTrace());
    }     
        
    public function SetWarning(Exception $e) : void
    {   
        $log = $this->Set(Level::Warning);
        $log->warning($e->getMessage(), $e->getTrace());
    }   
    
    public function SetInfo(Exception $e) : void
    {   
        $log = $this->Set(Level::Info);
        $log->info($e->getMessage(), $e->getTrace());
    }   
    
    private function Set(Level $level) : Logger
    {
        $log  = new Logger($this->settings->AppName);
        $log->pushHandler(new StreamHandler($this->settings->Path, $level));

        return $log;
    }
}