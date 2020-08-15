<?php

namespace App\Core;

use App\Controllers\ErrorController;

class Router
{
    public $getRoutes = array();
    public $postRoutes = array();
    protected $regexTypes = [
        'id' => '\d+',
        'name' => '\w+'
    ];
    protected $di;

    public function __construct($get, $post, $di)
    {
        $this->getRoutes = $get;
        $this->postRoutes = $post;
        $this->di = $di;
    }

    public function route(Request $request)
    {
        if ($request->getMethod() === 'GET') {
            $routes = $this->getRoutes;
        } else if ($request->getMethod() === 'POST') {
            $routes = $this->postRoutes;
        }

        foreach ($routes as $uri => $cont) {
            $uriRegex = $this->getUriRegex($uri);
            if (preg_match('@^' . $uriRegex . '$@', $request->getPath())) {
                list($controller, $method) = explode('@', $cont);
                return $this->callController($request, $uri, $controller, $method);
            }
        }

        return call_user_func(array(new ErrorController($this->di, $request), 'Error'));
    }

    public function getUriRegex($uri): string
    {
        foreach ($this->regexTypes as $type => $regex) {
            $uri = str_replace('{' . $type . '}', $regex, $uri);
        }

        return $uri;
    }

    public function getParams($requestPath, $route): array
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

    public function callController($request, $route, $controller, $method): void
    {
        $controller = '\\App\\Controllers\\' . $controller;
        $controller = new $controller($this->di, $request);

        $params = $this->getParams($request->getPath(), $route);

        call_user_func_array([$controller, $method], $params);
    }
}
