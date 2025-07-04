<?php

namespace Hub\Financial\bricks\Core\logging;

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
    
    public function SetInfo(string $mensagem) : void
    {   
        $log = $this->Set(Level::Info);
        $log->info($mensagem);
    }   
    
    private function Set(Level $level) : Logger
    {
        $log  = new Logger($this->settings->AppName);
        $log->pushHandler(new StreamHandler($this->settings->Path.date("Ymd").".log", $level));

        return $log;
    }
}