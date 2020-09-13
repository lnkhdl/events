<?php

namespace App\Core;

use App\Controllers\ErrorController;

class Router
{
    private $request;
    private $di;
    private $routes = [];
    private $regexTypes = [
        'id' => '\d+',
        'name' => '\w+'
    ];

    public function __construct($request, $di, $get, $post, $put, $delete)
    {
        $this->request = $request;
        $this->di = $di;
        $this->routes = $this->getCurrentMethodRoutes($get, $post, $put, $delete);
    }

    public function route()
    {
        foreach ($this->routes as $uri => $cont) {
            $uriRegex = $this->getUriRegex($uri);
            if (preg_match('@^' . $uriRegex . '$@', $this->request->getPath())) {
                list($controller, $method) = explode('@', $cont);
                return $this->callController($this->request, $uri, $controller, $method);
            }
        }

        return call_user_func(array(new ErrorController($this->di, $this->request), 'error404'));
    }

    private function getCurrentMethodRoutes(array $get, array $post, array $put, array $delete): array
    { 
        switch ($this->request->getMethod()) {
            case 'GET':
                return $get;
            case 'POST':
                return $post;
            case 'PUT':
                return $put;
            case 'DELETE':
                return $delete;
        }
    }

    private function getUriRegex($uri): string
    {
        foreach ($this->regexTypes as $type => $regex) {
            $uri = str_replace('{' . $type . '}', $regex, $uri);
        }

        return $uri;
    }

    private function getParams($requestPath, $route): array
    {
        $params = [];

        $pathParts = explode('/', $requestPath);
        $routeParts = explode('/', $route);

        foreach($routeParts as $index => $part) {
            if (preg_match('/{(.*?)}/', $part)) {
                array_push($params, $pathParts[$index]);
            }
        }

        return $params;
    }

    private function callController($request, $route, $controller, $method): void
    {
        $controller = '\\App\\Controllers\\' . $controller;
        $controller = new $controller($this->di, $request);

        $params = $this->getParams($request->getPath(), $route);

        call_user_func_array([$controller, $method], $params);
    }
}
