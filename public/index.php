<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use App\Core\JsonParser;
use App\Core\Request;
use App\Core\Router;

$configFile = __DIR__ . '/../src/Config/config.json';
$config = new JsonParser($configFile);

$dbConfigFile = __DIR__ . '/../src/Config/database.json';
$dbConfig = new JsonParser($dbConfigFile);

$request = new Request();

$routes = new Router();
require_once(__DIR__ . '/../src/Core/routes.php');

$routes->route($request);