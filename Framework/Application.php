<?php

namespace Framework;

class Application {

    private $registry;

    public function __construct()
    {
    	// получаем экземпляр объекта реестра
        $this->registry = Registry::getInstance();
		
        // описываем объект-свойство request, создаваться он будет при первом вызове
        $this->registry->request = $this->registry->asShared(function ($c) {
            return new Request($c);
        });
        
        // описываем объект-свойство response, создаваться он будет при первом вызове      
        $this->registry->response = $this->registry->asShared(function ($c) {
            return new Response($c);
        });
        
        // описываем объект-свойство db, создаваться он будет при первом вызове      
        $this->registry->db = $this->registry->asShared(function ($c) {
            return new Database($c);
        });

    }

    public function load_config()
    {
        // Загружаем конфиги из папки с приложением
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
	
    /*
     * Основная часть, 
     * создает запрос из пользовательского ввода, 
     * находит кто будет запрос будет обрабатывать, 
     * и передает ему запрос
     */
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
