<?php 

namespace Framework;

class Response extends Storage {
    
    public static function factory() {
        return new Response();
    }
     
    public function __construct($content = '', $status = 200, $headers = array()) {
        $this->content = $content;
        $this->status  = $status;
        $this->headers = $headers;
    }

    public function sendHeaders() {      
        header($this->header);    
    }

    public function sendContent() {       
        //echo htmlspecialchars($this->body, ENT_QUOTES, 'UTF-8');
        echo $this->body;
    }
    
    public function send()
    {
        $this->sendHeaders();
        $this->sendContent();
        if (function_exists('fastcgi_finish_request')) 
        {
            fastcgi_finish_request();
        }
    }   
    
    public function setContent($content) {
        $this->body = (string) $content;
    }
    
    public function setStatus($status) {
        $this->status = (int) $status;
    }
    
    public function setHeader() {}
}  