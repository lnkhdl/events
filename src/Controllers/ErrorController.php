<?php

namespace App\Controllers;

class ErrorController extends Controller
{
    public function error()
    {
        return $this->view->render('error');
    }
}