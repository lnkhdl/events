<?php

$get = [
    "/" => "PageController@index",
    "/index" => "PageController@index",
    "/about" => "PageController@about",
    "/contact" => "PageController@contact",
    "/event/{name}/{id}/{name}" => "EventController@test"
];

$post = [
    "/event/{id}" => "EventController@edit"
];