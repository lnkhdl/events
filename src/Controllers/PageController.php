<?php

namespace App\Controllers;

class PageController extends Controller
{
    public function index()
    {
        return $this->response->render('index');
    }

    public function about()
    {
        return $this->response->render('about');
    }

    public function contact()
    {
        return $this->response->render('contact');
    }

    public function test(int $id, string $name)
    {
        echo "Test page<br>";
        echo "ID: " . $id . "<br>";
        echo "Name: " . $name . "<br";
    }
}