<?php

namespace App\Controllers;

use App\Validation\EventValidator;

class EventController extends Controller
{
    public function test($name1, $id, $name2)
    {
        $data = [
            'name1' => $name1,
            'id' => $id,
            'name2' => $name2
        ];

        return $this->view->render('events/show', $data);
    }

    public function create()
    {
        return $this->view->render('events/create');
    }

    public function add()
    {
        $validator = new EventValidator($this->request->getPost());
        $validator->validate();

        if (!$validator->hasErrors()) {
            return $this->view->render('events/create', $this->request->getPost(), $validator->getErrors());
        }

        return $this->view->render('events/index', $this->request->getPost());
    }
}