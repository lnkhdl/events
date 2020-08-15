<?php

namespace App\Controllers;

class ErrorController extends Controller
{
    public function error()
    {
        $this->view->render('error');
    }
}