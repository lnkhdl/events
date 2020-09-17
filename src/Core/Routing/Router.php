<?php

namespace App\Core\Routing;

use App\Core\Routing\Request\Request;

class Router
{
    private $regexTypes = [
        'int' => '\d+',
        'string' => '\w+'
    ];

    public function getCurrentRoute(Request $request, array $routes): ?Route
    {
        foreach ($routes as $route) {
            if ($route->getMethod() === $request->getMethod()) {
                $uriRegex = $this->getUriRegex($route->getPattern());
                if (preg_match('@^' . $uriRegex . '$@', $request->getPath())) {
                    return $route;
                }
            }
        }
        return null;
    }

    private function getUriRegex($uri): string
    {
        foreach ($this->regexTypes as $type => $regex) {
            $uri = str_replace('{' . $type . '}', $regex, $uri);
        }

        return $uri;
    }

    public function getParameters($requestPath, $route): array
    {
        $params = [];

        $pathParts = explode('/', $requestPath);
        $routeParts = explode('/', $route);

        foreach($routeParts as $index => $part) {
            if (preg_match('/{(.*?)}/', $part)) {
                $params[substr($routeParts[$index], 1, -1)] = $pathParts[$index];
            }
        }
        return $params;
    }
}
