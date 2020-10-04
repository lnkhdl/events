<?php

namespace App\Controllers;

use ReflectionMethod;
use Exception;

class ControllerValidator
{
    public function validate(string $controllerClassName, string $action, array $parameters): void
    {
        $reflection = new ReflectionMethod('\\App\\Controllers\\' . $controllerClassName, $action);

        if (count($parameters) !== count($reflection->getParameters())) {
            throw new Exception("Number of parameters from the path does not match number of parameters expected in the Controller's method.");
        }
    }
}