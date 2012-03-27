<?php

namespace Framework;

class Controller_Template extends Controller {

    public $template = 'default_template';

    public function before()
    {
        parent::before();

        // подгружаю вьюху в свойство контроллера
        $this->template = View::factory($this->template);

        // Initialize empty values
        $this->template->title       = '';
        $this->template->description = '';
        $this->template->content     = '';
        $this->template->styles      = array();
        $this->template->scripts     = array();
    }

    public function after()
    {
        // в тело ответа записываю вывод вью
        $this->response->body = $this->template->render();

        parent::after();
    }
}
