<?php

namespace App\Core\Routing;

use App\Core\Routing\Request\Request;
use Exception;

class Router
{
    private $regexTypes = [
        'int' => '\d+',
        'string' => '\w+'
    ];

    public function getCurrentRoute(Request $request, array $routes): Route
    {
        foreach ($routes as $route) {
            if ($route->getMethod() === $request->getMethod()) {
                $uriRegex = $this->getUriRegex($route->getPattern());
                if (preg_match('@^' . $uriRegex . '$@', $request->getPath())) {
                    return $route;
                }
            }
        }
        
        throw new Exception('Page not found', 404);
    }

    /* 
     * This method changes {int} or {string} from the defined routes to its regex,
     * so it can be compared with the current request path which contains e.g. the actual number
     */
    private function getUriRegex(string $uri): string
    {
        foreach ($this->regexTypes as $type => $regex) {
            $uri = str_replace('{' . $type . '}', $regex, $uri);
        }

        return $uri;
    }

    /* 
     * Loops through the expected parameters defined in the route's pattern,
     * once found, e.g. {int} it is then saved into $params like ['int' => '1']
     */
    public function getParameters(string $requestPath, string $routePattern): array
    {
        $params = [];

        $pathParts = explode('/', $requestPath);
        $routeParts = explode('/', $routePattern);

        foreach($routeParts as $index => $part) {
            if (preg_match('/{(.*?)}/', $part)) {
                $params[substr($routeParts[$index], 1, -1)] = $pathParts[$index];
            }
        }

        return $params;
    }
}
