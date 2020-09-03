<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\DependencyInjector;

class Controller
{
    protected $view;
    protected $request;

    public function __construct(DependencyInjector $di, Request $request)
    {
        $this->view = $di->get('View');
        $this->request = $request;
    }
}