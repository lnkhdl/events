<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use App\Core\DependencyInjector;
use App\Core\Config;
use App\Core\View;
use App\Core\Request;
use App\Core\Router;


$di = new DependencyInjector();

$configFile = __DIR__ . '/../src/Config/config.php';
$config = new Config($configFile);
$di->set('Config', $config);

$dbConfigFile = __DIR__ . '/../src/Config/database.php';
$dbConfig = new Config($dbConfigFile);
$db = new PDO('mysql:host=' . $dbConfig->get('DB_HOST') . ';dbname=' . $dbConfig->get('DB_NAME'), $dbConfig->get('DB_USER'), $dbConfig->get('DB_PASS'));
$di->set('PDO', $db);

$view = new View($di);
$di->set('View', $view);

$request = new Request();

require_once($config->get('ROUTES_FILE'));
$routes = new Router($get, $post, $di);

$routes->route($request);