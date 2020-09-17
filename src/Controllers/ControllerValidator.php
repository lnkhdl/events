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
            throw new Exception("Number of parameters from path do not match number of parameters expected in the Controller's method.");
        }

        /*
        foreach ($reflection->getParameters() as $key => $parameter) {
            $type = $parameter->getType();
            assert($type instanceof \ReflectionNamedType);
            if ($type->getName() !== array_keys($parameters)[$key]) {
                throw new Exception('Parameters from path do not match parameters from the Controller method.');
            }
        }
        */
    }

}