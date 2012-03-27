<?php

namespace Framework;

class Controller {

    protected $request;
    protected $response;

    function __construct(Request $request, Response $response) {
        $this->request  = $request;
        $this->response = $response;
        $this->registry = Registry::getInstance();
    }

    function before() {
    }

    function after() {
    }
}
