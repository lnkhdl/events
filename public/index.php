<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use App\Core\DependencyInjector;
use App\Core\Config;
use App\Core\View;
use App\Core\Request;
use App\Core\Router;
use App\Core\PdoStorage;
use App\Model\Service\ServiceFactory;

$di = new DependencyInjector();

$configFile = __DIR__ . '/../config/config.php';
$config = new Config($configFile);
$di->set('Config', $config);

/*
$dbConfigFile = __DIR__ . '/../config/database.php';
$dbConfig = new Config($dbConfigFile);
$db = new PDO('mysql:host=' . $dbConfig->get('DB_HOST') . ';dbname=' . $dbConfig->get('DB_NAME'), $dbConfig->get('DB_USER'), $dbConfig->get('DB_PASS'));
$di->set('PDO', $db);
*/

$dbConfigFile = __DIR__ . '/../config/database.php';
$dbConfig = new Config($dbConfigFile);
$pdoStorage = new PdoStorage($dbConfig->get('DB_HOST'), $dbConfig->get('DB_NAME'), $dbConfig->get('DB_USER'), $dbConfig->get('DB_PASS'));
$di->set('Storage', $pdoStorage);

$serviceFactory = new ServiceFactory($pdoStorage);
$di->set('ServiceFactory', $serviceFactory);

$view = new View($di);
$di->set('View', $view);


$request = new Request();

require_once($config->get('ROUTES_FILE'));
$routes = new Router($get, $post, $di);

$routes->route($request);