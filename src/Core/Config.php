<?php

namespace App\Core;

class Config
{
    private $params = [];

    public function __construct($filePath)
    {
        $this->params = require_once $filePath;
    }

    public function has($paramKey): bool
    {
        return isset($this->params[$paramKey]);
    }

    public function get($paramKey): ?string
    {
        return $this->params[$paramKey] ?? null;
    }

}