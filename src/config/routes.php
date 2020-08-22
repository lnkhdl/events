<?php

$get = [
    "/" => "PageController@index",
    "/index" => "PageController@index",
    "/about" => "PageController@about",
    "/contact" => "PageController@contact",
    "/events" => "EventController@index",
    "/event/{id}" => "EventController@show",
    "/event/create" => "EventController@create",
    "/event/{id}/edit" => "EventController@edit",
    "/event/{name}/{id}/{name}" => "EventController@test"
];

$post = [
    "/event/add" => "EventController@add"
];

$put = [
    "/event/{id}" => "EventController@update"
];

$delete = [
    "/event/{id}" => "EventController@destroy"
];