<?php
declare(strict_types=1);

namespace App\Controllers;

class PageController extends Controller
{
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