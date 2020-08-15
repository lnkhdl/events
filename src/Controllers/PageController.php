<?php

namespace App\Controllers;

class PageController extends Controller
{
    public function index()
    {
        $this->view->render('index');
    }

    public function about()
    {
        $this->view->render('about');
    }

    public function contact()
    {
        $this->view->render('contact');
    }
}