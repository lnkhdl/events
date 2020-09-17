<?php

namespace App\Controllers;

use App\Core\Routing\{
    Request\Request,
    Response\ResponseInterface
};
use App\Core\DependencyInjector;

class Controller
{
    protected $request;
    protected $response;
    protected $injector;

    public function __construct(Request $request, ResponseInterface $response, DependencyInjector $injector)
    {
        $this->request = $request;
        $this->response = $response;
        $this->injector = $injector;
    }
}