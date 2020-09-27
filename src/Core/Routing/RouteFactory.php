<?php

namespace App\Core\Routing;

class RouteFactory
{
    public function create(array $routes): array
    {
        $routeObjects = [];
        foreach ($routes as $route) {
            array_push($routeObjects, $this->createRouteObject($route));
        }

        return $routeObjects;
    }

    private function createRouteObject($routeData): Route
    {
        list($method, $pattern, $controller, $action) = explode('|', $routeData);
        $route = new Route();
        $route->setMethod($method)->setPattern($pattern)->setController($controller)->setAction($action);
        return $route;
    }
}