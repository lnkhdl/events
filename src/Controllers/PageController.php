<?php

namespace App\Controllers;

class PageController
{
    public function index()
    {
        require_once(__DIR__ . '/../Templates/index.php');
    }

    public function about()
    {
        require_once(__DIR__ . '/../Templates/about.php');
    }

    public function contact()
    {
        require_once(__DIR__ . '/../Templates/contact.php');
    }
}