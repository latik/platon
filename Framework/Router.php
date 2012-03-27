<?php

namespace Framework;

Class Router {
    
    protected $request;
    protected $parsed = false;
    protected $routes = array();
    
    function __construct(Request $request, $routes) {
        $this->request = $request;
        $this->routes  = $routes;
    }
    
    private function _parse() {

       $tmp = array_filter(explode('/', $this->request->uri, 4)); 

       $this->Controller = 'Controller_' . (($controller = array_shift($tmp)) ?  $controller : 'Main');
       $this->Action     = ($action = array_shift($tmp)) ? $action : 'index';
       $this->Params     = (!empty($tmp)) ? implode('/', $tmp) : '';
              
       $this->parsed = true;
       
       unset($tmp);
    }

    public function getController() {
        if (!$this->parsed) 
        {
            $this->_parse();
        }
        return $this->Controller;
    }
    
    public function getAction() {
        if (! $this->parsed)
        {
            $this->_parse();
        }
        return $this->Action;
    }
    
    public function getParams() {
        if (! $this->parsed) 
        {
            $this->_parse();
        }
        return $this->Params;
    }

}