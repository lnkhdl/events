<?php

namespace App\Core;

use App\Core\Routing\{
    RouteFactory, 
    Router, 
    Request\RequestFactory,
    Response\Response
};
use App\Controllers\ControllerValidator;
use App\Model\Service\ServiceFactory;
use Exception;

class App
{
    public static function boot()
    {
        $definedRoutes = require_once Config::get('ROUTES_FILE');
        $routeFactory = new RouteFactory;
        $routes = $routeFactory->create($definedRoutes);

        $requestFactory = new RequestFactory;
        $request = $requestFactory->create();

        $router = new Router;
        $currentRoute = $router->getCurrentRoute($request, $routes);

        $request->setParameters($router->getParameters($request->getPath(), $currentRoute->getPattern()));

        $validator = new ControllerValidator;
        $validator = $validator->validate($currentRoute->getController(), $currentRoute->getAction(), $request->getParameters());

        if (substr($currentRoute->getPattern(), 0, 5) === "/api/") {
            $response = new Response('api');
        } else {
            $response = new Response('web');
        }

        $injector = new DependencyInjector;

        $dbConfig = require Config::get('DATABASE_DETAILS');
        $pdoStorage = new PdoStorage($dbConfig['DB_HOST'], $dbConfig['DB_NAME'], $dbConfig['DB_USER'], $dbConfig['DB_PASS']);
        $injector->set('Storage', $pdoStorage);

        $serviceFactory = new ServiceFactory($pdoStorage);
        $injector->set('ServiceFactory', $serviceFactory);

        $controller = '\\App\\Controllers\\' . $currentRoute->getController();
        $controller = new $controller($request, $response, $injector);

        call_user_func_array([$controller, $currentRoute->getAction()], $request->getParameters());
    }
}