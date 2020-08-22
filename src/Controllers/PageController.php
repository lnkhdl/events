<?php

namespace App\Controllers;

class PageController extends Controller
{
    public function index()
    {
        return $this->view->render('index');
    }

    public function about()
    {
        return $this->view->render('about');
    }

    public function contact()
    {
        return $this->view->render('contact');
    }
}