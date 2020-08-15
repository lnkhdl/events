<?php

namespace App\Core;

class DependencyInjector
{
    protected $dependencies = [];

    public function set(string $name, object $object): void
    {
        $this->dependencies[$name] = $object;
    }

    public function get(string $name): ?object
    {
        return $this->dependencies[$name] ?? null;
    }
}