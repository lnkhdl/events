<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use App\Core\Config;
use App\Core\Request;
use App\Core\Router;

$configFile = __DIR__ . '/../src/Config/config.php';
$config = new Config($configFile);

$dbConfigFile = __DIR__ . '/../src/Config/database.php';
$dbConfig = new Config($dbConfigFile);

$request = new Request();

require_once(__DIR__ . '/../src/Config/routes.php');
$routes = new Router($get, $post);

$routes->route($request);