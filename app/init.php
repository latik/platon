<?php 

$registry = Framework\Registry::getInstance();

// setup DB settings
$registry->db_config = (array)include(APPPATH . '/config/database.php');

// setup cache settings
$registry->cache_config = (array)include(APPPATH . '/config/cache.php');

// setup route settings
$registry->routes_config = (array)include(APPPATH . '/config/routes.php');