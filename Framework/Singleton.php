<?php

namespace Framework;

abstract class Singleton {
    
    protected function __construct() {        
    }
    
    final private function __clone() {        
    }
      
    final public static function getInstance() 
    {
        static $_instances = array();
        $calledClassName = get_called_class();

        if (!isset($_instances[$calledClassName]))
        {
            $_instances[$calledClassName] = new static();
        }
        return $_instances[$calledClassName];
    }

}