<?php 

return array
(
    '^articles/2003/$' => array('controller'=>'articles', 'action' =>'show_year'),
    '^about/$'         => array('controller'=>'about', 'action' =>'show'),
    '^contact/$'       => array('controller'=>'about', 'action' =>'contact'),
);