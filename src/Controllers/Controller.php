<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\DependencyInjector;

class Controller
{
    protected $db;
    protected $view;
    protected $request;

    public function __construct(DependencyInjector $di, Request $request)
    {
        $this->db = $di->get('PDO');
        $this->view = $di->get('View');
        $this->request = $request;
    }
}