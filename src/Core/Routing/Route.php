<?php

namespace App\Core\Routing;

class Route
{
    private $method;
    private $pattern;
    private $controller;
    private $action;

    /**
     * Get the value of method
     */ 
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Set the value of method
     *
     * @return Route
     */ 
    public function setMethod(string $method): Route
    {
        $this->method = strtoupper($method);

        return $this;
    }

    /**
     * Get the value of pattern
     */ 
    public function getPattern(): string
    {
        return $this->pattern;
    }

    /**
     * Set the value of pattern
     *
     * @return Route
     */ 
    public function setPattern(string $pattern): Route
    {
        $this->pattern = $pattern;

        return $this;
    }

    /**
     * Get the value of controller
     */ 
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * Set the value of controller
     *
     * @return Route
     */ 
    public function setController(string $controller): Route
    {
        $this->controller = $controller;

        return $this;
    }

    /**
     * Get the value of action
     */ 
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * Set the value of action
     *
     * @return Route
     */ 
    public function setAction(string $action): Route
    {
        $this->action = $action;

        return $this;
    }
}