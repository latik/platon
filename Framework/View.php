<?php 

namespace Framework;

class View extends Storage {
    
    public static function factory($template, array $data = array())
    {
        return new View($template, $data);
    }
    
    function __construct($template, array $data = array())
    {       
        $this->name = str_replace('_', '/', strtolower($template));
        $this->filename = APPPATH . 'classes/View' . DIRECTORY_SEPARATOR . $this->name . '.php';
        $this->_data = array_unique(array_merge($this->_data, $data));
    }
    
    public function render() 
    {
        $data = $this->_data;       
        extract($data, EXTR_SKIP);
        
        $evaluator = function ($match) use ($data)
        {
            if (isset($data[$match[1]]))
            {
                return $data[$match[1]];
            }       
            return $match[1];
        };        
        
        if (is_file($this->filename)) 
        {
            ob_start();
            include $this->filename;
            return preg_replace_callback('/\{\{s*(.+?)\s*\}\}/', $evaluator, ob_get_clean());
        }
        else 
        {
            return false;
        }
    }
    
    public function __toString() {
        return (string)$this->render();
    }
}