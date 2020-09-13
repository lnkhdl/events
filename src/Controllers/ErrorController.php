<?php

namespace App\Controllers;

class ErrorController extends Controller
{
    public function error404()
    {
        http_response_code(404);
        return $this->view->render('errors/404');
    }

    public function error500()
    {
        http_response_code(500);
        return $this->view->render('errors/500');
    }
}