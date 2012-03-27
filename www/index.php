<?php
// SET PHP ENVIRONMENT
@error_reporting(E_ALL | E_STRICT);
@ini_set('error_reporting', E_ALL | E_STRICT);
@ini_set('display_errors', '1');
@ini_set('display_startup_errors', '1');
@ini_set('ignore_repeated_errors', '1');

// Default timezone of server
date_default_timezone_set('UTC');

// Site dirs
define ('DOCROOT', str_replace('www', '', realpath(__DIR__)));
define ('APPPATH', DOCROOT . 'app'. DIRECTORY_SEPARATOR );

require_once __DIR__.'/../vendor/.composer/autoload.php';

// Run engine
$app = new Framework\Application;
$app->load_config();
$app->run();
$app->sendResponse();
