<?php

class Controller_Site extends Framework\Controller_Template {

    public $template = 'default_template';

    public function after()
    {
        $styles  = array(
                '/media/default/css/norm.css'  => 'screen',
                '/media/default/css/style.css' => 'screen',
        );
        $scripts = array(
                'http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js',
        );

        $this->template->styles = array_merge( $this->template->styles, $styles );
        $this->template->scripts = array_merge( $this->template->scripts, $scripts );

        parent::after();
    }
}
