<?php
declare(strict_types=1);

namespace App\Core;

class DependencyInjector
{
    protected $dependencies = [];

    public function set(string $name, object $object): void
    {
        $this->dependencies[$name] = $object;
    }

    public function get(string $name)
    {
        return $this->dependencies[$name] ?? null;
    }
}