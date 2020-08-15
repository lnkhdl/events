<?php

namespace App\Controllers;

class EventController extends Controller
{
    public function test($name1, $id, $name2)
    {
        $data = [
            'name1' => $name1,
            'id' => $id,
            'name2' => $name2
        ];

        $this->view->render('events/show', $data);
    }
}