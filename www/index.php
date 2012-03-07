<?php 
// SET PHP ENVIRONMENT
@error_reporting(E_ALL | E_STRICT);
@ini_set('error_reporting', E_ALL | E_STRICT);
@ini_set('display_errors', '1');
@ini_set('display_startup_errors', '1');
@ini_set('ignore_repeated_errors', '1');
date_default_timezone_set('UTC');

// use composer autoload class
require_once __DIR__.'/../vendor/.composer/autoload.php';

?>