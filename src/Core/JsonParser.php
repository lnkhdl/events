<?php

namespace App\Core;

class JsonParser
{
    protected $params = [];

    public function __construct($filePath)
    {
        $strJsonFileContents = file_get_contents($filePath);
        $this->params = json_decode($strJsonFileContents, true);
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