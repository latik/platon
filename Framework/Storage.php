<?php 

namespace Framework;

class Storage {
    
    protected $_data = array();
   
    public function __get($key) {
        if (array_key_exists($key, $this->_data))
        {
            return $this->_data[$key];
        }
        else
            return null;
    }
    
    public function __set($key, $value) {
        $this->_data[$key] = $value;
    }   
}