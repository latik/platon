<?php

namespace Framework;

class Registry extends Singleton {

    protected $values = array();
     
    function __set($id, $value) {
        $this->values[$id] = $value;
    }

    function __get($id) {
        if (!isset($this->values[$id])) 
        {
            throw new Exception(sprintf('Value "%s" is not defined.', $id));
        }
        if (is_callable($this->values[$id])) 
        {
            return $this->values[$id]($this);
        }
        else 
        {
            return $this->values[$id];
        }
    }

    function asShared($callable) {       
        return function ($c) use (&$callable) {           
            static $object;          
            if (is_null($object)) 
            {
                $object = $callable($c);
            }           
            return $object;
        };
    }
}