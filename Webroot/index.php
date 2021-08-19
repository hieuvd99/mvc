<?php

define('WEBROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_FILENAME"]));
define('BASEPATH', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_FILENAME"]));

// require(ROOT . 'Config/core.php');
// require(ROOT . 'router.php');
// require(ROOT . 'request.php');
// require(ROOT . 'dispatcher.php');

require __DIR__ . './../vendor/autoload.php';

use mvc\Dispatcher;

$dispatch = new Dispatcher();
$dispatch->dispatch();

?>