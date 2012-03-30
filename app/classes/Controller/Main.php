<?php

class Controller_Main extends Controller_Site {

        public function index()
        {
            $this->template->title        = 'Main';
            $this->template->description  = 'description this page - This main page';
            $this->template->content      = 'Content main page!!!!<br/>';

            $user = new Model_User($this->registry);

            $content = $user->getname();

            $this->template->content      = $content . '<br>';
            
            $this->template->content .= $this->request->user_agent . '<br>';

            //Передаем переменные в вьюху

            $data = array();

            $this->template->content .= Framework\View::factory('main', $data);
        }
}
