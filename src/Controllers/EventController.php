<?php

namespace App\Controllers;

class EventController
{
    public function show($id)
    {
        echo 'This is event ID: ' . $id;
    }
    
    public function test($name1, $name2)
    {
        echo 'This is event: ' . $name1 . ' and ' . $name2;
    }

    public function test2($name1, $id, $name2)
    {
        echo 'This is event: <br>' . $name1 . '<br>' . $id . '<br>' . $name2;
    }
}