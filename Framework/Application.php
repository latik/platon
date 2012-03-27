<?php

namespace Framework;

class Application {

    private $registry;

    public function __construct()
    {
        $this->registry = Registry::getInstance();

        $this->registry->request = $this->registry->asShared(function ($c) {
            return new Request($c);
        });

        $this->registry->response = $this->registry->asShared(function ($c) {
            return new Response($c);
        });

        $this->registry->db = $this->registry->asShared(function ($c) {
            return new Database($c);
        });

    }

    public function load_config()
    {
        // Загружаем конфиги
        if (file_exists(APPPATH . 'init.php'))
        {
            include APPPATH . 'init.php';

            return $this;
        }
        else
        {
            throw new Exception('Configuration not exists :(');
        }
    }

    public function run()
    {

       // создаем объект request, хранящий параметры запроса
       $request  = $this->registry->request;

       // создаем объект response, хранящий ответ
       $response  = $this->registry->response;

       // создаем объект router, выбирающий подходящий контроллер для обработки запроса
       $routes   = $this->registry->routes_config;
       $router   = new Router($request, $routes);

       // получаем из роутера имя контроллера и его параметры
       $controller_name        = $router->getController();
       $controller_action      = $router->getAction();
       $controller_params      = $router->getParams();

       // создаем экземпляр контроллера и запускаем его с параметрами
       $controller = new $controller_name($request, $response);
       $controller->before();
       $controller->$controller_action($controller_params);
       $controller->after();

    }

    public function sendResponse()
    {
        $this->registry->response->send();
    }
}
