<?php

$get = [
    "/" => "PageController@index",
    "/index" => "PageController@index",
    "/about" => "PageController@about",
    "/contact" => "PageController@contact",
    "/event/{id}" => "EventController@show",
    "/event/{name}/{name}" => "EventController@test",
    "/event/{name}/{id}/{name}" => "EventController@test2"
];

$post = [
    "/event/{id}" => "EventController@edit"
];