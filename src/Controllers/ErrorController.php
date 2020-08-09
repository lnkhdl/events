<?php

namespace App\Controllers;

class ErrorController
{
    public function error()
    {
        require_once(__DIR__ . '/../Templates/error.php');
    }
}