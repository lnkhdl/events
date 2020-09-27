<?php

namespace App\Core;

class Config
{
    public static $params = [];

    public static function get($paramKey): string
    {
        if (!self::$params) {
            self::$params = require $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        }

        return self::$params[$paramKey];
    }
}