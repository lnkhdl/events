<?php

namespace App\Core\Routing;

class RouteFactory
{
    /**
     * Array of Route objects
     */
    private $routes = [];

    /**
     * Creates Route objects and adds them into the array
     */
    public function create(array $routes): array
    {
        foreach ($routes as $route) {
            $this->routes[] = $this->createRouteObject($route);
        }

        return $this->routes;
    }

    private function createRouteObject($routeData): Route
    {
        list($method, $pattern, $controller, $action) = explode('|', $routeData);
        $route = new Route();
        $route->setMethod($method)->setPattern($pattern)->setController($controller)->setAction($action);
        return $route;
    }



}