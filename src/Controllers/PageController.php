<?php
declare(strict_types=1);

namespace App\Controllers;

class PageController extends Controller
{
    public function contact()
    {
        return $this->response->render('contact');
    }
}