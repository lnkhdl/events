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
    "/error404" => "ErrorController@error404",
    "/error500" => "ErrorController@error500"
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