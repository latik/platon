<?php

namespace Framework;

class Request extends Storage {

    function __construct() {
        $this->method       = isset($_SERVER['REQUEST_METHOD']) ? strtoupper(Security::sanitize($_SERVER['REQUEST_METHOD'])) : 'GET';
        $this->post         = isset($_SERVER['$_POST']) ? Security::sanitize($_SERVER['$_POST']) : NULL;
        $this->get          = isset($_SERVER['$_GET']) ? Security::sanitize($_SERVER['$_GET']) : NULL;
        $this->http_host    = isset($_SERVER['HTTP_HOST']) ? Security::sanitize($_SERVER['HTTP_HOST']) : NULL;
        $this->user_agent   = isset($_SERVER['HTTP_USER_AGENT']) ? Security::sanitize($_SERVER['HTTP_USER_AGENT']) : NULL;
        $this->http_referer = isset($_SERVER['HTTP_REFERER']) ? Security::sanitize($_SERVER['HTTP_REFERER']) : NULL;
        $this->session      = isset($_SESSION) ? Security::sanitize($_SESSION) : NULL;
        $this->cookie       = !empty($_COOKIE) ? Security::sanitize($_COOKIE) : NULL;
        $this->files        = !empty($_FILES) ? Security::sanitize($_FILES) : NULL;
        $this->uri          = $this->detect_uri();
    }

    public function detect_uri()    {
        if ( ! empty($_SERVER['PATH_INFO']))
        {
            $uri = $_SERVER['PATH_INFO'];
        }
        else
        {
            if (isset($_SERVER['REQUEST_URI']))
            {
                $uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
            }
            elseif (isset($_SERVER['PHP_SELF']))
            {
                $uri = $_SERVER['PHP_SELF'];
            }
            elseif (isset($_SERVER['REDIRECT_URL']))
            {
                $uri = $_SERVER['REDIRECT_URL'];
            }
            else {
                throw new Exception('Unable to detect the URI using PATH_INFO, REQUEST_URI, PHP_SELF or REDIRECT_URL');
            }
        }

        // Reduce multiple slashes to a single slash
        $uri = preg_replace('#//+#ui', '/', $uri);

        // Remove all dot-paths from the URI, they are not valid
        $uri = preg_replace('#\.[\s./]*/#ui', '', $uri);

        // sanitize uri with php filter
        $uri = filter_var($uri, FILTER_SANITIZE_URL);

        return $uri;
    }
}
