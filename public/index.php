<?php

// Default timezone of server
date_default_timezone_set('UTC');

// Site dirs
define ('DOCROOT', dirname(__DIR__). DIRECTORY_SEPARATOR);
define ('APPPATH', DOCROOT . 'app'. DIRECTORY_SEPARATOR);

require_once __DIR__ . '/../vendor/autoload.php';

// Run engine
$app = new Framework\Application;
$app->load_config();
$app->run();
$app->sendResponse();
